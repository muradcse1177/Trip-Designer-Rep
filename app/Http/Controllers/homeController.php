<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class homeController extends Controller
{
    public function domainCheck(){
        try{
            //$c_domain = $_SERVER['SERVER_NAME'];
            $c_domain = 'tripdesigner.net';
            $rows = DB::table('domain')->where('name',$c_domain)->first();
            $row['domain'] = @$rows->name;
            $row['agent_id'] = @$rows->agent_id;
            return @$row;
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function home(Request $request){
        try{
            $domain =$this->domainCheck();
            //dd($this->domainCheck());
            if($domain['agent_id']) {
                $rows1 = DB::table('airport_details')->get();
                $rows2 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
                $rows3 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->inRandomOrder()->get()->take(12);

                $rows4 = DB::table('b2c_visa')->where('agent_id',$domain['agent_id'])->inRandomOrder()->get()->take(12);
                $rows5 = DB::table('b2c_visa_country')->where('agent_id',$domain['agent_id'])->get();

                $rows9 = DB::table('b2c_manpower_country')->where('agent_id',$domain['agent_id'])->get();
                $rows7 = DB::table('b2c_manpower')->where('agent_id',$domain['agent_id'])->inRandomOrder()->get()->take(12);

                $rows8 = DB::table('b2c_hajj_umrah')->where('agent_id',$domain['agent_id'])->get()->take(12);

                $rows10 = DB::table('b2c_service')->where('agent_id',$domain['agent_id'])->get();

                $rows6 = DB::table('b2c_blog')->where('agent_id',$domain['agent_id'])->inRandomOrder()->get()->take(6);
                return view('home',
                    [
                        'airports' => $rows1, 't_country' => $rows2, 't_package' => $rows3, 'visas' => $rows4,
                        'permits' => $rows7,'u_packages' => $rows8, 'v_country' => $rows5, 'm_country' => $rows9,
                        'blogs' => $rows6,'services' => $rows10,
                    ]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function aboutUs(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows6 = DB::table('b2c_blog')->where('agent_id',$domain['agent_id'])->get();
                return view('frontend.about-us', ['blogs' => $rows6]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchTourPackage(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $count = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get()->count();
                $rows1 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->where('c_name',$request->country)->orderBy('p_p_adult','desc')->get();
                $rows2 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
                return view('frontend.tour-package',['t_package' => $rows1,'t_country' => $rows2,'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function tourPackage(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $count = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get()->count();
                $rows1 = DB::table('b2c_tour_package')->where('agent_id',$domain['agent_id'])->get();
                $rows2 = DB::table('b2c_tour_package_country')->where('agent_id',$domain['agent_id'])->get();
                return view('frontend.tour-pack', ['t_package' => $rows1, 't_country' => $rows2, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchVisa(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_visa')->where('agent_id', $domain['agent_id'])->where('country', $request->country)->first();
                $rows2 = DB::table('b2c_visa_country')->where('agent_id', $domain['agent_id'])->get();
                $rows3 = DB::table('b2c_visa')->where('agent_id', $domain['agent_id'])->inRandomOrder()->limit(5)->get();
                return view('frontend.visa-details', ['visa' => $rows1, 'v_country' => $rows2, 'visas' => $rows3]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchManpower(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                 $count = DB::table('b2c_manpower')->where('agent_id', $domain['agent_id'])->get()->count();
                 $rows1 = DB::table('b2c_manpower')->where('agent_id', $domain['agent_id'])->where('country', $request->country)->get();
                 $rows2 = DB::table('b2c_manpower_country')->where('agent_id', $domain['agent_id'])->get();
                 return view('frontend.work-permit-country', ['v_country' => $rows2, 'visas' => $rows1,'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function visa(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $count = DB::table('b2c_visa')->where('agent_id', $domain['agent_id'])->get()->count();
                $rows2 = DB::table('b2c_visa_country')->where('agent_id', $domain['agent_id'])->get();
                $rows3 = DB::table('b2c_visa')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.visa', ['v_country' => $rows2, 'visas' => $rows3, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function manpower(Request $request){
        try{
            $domain =$this->domainCheck();
            if($domain['agent_id'])  {
                $count = DB::table('b2c_manpower')->where('agent_id', $domain['agent_id'])->get()->count();
                $rows2 = DB::table('b2c_manpower_country')->where('agent_id', $domain['agent_id'])->get();
                $rows3 = DB::table('b2c_manpower')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.work-permit', ['v_country' => $rows2, 'visas' => $rows3, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function service(Request $request){
        try{
            $domain =$this->domainCheck();
            if($domain['agent_id'])  {
                $count = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->get()->count();
                $rows3 = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->get();
                $rows4 = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->where('name', $request->name)->first();
                return view('frontend.service-details', ['services' => $rows3,'ser' => $rows4, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function hajjUmrah(Request $request){
        try{
            $domain =$this->domainCheck();
            if($domain['agent_id'])  {
                $count = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->get()->count();
                $rows3 = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.hajj-umrah', ['t_package' => $rows3, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function services(Request $request){
        try{
            $domain =$this->domainCheck();
            if($domain['agent_id'])  {
                $count = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->get()->count();
                $rows3 = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->get();
                $rows4 = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->where('name', $request->name)->first();
                return view('frontend.services', ['services' => $rows3,'ser' => $rows4, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchTourPackageBySlug(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_tour_package')->where('agent_id', $domain['agent_id'])->where('slug', $request->slug)->first();
                $rows2 = DB::table('b2c_tour_package')->where('agent_id', $domain['agent_id'])->where('c_name', $rows1->c_name)->take(10)->get();
                return view('frontend.tour-package-details', ['package' => $rows1, 't_package' => $rows2]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchVisaBySlug(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_visa')->where('agent_id', $domain['agent_id'])->where('slug', $request->slug)->first();
                $rows2 = DB::table('b2c_visa_country')->where('agent_id', $domain['agent_id'])->get();
                $rows3 = DB::table('b2c_visa')->where('agent_id', $domain['agent_id'])->inRandomOrder()->limit(5)->get();
                return view('frontend.visa-details', ['visa' => $rows1, 'v_country' => $rows2, 'visas' => $rows3]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchHajjUmrahBySlug(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->where('slug', $request->slug)->first();
                $rows3 = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->inRandomOrder()->limit(5)->get();
                return view('frontend.hajj-umrah-details', ['package' => $rows1, 't_package' => $rows3]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchHajjUmrahPackage(Request $request){
        try{
             $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->where('type', $request->type)->get();
                $rows3 = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->inRandomOrder()->limit(5)->get();
                 $count = DB::table('b2c_hajj_umrah')->where('agent_id', $domain['agent_id'])->get()->count();
                return view('frontend.hajj-umrah', ['package' => $rows1, 't_package' => $rows3,'count' => $count]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchManpowerBySlug(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_manpower')->where('agent_id', $domain['agent_id'])->where('slug', $request->slug)->first();
                $rows2 = DB::table('b2c_manpower_country')->where('agent_id', $domain['agent_id'])->get();
                $rows3 = DB::table('b2c_manpower')->where('agent_id', $domain['agent_id'])->inRandomOrder()->limit(5)->get();
                return view('frontend.manpower-details', ['visa' => $rows1, 'v_country' => $rows2, 'visas' => $rows3]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchServiceBySlug(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                 $count = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->get()->count();
                 $rows3 = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->get();
                 $rows4 = DB::table('b2c_service')->where('agent_id', $domain['agent_id'])->where('slug', $request->slug)->first();
                 return view('frontend.service-details', ['services' => $rows3,'ser' => $rows4, 'count' => $count,]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function searchBlogBySlug(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows1 = DB::table('b2c_blog')->where('agent_id', $domain['agent_id'])->where('slug', $request->slug)->first();
                $rows3 = DB::table('b2c_blog')->where('agent_id', $domain['agent_id'])->inRandomOrder()->limit(5)->get();
                return view('frontend.blog', ['blog' => $rows1, 'blogs' => $rows3,]);
            }
            else{
                    return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
                }
            }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function orderRequest(Request $request){
        try{
            //dd($request);
            $domain =$this->domainCheck();
            $num = substr(str_shuffle(str_repeat($x='0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(8/strlen($x)) )),1,8);
             if($domain['agent_id'])  {
                 //dd($request);
                $result = DB::table('order_request')->insert([
                    'agent_id' => $domain['agent_id'],
                    'r_ref' => $num,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'person' => $request->person,
                    'view' => $request->view,
                    'date' => date('Y-m-d'),
                    'r_type' => $request->r_type,
                    'status' => 'Requested',
                    'order_type' => 'B2C',
                    'remarks' => json_encode($request->remarks),
                ]);
                $to = 'tripdesigner.xyz@gmail.com';
                $email_cus = [$request->email];
                $email_admin = [$to];
                $data = [
                    'tracking' => $num,
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'person' => $request->person,
                    'r_type' => $request->r_type,
                    'status' => 'Requested',
                    'remarks' => json_encode($request->remarks),
                ];
                if ($result) {
                    Mail::send('email.customer-order-request', $data, function ($message) use ($email_cus) {
                        $message->subject("Trip Designer: Order Request Confirmation");
                        $message->from('sales@tripdesigner.net', 'Sales-Trip Designer');
                        $message->to($email_cus);
                    });
                    Mail::send('email.admin-order-request', $data, function ($message) use ($email_admin,$data) {
                        $message->subject("Order Request Confirmation Type - ".$data['r_type']);
                        $message->from('sales@tripdesigner.net', 'Sales-Trip Designer');
                        $message->to($email_admin);
                    });
                    return view('frontend.success-order-request', ['data' => $data,'successMessage' => 'Your Request Sent Successfully!! Please check your email']);

                } else {
                    return back()->with('errorMessage', 'Please try again!!');
                }
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function contactUS(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $result = DB::table('contact_us')->insert([
                    'agent_id' => $domain['agent_id'],
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'query' => json_encode($request->ask),
                ]);
                $from = 'tripdesigner.xyz@gmail.com';
                $email = [$from, $request->email,];
                $data = [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'subject' => $request->subject,
                    'query' => json_encode($request->ask),
                ];
                $rows = DB::table('subcriber')->where('agent_id', $domain['agent_id'])->get()->count();
                if ($rows < 1) {
                    $result = DB::table('subcriber')->insert([
                        'email' => $request->email,
                    ]);
                }
                if ($result) {
                    Mail::send('email.contact-us', $data, function ($message) use ($email) {
                        $message->subject("Trip Designer: Message Confirmation Email");
                        $message->from('sales@tripdesigner.net', 'Sales-Trip Designer');
                        $message->to($email);
                    });
                    return redirect()->to('contact-us')->with('successMessage', 'Your Query Sent Successfully!! Please check your email.');
                } else {
                    return back()->with('errorMessage', 'Please try again!!');
                }
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function subscribe(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $from = 'tripdesigner.xyz@gmail.com';
                $email = [$from, $request->email,];
                $data = [
                    'email' => $request->email,
                ];
                $rows = DB::table('subcriber')->where('agent_id', $domain['agent_id'])->get()->count();
                if ($rows < 1) {
                    $result = DB::table('subcriber')->insert([
                        'agent_id' => $domain['agent_id'],
                        'email' => $request->email,
                    ]);
                    if ($result) {
                        Mail::send('email.subscriber', $data, function ($message) use ($email) {
                            $message->subject("Trip Designer: Subscriber Notification");
                            $message->from('sales@tripdesigner.net', 'Sales-Trip Designer');
                            $message->to($email);
                        });
                        return redirect()->to('contact-us')->with('successMessagee', 'Thanks to subscribing us! We shall send discount and other notification to you !!');
                    } else {
                        return back()->with('errorMessagee', 'Please try again!!');
                    }
                } else {
                    return back()->with('errorMessagee', 'Your Email Already Exits!! No need to subscribe Again!');
                }
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function privacyPolicy(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows6 = DB::table('b2c_blog')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.privacy-policy', ['blogs' => $rows6]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function refundPolicy(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows6 = DB::table('b2c_blog')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.refund-policy', ['blogs' => $rows6]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function termsCondition(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows6 = DB::table('b2c_blog')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.terms-conditions', ['blogs' => $rows6]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function CookiePolicy(Request $request){
        try{
            $domain =$this->domainCheck();
             if($domain['agent_id'])  {
                $rows6 = DB::table('b2c_blog')->where('agent_id', $domain['agent_id'])->get();
                return view('frontend.cookie-policy', ['blogs' => $rows6]);
            }
            else{
                return view('frontend.404',['msg' => 'Your Domain is Not Enlisted in Our Database!!']);
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getAirportDetails(Request $request){
        try{
            $code = $request->code;
            $rows = DB::table('airport_details')
                ->where('iata_codes', $code)
                ->orWhere('name', 'like', '%'.$code)
                ->orWhere('city', 'like', '%'.$code)
                ->orWhere('country', 'like', '%'.$code)
                ->get();
            $div = '<ul id="suggest-list">';
            $div1="";
            foreach ($rows as $row) {
                $coma= ',';
                $cod_city = "selectCountry('$row->iata_codes$coma$row->city')";
                $div1 =$div1.'<li onClick="'.$cod_city.'">'. $row->iata_codes.','.$row->name.','.$row->city.'</li>';
            }
             $div = $div.$div1.'</ul>';

            return $div;
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function getAirportDetails1(Request $request){
        try{
            $code = $request->code;
            $rows = DB::table('airport_details')
                ->where('iata_codes', $code)
                ->orWhere('name', 'like', '%'.$code)
                ->orWhere('city', 'like', '%'.$code)
                ->orWhere('country', 'like', '%'.$code)
                ->get();
            $div = '<ul id="suggest-list1">';
            $div1="";
            foreach ($rows as $row) {
                $coma= ',';
                $cod_city = "selectCountry1('$row->iata_codes$coma$row->city')";
                $div1 =$div1.'<li onClick="'.$cod_city.'">'. $row->iata_codes.','.$row->name.','.$row->city.'</li>';
            }
             $div = $div.$div1.'</ul>';

            return $div;
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function adult(Request $request){

    }
    public function getCurlResult($url, $data, $headers){
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            echo 'Error: ' . curl_error($ch);
        } else {
            $decoded_response = json_decode(($response));
//                dd($decoded_response);
            return $decoded_response;
        }
        curl_close($ch);
    }
    public function flightSearchResult(Request $request){
        try{
            if($request->departure) {
                //return view('frontend.flight-search-result');
                Session::forget('flight_arr');
                $dep_city = $request->departure;
                $arr_city = $request->arrival;
                $dep_date = trim($request->dep_date);
                $adt = trim($request->adult);
                $chd = trim($request->child);
                $inf = trim($request->infant);
                $f_class = trim($request->f_class);
                $f_type = trim($request->f_type);
                $exp_dep_city = explode(",", $dep_city);
                $tr_exp_dep_city = trim($exp_dep_city[0]);
                $exp_arr_city = explode(",", $arr_city);
                $tr_exp_arr_city = trim($exp_arr_city[0]);
                $flight_arr['dep_city'] = $dep_city;
                $flight_arr['arr_city'] = $arr_city;
                $flight_arr['dep_date'] = $dep_date;
                $flight_arr['adt'] = $adt;
                $flight_arr['chd'] = $chd;
                $flight_arr['inf'] = $inf;
                $flight_arr['f_class'] = $f_class;
                $flight_arr['f_type'] = $f_type;
                Session::put('flight_arr', $flight_arr);
                $inc = 1;
                for ($i = 0; $i < $adt; $i++) {
                    $arr_pax[] = [
                        "paxID" => 'PAX' . $inc,
                        "ptc" => "ADT"
                    ];
                    $inc++;
                }
                for ($i = 0; $i < $chd; $i++) {
                    $arr_pax[] = [
                        "paxID" => 'PAX' . $inc,
                        "ptc" => "CHD"
                    ];
                    $inc++;
                }
                for ($i = 0; $i < $inf; $i++) {
                    $arr_pax[] = [
                        "paxID" => 'PAX' . $inc,
                        "ptc" => "INF"
                    ];
                    $inc++;
                }
                $data = array(
                    "pointOfSale" => "BD",
                    "request" => array(
                        "originDest" => array(
                            array(
                                "originDepRequest" => array(
                                    "iatA_LocationCode" => $tr_exp_dep_city,
                                    "date" => $dep_date
                                ),
                                "destArrivalRequest" => array(
                                    "iatA_LocationCode" => $tr_exp_arr_city,
                                    "date" => $dep_date
                                )
                            )
                        ),
                        "pax" => $arr_pax,
                        "shoppingCriteria" => array(
                            "tripType" => $f_type,
                            "travelPreferences" => array(
                                "vendorPref" => array(
                                    ""
                                ),
                                "cabinCode" => $f_class
                            ),
                            "returnUPSellInfo" => true
                        )
                    )
                );
                $url = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/AirShopping';
                $headers = array(
                    'Content-Type: application/json',
                    'Accept: text/plain',
                    'X-API-KEY: UV4zX25vRlFYJDlRYzVrTko/JHdOMFpxRE50UHpMQ0NDYT9adEtkYXokTXJTNHZrNHJaZDdramFhdCMkUzRnMg=='
                );
                $decoded_response = $this->getCurlResult($url, $data, $headers);
                if($decoded_response->response == null){
                    return redirect('/')->with('errorMas', 'Session Timed Out. Please Try Again!');
                }
                return view('frontend.flight-search-result', ['flights' => $decoded_response]);
            }
            else{
                return view('frontend.404',['msg' => 'Bad Request!!']);
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function flightDetails(Request $request){
        try{
            if (Session::get('user_id')) {
                $traceId = $request->traceId;
                $offerId = $request->offerId;
                $data = array(
                    "traceId" => $traceId,
                    "offerId" => [$offerId]
                );
                $url = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OfferPrice';
                $headers = array(
                    'Content-Type: application/json',
                    'Accept: text/plain',
                    'X-API-KEY: UV4zX25vRlFYJDlRYzVrTko/JHdOMFpxRE50UHpMQ0NDYT9adEtkYXokTXJTNHZrNHJaZDdramFhdCMkUzRnMg=='
                );
                $decoded_response = $this->getCurlResult($url, $data, $headers);
                if($decoded_response->response == null){
                    $errorMessage = $decoded_response->error->errorMessage;
                    return redirect('/')->with('errorMas', $errorMessage);
                }
                $flight_arr = Session::get('flight_arr');
                $result = $this->domesticFlightDetector($flight_arr['dep_city'], $flight_arr['arr_city']);
                $countries = DB::table('countries')->get();
                return view('frontend.flight-details', ['flights' => $decoded_response, 'domestic' => $result, 'countries' => $countries]);
            }
            else{
                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
                Session::put('reference_url',$actual_link);
                return redirect()->to('all-login');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function flightBooking(Request $request){
        try {
            //dd($request);
            if (Session::get('user_id')) {
                $traceId = $request->traceId;
                $offerId = $request->offerId;
                if ($request->domestic == 0) {
                    for ($i = 0; $i < $request->paxCount; $i++) {
                        $paxLists[] = [
                            "ptc" => $request->pax_type[$i],
                            "individual" => [
                                "givenName" => $request->f_name[$i],
                                "surname" => $request->l_name[$i],
                                "gender" => $request->gender[$i],
                                "birthdate" => $request->dob[$i],
                                "nationality" => $request->country[$i],
                                "identityDoc" => array(
                                    "identityDocType" => "Passport",
                                    "identityDocID" => $request->p_number[$i],
                                    "expiryDate" => $request->p_date[$i],
                                ),
//                            "associatePax"=>[
//                                "givenName"=> $request->f_name[0],
//                                "surname"=> $request->l_name[0]
//                            ],
                            ]
                        ];
                    }
                }
                if ($request->domestic == 1) {
                    for ($i = 0; $i < $request->paxCount; $i++) {
                        $paxLists[] = [
                            "ptc" => $request->pax_type[$i],
                            "individual" => [
                                "givenName" => $request->f_name[$i],
                                "surname" => $request->l_name[$i],
                                "gender" => $request->gender[$i],
                                "birthdate" => $request->dob[$i],
                                "nationality" => $request->country[$i],
                            ]
                        ];
                    }
                }
                $data = array(
                    "traceId" => $traceId,
                    "offerId" => [$offerId],
                    "request" => array(
                        "contactInfo" => array(
                            "phone" => array(
                                "phoneNumber" => $request->phone,
                                "countryDialingCode" => $request->phoneCode,
                            ),
                            "emailAddress" => $request->email,
                        ),
                        "paxList" => $paxLists
                    ),
                );
//            dd($data);
                $url = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OrderSell';
                $headers = array(
                    'Content-Type: application/json',
                    'Accept: text/plain',
                    'X-API-KEY: UV4zX25vRlFYJDlRYzVrTko/JHdOMFpxRE50UHpMQ0NDYT9adEtkYXokTXJTNHZrNHJaZDdramFhdCMkUzRnMg=='
                );
                $decoded_response = $this->getCurlResult($url, $data, $headers);
                if($decoded_response->response == null){
                    $errorMessage = $decoded_response->error->errorMessage;
                    return redirect('/')->with('errorMas', $errorMessage);
                }
                if ($decoded_response->success == true) {
                    $decoded_gross = $decoded_response->response->offersGroup[0]->offer->price->gross->total;
                    if ($request->grossAmount == $decoded_gross) {
                        $urlNext = 'https://bdf.centralindia.cloudapp.azure.com/api/enterprise/OrderCreate';
                        $decoded_responseNext = $this->getCurlResult($urlNext, $data, $headers);
                        dd($decoded_responseNext);
                    }
                    else{

                    }
                }
                if ($decoded_response->success == false) {
                    $errorMessage = $decoded_response->error->errorMessage;
                    return back()->with('errorMessage', $errorMessage);
                }
                return view('frontend.flight-details', ['flights' => $decoded_response,]);

            }
            else{
                $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";;
                Session::put('reference_url',$actual_link);
                return redirect()->to('all-login');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function domesticFlightDetector($dep_city , $arr_city){
        $dep_city_arr = ['DAC','CXB','CGP','JSR','RJH','SPD','ZYL','BZL'];
        $arr_city_arr = ['DAC','CXB','CGP','JSR','RJH','SPD','ZYL','BZL'];

        $exp_dep_city = explode(",", $dep_city);
        $tr_exp_dep_city = trim($exp_dep_city[0]);
        $exp_arr_city = explode(",", $arr_city);
        $tr_exp_arr_city = trim($exp_arr_city[0]);

        if (in_array($tr_exp_dep_city, $dep_city_arr)) {
            $found_dep = 1;
        }
        else{
            $found_dep = 0;
        }
        if (in_array($tr_exp_arr_city, $arr_city_arr)) {
            $found_arr = 1;
        }
        else{
            $found_arr = 0;
        }
        if( $found_dep == 1 && $found_arr == 1){
            $dom = 1;
        }
        else{
            $dom = 0;
        }
        return $dom;
    }


}

