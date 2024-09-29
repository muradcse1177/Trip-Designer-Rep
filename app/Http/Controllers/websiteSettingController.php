<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class websiteSettingController extends Controller
{
    public function b2cVisaManagement(Request $request){
        try{
            $rows1 = DB::table('b2c_visa_country')->where('agent_id',Session::get('user_id'))->get();
            $rows2 = DB::table('b2c_visa')->where('agent_id',Session::get('user_id'))->orderBy('id','desc')->get();
            return view('websiteSetting.visaManagement',['countries' => $rows1,'visas' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CVisaPage(Request $request){
        try{
            $rows1 = DB::table('b2c_visa_country')->where('agent_id',Session::get('user_id'))->get();
            $rows2 = DB::table('b2c_visa')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
            return view('websiteSetting.editB2CVisaPage',['countries' => $rows1,'visas' => $rows2]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function createNewB2CVisa(Request $request){
        try{
            //dd($request);
            $fileName = time() . '.' . $request->v_c_photo->extension();
            $request->v_c_photo->move(public_path('images/upload/company/'), $fileName);
            $logo = 'public/images/upload/company/'.$fileName;
            $result = DB::table('b2c_visa')->insert([
                'agent_id' => Session::get('user_id'),
                'country' => $request->c_name,
                'title' => $request->title,
                'v_c_photo' => $logo,
                'slug' => $request->slug,
                'keyword' =>  json_encode($request->keyword),
                'description' => json_encode($request->description),
                'requirements' => json_encode($request->requirements),
                'price_details' => json_encode($request->p_details),
                'em_info' => json_encode($request->em_info),
            ]);
            if ($result) {
                return redirect()->to('b2cVisaManagement')->with('successMessage', 'New Visa Service Added Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editNewB2CVisa(Request $request){
        try {
            if ($request) {
                $rows = DB::table('b2c_visa')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
                if($request->v_c_photo){
                    $fileName = time() . '.' . $request->v_c_photo->extension();
                    $request->v_c_photo->move(public_path('images/upload/company/'), $fileName);
                    $logo = 'public/images/upload/company/'.$fileName;
                }
                else{
                    $logo =   $rows->v_c_photo;
                }
                $result =DB::table('b2c_visa')
                    ->where('id', $rows->id)
                    ->where('agent_id',Session::get('user_id'))
                    ->update([
                        'country' => $request->c_name,
                        'title' => $request->title,
                        'v_c_photo' => $logo,
                        'slug' => $request->slug,
                        'keyword' =>  json_encode($request->keyword),
                        'description' => json_encode($request->description),
                        'requirements' => json_encode($request->requirements),
                        'price_details' => json_encode($request->p_details),
                        'em_info' => json_encode($request->em_info),
                    ]);
                if($result){
                    return back()->with('successMessage', 'Visa Updated Successfully!!');
                }
                else{
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteB2CVisaManagement(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_visa')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('b2cVisaManagement')->with('successMessage', 'Visa deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function b2cCompany(Request $request){
        try{
            $rows = DB::table('company_info')->where('agent_id',Session::get('user_id'))->first();
            return view('websiteSetting.companyInfo',['info' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addCompanyInfo(Request $request){
        try {
            if ($request) {
                $rows = DB::table('company_info')->where('agent_id',Session::get('user_id'))->get()->count();
                if($rows>0){
                    $rows = DB::table('company_info')->where('agent_id',Session::get('user_id'))->first();
                    if($request->logo){
                        $request->validate([
                            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                        ]);

                        $fileName = time() . '.' . $request->logo->extension();
                        $request->logo->move(public_path('images/upload/company/'), $fileName);
                        $logo = 'public/images/upload/company/'.$fileName;
                    }
                    else{
                        $logo =   $rows->logo;
                    }
                    $result =DB::table('company_info')
                        ->where('id', $rows->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->update([
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone1' => $request->phone1,
                            'phone2' => $request->phone2,
                            'currency' => $request->currency,
                            'symbol' => $request->symbol,
                            'address' => $request->address,
                            'tagline' => $request->tagline,
                            'logo' => $logo,
                            'f_link' => $request->f_link,
                            'in_link' => $request->in_link,
                            'y_link' => $request->y_link,
                            'about_us' => json_encode($request->about_us),
                            'privacy_policy' => json_encode($request->privacy_policy),
                            'tnt' => json_encode($request->tnt),
                            'r_policy' => json_encode($request->r_policy),
                            'c_policy' => json_encode($request->c_policy),
                        ]);
                    if($result){
                        return back()->with('successMessage', 'Company Updated Successfully!!');
                    }
                    else{
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
                else{
                    $request->validate([
                        'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
                    ]);

                    $fileName = time() . '.' . $request->logo->extension();
                    $request->logo->move(public_path('images/upload/company/'), $fileName);
                    $logo = 'public/images/upload/company/'.$fileName;

                    $result = DB::table('company_info')->insert([
                        'agent_id' => Session::get('user_id'),
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone1' => $request->phone1,
                        'phone2' => $request->phone2,
                        'currency' => $request->currency,
                        'symbol' => $request->symbol,
                        'address' => $request->address,
                        'tagline' => $request->tagline,
                        'logo' => $logo,
                        'f_link' => $request->f_link,
                        'in_link' => $request->in_link,
                        'y_link' => $request->y_link,
                        'about_us' => json_encode($request->about_us),
                        'privacy_policy' => json_encode($request->privacy_policy),
                        'tnt' => json_encode($request->tnt),
                        'r_policy' => json_encode($request->r_policy),
                        'c_policy' => json_encode($request->c_policy),
                    ]);
                    if($result){
                        return back()->with('successMessage', 'Company Added Successfully!!');
                    }
                    else{
                        return back()->with('errorMessage', 'Please Try Again!!');
                    }
                }
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function tourPackCountry(Request $request){
        try{
            $rows = DB::table('b2c_tour_package_country')->where('agent_id',Session::get('user_id'))->orderBy('id','desc')->get();
            return view('websiteSetting.tourPackCountry',['countries' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function b2cManpowerCountry(Request $request){
        try{
            $rows = DB::table('b2c_manpower_country')->where('agent_id',Session::get('user_id'))->orderBy('id','desc')->get();
            return view('websiteSetting.b2cManpowerCountry',['countries' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function b2cVisaCountry(Request $request){
        try{
            $rows = DB::table('b2c_visa_country')->where('agent_id',Session::get('user_id'))->orderBy('id','desc')->get();
            return view('websiteSetting.b2cVisaCountry',['countries' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addTourPackCountry(Request $request){
        try{
            //dd($request);
            $result = DB::table('b2c_tour_package_country')->insert([
                'agent_id' => Session::get('user_id'),
                'name' => $request->name,
            ]);
            if ($result) {
                return redirect()->to('tourPackCountry')->with('successMessage', 'New Country Added Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public  function addManpowerCountry(Request $request){
        try{
            //dd($request);
            $result = DB::table('b2c_manpower_country')->insert([
                'agent_id' => Session::get('user_id'),
                'name' => $request->name,
            ]);
            if ($result) {
                return redirect()->to('b2cManpowerCountry')->with('successMessage', 'New Country Added Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addVisaCountry(Request $request){
        try{
            $result = DB::table('b2c_visa_country')->insert([
                'agent_id' => Session::get('user_id'),
                'name' => $request->name,
            ]);
            if ($result) {
                return redirect()->to('b2cVisaCountry')->with('successMessage', 'New Country Added Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editTourCountryName (Request $request){
        try{
            $rows1 = DB::table('b2c_tour_package_country')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            return view('websiteSetting.editTourCountryName',['tours' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editVisaCountryName (Request $request){
        try{
            $rows1 = DB::table('b2c_visa_country')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            return view('websiteSetting.editVisaCountryName',['visa' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editTourPackCountry (Request $request){
        try{
            $result = DB::table('b2c_tour_package_country')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'name' => $request->name,
                ]);
            if ($result) {
                return redirect()->to('tourPackCountry')->with('successMessage', 'Country Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editManpowerCountryName (Request $request){
        try{
            $rows1 = DB::table('b2c_manpower_country')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->first();
            return view('websiteSetting.editManpowerCountryName',['visa' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editManpowerPackCountry (Request $request){
        try{
            $result = DB::table('b2c_manpower_country')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'name' => $request->name,
                ]);
            if ($result) {
                return redirect()->to('b2cManpowerCountry')->with('successMessage', 'Country Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editVisaPackCountry (Request $request){
        try{
            $result = DB::table('b2c_visa_country')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'name' => $request->name,
                ]);
            if ($result) {
                return redirect()->to('b2cVisaCountry')->with('successMessage', 'Country Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteTourCountryName(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_tour_package_country')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('tourPackCountry')->with('successMessage', 'Country deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteVisaCountryName(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_visa_country')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('b2cVisaCountry')->with('successMessage', 'Country deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteManpowerCountryName(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_manpower_country')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('b2cManpowerCountry')->with('successMessage', 'Country deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function b2cTourPackage(Request $request){
        try{
            $rows = DB::table('b2c_tour_package')->where('agent_id',Session::get('user_id'))->get();
            $rows1 = DB::table('b2c_tour_package_country')->where('agent_id',Session::get('user_id'))->get();
            return view('websiteSetting.b2cTourPackage',['packages' => $rows,'countries' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addB2CTourPackage(Request $request){
        try{
            $fileName = time() . '.' . $request->p_c_photo->extension();
            $request->p_c_photo->move(public_path('images/upload/tour/'), $fileName);
            $p_c_photo = 'public/images/upload/tour/'.$fileName;
            $i = 0;
            foreach ($request->p_m_photo as $photos){
                $fileName = $i.time() . '.' . $photos->extension();
                $photos->move(public_path('images/upload/tour/'), $fileName);
                $p_m_photo[$i] = 'public/images/upload/tour/'.$fileName;
                $i++;
                echo $i;
            }
            $p_m_photos = json_encode($p_m_photo);
            $result = DB::table('b2c_tour_package')->insert([
                'agent_id' => Session::get('user_id'),
                'c_name' => $request->c_name,
                'p_name' => $request->p_name,
                'p_code' => $request->p_code,
                'night' => $request->night,
                'p_c_photo' => $p_c_photo,
                'p_m_photo' => $p_m_photos,
                'p_p_adult' => $request->p_p_adult,
                'p_p_child' => $request->p_p_child,
                'slug' => $request->slug,
                'highlights' => json_encode($request->highlights),
                'title' => json_encode($request->title),
                'itinary' => json_encode($request->description),
                'inclusion' => json_encode($request->inclusion),
                'exclusion' => json_encode($request->exclusion),
                'tnt' => json_encode($request->tnt),
                'include' => json_encode($request->include),
            ]);
            if($result){
                return back()->with('successMessage', 'Tour Package Added Successfully!!');
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editB2CTourPackagePage(Request $request){
        try{
            $rows = DB::table('b2c_tour_package')->where('id',$request->id)->first();
            $rows1 = DB::table('b2c_tour_package_country')->get();
            return view('websiteSetting.editB2CTourPackagePage',['package' => $rows,'countries' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CTourPackage (Request $request){
        try{
            $rows = DB::table('b2c_tour_package')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
            if($request->p_c_photo){
                $fileName = time() . '.' . $request->p_c_photo->extension();
                $request->p_c_photo->move(public_path('images/upload/tour/'), $fileName);
                $p_c_photo = 'public/images/upload/tour/'.$fileName;
            }
            else{
                $p_c_photo = $rows->p_c_photo;
            }
            if($request->p_m_photo){
                $i = 0;
                foreach ($request->p_m_photo as $photos){
                    $fileName = $i.time() . '.' . $photos->extension();
                    $photos->move(public_path('images/upload/tour/'), $fileName);
                    $p_m_photo[$i] = 'public/images/upload/tour/'.$fileName;
                    $i++;
                    echo $i;
                }
                $p_m_photos = json_encode($p_m_photo);
            }
            else{
                $p_m_photos = $rows->p_m_photo;
            }
            $result = DB::table('b2c_tour_package')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'c_name' => $request->c_name,
                    'p_name' => $request->p_name,
                    'p_code' => $request->p_code,
                    'night' => $request->night,
                    'p_c_photo' => $p_c_photo,
                    'p_m_photo' => $p_m_photos,
                    'p_p_adult' => $request->p_p_adult,
                    'p_p_child' => $request->p_p_child,
                    'slug' => $request->slug,
                    'highlights' => json_encode($request->highlights),
                    'title' => json_encode($request->title),
                    'itinary' => json_encode($request->description),
                    'inclusion' => json_encode($request->inclusion),
                    'exclusion' => json_encode($request->exclusion),
                    'tnt' => json_encode($request->tnt),
                    'include' => json_encode($request->include),
                ]);
            if ($result) {
                return redirect()->to('b2cTourPackage')->with('successMessage', 'Tour Package Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteB2CTourPackage(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_tour_package')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('b2cTourPackage')->with('successMessage', 'Tour Package deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function b2cManpowerManagement(Request $request){
        try{
            $rows = DB::table('b2c_manpower')->where('agent_id',Session::get('user_id'))->get();
            $rows1 = DB::table('b2c_manpower_country')->where('agent_id',Session::get('user_id'))->get();
            return view('websiteSetting.b2cManpowerManagement',['packages' => $rows,'countries' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addB2CManpower(Request $request){
        try{
            $fileName = time() . '.' . $request->c_photo->extension();
            $request->c_photo->move(public_path('images/upload/manpower/'), $fileName);
            $c_photos = 'public/images/upload/manpower/'.$fileName;

            $result = DB::table('b2c_manpower')->insert([
                'agent_id' => Session::get('user_id'),
                'country' => $request->c_name,
                'c_photo' => $c_photos,
                'salary' => $request->salary,
                'period' => $request->period,
                'accommodation' => $request->accommodation,
                'slug' => $request->slug,
                'requirements' => json_encode($request->requirements),
                'responsibilities' => json_encode($request->responsibilities),
                'p_time' => json_encode($request->p_time),
                'p_method' => json_encode($request->p_method),
                'r_policy' => json_encode($request->r_policy),
                'tnt' => json_encode($request->tnt),
                'exclusion' => json_encode($request->exclusion),
            ]);
            if($result){
                return back()->with('successMessage', 'Manpower Package Added Successfully!!');
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CManpowerPackagePage(Request $request){
        try{
            $rows = DB::table('b2c_manpower')->where('id',$request->id)->first();
            $rows1 = DB::table('b2c_manpower_country')->get();
            return view('websiteSetting.editB2CManpowerPackagePage',['package' => $rows,'countries' => $rows1]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CManpowerPackage (Request $request){
        try{
            $rows = DB::table('b2c_manpower')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
            if($request->c_photo){
                $fileName = time() . '.' . $request->c_photo->extension();
                $request->c_photo->move(public_path('images/upload/manpower/'), $fileName);
                $c_photo = 'public/images/upload/manpower/'.$fileName;
            }
            else{
                $c_photo = $rows->c_photo;
            }
            $result = DB::table('b2c_manpower')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'country' => $request->c_name,
                    'c_photo' => $c_photo,
                    'salary' => $request->salary,
                    'period' => $request->period,
                    'accommodation' => $request->accommodation,
                    'slug' => $request->slug,
                    'requirements' => json_encode($request->requirements),
                    'responsibilities' => json_encode($request->responsibilities),
                    'p_time' => json_encode($request->p_time),
                    'p_method' => json_encode($request->p_method),
                    'r_policy' => json_encode($request->r_policy),
                    'tnt' => json_encode($request->tnt),
                    'exclusion' => json_encode($request->exclusion),
                ]);
            if ($result) {
                return redirect()->to('b2cManpowerManagement')->with('successMessage', 'Manpower Package Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteB2CManpowerPackage(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_manpower')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('b2cManpowerManagement')->with('successMessage', 'Manpower Package deleted successfully!!');
                    } else {
                        dd('ok');
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function b2cServiceManagement(Request $request){
        try{
            $rows = DB::table('b2c_service')->where('agent_id',Session::get('user_id'))->get();
            return view('websiteSetting.b2cServiceManagement',['services' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addB2CServices(Request $request){
        try{
            //dd($request);
            $fileName = time() . '.' . $request->c_photo->extension();
            $request->c_photo->move(public_path('images/upload/services/'), $fileName);
            $c_photo = 'public/images/upload/services/'.$fileName;
            //dd($request);
            $result = DB::table('b2c_service')->insert([
                'agent_id' => Session::get('user_id'),
                'name' => $request->name,
                'title' => $request->title,
                'slug' => $request->slug,
                'c_photo' => $c_photo,
                's_details' => json_encode($request->s_details),
                'p_method' => json_encode($request->p_method),
                'exclusion' => json_encode($request->exclusion),
                'tnt' => json_encode($request->tnt),
            ]);
            if($result){
                return back()->with('successMessage', 'New Service Added Successfully!!');
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CServicePage(Request $request){
        try{
            $rows = DB::table('b2c_service')->where('id',$request->id)->first();
            return view('websiteSetting.editB2CServicePage',['package' => $rows,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CService  (Request $request){
        try{
            $rows = DB::table('b2c_service')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
            if($request->c_photo){
                $fileName = time() . '.' . $request->c_photo->extension();
                $request->c_photo->move(public_path('images/upload/services/'), $fileName);
                $c_photo = 'public/images/upload/services/'.$fileName;
            }
            else{
                $c_photo = $rows->c_photo;
            }
            $result = DB::table('b2c_service')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'name' => $request->name,
                    'title' => $request->title,
                    'slug' => $request->slug,
                    'c_photo' => $c_photo,
                    's_details' => json_encode($request->s_details),
                    'p_method' => json_encode($request->p_method),
                    'exclusion' => json_encode($request->exclusion),
                    'tnt' => json_encode($request->tnt),
                ]);
            if ($result) {
                return redirect()->to('b2cServiceManagement')->with('successMessage', 'Service Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteB2CService(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_service')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('b2cServiceManagement')->with('successMessage', 'Service  deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function blogManagement(Request $request){
        try{
            $rows = DB::table('b2c_blog')->where('agent_id',Session::get('user_id'))->get();
            return view('websiteSetting.blogManagement',['blogs' => $rows]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addB2CBlog(Request $request){
        try{
            $fileName = time() . '.' . $request->b_c_photo->extension();
            $request->b_c_photo->move(public_path('images/upload/blog/'), $fileName);
            $b_c_photo = 'public/images/upload/blog/'.$fileName;
            //dd($request);
            $result = DB::table('b2c_blog')->insert([
                'agent_id' => Session::get('user_id'),
                'b_title' => $request->b_title,
                'b_category' => $request->b_category,
                'slug' => $request->slug,
                'p_by' => $request->p_by,
                'b_c_photo' => $b_c_photo,
                'keyword' => json_encode($request->keyword),
                'description' => json_encode($request->description),
                's_description' => $request->s_description,
                'details' => json_encode($request->details),
                'map_location' => json_encode($request->map_location),
            ]);
            if($result){
                return back()->with('successMessage', 'New Blog Added Successfully!!');
            }
            else{
                return back()->with('errorMessage', 'Please Try Again!!');
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function editB2CBlogPage(Request $request){
        try{
            $rows = DB::table('b2c_blog')->where('id',$request->id)->first();
            return view('websiteSetting.editB2CBlogPage',['blog' => $rows,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }

    public function editB2CBlog (Request $request){
        try{
            $rows = DB::table('b2c_blog')->where('agent_id',Session::get('user_id'))->where('id',$request->id)->first();
            if($request->b_c_photo){
                $fileName = time() . '.' . $request->b_c_photo->extension();
                $request->b_c_photo->move(public_path('images/upload/blog/'), $fileName);
                $b_c_photo = 'public/images/upload/blog/'.$fileName;
            }
            else{
                $b_c_photo = $rows->b_c_photo;
            }
            $result = DB::table('b2c_blog')
                ->where('id',$request->id)
                ->where('agent_id',Session::get('user_id'))
                ->update([
                    'b_title' => $request->b_title,
                    'b_category' => $request->b_category,
                    'slug' => $request->slug,
                    'p_by' => $request->p_by,
                    'b_c_photo' => $b_c_photo,
                    'keyword' => json_encode($request->keyword),
                    'description' => json_encode($request->description),
                    's_description' => $request->s_description,
                    'details' => json_encode($request->details),
                    'map_location' => json_encode($request->map_location),
                ]);
            if ($result) {
                return redirect()->to('blogManagement')->with('successMessage', 'Blog Updated Successfully!!');
            } else {
                return back()->with('errorMessage', 'Please try again!!');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function deleteB2CBlog(Request $request){
        try{
            if($request) {
                if($request->id) {
                    $result =DB::table('b2c_blog')
                        ->where('id', $request->id)
                        ->where('agent_id',Session::get('user_id'))
                        ->delete();
                    if ($result) {
                        return redirect()->to('blogManagement')->with('successMessage', 'Blog  deleted successfully!!');
                    } else {
                        return back()->with('errorMessage', 'Please try again!!');
                    }
                }
                else {
                    return back()->with('errorMessage', 'Bad Request!!');
                }
            }
            else{
                return back()->with('errorMessage', 'Please fill up the form');
            }
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function domainManage(Request $request){
        try{
            $rows = DB::table('domain')->where('agent_id',Session::get('user_id'))->first();
            return view('websiteSetting.domainManage',['domainy' => $rows,]);
        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
    public function addDomain(Request $request){
        try{
            $rows = DB::table('domain')->where('id',$request->name)->get();
            if($rows->count()>1){
                return back()->with('errorMessage', 'Domain Already Exits!!');
            }
            else{
                $result = DB::table('domain')->insert([
                    'agent_id' => Session::get('user_id'),
                    'name' => $request->name,
                ]);
                if($result){
                    return back()->with('successMessage', 'New Domain Added Successfully!!');
                }
                else{
                    return back()->with('errorMessage', 'Please Try Again!!');
                }
            }

        }
        catch(\Illuminate\Database\QueryException $ex){
            return back()->with('errorMessage', $ex->getMessage());
        }
    }
}
