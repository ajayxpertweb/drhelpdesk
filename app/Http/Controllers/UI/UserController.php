<?php

namespace App\Http\Controllers\UI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input; 
use Auth;
use DB;
use Mail; 
use redirect;
use Session;
use Validator;
use Carbon\carbon;
use App\User;  
use App\TempCart;
use App\Cart;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use App\UserDetail;
use App\Product;
use App\Vendor;
use App\Review;
use App\Prescription;
use App\DeWallet;
use App\Package;
use App\OrderAssignHistory;
use App\OrderStatusHistory;
use App\OrderCouponHistory;
use App\PasswordReset;
use App\Register;

class UserController extends Controller
{
    public function userRegistration(){ 
        $data['flag'] = 1;
        return view('UI/webviews/user.manage_user',$data);
    }

    public function userLogin(){ 
        $data['flag'] = 6;
        return view('UI/webviews/user.manage_user',$data);
    }

    // public function userRegistrationSubmit1(Request $request) {
    //   	$request->validate([
    //         'name'=> 'required',
    //         'email'=>'required|email|unique:users',
    //         'phone'=>'required|numeric|unique:users',
    //         'password' => 'min:6|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
    //         'password_confirmation' => 'min:6'
    //     ],
                
    //       [   
    //         'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
    //       ]
                
    //             );      
    //     try{
    //         $otp=rand(0000,9999);  //varification work pending
    //         $data = new User;
    //         $data->name=$request->name;
    //         $data->email=$request->email;
    //         $data->phone=$request->phone;
    //         $data->password=bcrypt($request->password);
    //         $data->user_type=$request->user_type;
    //         $data->save();   

            
    //         $data1 = new UserDetail;
    //         $data1->user_id=$data->id;
    //         $data1->user_name=$data->name;
    //         $data1->email= $data->email;
    //         $data1->mobile=$data->phone; 
    //         $data1->speciality=$request->speciality; 

    //         $data1->save();      

    //         $data2 = new DeWallet;
    //         $data2->user_id=$data->id;
    //         $data2->coin=0; 
    //         $data2->save();   
            
    //         $user = User::where('email',$request->email)->first();
    //         if ($request->phone!=null) {
    //             $otp = rand (1000, 9999);
    //             $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.Stay Home !!!  Stay safe !!!");
    //             $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$request->phone."&message=".$msg);
    //             curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
    //             $response=curl_exec($curl);
    //             curl_close($curl);
    //         } 
    //         $user1 = User::where('user_type',1)->first();
    //         if($user->user_type == 2){
    //             $user_type = 'User';
    //         }elseif($user->user_type == 3){
    //             $user_type = 'Doctor';
    //         } 
    //         if($request->user_type == 2){
    //             $to_name = $data->name;
    //             $to_email = $data->email; 
    //             Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
    //                 $message->to($to_email, $to_name)
    //                 ->subject('Registration In DHD');
    //                 $message->from('dhd@lsne.in','Drhelpdesk');
    //             });
    //         }elseif($request->user_type == 3){
    //             $to_name = $data->name;
    //             $to_email = $data->email; 
    //             Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
    //                 $message->to($to_email, $to_name)
    //                 ->subject('Registration In DHD');
    //                 $message->from('dhd@lsne.in','Drhelpdesk');
    //             });
    //         } 

    //         // $user = User::where('email',$request->email)->first();
    //         // if ($request->phone!=null) {
    //         //     $otp = rand (1000, 9999);
    //         //     $msg=urlencode("Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You
    //         //         .");
    //         //     $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$request->phone."&message=".$msg);
    //         //     curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
    //         //     $response=curl_exec($curl);
    //         //     curl_close($curl);
    //         // }

    //         // $to = $data['email'];
    //         // $subject = 'WelCome In DHD';
    //         // $message = "Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You.";
    //         // $headers = 'From:dhd@lsne.in';        
    //         // if(mail($to, $subject, $message, $headers)) {
                
    //         // } 
    //         // else {
                
    //         // }  

    //         // $user1 = User::where('user_type',1)->first();
    //         // if($user->user_type == 2){
    //         //     $user_type = 'User';
    //         // }elseif($user->user_type == 3){
    //         //     $user_type = 'Doctor';
    //         // }
    //         // $to = $user1['email'];
    //         // $subject = 'New'.$user_type.'Registration with DHD';
    //         // $message = "Dear ".$request->name.", \nEmail-       ".$request->email."\n And Password is-     ".$request->password." \n\nThank You.";
    //         // $headers = 'From:dhd@lsne.in';        
    //         // if(mail($to, $subject, $message, $headers)) {
    //         //     // echo 'Your Login Credentials Is Send To your registered email Address';
    //         // } 
    //         // else {
    //         //     // echo 'Sorry! something went wrong, please try again.';
    //         // }                           
    //     }
    //     catch(\Exception $e){
    //         echo $e;
    //         dd($e);
    //     }
    //     return back()->with('msg','Registration Successfull Please Complete Your Profile After Login !'); }
    public function userRegistrationSubmit(Request $request) {
        $request->validate([
                'name'=> 'required',
                'email'=>'required|email|unique:users',
                'phone'=>'required|numeric|unique:users',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'password_confirmation' => 'min:6'
            ],
                    
            [   
                'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
            ]
                
        );      
        $session = Session::getId(); 
        $result = DB::table('registers')->where('session_id',$session)->first();
        try{
            $otp=rand(0000,9999);  //varification work pending
            $data = new User;
            $data->name=$result->name;
            $data->email=$result->email;
            $data->phone=$result->phone;
            $data->password=bcrypt($result->password);
            $data->user_type=$result->user_type;
            $data->save();   

            
            $data1 = new UserDetail;
            $data1->user_id=$data->id;
            $data1->user_name=$data->name;
            $data1->email= $data->email;
            $data1->mobile=$data->phone; 
            $data1->speciality=$result->speciality; 

            $data1->save();      

            $data2 = new DeWallet;
            $data2->user_id=$data->id;
            $data2->coin=20; 
            $data2->save();   
            
            $user = User::where('email',$request->email)->first();
            if ($request->phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.                                                     Stay Home !!!  Stay safe !!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$request->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            } 
            $user1 = User::where('user_type',1)->first();
            if($user->user_type == 2){
                $user_type = 'User';
            }elseif($user->user_type == 3){
                $user_type = 'Doctor';
            } 
            if($request->user_type == 2){
                $to_name = $data->name;
                $to_email = $data->email; 
                Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
            }elseif($request->user_type == 3){
                $to_name = $data->name;
                $to_email = $data->email; 
                Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
            } 

            // $user = User::where('email',$request->email)->first();
            // if ($request->phone!=null) {
            //     $otp = rand (1000, 9999);
            //     $msg=urlencode("Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You
            //         .");
            //     $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$request->phone."&message=".$msg);
            //     curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
            //     $response=curl_exec($curl);
            //     curl_close($curl);
            // }

            // $to = $data['email'];
            // $subject = 'WelCome In DHD';
            // $message = "Dear ".$request->name.", \nYour Registration Succesfully Submitted In DHD Your Email-       ".$request->email."\n And Password is-     ".$request->password." \n\n And Complete Your Profile After Login With These Credentials You given a 25 % off discount coupon can use it single time after purchasing first order coupon  code is FIRST25 Thank You.";
            // $headers = 'From:dhd@lsne.in';        
            // if(mail($to, $subject, $message, $headers)) {
                
            // } 
            // else {
                
            // }  

            // $user1 = User::where('user_type',1)->first();
            // if($user->user_type == 2){
            //     $user_type = 'User';
            // }elseif($user->user_type == 3){
            //     $user_type = 'Doctor';
            // }
            // $to = $user1['email'];
            // $subject = 'New'.$user_type.'Registration with DHD';
            // $message = "Dear ".$request->name.", \nEmail-       ".$request->email."\n And Password is-     ".$request->password." \n\nThank You.";
            // $headers = 'From:dhd@lsne.in';        
            // if(mail($to, $subject, $message, $headers)) {
            //     // echo 'Your Login Credentials Is Send To your registered email Address';
            // } 
            // else {
            //     // echo 'Sorry! something went wrong, please try again.';
            // }                           
        }
        catch(\Exception $e){
            echo $e;
            dd($e);
        }
        return back()->with('msg','Registration Successfull Please Complete Your Profile After Login !'); 
    }


