<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class BkashController extends Controller
{
    private $base_url;
    private $username;
    private $password;
    private $app_key;
    private $app_secret;

    public function __construct()
    {
        env('SANDBOX') ? $this->base_url = 'https://tokenized.sandbox.bka.sh/v1.2.0-beta' : $this->base_url = 'https://tokenized.pay.bka.sh/v1.2.0-beta';
        $this->username = env('BKASH_USERNAME');
        $this->password = env('BKASH_PASSWORD');
        $this->app_key = env('BKASH_APP_KEY');
        $this->app_secret = env('BKASH_APP_SECRET');
    }
    public function authHeaders()
    {
        return array(
            'Content-Type:application/json',
            'Authorization:' . $this->grant(),
            'X-APP-Key:' . $this->app_key
        );
    }

    public function curlWithBody($url, $header, $method, $body_data)
    {
        $curl = curl_init($this->base_url . $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $body_data);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }

    function getIdTokenFromRefreshToken($refresh_token){

	    $header = array(
            'Content-Type:application/json',
            'username:' . $this->username,
            'password:' . $this->password
        );

        $body_data = array('app_key' => $this->app_key, 'app_secret' => $this->app_secret, 'refresh_token' => $refresh_token);

        $response = $this->curlWithBody('/tokenized/checkout/token/refresh', $header, 'POST', json_encode($body_data));

        $idToken = json_decode($response)->id_token;

        return $idToken;

    }

    public function grant()
    {

        if (!Schema::hasTable('bkash_token')) {
//            DB::beginTransaction();
            Schema::create('bkash_token', function ($table) {
                $table->boolean('sandbox_mode')->notNullable();
                $table->bigInteger('id_expiry')->notNullable();
                $table->string('id_token', 2048)->notNullable();
                $table->bigInteger('refresh_expiry')->notNullable();
                $table->string('refresh_token', 2048)->notNullable();
            });
            $insertedRows = DB::table('bkash_token')->insert([
                'sandbox_mode' => 1,
                'id_expiry' => 0,
                'id_token' => 'id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'refresh_token',
            ]);

            if ($insertedRows > 0) {

                // echo 'Row inserted successfully.';
            } else {
                echo 'Error inserting row.';
            }



            $insertedRows = DB::table('bkash_token')->insert([
                'sandbox_mode' => 0,
                'id_expiry' => 0,
                'id_token' => 'id_token',
                'refresh_expiry' => 0,
                'refresh_token' => 'refresh_token',
            ]);

            if ($insertedRows > 0) {
                // echo 'Row inserted successfully.';

            } else {
                echo 'Error inserting row.';
            }
//            DB::commit();
        }


//        DB::beginTransaction();

        $sandbox = env('SANDBOX');

        $tokenData = DB::table('bkash_token')->where('sandbox_mode', $sandbox)->first();

        if ($tokenData) {
            // Access the token data
            $idExpiry = $tokenData->id_expiry;
            $idToken = $tokenData->id_token;
            $refreshExpiry = $tokenData->refresh_expiry;
            $refreshToken = $tokenData->refresh_token;

            if($idExpiry>time()){
                // dd("Id token from db: ".$idToken);
                return $idToken;
            }
            if($refreshExpiry>time()){
                $idToken = $this->getIdTokenFromRefreshToken($refreshToken);
                $updatedRows = DB::table('bkash_token')
                    ->where('sandbox_mode',$sandbox)
                    ->update([
                        'id_expiry' => time() + 3600, // Set new expiry time
                        'id_token' => $idToken,
                    ]);

                if ($updatedRows > 0) {
//                    DB::commit();
                    //echo 'Rows updated successfully.';
                } else {
                    //echo 'Error updating rows.';
                }
                // dd("Id token from refresh api: ".$idToken);
                return $idToken;
            }
            // Do something with the token data
        } else {
            echo 'Token not found.';
        }


        $header = array(
            'Content-Type:application/json',
            'username:' . $this->username,
            'password:' . $this->password
        );

        $body_data = array('app_key' => $this->app_key, 'app_secret' => $this->app_secret);

        $response = $this->curlWithBody('/tokenized/checkout/token/grant', $header, 'POST', json_encode($body_data));

        $idToken = json_decode($response)->id_token;

        $updatedRows = DB::table('bkash_token')
            ->where('sandbox_mode',$sandbox)
            ->update([
                'id_expiry' => time() + 3600, // Set new expiry time
                'id_token' => $idToken,
                'refresh_expiry' => time() + 864000,
                'refresh_token' => json_decode($response)->refresh_token,
            ]);

        if ($updatedRows > 0) {
//            DB::commit();
            //echo 'Rows updated successfully.';
        } else {
            //echo 'Error updating rows.';
        }
        // dd("Id token from grant api: ".$idToken);
        return $idToken;
    }

    public function payment(Request $request)
    {
        return view('bkash.pay');
    }

    public function createPayment(Request $request)
    {
        // Step 1: Get payment data from session
        $payment = session('bkash_payment');

        if (!$payment || !$payment['amount'] || $payment['amount'] < 1) {
            return redirect()->back()->with('errorMessage', 'Invalid or expired payment session.');
        }
        $token = $this->grant();

        // Step 2: Prepare request data
        $header = $this->authHeaders();
        $callbackURL = URL::to('/') . route('url-callback', [], false); // uses named route
        $merchantInvoice = $payment['tran_id'] ?? 'Inv_' . Str::random(6);

        $body_data = [
            'mode' => '0011',
            'payerReference' => $payment['phone'] ?? '01700000000',
            'callbackURL' => $callbackURL,
            'amount' => $payment['amount'],
            'currency' => 'BDT',
            'intent' => 'sale',
            'merchantInvoiceNumber' => $merchantInvoice
        ];
        Log::debug('bKash Auth Token:', ['token' => $token]);
        Log::debug('bKash Request Headers:', $header);
        Log::debug('bKash Request Body:', $body_data);

        // Step 3: Send request to bKash API
        $response = $this->curlWithBody('/tokenized/checkout/create', $header, 'POST', json_encode($body_data));
        $res = json_decode($response, true);

        Log::debug('bKash API Response:', ['response' => $response]);

        // Step 4: Handle response
        if (isset($res['bkashURL'])) {
            return redirect()->away($res['bkashURL']);
        }

        // Step 5: Error fallback
        Log::error('bKash Create Payment Failed', ['response' => $res]);
        return redirect()->back()->with('errorMessage', $res['statusMessage'] ?? 'bKash payment initiation failed.');
    }

    public function executePayment($paymentID)
    {

        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID
        );


        $response = $this->curlWithBody('/tokenized/checkout/execute', $header, 'POST', json_encode($body_data));

        return $response;
    }
    public function queryPayment($paymentID)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', json_encode($body_data));

        return $response;
    }

    public function callback(Request $request)
    {
        $paymentID = $request->paymentID ?? null;

        if (!$paymentID || $request->status !== 'success') {
            return $this->renderConfirmationView('Failed', 'Payment was cancelled or failed.', null);
        }


        $response = $this->executePayment($paymentID);
        if(is_null($response)){
            sleep(1);
            $response = $this->queryPayment($request['paymentID']);
        }
        $result = json_decode($response, true);


//        if (!$result || !isset($result['message'])) {
//            sleep(1);
//            $response = $this->queryPayment($paymentID);
//            $result = json_decode($response, true);
//        }

        $invoiceId = $result['merchantInvoiceNumber'] ?? $result['merchantInvoice'] ?? null;
//        dd($response);
        if (
            isset($result['statusCode']) &&
            $result['statusCode'] === '0000' &&
            $result['transactionStatus'] === 'Completed'
        ) {
            // ✅ Protect update
            $updated = DB::table('payment_orders')
                ->where('transaction_id', $invoiceId)
                ->where('status', '!=', 'Complete')
                ->update([
                    'status'     => 'Complete',
                    'updated_at' => now()
                ]);
//            dd($result);
//            DB::commit();
            Log::info('Order status update', [
                'invoiceId' => $invoiceId,
                'updated'   => $updated,
            ]);

            $order = DB::table('payment_orders')
                ->where('transaction_id', $invoiceId)
                ->first();

            if ($order && $order->customer_type === 'B2C' && $order->product_category === 'Course') {
                app(\App\Http\Controllers\paymentController::class)->coursePaymentRedirect($order);
            }

            return view('frontend.payment-success', compact('order'));
        }

        return $this->renderConfirmationView('Failed', $result['statusMessage'] ?? 'Payment failed.', $invoiceId);
    }


    private function renderConfirmationView($status, $message, $tranId = null)
    {
        if ($tranId) {
            DB::table('payment_orders')
                ->where('transaction_id', $tranId)
                ->where('status', '!=', 'Complete') // ✅ protect Complete status
                ->update([
                    'status'     => $status,
                    'updated_at' => now(),
                ]);

            $order = DB::table('payment_orders')->where('transaction_id', $tranId)->first();
        } else {
            $order = (object)[
                'transaction_id'   => 'Unavailable',
                'time'             => now(),
                'name'             => 'N/A',
                'email'            => 'N/A',
                'phone'            => 'N/A',
                'product_name'     => 'N/A',
                'product_category' => 'N/A',
                'status'           => $status,
            ];
        }

        return view('frontend.payment-success', compact('order'));
    }

    public function getRefund(Request $request)
    {
        return view('bkash.refund');
    }

    public function refundPayment(Request $request)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $request->paymentID,
            'trxID' => $request->trxID
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', json_encode($body_data));

        $res_array = json_decode($response, true);

        $message = "Refund Failed !!";

        if (!isset($res_array['refundTrxID'])) {

            $body_data = array(
                'paymentID' => $request->paymentID,
                'amount' => $request->amount,
                'trxID' => $request->trxID,
                'sku' => 'sku',
                'reason' => 'Quality issue'
            );

            $response = $this->curlWithBody('/tokenized/checkout/payment/refund', $header, 'POST', json_encode($body_data));

            $res_array = json_decode($response, true);

            if (isset($res_array['refundTrxID'])) {
                // your database insert operation
                $message = "Refund successful !!.Your Refund TrxID : " . $res_array['refundTrxID'];
            }

        } else {
            $message = "Already Refunded !!.Your Refund TrxID : " . $res_array['refundTrxID'];
        }

        return view('bkash.refund')->with([
            'response' => $message,
        ]);
    }

    public function queryPaymentAPI(Request $request,$paymentID)
    {
        $header = $this->authHeaders();

        $body_data = array(
            'paymentID' => $paymentID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/payment/status', $header, 'POST', json_encode($body_data));

        return $response;
    }


    public function getSearchTransaction(Request $request)
    {
        return view('bkash.search');
    }

    public function searchTransaction(Request $request)
    {

        $header = $this->authHeaders();
        $body_data = array(
            'trxID' => $request->trxID,
        );

        $response = $this->curlWithBody('/tokenized/checkout/general/searchTransaction', $header, 'POST', json_encode($body_data));


        return view('bkash.search')->with([
            'response' => $response,
        ]);
    }

}