    public function otpSubmit(Request $request) {
        $session = Session::getId(); 
        $request->validate([
                'name'=> 'required',
                'email'=>'required|email|unique:users',
                'phone'=>'required|numeric|unique:users',
                'password' => 'min:6|required_with:password_confirmation|same:password_confirmation|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'password_confirmation' => 'min:6'
            ],
                    
            [   
                'password.regex'  => 'Password Should have At least one Uppercase, one Lowercase, one Numeric, one Special character with more than 6 characters.'
            ]
                
        );      
        try{
            $token = rand(111111, 999999);    //varification work pending

            $data = new Register;
            $data->name=$request->name;
            $data->email=$request->email;
            $data->phone=$request->phone;
            $data->password=bcrypt($request->password);
            $data->user_type=$request->user_type;
            $data->otp=$token;
            $data->speciality=$request->speciality;
            $data->session_id = $session;
            $data->save(); 

            if ($request->phone!=null) { 
                $msg=urlencode($token." is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$request->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            } 
             
        }
        catch(\Exception $e){
            echo $e;
            dd($e);
        }
        return redirect('otp')->with('msg','Your Otp is send to your mobile number please verify first to complete registration process!'); 
    }

    public function otp(){  
        return view('UI/components/user/otp_submit');
    }

    public function otpSubmit1(Request $request) { 
        $otp_verify = DB::table('registers')->where('otp',$request->otp)->first();
            if($otp_verify != null){
                $session = Session::getId(); 
                $result = DB::table('registers')->where('otp',$request->otp)->first();
           
                $data = new User;
                $data->name=$result->name;
                $data->email=$result->email;
                $data->phone=$result->phone;
                $data->password= $result->password;
                $data->user_type=$result->user_type;
                $data->save();   

                
                $data1 = new UserDetail;
                $data1->user_id=$data->id;
                $data1->user_name=$data->name;
                $data1->email= $data->email;
                $data1->mobile=$data->phone; 
                $data1->speciality=$result->speciality; 

                $data1->save();      

                $data2 = new DeWallet;
                $data2->user_id=$data->id;
                $data2->coin=0; 
                $data2->save();   
                
                $user = User::where('email',$result->email)->first();
                if ($result->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Thank you for registering with DrHelpDesk.Enjoy Online Shopping.                                                     Stay Home !!!  Stay safe !!!");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$result->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                } 
                
                $user1 = User::where('user_type',1)->first();
                if($user->user_type == 2){
                    $user_type = 'User';
                }elseif($user->user_type == 3){
                    $user_type = 'Doctor';
                } 
                if($user->user_type == 2){
                    $to_name = $data->name;
                    $to_email = $data->email; 
                    Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email){
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('dhd@lsne.in','Drhelpdesk');
                    });
                }elseif($user->user_type == 3){
                    $to_name = $data->name;
                    $to_email = $data->email; 
                    Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('dhd@lsne.in','Drhelpdesk');
                    });
                } 
                DB::table('registers')->where('otp',$request->otp)->delete();
                 
                return redirect('login-user')->with('message','Registration Successfull Please Complete Your Profile After Login !'); 
            }else{
                return back()->with('msg','Otp Not Match'); 
            }
    }

    public function userLoginSubmit(Request $request) { 
        $mode = $this->isEmail($request->get('phn_or_email'));
       $session = Session::getId();    
        $cart = TempCart::where('session_id',Session::getId())->get(); 
       $data = [];
        if($mode){
            $data['email'] = $request->get('phn_or_email');
            $data['password'] = $request->get('password'); 
            $data['user_type'] = $request->get('user_type'); 
        }else{
           $data['phone'] = $request->get('phn_or_email');
            $data['password'] = $request->get('password'); 
            $data['user_type'] = $request->get('user_type'); 
        }
        
         if(Auth::attempt ($data)) 
        { 
            session ( [ 
                'name' => ($mode == 'email')?$data['email']:$data['phone'] , 
            ]);  
            foreach ($cart as $r){   
               $result1=DB::table('carts')->where('product_id',$r->product_id)->where('user_id',Auth::user()->id)->first();   
                    if($result1 == null){
                        $data = new Cart;  
                        $data->user_id= Auth::user()->id; 
                        $data->product_id= $r->product_id;
                        $data->quantity=  $r->quantity;  
                        $data->type=  $r->type;  
                        $data->save();
                    } 
                    TempCart::where('session_id',$r->session_id)->delete(); 
            }
            $doc_id = $request->get ('doc_id');
           
            if(!empty($doc_id)) {
                return back();
            } else {
                return redirect('/dashboard');
            }
        }else {
            Session::flash ( 'message', "Somethingh Went Wrong ! Please Contact To Administrator" );
            return redirect()->back()->with('message',"Somethingh Went Wrong ! Please Contact To Administrator");
            //return back();
        } 
    }

    public function dashboard(){  
        if(Auth::user()->user_type == 1){
            return redirect('admin');
        }elseif(Auth::user()->user_type == 2){
            return redirect('/'); 
        }elseif(Auth::user()->user_type == 3){
            return redirect('/'); 
        }elseif(Auth::user()->user_type == 4){
            return redirect('/'); 
        } 
    }
  
    public function addtoCart(Request $req){    
        $session = Session::getId(); 
        $type = 1;
        if(!empty($req->cat_id) && $req->cat_id==15){
            $type = 2;
        }
        if(Auth::check()){
            $result1=DB::table('carts')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count(); 
            if($result1 == 0){
                DB::table('carts')->insert([
                    'product_id'=>$req->products_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>1 
                ]); 
            }
        }else{
            $result=DB::table('temp_carts')->where('product_id',$req->products_id)->where('session_id',$session)->count(); 
            if($result == 0){
                DB::table('temp_carts')->insert([
                    'product_id'=>$req->products_id,
                    'session_id'=> $session,
                    'type' => $type,
                    'quantity'=>1 
                ]); 
            }
        } 
        Session::flash ( 'message1', "Item Added into Cart" );
        return back(); 
    }

    public function addtoCart1(Request $req){    
        $session = Session::getId();
        $type = 1;
        if(!empty($req->cat_id) && $req->cat_id==15){
            $type = 2;
        }
        if(Auth::check()){
            $result1=DB::table('carts')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count(); 
            if($result1 == 0){
                DB::table('carts')->insert([
                    'product_id'=>$req->products_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>$req->quantity 
                ]); 
            }
        }else{
            $result=DB::table('temp_carts')->where('product_id',$req->products_id)->where('session_id',$session)->count(); 
            if($result == 0){
                DB::table('temp_carts')->insert([
                    'product_id'=>$req->products_id,
                    'session_id'=> $session,
                    'type' => $type,
                    'quantity'=>$req->quantity 
                ]); 
            }
        } 
        Session::flash ( 'message1', "Item Added into Cart" );
        return back(); 
    }
    
    public function userMyCart(Request $req){ 
        $value = $req->session()->get('location_name');
        $data['map_location']= $value;  
       // dd($value);
        $data['flag'] = 2; 
        $dt = Carbon::now()->toDateString(); 
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first(); 
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get(); 
          // dd($match->count());
        } 
        //dd($req->session()->get('couponData')['type1']);
        $data['copoun_amount'] = $req->session()->get('couponData')?$req->session()->get('couponData')['amount']:0;
        $data['type'] = $req->session()->get('couponData')?$req->session()->get('couponData')['type1']:0;
        
        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied"; 
                $data['type'] = $coupon1->type; 
                $type1 = $coupon1->type;
                $cc = $coupon1->amount; 
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                //session(['type1'=>$type1]); 
                //session(['amount'=>$cc]); 
                $data['copoun_amount']=$cc;  
                $data['type_price']=$type1;  
               // dd( $data['copoun_amount']);
            }else{
                $data['result1']='Your copoun code limit exceed.'; 
            }  
            //($data['result1']);
        } 
        else{
            $data['result1']='';  
        }
        $session = Session::getId(); 
        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type')->get(); 
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type')->get();  
        $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }
        
        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        $data['type1totalitem'] = $type1Toatl;
        $data['type2totalitem'] = $type2Toatl;
        $data['type1totalprice'] = $total1;
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price' ,'products.extra_discount' , 'products.special_price','temp_carts.quantity','temp_carts.temp_carts_id', 'temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            } 
            //dd($data1);
        }

        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price','products.extra_discount' , 'products.special_price','carts.quantity','carts.id', 'carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;   
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1; 
            //dd( $data['result']);
        }else{
            $data['result']='Please Choose To Continue Shopping'; 
        }  

        
        return view('UI/webviews/user.manage_user',$data);
    }

    // public function userMyCart1(){ 
    //     $data['flag'] = 2; 
    //     $session = Session::getId(); 
    //     $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
    //     $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
    //     $count = DB::table('temp_carts')->where('session_id',$session)->count(); 

    //     foreach ($r as $key => $r1) {
    //         $data1[]=DB::table('products')
    //         ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price' ,'products.extra_discount' , 'products.special_price','temp_carts.quantity','temp_carts.temp_carts_id')->where('products.products_id',$r1)
    //         ->first();
    //     }

    //     foreach ($cart as $key => $r2) {
    //         $data1[]=DB::table('products')
    //         ->join('carts', 'products.products_id', '=', 'carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price','products.extra_discount' , 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
    //         ->first();
    //     }
    //     if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
    //         $data['result'] = $data1;   
    //     }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
    //         $data['result'] = $data1;   
    //     }else{
    //         $data['result']='Please Choose To Continue Shopping'; 
    //     }  
    //     return view('UI/webviews/user.manage_user',$data);
    // }

    public function cartUpdate(Request $req){  
        if(Auth::check()){
           Cart::where('id',$req->cart_id)->update([
             'quantity'=>$req->new_quantity
            ]); 
        }else{
            TempCart::where('temp_carts_id',$req->cart_id)->update([
             'quantity'=>$req->new_quantity
            ]); 
        }
        
        return 1;
    } 
    
    public function removeProduct(Request $req){ 
        if(Auth::check()){
           Cart::where('id',$req->cart_id)->delete();
            return 1;
        }else{
            TempCart::where('temp_carts_id',$req->cart_id)->delete();
            return 1; 
        }   
    }

    // public function userCheckout2(Request $req){ 
    //     $data['flag'] = 3; 
    //     // $latitude = 26.2657;
    //     // $longitude =  77.9940;
    //     // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyCx7vsP8llZYTAmjxBD6-yM6z_UJvff2W4";
    //     // $geocodeResponseData = file_get_contents($googleMapUrl);
    //     // $responseData = json_decode($geocodeResponseData, true);
    //     // if($responseData['status']=='OK') 
    //     // {  
    //     //     foreach ($responseData['results'][0]['address_components'] as $r) { 
    //     //         if ($r['types'][0]== 'locality') {
    //     //             //$city = $r['long_name'];
    //     //             break; 
    //     //         } 
    //     //     }  
    //     // }  
    //     //session(['city'=>$city]);  
    //     $data['session']=session('city');   
    //     $data['url'] = "";
    //     $session = Session::getId(); 
    //     $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
    //     $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
    //     $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
    //     foreach ($r as $key => $r1) {
    //         $data1[]=DB::table('products')
    //         ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id')->where('products.products_id',$r1)
    //         ->first();
    //     }
    //     foreach ($cart as $key => $r2) {
    //         $data1[]=DB::table('products')
    //         ->join('carts', 'products.products_id', '=', 'carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
    //         ->first();
    //     }
    //     if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
    //         $data['result'] = $data1;  
    //     }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
    //         $data['result'] = $data1;  
    //     }else{
    //         $data['result']='Please Choose To Continue Shopping'; 
    //     }  
    //     return view('UI/webviews/user.manage_user',$data);
    // }

    // public function userCheckout3(Request $req){ 
    //     $data['flag'] = 3;
    //     // $latitude = 26.4947;
    //     // $longitude =  77.9940;
    //     // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyCx7vsP8llZYTAmjxBD6-yM6z_UJvff2W4";
    //     // $geocodeResponseData = file_get_contents($googleMapUrl);
    //     // $responseData = json_decode($geocodeResponseData, true);
    //     // if($responseData['status']=='OK') 
    //     // {  
    //     //     foreach ($responseData['results'][0]['address_components'] as $r) { 
    //     //         if ($r['types'][0]== 'locality') {
    //     //             $city = $r['long_name'];
    //     //             break; 
    //     //         } 
    //     //     }  
    //     // }  
    //     // session(['city'=>$city]);  
    //     $data['session']=session('city');  
    //     $data['url'] = $req->prescription_id; 
    //     $session = Session::getId(); 
    //     $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
    //     $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
    //     $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
    //     foreach ($r as $key => $r1) {
    //         $data1[]=DB::table('products')
    //         ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.categories' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id')->where('products.products_id',$r1)
    //         ->first();
    //     }
    //     foreach ($cart as $key => $r2) {
    //         $data1[]=DB::table('products')
    //         ->join('carts', 'products.products_id', '=', 'carts.product_id')
    //         ->select('products.products_id','products.product_name' ,'products.price', 'products.categories' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
    //         ->first();
    //     }
    //     if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
    //         $data['result'] = $data1;  
    //     }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
    //         $data['result'] = $data1;  
    //     }else{
    //         $data['result']='Please Choose To Continue Shopping'; 
    //     }  
    //     return view('UI/webviews/user.manage_user',$data);
    // }
    public function userCheckout(Request $req){ 
        $data['flag'] = 3; 
        $value = $req->session()->get('location_name');
        $data['map_location']= $value; 
         
        $data['session']=$value;   
        $data['url'] = "";
        $session = Session::getId();
        //add couponn funcinility
        $dt = Carbon::now()->toDateString(); 
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first(); 
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get(); 
          // dd($match->count());
        } 
        //dd($req->session()->get('couponData')['type1']);
        $data['copoun_amount'] = $req->session()->get('couponData')?$req->session()->get('couponData')['amount']:0;
        $data['type'] = $req->session()->get('couponData')?$req->session()->get('couponData')['type1']:0;
        
        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied"; 
                $data['type'] = $coupon1->type; 
                $type1 = $coupon1->type;
                $cc = $coupon1->amount; 
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                //session(['type1'=>$type1]); 
                //session(['amount'=>$cc]); 
                $data['copoun_amount']=$cc;  
                $data['type_price']=$type1;  
               // dd( $data['copoun_amount']);
            }else{
                $data['result1']='Your copoun code limit exceed.'; 
            }  
            //($data['result1']);
        } 
        else{
            $data['result1']='';  
        }
        //end coupon functionolity
        $prescriptionReqTempCart = DB::Select(DB::raw("SELECT count(temp_carts_id) as ptotal FROM `temp_carts` as tc inner join products as p on p.products_id = tc.product_id where p.prescription='1' and tc.session_id='".$session."'"));
        $prescriptionReqCart = DB::Select(DB::raw("SELECT count(id) as ptotal FROM `carts` as tc inner join products as p on p.products_id = tc.product_id where p.prescription='1' and tc.user_id='".Auth::id()."'"));
        if($prescriptionReqTempCart[0]->ptotal > 0 || $prescriptionReqCart[0]->ptotal > 0){
            return redirect('upload-prescription');
        }
        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type')->get(); 
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type')->get();  
        
        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }
        
        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        $data['type1totalitem'] = $type1Toatl;
        $data['type2totalitem'] = $type2Toatl;
        $data['type1totalprice'] = $total1;
        
        $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package','packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;  
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;  
        }else{
            $data['result']='Please Choose To Continue Shopping'; 
        }  
        
        return view('UI/webviews/user.manage_user',$data);
    }

    /*public function userCheckout1(Request $req){ 
        $data['flag'] = 3; 
        $value = $req->session()->get('location_name');
           $data['map_location']= $value;
        $data['session']=$value;  
        $data['url'] = $req->prescription_id; 
        $session = Session::getId(); 
        $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
        $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
        $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        // foreach ($r as $key => $r1) {
        //     $data1[]=DB::table('products')
        //     ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
        //     ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription', 'products.categories' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id')->where('products.products_id',$r1)
        //     ->first();
        // }
        // foreach ($cart as $key => $r2) {
        //     $data1[]=DB::table('products')
        //     ->join('carts', 'products.products_id', '=', 'carts.product_id')
        //     ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription', 'products.categories' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
        //     ->first();
        // }
        $data1 = [];
        foreach ($r as $key => $r1) {
            if($r1['type'] == 1 || $r1['type'] == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1['type'] == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2['type'] == 1 || $r2['type'] == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2['type'] == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;  
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;  
        }else{
            $data['result']='Please Choose To Continue Shopping'; 
        }  
        dd($data);
        return view('UI/webviews/user.manage_user',$data);
    }*/
    /*public function userCheckout1(Request $req){ 
        $data['flag'] = 3; 
        $value = $req->session()->get('location_name');
        $data['map_location']= $value; 
         
        $data['session']=$value;   
        $data['url'] = $req->prescription_id;
        $session = Session::getId();
        
        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type')->get(); 
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type')->get();  
        $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
        
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.package_cost', 'packages.prescription', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.package_cost', 'packages.prescription', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        $data['type1totalitem'] = $type1Toatl;
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;  
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;  
        }else{
            $data['result']='Please Choose To Continue Shopping'; 
        }  
        
        return view('UI/webviews/user.manage_user',$data);
    }*/
    
    public function userCheckout1(Request $req){ 
        $data['flag'] = 3; 
        $value = $req->session()->get('location_name');
        $data['map_location']= $value; 
         
        $data['session']=$value; 
        $data['url'] = !empty($req->prescription_id) ? $req->prescription_id: "";
        $session = Session::getId();
        //add couponn funcinility
        $dt = Carbon::now()->toDateString(); 
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first(); 
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get(); 
          // dd($match->count());
        } 
        //dd($req->session()->get('couponData')['type1']);
        $data['copoun_amount'] = $req->session()->get('couponData')?$req->session()->get('couponData')['amount']:0;
        $data['type'] = $req->session()->get('couponData')?$req->session()->get('couponData')['type1']:0;
        
        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied"; 
                $data['type'] = $coupon1->type; 
                $type1 = $coupon1->type;
                $cc = $coupon1->amount; 
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                //session(['type1'=>$type1]); 
                //session(['amount'=>$cc]); 
                $data['copoun_amount']=$cc;  
                $data['type_price']=$type1;  
               // dd( $data['copoun_amount']);
            }else{
                $data['result1']='Your copoun code limit exceed.'; 
            }  
            //($data['result1']);
        } 
        else{
            $data['result1']='';  
        }
        //end coupon functionolity
        
        $r = DB::table('temp_carts')->where('session_id',$session)->select('product_id','type')->get(); 
        $cart = DB::table('carts')->where('user_id',Auth::id())->select('product_id','type')->get();  
        
        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }
        
        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        $data['type1totalitem'] = $type1Toatl;
        $data['type2totalitem'] = $type2Toatl;
        $data['type1totalprice'] = $total1;
        
        $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
        if(count($cart)==0 && $count==0){
            return redirect('/');
        }
        foreach ($r as $key => $r1) {
            if($r1->type == 1 || $r1->type == 2){
                $data1[]=DB::table('products')
                ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' ,'products.extra_discount', 'products.special_price','temp_carts.quantity','temp_carts.temp_id','temp_carts.type')->where('products.products_id',$r1->product_id)
                ->first();
            }elseif($r1->type == 3){
              $data1[]=DB::table('packages')
              ->join('temp_carts', 'packages.id', '=', 'temp_carts.product_id')
              ->select('packages.id','packages.package_name','packages.package' ,'packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'temp_carts.quantity','temp_carts.temp_carts_id','temp_carts.type')->where('packages.id',$r1->product_id)
              ->first();
            }
        }
        foreach ($cart as $key => $r2) {
            if($r2->type == 1 || $r2->type == 2){
                $data1[]=DB::table('products')
                ->join('carts', 'products.products_id', '=', 'carts.product_id')
                ->select('products.products_id','products.product_name' ,'products.price', 'products.prescription' , 'products.extra_discount', 'products.special_price','carts.quantity','carts.id','carts.type')->where('products.products_id',$r2->product_id)
                ->first();
            }elseif($r2->type == 3){
              $data1[]=DB::table('packages')
              ->join('carts', 'packages.id', '=', 'carts.product_id')
              ->select('packages.id','packages.package_name','packages.package','packages.prescription' ,'packages.package_cost', 'packages.offer_discount' , 'packages.type' , 'packages.image' ,'carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)
              ->first();
            }
        }
        
        if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $data['result'] = $data1;  
        }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $data['result'] = $data1;  
        }else{
            $data['result']='Please Choose To Continue Shopping'; 
        }  
        
        return view('UI/webviews/user.manage_user',$data);
    }
    
    public function userAddressSubmit(Request $req){
        if($req->id){
            $data = Auth::id();
            UserAddress::where('id',$req->id)->update([ 
                'user_id' => Auth::id(), 
                'name' => $req->name,  
                'phone' => $req->phone,   
                'address' => $req->address, 
                'apartment' => $req->apartment, 
                'city' => $req->city, 
                'state' => $req->state, 
                'pin_code' => $req->pin_code, 
                'country' => $req->country  
            ]);
            if($req->url == 'http://localhost/dhdproject/public/user-address'){ 
                return redirect('/user-address')->with('msg','Your Address Edit Successfull'); 
            }else{ 
                return redirect('checkout/');
            }
            
        }else{
            $data= new UserAddress;
            $data->user_id = Auth::id(); 
            $data->name = $req->name;  
            $data->phone  = $req->phone;   
            $data->address = $req->address; 
            $data->apartment = $req->apartment; 
            $data->city = $req->city; 
            $data->state  = $req->state; 
            $data->pin_code  = $req->pin_code; 
            $data->country  = $req->country;  
            $data->save(); 
            //dd($req->url);
            if($req->url == 'http://localhost/dhdproject/public/user-address'){ 
                return back()->with('msg','Your Address Add Successfull'); 
            }else{ 
                return redirect('checkout/');
            }
           
        } 
    }

    public function userAddressDelete($id){ 
        UserAddress::where('id',$id)->delete();
        return back()->with('msg','Your Address Delete Successfully');
    } 
    
     public function checkoutSubmit(Request $req){  
        
        $name =  Auth::user()->name;
        $email =  Auth::user()->email;
        //$check_location_name = DB::table('locations')->where('location_name',$map_location)->first(); 
        if(!$req->address_id){
            return back()->with('msg','Please Fill A Address'); 
        }
        $session = Session::getId();
        $cart = DB::table('carts')->where('user_id',Auth::id())->count();
        $tempcart = DB::table('temp_carts')->where('session_id',$session)->count();
        //get type 1 product count
        $type1Tcart = DB::table('temp_carts')->where('session_id',$session)->where('type',1)->count();
        $type1cart = DB::table('carts')->where('user_id',Auth::id())->where('type',1)->count();
        $type1Toatl = $type1Tcart + $type1cart;
        //get type2 and 3 cart
        $type2Tcart = DB::table('temp_carts')->where('session_id',$session)->whereIn('type',[2,3])->count();
        $type2cart = DB::table('carts')->where('user_id',Auth::id())->whereIn('type',[2,3])->count();
        $type2Toatl = $type2Tcart + $type2cart;
        //get total cost of type1 product
        $type1cartTotal = 0;
        if(!empty(Auth::id())) {
            $type1cartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ptype1total FROM `carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.user_id='.Auth::id()));
        }
        
        $type1tcartTotal = DB::Select(DB::raw('SELECT sum(c.quantity*(IF(p.special_price is not null, p.special_price, p.price))) as ctype1total FROM `temp_carts` as c inner join products as p on c.product_id = p.products_id WHERE c.type in (1) and c.session_id="'.$session.'"'));
        $total1 = (!empty($type1cartTotal[0]->ptype1total)?$type1cartTotal[0]->ptype1total:0) + (!empty($type1tcartTotal[0]->ctype1total)?$type1tcartTotal[0]->ctype1total:0);
        if($req->payment_mode=='COD' && $type2Toatl > 0){
            return redirect('/');
        }
        
        if($cart==0 && $tempcart==0){
            return redirect('/');
        }
        if ($req->address_id) {  
           
            #if ($req->payment_mode=='COD') {
                $total_amount1=0;
                $tamount = 0;
                $extra_discount = 0;
                $balance=0;
                $total_amount_with_shipping = 0; 
                $totaltype1amount = 0;
                $data=Cart::where('user_id',Auth::user()->id)->get();  

                $address = DB::table('user_addresses')->where('id',$req->address_id)->first(); 
                $location_name = DB::table('locations')->where('location_name',$address->city)->first(); 
                 
                $order_id = "DHD".Auth::user()->id.time();

                $reg = new Order;
                $reg->user_id = Auth::user()->id;
                $reg->order_id = $order_id;
                $reg->address_id = $req->address_id;  
                $reg->order_status = 1;  
                $reg->prescription_id = $req->prescription_id; 
                $reg->payment_mode = $req->payment_mode;   
                $reg->user_name = $address->name;  
                $reg->user_phone  = $address->phone;   
                $reg->user_address = $address->address; 
                $reg->user_apartment = $address->apartment; 
                $reg->user_city = $address->city; 
                $reg->user_state  = $address->state; 
                $reg->pin_code  = $address->pin_code; 
                $reg->user_country  = $address->country; 
                $reg->save();    //order item table  
                $count=0;  
                $prod_name = [];
                $sub = [];
                foreach ($data as $r) {
                    $sub_order_id = "DHD".Auth::user()->id.$count.time(); 
                    $reg1 = new OrderItem;
                    $reg1->order_id = $reg->order_id; 
                    $reg1->sub_order_id = $sub_order_id;

                    if($r->type == 1 || $r->type == 2){
                        $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
                        $match = Vendor::where('main_category', $categories)->where('city', $address->city)->orderBy('assign_priority','asc')->limit(1)->pluck('vendors_id')->first(); 
                        
                        if($location_name){
                            $reg1->assign_vendor_id = $match; 
                            $reg1->quick_delivery = 1;
                        }elseif($location_name == null){
                              
                            $reg1->quick_delivery = 2;
                        }
                        $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();  
                        $reg1->prod_id = $r->product_id;  
                        $reg1->quantity =$r->quantity; 
                        $reg1->type =$r->type; 
                        $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
                        $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
                        if($special_price != null){
                            $reg1->sub_total=$special_price; 
                        }else{
                            $reg1->sub_total=$price;  
                        }
                        $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();  
                        $reg1->order_status = 1; 
                        $prod_name[] = $reg1->prod_name;
                        $sub[] = $reg1->sub_total;
                    }elseif($r->type == 3){
                        $categories = 15;
                        $match = Vendor::where('main_category', $categories)->where('city', $address->city)->orderBy('assign_priority','asc')->limit(1)->pluck('vendors_id')->first(); 
                        
                        if($location_name){
                            $reg1->assign_vendor_id = $match;
                            $reg1->quick_delivery = 1;
                        }elseif($location_name == null){ 
                            $reg1->quick_delivery = 2;
                        }
                        $reg1->prod_name=Package::where('id',$r->product_id)->pluck('package_name')->first();  
                        $reg1->prod_id = $r->product_id;  
                        $reg1->quantity =$r->quantity; 
                        $reg1->type =$r->type; 
                        $price=Package::where('id',$r->product_id)->pluck('package_cost')->first();
                        // if($r->offer_discount != null){
                            $discount = ($r->offer_discount * $price) / 100;
                            $discount1 =  $price - $discount; 
                        // }
                        $special_price = $discount1;
                        
                        if($special_price != null){
                            $reg1->sub_total=$special_price; 
                        }else{
                            $reg1->sub_total=$price;  
                        }
                        $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();  
                        $reg1->order_status = 1; 
                        $prod_name[] = $reg1->prod_name;
                        $sub[] = $reg1->sub_total;
                    }
                    $reg1->save();


                    if($special_price != null){
                        $total_amount1+=  
                        $special_price  * $r->quantity; 
                    }else{
                        $total_amount1+=  
                        $price  * $r->quantity;  
                    } 
                    
                    if($special_price != null && $reg1->extra_discount != null){  
                        $extra_discount+= ($special_price * $r->quantity *  $reg1->extra_discount)/100; 
                        $extra_discount_1 = ($special_price * $r->quantity *  $reg1->extra_discount)/100;
                    }    
                    elseif($price != null && $reg1->extra_discount != null){ 
                        $extra_discount+= ($price * $r->quantity *  $reg1->extra_discount)/100; 
                        $extra_discount_1 = ($price * $r->quantity *  $reg1->extra_discount)/100;
                    }  
                    
                    if($r->type == 1){
                        if($special_price != null){
                            $totaltype1amount +=  
                            $special_price  * $r->quantity; 
                        }else{
                            $totaltype1amount +=  
                            $price  * $r->quantity;  
                        }
                        
                        $totaltype1amount = $totaltype1amount - $extra_discount_1;
                    }
                    
                    $coupon = Session::get('couponData')['amount'];
                    $code_coupon = Session::get('couponData')['copoun_code']; 
                    $type1 = Session::get('couponData')['type1']; 
                    if($coupon != null){
                        if($type1 =='fixed'){ 
                            $tamount+= $total_amount1 - $extra_discount - $coupon;  
                        }elseif($type1 =='percentage'){
                            $tamount+= $total_amount1 - $extra_discount - ($total_amount1 * $coupon / 100);  
                        }
                    }else{
                        $tamount+= $total_amount1 - $extra_discount; 
                    }
                    
                    // $tamount =  $total_amount1 -$extra_discount-$coupon;
                    $shipping = DB::table('shipping_charges')->where('min','<=',  $tamount)->where('max','>=',$tamount)->first();
                    $tamount = $tamount > 0?$tamount:0;
                    if($tamount <= 800 ){
                        if($location_name){
                            $shipping_percent = ($tamount * $shipping->percent)/100;
                        }else{
                            $shipping_percent = "60";                    
                        } 
                    }else{
                        $shipping_percent = 0;
                    } 
                    
                    //dd($shipping_percent ); 
                    //dd($code_coupon); 
                    // if($coupon != null){
                    //     if($type1 =='fixed'){
                    //       $balance =  $coupon;
                    //     }elseif($type1 =='percent'){
                    //       $balance =  $total_amount1 * $coupon/100;
                    //     }
                    // }

                    $wallet = DB::table('de_wallets')->where('user_id',Auth::user()->id)->pluck('coin')->first();
                    $coin = $wallet * 0.25;

                    if($req->coin == 'on'){
                        if($tamount > $coin){
                            $total_amount_with_shipping = $tamount + $shipping_percent - $coin;  
                            DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
                                'coin' => $wallet - $coin / 0.25
                            ]); 
                        }elseif($tamount < $coin){
                            $left_coin = $coin - $tamount;
                            $total_amount_with_shipping =  $coin - $tamount + $shipping_percent;
                            DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
                                'coin' =>  $left_coin / 0.25
                            ]); 
                        } 
                    }else{

                        $total_amount_with_shipping = $tamount + $shipping_percent;
                    }
                    
                }  
                $p = implode("", $prod_name);
                $s  = implode("", $sub);
                if(! $location_name){
                        $curl1 = curl_init();

                        curl_setopt_array($curl1, array(
                          CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS =>"{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
                          CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json"
                          ),
                        ));
                        
                        $response1 = curl_exec($curl1);
                        
                        curl_close($curl1);
                        $data1 = json_decode($response1); 
            
                        $curl = curl_init();
                        $token =   $data1->token;
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS =>"{\n  \"order_id\": \"$reg->order_id\",\n  \"order_date\": \"2019-07-24 11:11\",\n  \"pickup_location\": \"aensa\",\n  \"channel_id\": \"custom\",\n  \"comment\": \"Reseller: M/s Goku\",\n  \"billing_customer_name\": \"$name\",\n  \"billing_last_name\": \"$name\",\n  \"billing_address\": \" $address->name\",\n  \"billing_address_2\": \"$address->name\",\n  \"billing_city\": \"$address->city\",\n  \"billing_pincode\": \"$address->pin_code\",\n  \"billing_state\": \"$address->state\",\n  \"billing_country\": \"India\",\n  \"billing_email\": \"$email\",\n  \"billing_phone\": \"9315626818\",\n  \"shipping_is_billing\": true,\n  \"shipping_customer_name\": \"$address->name\",\n  \"shipping_last_name\": \"\",\n  \"shipping_address\": \"$address->apartment\",\n  \"shipping_address_2\": \"\",\n  \"shipping_city\": \"$address->city\",\n  \"shipping_pincode\": \"$address->pin_code\",\n  \"shipping_country\": \"$address->country\",\n  \"shipping_state\": \" $address->state\",\n  \"shipping_email\": \"\",\n  \"shipping_phone\": \" $address->phone\",\n  \"order_items\": [\n    {\n      \"name\": \" $p\",\n      \"sku\": \"chakra123\",\n      \"units\": 10,\n      \"selling_price\": \" $s\",\n      \"discount\": \"\",\n      \"tax\": \"\",\n      \"hsn\": 441122\n    }\n  ],\n  \"payment_method\": \"Prepaid\",\n  \"shipping_charges\": $shipping_percent,\n  \"giftwrap_charges\": 0,\n  \"transaction_charges\": 0,\n  \"total_discount\": 0,\n  \"sub_total\": $total_amount_with_shipping,\n  \"length\": 10,\n  \"breadth\": 15,\n  \"height\": 20,\n  \"weight\": 2.5\n}",
                          CURLOPT_HTTPHEADER => array(
                            "Content-Type: application/json",
                            "Authorization: Bearer $token"
                          ),
                        )); 
                        $response = curl_exec($curl);
                        
                        curl_close($curl);
                        $data = json_decode($response, true); 
                        //echo '<pre>'; print_r( $data) ; die;
                        //dd($order_id);
                        $Shiprocket_Order_Id     =  $data['order_id'];
                        $Shiprocket_Shipment_Id      =   $data['shipment_id']; 
                        DB::table('order_items')->where('order_id',$reg->order_id)->update(['Shiprocket_Order_Id'=>$Shiprocket_Order_Id ,'Shiprocket_Shipment_Id'=>$Shiprocket_Shipment_Id]);
                    }
                $order_assign = new OrderAssignHistory;
                $order_assign->order_id = $reg->order_id; 
                $order_assign->sub_order_id = $reg1->sub_order_id;
                $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
                if(! $location_name){
                    $order_assign->Shiprocket_Order_Id = $Shiprocket_Order_Id; 
                    $order_assign->Shiprocket_Shipment_Id    = $Shiprocket_Shipment_Id ; 
                } 
                $order_assign->save();

                $order_status = new OrderStatusHistory;
                $order_status->order_id = $reg->order_id; 
                $order_status->sub_order_id = $reg1->sub_order_id;
                $order_status->order_status = 1; 
                $order_status->save(); 
                $count++;   

                // dd($shipping_percent , $total_amount_with_shipping ,$balance , $extra_discount);
                $coupon_history = new OrderCouponHistory;
                $coupon_history->user_id = Auth::user()->id; 
                $coupon_history->order_id = $reg->order_id; 
                $coupon_history->coupon_price = $balance;
                $coupon_history->coupon_code = $code_coupon;
                $coupon_history->coupon_type = $type1; 
                $coupon_history->save();

                if($req->coin == 'on'){
                    if($tamount > $coin){
                        DB::table('orders')->where('order_id', $order_id)->update([
                            'shipping_charge' => $shipping_percent,
                            'amount' =>  $total_amount_with_shipping,
                            'de_wallet_coin' =>  $wallet
                        ]);
                    }elseif($tamount < $coin){
                        DB::table('orders')->where('order_id', $order_id)->update([
                            'shipping_charge' => $shipping_percent,
                            'amount' =>  $total_amount_with_shipping,
                            'de_wallet_coin' =>  $wallet - $left_coin / 0.25
                        ]);  
                    }
                }else{
                    DB::table('orders')->where('order_id', $order_id)->update([
                        'shipping_charge' => $shipping_percent,
                        'amount' =>  $total_amount_with_shipping,
                        'de_wallet_coin' => 0
                    ]);
                } 
                $damount = floor($tamount/5);
                $walletCnt = DB::table('de_wallets')->where('user_id',Auth::user()->id)->count();
                if($walletCnt > 0){
                 DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
                                'coin' => $damount
                            ]);
                }else{
                    DB::Select(DB::raw("insert into de_wallets set coin='".$damount."', user_id='".Auth::user()->id."'"));
                }
                Cart::where('user_id',Auth::user()->id)->delete(); 
                $req->session()->forget('couponData');
                $req->session()->forget('location_name');
                $req->session()->forget('set_location_name');
                if($req->payment_mode=='COD') {
                    return redirect('order-suceess/'.$reg->order_id); exit;
                } else {
                    return redirect('get-payment/'.$reg->order_id); exit;
                }
                #return redirect('order-suceess/'.$reg->order_id); exit;
            #} 
        } 
    }
    // public function checkoutSubmit1(Request $req){
    //     if ($req->address_id) { 
    //         // Order table 
    //         if ($req->payment_mode=='COD') {
    //             $data=Cart::where('user_id',Auth::user()->id)->get();  
    //             $shipping = DB::table('shipping_charges')->where('min','<=', $req->amount)->where('max','>=',$req->amount)->first();
    //             if($req->amount <= 800 ){
    //                 $shipping_percent = ($req->amount * $shipping->percent)/100;
    //             }else{
    //                 $shipping_percent = 0;
    //             }
    //             $total_amount_with_shipping = $shipping_percent + $req->amount; 
    //             $address = DB::table('user_addresses')->where('id',$req->address_id)->first(); 
    //             $order_id = "DHD".$req->user_id.time();
    //             $reg = new Order;
    //             $reg->user_id = Auth::user()->id;
    //             $reg->order_id = $order_id; 
    //             $reg->address_id = $req->address_id; 
    //             $reg->amount = $total_amount_with_shipping;
    //             $reg->de_wallet_coin = $req->de_wallet_coin; 
    //             $reg->prescription_id = $req->prescription_id; 
    //             $reg->payment_mode = $req->payment_mode;   
    //             $reg->shipping_charge = $shipping_percent; 
    //             $reg->user_name = $address->name;  
    //             $reg->user_phone  = $address->phone;   
    //             $reg->user_address = $address->address; 
    //             $reg->user_apartment = $address->apartment; 
    //             $reg->user_city = $address->city; 
    //             $reg->user_state  = $address->state; 
    //             $reg->pin_code  = $address->pin_code; 
    //             $reg->user_country  = $address->country; 
    //             $reg->save();  
    //         //order item table  
    //             $count=0;
    //             foreach ($data as $r) {
    //                 $sub_order_id = "DHD".$req->user_id.$count.time();
    //                 $reg1 = new OrderItem;
    //                 $reg1->order_id = $reg->order_id; 
    //                 $reg1->sub_order_id = $sub_order_id;
    //                 $reg1->order_status = 1;  
    //                 $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
    //                 $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
    //                 if($special_price != null){
    //                     $reg1->sub_total=$special_price;  
    //                 }else{
    //                     $reg1->sub_total=$price;  
    //                 }
    //                 $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();  
    //                 $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();  
    //                 $reg1->prod_id = $r->product_id;
    //                 $reg1->quantity =$r->quantity; 
    //                 $count++;
    //                 $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
    //                 $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('assign_priority')->first();
    //                 //dd($match);
    //                 $reg1->assign_vendor_id = $match;
    //                 $reg1->save();  
    //             // order assign history
    //                 $order_assign = new OrderAssignHistory;
    //                 $order_assign->order_id = $reg->order_id; 
    //                 $order_assign->sub_order_id = $reg1->sub_order_id;
    //                 $order_assign->assign_vendor_id = $reg1->assign_vendor_id; 
    //                 $order_assign->save();  
    //             // order status history  
    //                 $order_status = new OrderStatusHistory;
    //                 $order_status->order_id = $reg->order_id; 
    //                 $order_status->sub_order_id = $reg1->sub_order_id;
    //                 $order_status->order_status = 1; 
    //                 $order_status->save(); 
    //             } 
    //             // User Mail
    //                 // $user = User::where('id',Auth::user()->id)->first();
    //                 // $to = $user['email'];
    //                 // $subject = 'Order Details';
    //                 // $message = "Dear ".$user->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';        
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // } 
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }  

    //                 // $user1 = User::where('user_type',1)->first();
    //                 // $to = $user1['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user1->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';        
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // } 
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }     

    //                 // $user2 = User::where('id',$match)->first();
    //                 // $to = $user2['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user2->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';        
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // } 
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }     

    //             // Cart Empty 
    //             Cart::where('user_id',Auth::user()->id)->delete(); 

    //             // DE-wallet Table data update
    //             if ($req->de_wallet_coin != null) {
    //                 DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
    //                     'coin' => 0
    //                 ]);
    //             }
                
    //             return redirect('order-suceess/'.$reg->order_id);
    //         } 
    //     }else{
    //         $data= new UserAddress;
    //         $data->user_id = Auth::id(); 
    //         $data->name = $req->name;  
    //         $data->phone  = $req->phone;   
    //         $data->address = $req->address; 
    //         $data->apartment = $req->apartment; 
    //         $data->city = $req->city; 
    //         $data->state  = $req->state; 
    //         $data->pin_code  = $req->pin_code; 
    //         $data->country  = $req->country; 
    //         $data->save(); 
    //         if ($req->payment_mode=='COD') {
    //             $data1=Cart::where('user_id',Auth::user()->id)->get(); 
    //             $order_id = "DHD".$req->user_id.time();
    //             $shipping = DB::table('shipping_charges')->where('min','<=', $req->amount)->where('max','>=',$req->amount)->first();
    //             if($req->amount <= 800 ){
    //                 $shipping_percent = ($req->amount * $shipping->percent)/100;
    //             }else{
    //                 $shipping_percent = 0;
    //             }
    //             $total_amount_with_shipping = $shipping_percent + $req->amount;
    //             //dd($shipping_percent);
    //             $reg = new Order; 
    //             $reg->user_id = Auth::user()->id;
    //             $reg->order_id = $order_id; 
    //             $reg->prescription_id = $req->prescription_id;  
    //             $reg->address_id = $data->id; 
    //             $reg->shipping_charge = $shipping_percent; 
    //             $reg->amount = $total_amount_with_shipping;
    //             $reg->de_wallet_coin = $req->de_wallet_coin;  
    //             $reg->payment_mode = $req->payment_mode; 
    //             $reg->user_name = $req->name;  
    //             $reg->user_phone  = $req->phone;   
    //             $reg->user_address = $req->address; 
    //             $reg->user_apartment = $req->apartment; 
    //             $reg->user_city = $req->city; 
    //             $reg->user_state  = $req->state; 
    //             $reg->pin_code  = $req->pin_code; 
    //             $reg->user_country  = $req->country; 
    //             //dd($req);
    //             $reg->save();   
    //             $count=0;
    //             foreach ($data1 as $r) {
    //                 $sub_order_id = "DHD".$req->user_id.$count.time();
    //                 $reg1 = new OrderItem;
    //                 $reg1->order_id = $reg->order_id; 
    //                 $reg1->sub_order_id = $sub_order_id;
    //                 $reg1->order_status = 1;   
    //                 $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
    //                 $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
    //                 if($special_price != null){
    //                     $reg1->sub_total=$special_price;  
    //                 }else{
    //                     $reg1->sub_total=$price;  
    //                 }
    //                 $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();  
    //                 $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first(); 
    //                 $reg1->prod_id = $r->product_id;
    //                 $reg1->quantity =$r->quantity;
    //                 $count++;
    //                 $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
    //                 $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('assign_priority')->first();
    //                 //dd($match);

    //                 $reg1->assign_vendor_id = $match;
    //                 $reg1->save();

    //                 $order_assign = new OrderAssignHistory;
    //                 $order_assign->order_id = $reg->order_id; 
    //                 $order_assign->sub_order_id = $reg1->sub_order_id;
    //                 $order_assign->assign_vendor_id = $reg1->assign_vendor_id; 
    //                 $order_assign->save(); 

    //                 $order_status = new OrderStatusHistory;
    //                 $order_status->order_id = $reg->order_id; 
    //                 $order_status->sub_order_id = $reg1->sub_order_id;
    //                 $order_status->order_status = 1; 
    //                 $order_status->save(); 
    //             }
    //              // User Mail
    //                 // $user = User::where('id',Auth::user()->id)->first();
    //                 // $to = $user['email'];
    //                 // $subject = 'Order Details';
    //                 // $message = "Dear ".$user->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';        
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // } 
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }  

    //                 // $user1 = User::where('user_type',1)->first();
    //                 // $to = $user1['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user1->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';        
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // } 
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }     

    //                 // $user2 = User::where('id',$match)->first();
    //                 // $to = $user2['email'];
    //                 // $subject = 'Order Status Change';
    //                 // $message = "Dear ".$user2->name.", \nYour Order Details-      \n\nThank You.";
    //                 // $headers = 'From:info@dhd.in';        
    //                 // if(mail($to, $subject, $message, $headers)) {
    //                 //     echo 'Your Order Details is Send To your registered email Address';
    //                 // } 
    //                 // else {
    //                 //     echo 'Sorry! something went wrong, please try again.';
    //                 // }     

    //             Cart::where('user_id',Auth::user()->id)->delete(); 
    //             if ($req->de_wallet_coin != null) {
    //                 DB::table('de_wallets')->where('user_id',Auth::user()->id)->update([
    //                     'coin' => 0
    //                 ]);
    //             }
    //             return redirect('order-suceess/'.$reg->order_id);
    //         } 
    //     }  
    // }

    public function orderSuccessPage($order_id){ 
        $data['flag']=4;
        $data['booking'] = Order::where('order_id',$order_id)->first();
        return view('UI/webviews/user.manage_user',$data);
    }

    public function userDashboard(){ 
        $data['flag'] = 6;
        $data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->orderBy('created_at','desc')->take(5)->get(); 
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }
    public function userProfile(){ 
        $data['flag'] = 1;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userOrderHistory(){ 
        if(Auth::user()){
            $data['flag'] = 2;
            #$data['order'] = DB::table('orders')->where('user_id' , Auth::user#()->id)->orderBy('created_at','desc')->get(); 
            
            $order = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type =1 group by order_id) and user_id='".Auth::id()."'"));
            $data['order'] = collect($order);
            //dd($order);
            
            return view('UI/webviews/user.manage_user_dashboard',$data);
        }else{
           return redirect('/');
        }
          }

    public function userMyBooking(){ 
        $data['flag'] = 3;
        $order = DB::Select(DB::raw("Select * from orders where order_id in (Select order_id from order_items where type =2 or type =3 group by order_id) and user_id='".Auth::id()."'"));
            $data['order'] = collect($order);
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userAddress(){ 
        $data['flag'] = 4;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userAddressEdit(Request $req){ 
        $data['flag'] = 7;
        $data['address'] = UserAddress::where('id' ,$req->id)->first(); 
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }

    public function userPassword(){ 
        $data['flag'] = 5;
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }
    
    public function userOrderDetail($order_id){ 
        $data['flag'] = 8;
         
        $data['order'] = OrderItem::where('order_id',$order_id)->orderBy('id','desc')->get(); 
        $data['order_status'] = DB::table('order_status')->get(); 
        // $data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->orderBy('created_at','desc')->get(); 
        return view('UI/webviews/user.manage_user_dashboard',$data);
    }
    
    public function userProfileSubmit(Request $req){   
        if($req->user_id) {  
            if($req->hasFile('image')) {
                $file = $req->file('image');
                $filename = 'userdetails'.time().'.'.$req->image->extension();
                $destinationPath = storage_path('../public/upload/userdetails');
                $file->move($destinationPath, $filename);
                $userdetails = 'upload/userdetails/'.$filename;
            }
            else{
                $userdetails=$req->image;
            }  
            UserDetail::where('user_id',$req->user_id)->update([ 
                'user_name' => $req->user_name, 
                'image' => $userdetails,
                'dob' => $req->dob,  
                'gender' => $req->gender,  
                'address' => $req->address, 
                'address2' => $req->address2,  
                'city' => $req->city, 
                'pin_code' => $req->pin_code, 
                'state' => $req->state, 
                'country' => $req->country 
            ]);  

            User::where('id',$req->user_id)->update([ 
                'name' => $req->user_name 
            ]);  
            return back()->with('msg','Profile Edit  Successfully');
        } 
    }

   
    public function trackorder(Request $req){    
        $order_id   =  $req->order_id;
        $order_data =  DB::table('order_items')->where('order_id',$req->order_id)->first();
        $Shiprocket_Order_Id  =  $order_data->Shiprocket_Order_Id;
        $Shiprocket_Shipment_Id  =  $order_data->Shiprocket_Shipment_Id;
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjU3MjAwNSwiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTM1OTcxODksImV4cCI6MTU5NDQ2MTE4OSwibmJmIjoxNTkzNTk3MTg5LCJqdGkiOiJwRVpPS256dGN1WnR1TmtaIn0.yDLq4NuwfPCPUY3sLYbGeUIJquTsU7t70Od22mio-k4";
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/courier/track/shipment/$Shiprocket_Shipment_Id",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "Authorization: Bearer $token"
        ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        echo $response; die; 
    } 
    
    public function orderCancelOrder(Request $req){  
        //dd($order_data);
        DB::table('order_items')->where('order_id',$req->order_id)->update([
            'order_status'=> $req->status 
        ]);
        return back()->with('msg','This ' .  $req->order_id  . ' Order Cancelled Successfully');
    }

    public function shippingorderCancelOrder(Request $req){    
        $order_data =  DB::table('order_items')->where('order_id',$req->order_id)->first();
        $Shiprocket_Order_Id  =  $order_data->Shiprocket_Order_Id;
        $Shiprocket_Shipment_Id  =  $order_data->Shiprocket_Shipment_Id;
        $curl = curl_init();
        $token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOjU3MjAwNSwiaXNzIjoiaHR0cHM6Ly9hcGl2Mi5zaGlwcm9ja2V0LmluL3YxL2V4dGVybmFsL2F1dGgvbG9naW4iLCJpYXQiOjE1OTM1OTcxODksImV4cCI6MTU5NDQ2MTE4OSwibmJmIjoxNTkzNTk3MTg5LCJqdGkiOiJwRVpPS256dGN1WnR1TmtaIn0.yDLq4NuwfPCPUY3sLYbGeUIJquTsU7t70Od22mio-k4";
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "POST",
        CURLOPT_POSTFIELDS =>"{\n  \"ids\": [$Shiprocket_Order_Id]\n}",
        CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json",
                "Authorization: Bearer $token"
            ),
        )); 
        $response = curl_exec($curl); 
        curl_close($curl);
        echo $response;
        //dd($order_data);
        DB::table('order_items')->where('order_id',$req->order_id)->update([
            'order_status'=> $req->status 
        ]);
        return back()->with('msg','This ' .  $req->order_id  . ' Order Cancelled Successfully');
    }
    

    public function addReviewComment(Request $req){   
        if (Review::where(['user_id'=>Auth::id(),'product_id'=>$req->product_id])->count()>0) {
            return back()->with('msg2', 'You already give a rating or review');
        }
        else{
            $reg = new Review;
            $reg->user_id = Auth::id();
            $reg->user_name = $req->user_name;
            $reg->product_id = $req->product_id;
            $reg->email = $req->email;
            $reg->comment = $req->comment;
            $reg->rating = $req->rating;
            $reg->type = $req->type;
            $reg->save();
            if($req->type == 1){

                $data = Product::where('products_id',$req->product_id)->first(); 
                $data1 = $data->rating;  
                Product::where('products_id',$req->product_id)->update([
                    'rating'=>($req->rating + $data1)/2
                ]); 
            }elseif($req->type == 2){
                $data = Package::where('id',$req->product_id)->first(); 
                $data1 = $data->rating;  
                Package::where('products_id',$req->product_id)->update([
                    'rating'=>($req->rating + $data1)/2
                ]); 
            }
            return back()->with('msg2', 'You give a rating or review successfully!');
        }
    } 

    public function prescription(Request $req){
        try {
            $file = $req->file('prescription_image');
            if($req->hasFile('prescription_image')) {
                $file = $req->file('prescription_image');
                $filename = 'prescription'.time().'.'.$req->prescription_image->extension();
                $destinationPath = storage_path('../public/upload/prescription');
                $file->move($destinationPath, $filename);
                $data= new Prescription;
                $data->user_id = Auth::id(); 
               
                $data->comment = $req->comment; 
                $data->prescription_image = 'upload/prescription/'.$filename;  
                $data->save();
                echo '1';
            } else{
                echo '2';
               
            }
            exit;
        } catch(Exception $e){
            echo '2';
            exit;
        }
        
        //return redirect('/checkout1/'.$data->user_id.'/'.$data->id);
    }
    public function forgetPasswordView()
    {
        return view('UI.webviews.forget_password_view_website');
    }
    public function forgotPasswordSubmit(Request $req){
        if(User::where('email', $req->email)->count() > 0) {
            //$token = 
            $reg = new PasswordReset;
            $reg->email = $req->email;
            $reg->save();

            $token = sha1(rand()).$reg->id;

            PasswordReset::where('email', $req->email)->update(['validator' => $token]);
            
            $user = User::where('email',$req->email)->first();
            $phone=User::where('email', $req->email)->pluck('phone')->first();
            //dd($user);
            if ($phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Please click on the given URL to complete the proccess. Your password reset link is http://lsne.in/dhd/public/passwordreset/".$token);
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }
            $to = $req->email;
            $subject = 'Password Reset';
            $message = "Your password reset link  is :\nhttp://lsne.in/dhd/public/passwordreset/".$token." \n\nThank You  \n\nTeam DrHelpDessk";
            $headers = 'From: dhd@lsne.in';        
            // if(mail($to, $subject, $message, $headers)) {
               
            // } else {
                
            // }
            Mail::send('emails.password_reset', ['msg' => $message, 'user' => $user] , function($message) use ($to){ 
            $message->to($to, 'User')->subject('Reset Password'); 
            $message->from('dhd@lsne.in','Drhelpdesk');
         });    
                
            return back()->with('msg','Your password reset link has been sent to your registered mobile number and email successfully');
        } else {
            return back()->with('msg','Email Not Register');
        }
    }
    public function forgetPassword($id)
    {  
        $forms=PasswordReset::where('validator',$id)->first();
        //$forms = profiles::where('id',$id)->select('email')->first();  
      return view('UI.webviews.forgetpassword' ,compact("forms"));
    }

    public function submit(Request $req)
    {
        $jsonDatat = json_decode($req->email, true);
       
        $password = $req->password;
        $confirm_password = $req->cnf_password;
        if($password == $confirm_password && $jsonDatat['email'] != null)
        {
           User::Where('email', $jsonDatat['email'])->update([
            'password'=>bcrypt($req->password)
                                                        ]);
                                                        
             User::Where('email', $jsonDatat['email'])->update([
            'password'=>bcrypt($req->password)
                                                        ]);                                            
                                                         
           PasswordReset::where('email',  $jsonDatat['email'])->delete();
           return redirect('login-user')->with('message','Your Password Is SuccessFully Changed ! Please Login');
           
        } 
        else
        { 
            return back()->with('msg', 'password do not match, please try again');
        } 
    }
    

    public function thanku()
    {
        return view('UI.webviews.thanku');
    }
    
    public function packageAddtToCart(Request $req){    
        $session = Session::getId(); 
        $type = 3; 
        if(Auth::check()){
            $result1=DB::table('carts')->where('product_id',$req->products_id)->where('user_id',Auth::user()->id)->count(); 
            if($result1 == 0){
                DB::table('carts')->insert([
                    'product_id'=>$req->products_id,
                    'user_id'=> Auth::user()->id,
                    'type' => $type,
                    'quantity'=>1 
                ]); 
            }
        }else{
            $result=DB::table('temp_carts')->where('product_id',$req->products_id)->where('session_id',$session)->count(); 
            if($result == 0){
                DB::table('temp_carts')->insert([
                    'product_id'=>$req->products_id,
                    'session_id'=> $session,
                    'type' => $type,
                    'quantity'=>1 
                ]); 
            }
        } 
        Session::flash ( 'message1', "Packages Added into Cart" );
        return back(); 
    }
    
    // for coupon on  ajax
     public function userMyCartOnAjax(Request $req){ 
        $value = $req->session()->get('location_name');
        $dt = Carbon::now()->toDateString(); 
        //dd($req->coupon_code);
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupon_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first(); 
        //dd($coupon1);
        if (Auth::check()) {
           $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupon_code)->where('user_id',Auth::user()->id)->get(); 
          // dd($match->count());
        } 
        //dd($req->session()->get('couponData')['type1']);
        
        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                $copoun_name = $coupon1->copoun_name;
                $data['result1']="$copoun_name Applied"; 
                $data['type'] = $coupon1->type; 
                $type1 = $coupon1->type;
                $cc = $coupon1->amount; 
                $copoun_code = $coupon1->copoun_code;
                $coupondata = array('copoun_code'=>$copoun_code, 'type1'=>$type1, 'amount'=>$cc);
                $req->session()->put('couponData', $coupondata);
                
            }else{
                $data['result1']='Your copoun code limit exceed.'; 
            }  
            //($data['result1']);
        } 
        else{
            $data['result1']='';  
        }
        
         }
         
         
        public function userBookingDetails($order_id){ 
            $data['flag'] = 8;
            
            $data['order'] = OrderItem::where('order_id',$order_id)->orderBy('id','desc')->get(); 
            $data['order_status'] = DB::table('order_status')->get(); 
            // $data['order'] = DB::table('orders')->where('user_id' , Auth::user()->id)->orderBy('created_at','desc')->get(); 
            return view('UI/webviews/user.manage_user_dashboard',$data);
        }
        
        public function orderFailPage($order_id){ 
            $data['flag']=8;
            $data['booking'] = Order::where('order_id',$order_id)->first();
            return view('UI/webviews/user.manage_user',$data);
        }
        
  function isEmail($email) {
      return (preg_match("/(@.*@)|(\.\.)|(@\.)|(\.@)|(^\.)/", $email) || !preg_match("/^.+\@(\[?)[a-zA-Z0-9\-\.]+\.([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/", $email)) ? false : true;
     }
     
     
} 