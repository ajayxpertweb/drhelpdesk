<?php 
namespace App\Http\Controllers\api; 
use Illuminate\Support\Facades\Hash; 
use Mail; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\UserDetail;
use App\Review;
use App\Coupon;
use App\OrderCouponHistory;
use DB;
use App\DeWallet; 
use App\ApplyReferCode;
use App\PasswordReset;
use Carbon\carbon;
use App\OtpStore;
use App\ConsultationHistory;
use App\ConsultationTransaction;
use App\Wallet; 
use App\WalletTransactionHistory;
use App\DoctorFeedback;

class UserController extends Controller
{
	public function login(Request $req){
		$user1=User::where('email',$req->user_name)->orWhere('phone',$req->user_name)->select('id','name','email','phone','password','user_type')->first(); 
        if($req->user_type == 4){
             $user = User::Join('vendors','users.id','vendors.user_id')->where('users.email',$req->user_name)->orWhere('users.phone',$req->user_name)->select('users.*' ,'vendors.*')->first(); 
        }elseif($req->user_type == 5){
             $user = User::Join('delivery_boys','users.id','delivery_boys.user_id')->where('users.email',$req->user_name)->orWhere('users.phone',$req->user_name)->select('users.*' ,'delivery_boys.*')->first(); 
        }
        elseif($req->user_type == 2){
            $user = User::Join('user_details','users.id','user_details.user_id')->where('users.email',$req->user_name)->orWhere('users.phone',$req->user_name)->select('users.id','users.name','users.email','users.phone','users.password','users.refer_code','users.user_type','user_details.image','user_details.gender','user_details.dob','user_details.address','user_details.address2','user_details.city','user_details.pin_code','user_details.state','user_details.country')->first(); 
        }elseif($req->user_type == 3){
            $user = User::Join('user_details','users.id','user_details.user_id')->where('users.email',$req->user_name)->orWhere('users.phone',$req->user_name)->select('users.id','users.name','users.email','users.phone','users.password','users.refer_code','users.user_type','user_details.image','user_details.gender','user_details.dob','user_details.address','user_details.address2','user_details.city','user_details.pin_code','user_details.state','user_details.country','user_details.speciality','user_details.service','user_details.specialization','user_details.consultation_fees','user_details.number_of_consultation','user_details.description')->first(); 
        }
		if($user != null) {
			if($user->password!=null){
				if (Hash::check($req->password,$user->password) && $user->user_type==$req->user_type) {
					return response()->json($data = [
						'status' => 200,
						'msg' => 'Login Successfully', 
						'user'=>$user,   
					]);
				}
				else{
					return response()->json($data = [
						'status' => 400,
						'msg' => 'Credential not match'
					]);
				}
			}     
		}
		else{
			return response()->json($data = [
				'status' => 404,
				'msg' => 'User Not Found'
			]);
		}  
	}  
    public function register(Request $req){
        $user= null; 
        if($req->email){
            $user=User::where('email',$req->email)->first();
        }if($req->phone){
            $user=User::where('phone',$req->phone)->first();
        }if( $user !=null) {   
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Already Registered'
            ]);
        }else{ 
            $reg = new User;
            $reg->name = $req->name;
            $reg->email = $req->email;
            $reg->password = bcrypt($req->password);
            $reg->phone = $req->phone; 
            $reg->user_type = $req->user_type; //1 for admin 2-user , 3-doctor
            $is_saved = $reg->save(); 

            // $rest = substr($req->name, 0,3); 
            // $num  = sprintf("%02s", $reg->id);
            $refer_code = rand (100000, 999999);
            //dd($refer_code);
            if ($is_saved) {           
                DB::table('users')->where('id', $reg->id)->update([
                    'refer_code' => $refer_code
                ]);
            }
            
            $reg1= new UserDetail;
            $reg1->user_id=$reg->id;
            $reg1->user_name=$reg->name;
            $reg1->email=$reg->email;
            $reg1->mobile=$reg->phone;
            $reg1->save();
            
            if($req->apply_refer_code == null){
                $data2 = new DeWallet;
                $data2->user_id=$reg->id;
                $data2->coin = 0; 
                $data2->save();
            }
            
            if($req->apply_refer_code != null){
                $refer_code1 = new ApplyReferCode;
                $refer_code1->user_id = $reg->id;
                $refer_code1->apply_refer_code = $req->apply_refer_code; 
                $refer_code1->save(); 
            }

            $user = User::where('email',$req->email)->first();
            if ($req->phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Your refer code is ".$refer_code." Thank you for registering with DrHelpDesk.Enjoy Online Shopping.                                                     Stay Home !!!  Stay safe !!!");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            } 
            if($req->apply_refer_code != null){
                $check_refer_code = User::where('refer_code',$req->apply_refer_code)->first();
                DB::table('de_wallets')->where('user_id', $check_refer_code->id)->update([
                        'coin' => $check_refer_code->coin + 20
                ]);
                
                $data2 = new DeWallet;
                $data2->user_id=$reg->id;
                $data2->coin = 20; 
                $data2->save();
            
                if ($check_refer_code->phone != null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Your refer code is used by other and you earn 20 coin in your de-wallet account");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$check_refer_code->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                } 
            }
            $user1 = User::where('user_type',1)->first();
            if($user->user_type == 2){
                $user_type = 'User';
            }elseif($user->user_type == 3){
                $user_type = 'Doctor';
            } 
            if($req->user_type == 2){
                $to_name = $reg->name;
                $to_email = $reg->email; 
                Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
            }elseif($req->user_type == 3){
                $to_name = $reg->name;
                $to_email = $reg->email; 
                Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
            } 
            if ($reg) {
                return response()->json($data = [
                    'status' => 200, 
                    'msg' => 'Registration Successfull', 
                    'user'=>User::Join('user_details','users.id','user_details.user_id')->where('users.id',$reg->id)->select('users.id','users.name','users.email','users.phone','users.user_type','users.refer_code','user_details.image','user_details.gender','user_details.dob','user_details.address','user_details.address2','user_details.city','user_details.pin_code','user_details.state','user_details.country','user_details.speciality','user_details.service','user_details.specialization','user_details.consultation_fees','user_details.number_of_consultation','user_details.description')->first()
                ]);
            }else {
                return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Something Went Wrong'
                ]);
            }
        } 
    }
    public function socialLogin(Request $req){
        $user= null;//User::where('email',$req->email)->orWhere('phone',$req->phone)->first();
        if($req->email){
            $user=User::where('email',$req->email)->first();
        }
        else{
            $user=User::where('phone',$req->phone)->first();
        }
        if( $user !=null) {    
         return response()->json($data = [
             'status' => 200,
             'msg' => 'Already Registered',
             'user'=>User::Join('user_details','users.id','user_details.user_id')->where('users.id',$user->id)->select('users.id','users.name','users.email','users.phone','users.user_type','users.refer_code','user_details.image','user_details.gender','user_details.dob','user_details.address','user_details.address2','user_details.city','user_details.pin_code','user_details.state','user_details.country','user_details.speciality','user_details.service','user_details.specialization','user_details.consultation_fees','user_details.number_of_consultation','user_details.description')->first()
          ]);
         }
         //else if($req->phone){
        else{
             //$otp = rand (1000, 9999);
            $reg = new User;
            $reg->name = $req->name;
            $reg->email = $req->email;
            $reg->password = bcrypt($req->password);
            $reg->phone = $req->phone;
            $reg->user_type = $req->user_type;
            $is_saved = $reg->save();

            $reg1= new UserDetail;
            $reg1->user_id=$reg->id;
            $reg1->user_name=$reg->name;
            $reg1->email=$reg->email;
            $reg1->mobile=$reg->phone;
            $reg1->save();
            $refer_code = rand (100000, 999999);
            //dd($refer_code);
            if ($is_saved) {           
                DB::table('users')->where('id', $reg->id)->update([
                    'refer_code' => $refer_code
                ]);
            }
            $user = User::where('email',$req->email)->first(); 
            $user1 = User::where('user_type',1)->first();
            if($user->user_type == 2){
                $user_type = 'User';
            }elseif($user->user_type == 3){
                $user_type = 'Doctor';
            } 
            if($req->user_type == 2){
                $to_name = $reg->name;
                $to_email = $reg->email; 
                Mail::send('emails.user_reg_mail',  ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
            }elseif($req->user_type == 3){
                $to_name = $reg->name;
                $to_email = $reg->email; 
                Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
            } 
            if ($reg) {
                 return response()->json($data = [
                     'status' => 200,
                     'msg' => 'First Time Login Successfull',
                     'user'=>User::Join('user_details','users.id','user_details.user_id')->where('users.id',$reg->id)->select('users.id','users.name','users.email','users.phone','users.user_type','users.refer_code','user_details.image','user_details.gender','user_details.dob','user_details.address','user_details.address2','user_details.city','user_details.pin_code','user_details.state','user_details.country')->first()
                  ]);
             }
             else {
                 return response()->json($data = [
                     'status' => 201,
                     'msg' => 'Something Went Wrong'
                  ]);
             }
         }
    }
    public function writeReview(Request $req){
	 if (Review::where(['user_id'=>$req->user_id,'product_id'=>$req->product_id])->count()>0) {
		return response()->json($data = [
			'status' => 200,
			'msg' => 'You already give review on this product',
			'data'=>Review::where(['user_id'=>$req->user_id,'product_id'=>$req->product_id])->first()
		 ]);
	 }
	 else{
		$reg = new Review;
        $reg->user_id = $req->user_id;
        $reg->user_name = $req->user_name;
        $reg->product_id = $req->product_id;
        $reg->email = $req->email;
        $reg->comment = $req->comment;
        $reg->rating = $req->rating;
        $reg->save();
        if ($reg) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Reviews Added Successfully',
                'data'=>Review::where('id',$reg->id)->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
	 }
    }
    public function showReview(Request $req){
		$product=Review::where(['product_id'=>$req->product_id])->get();
		$rating=Review::where(['product_id'=>$req->product_id])->avg('rating');
		$people=Review::where(['product_id'=>$req->product_id])->distinct()->count('user_id');
        
        if ($product->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Reviews Data',
                'people'=>$people,
                'rating'=>$rating,
                'result'=>$product
             ]);
        }
        else{
            return response()->json($data = [
                'status' => 404,
                'msg' => 'No Review Found'
             ]);
        }
    }
    public function applyCoupen(Request $req){
        $dt = Carbon::now()->toDateString();
        $coupon1 = DB::table('coupons')->where('copoun_code',$req->coupen_code)->where('from', '<=', $dt)->where('to', '>=', $dt)->first(); 
        //dd($coupon1);
        $match = DB::table('order_coupon_histories')->where('coupon_code',$req->coupen_code)->where('user_id',$req->id)->get();  

        if($coupon1 != null){
            if($match->count() <= $coupon1->no_of_uses){
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Success',
                    'result'=>$coupon1
                ]); 
            }else {
                return response()->json($data = [
                    'status' => 203,
                    'msg' => 'You Are Already Uses This Coupen Code'
                 ]);
            } 
        }else {
            return response()->json($data = [
                'status' => 202,
                'msg' => 'Coupen Code Does Not Match'
             ]);
        }  
    } 
    public function forgotPassword(Request $req){
        if(User::where('email', $req->email)->count() > 0) {
            //$token = 
            $reg = new PasswordReset;
            $reg->email = $req->email;
            $reg->save();

            $token = sha1(rand()).$reg->id;

            PasswordReset::where('email', $req->email)->update(['validator' => $token]);

            $phone=User::where('email', $req->email)->pluck('phone')->first();
            //dd($user);
            if ($phone!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Please click on the given URL to complete the proccess. Your password reset link is http://lsne.in/dhd/public/passwordreset/".$token);
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$phone."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);


            }
            $to = $req->email;
            $subject = 'Password Reset';
            $message = "Your password reset link  is :\nhttp://lsne.in/dhd/public/passwordreset/".$token." \n\nThank You  \n\nTeam DrHelpDesk";
            $headers = 'From: dhd@lsne.in';        
            if(mail($to, $subject, $message, $headers)) {
               
            } else {
                
            }

            return response()->json($data = [
                'status' => 200,
                'msg' => 'Your password reset link has been sent to your registered mobile number and email successfully'
            ]);
        } else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Email not registered'
            ]);
        }
    }
    public function changePassword(Request $req){
        $password= User::where('id',$req->user_id)->pluck('password')->first();
        $new=$req->new_pwd;
        $cnf=$req->cnf_pwd;
        if(Hash::check($req->password,$password)){
            if($new==$cnf){
                User::where('id',$req->user_id)->update([
                    'password'=>bcrypt($req->new_pwd),
                     
                ]);
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Password Change Successfully'
                ]);
            }
            else{
                return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Confirm Password Not Match'
                ]);
            }
        }
        else{
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Your Credential Not Match'
            ]);
        }
    }
    // public function editProfile(Request $req){   
    //     if($req->hasFile('image')) {
    //         $file = $req->file('image');
    //         $filename = 'userdetails'.time().'.'.$req->image->extension();
    //         $destinationPath = storage_path('../public/upload/userdetails');
    //         $file->move($destinationPath, $filename);
    //         $userdetails = 'upload/userdetails/'.$filename;
    //     }
    //     else{
    //         $userdetails=$req->image;
    //     }  
    //     UserDetail::where('user_id',$req->user_id)->update([ 
    //         'user_name' => $req->user_name, 
    //         'email' => $req->email, 
    //         'mobile' => $req->mobile, 
    //         'image' => $userdetails,
    //         'dob' => $req->dob,  
    //         'gender' => $req->gender,  
    //         'address' => $req->address, 
    //         'address2' => $req->address2,  
    //         'city' => $req->city, 
    //         'pin_code' => $req->pin_code, 
    //         'state' => $req->state, 
    //         'country' => $req->country 
    //     ]);  

    //     User::where('id',$req->user_id)->update([ 
    //         'name' => $req->user_name 
    //     ]);  
        
             
    //     // $msg=urlencode("Your refer code is ".$userdetails." Thank you for registering with DrHelpDesk.Enjoy Online Shopping.Stay Home !!!  Stay safe !!!");
    //     // $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->mobile."&message=".$msg);
    //     // curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
    //     // $response=curl_exec($curl);
    //     // curl_close($curl);
       
    //     if ($req->user_id) {
    //         return response()->json($data = [
    //             'status' => 200,
    //             'msg' => 'Profile Edit Successfully',
    //             'profile'=>UserDetail::where('user_id',$req->user_id)->select('user_details_id','user_id','user_name','dob','image','gender','address','address2','city','state','pin_code','country')->first()
    //          ]);
    //     }
    //     else {
    //         return response()->json($data = [
    //             'status' => 201,
    //             'msg' => 'Something Went Wrong'
    //          ]);
    //     }
    // }  
    public function editProfile(Request $req){   
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
            'email' => $req->email, 
            'mobile' => $req->mobile, 
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
        if($req->user_type == 3){
            UserDetail::where('user_id',$req->user_id)->update([ 
                'speciality' => $req->speciality, 
                'service' => $req->service, 
                'specialization' => $req->specialization, 
                'consultation_fees' => $req->consultation_fees,
                'number_of_consultation' => $req->number_of_consultation,  
                'description' => $req->about 
            ]);
        } 
        User::where('id',$req->user_id)->update([ 
            'name' => $req->user_name 
        ]);   
        if ($req->user_id) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Profile Edit Successfully',
                'profile'=>UserDetail::where('user_id',$req->user_id)->select('user_details_id','user_id','user_name','dob','image','gender','address','address2','city','state','pin_code','country','speciality','service','specialization','consultation_fees','number_of_consultation','description')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    } 
    public function otp(Request $req){
        //dd($req->mobile_no);
        $check = DB::table('users')->orwhere('phone', $req->mobile_no)->orwhere('email', $req->email)->first(); 
        if($check == null) { 
            $reg = new OtpStore;
            $reg->mobile_no = $req->mobile_no; 
            $reg->save(); 
            
            $token = rand(111111, 999999);  
             
            $msg=urlencode($token." is your DrHelpDesk verification code. Stay Home!!! Stay Safe!!");
            $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->mobile_no."&message=".$msg);
            curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
            $response=curl_exec($curl);
            curl_close($curl); 
                
            OtpStore::where('mobile_no', $req->mobile_no)->update([
                'otp' => $token
            ]); 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'your otp is '. $token .' sent to your number successfully',
                'otp' =>$token,
                
            ]);
        }elseif($check->email != $req->email) {  
            return response()->json($data = [
                'status' => 400,
                'msg' => 'mobile number is already registered',
                'check' =>1,
                
            ]);
        }elseif($check->phone != $req->mobile_no) {  
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Email is already registered',
                'check' =>2,
                
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'mobile number or email is already registered',
                'check'=> 3
            ]);
        }
    }
    public function applyReferCode(Request $req){ 
        $apply_refer_code = DB::table('users')->where('refer_code',$req->refer_code)->select('refer_code')->first(); 
        //dd($coupon1); 
        if($apply_refer_code != null){ 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Success',
                'result'=>$apply_refer_code
            ]);  
        }else {
            return response()->json($data = [
                'status' => 202,
                'msg' => 'Refer Code Not Match'
             ]);
        }  
    }  
    public function consultDoctorList(Request $req){ 
        $doctor_list = ConsultationHistory::Join('user_details','consultation_histories.doc_id','user_details.user_id')->where('consultation_histories.user_id',$req->user_id)->select('consultation_histories.*','user_details.image','user_details.user_name','user_details.user_details_id')->get();   
         
        if($doctor_list->count() > 0){ 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Success',
                'doctor_list'=>$doctor_list
            ]);  
        }else {
            return response()->json($data = [
                'status' => 202,
                'msg' => 'You have not consult any doctor till now'
             ]);
        }  
    } 
    public function userUsesDoctor(Request $req){ 
        $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$req->doctor_id)->orderBy('created_at','desc')->pluck('consultation_credit')->first(); 
        if($no_of_uses_left  == null){
            $no_of_uses_left = 0;
        }
        $wallet_amount = Wallet::where('user_id',$req->user_id)->pluck('amount')->first(); 
        $total_no_consultation =  ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$req->doctor_id)->orderBy('id','desc')->get();  
         
        if($wallet_amount >= 0){ 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Success',
                'wallet_balance_amount'=>$wallet_amount,
                'no_of_uses_left'=>$no_of_uses_left,
                'total_no_consultation'=>$total_no_consultation,
            ]);  
        }else {
            return response()->json($data = [
                'status' => 202,
                'msg' => 'You have not any credit to contact from doctor please recharge your wallet'
             ]);
        }  
    }    
    public function userWalletHistory(Request $req){ 
        $wallet_amount = Wallet::where('user_id',$req->user_id)->select('amount')->first();  
        $transaction_history =  WalletTransactionHistory::where('user_id',$req->user_id)->orderBy('id','desc')->get();  
         
        if($transaction_history->count() > 0){ 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Success',
                'wallet_amount'=>$wallet_amount,
                'transaction_history'=>$transaction_history,
            ]);  
        }else {
            return response()->json($data = [
                'status' => 202,
                'msg' => 'You have not recharge your wallet'
             ]);
        }  
    }   
    public function userAddWallet(Request $req){  
        $totalAmt = 0;
        if(!empty($req->user_id) && $req->user_id > 0) {
            $wallet_details = DB::table('wallets')->where('user_id', $req->user_id)->first();
            if(empty($wallet_details)) {
                $wallet = new Wallet;
                $wallet->user_id = $req->user_id;
                $wallet->amount = $req->amount; 
                $totalAmt = $req->amount;
                $wallet->save();
                $wallet1  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            } else {
                $alAmt = (int) $wallet_details->amount;
                $currentAmt = (int) $req->amount;
                $totalAmt = $alAmt+$currentAmt;
                Wallet::where('user_id',$req->user_id)->update([
                    'amount'=>$totalAmt
                ]);
                $wallet1  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            } 
            $data2 = new WalletTransactionHistory;
            $data2->user_id = $req->user_id;
            $data2->amount =  $req->amount;
            $data2->payment_request_id = $req->payment_request_id;
            $data2->payment_status = $req->payment_status;
            $data2->payment_id = $req->payment_id; 
            $data2->save();

            if ($data2 != null) {
                return response()->json($data = [
                 'status' => 200,
                 'msg' => 'Wallet Recharge Successfull',
                 'transaction_history'=> $data2,
                 'user'=> $wallet1
              ]);
            }
        }
        else {
            return response()->json($data = [
             'status' => 201,
             'msg' => 'Something Went Wrong'
          ]);
        }
    }  
    public function consultDoctor(Request $req){  
        $doctor = DB::table('user_details')->where('user_id',$req->doctor_id)->first();
        $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$req->doctor_id)->orderBy('id','desc')->first(); 
        $no_of_uses_left1 = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$req->doctor_id)->first(); 
        //dd($no_of_uses_left1);
        
        if($no_of_uses_left->consultation_credit > 0){ 
            $doctor = DB::table('user_details')->where('user_id',$req->doctor_id)->first();
            $consult_history = new ConsultationHistory;
            $consult_history->user_id = $req->user_id;
            $consult_history->doc_id = $req->doctor_id;
            $consult_history->status = $req->status;
            $consult_history->type = $req->type;
            $consult_history->start_date_time =  Carbon::now();  
            $consult_history->save(); 
            
            $consult_trans = new ConsultationTransaction;
            $consult_trans->user_id = $req->user_id;
            $consult_trans->doc_id = $req->doctor_id;
            $consult_trans->consultation_credit = $no_of_uses_left->consultation_credit - 1;
            $consult_trans->type = $req->type; 
            $consult_trans->save();    
            
            // $wallet  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            // DB::table('wallets')->where('user_id', $req->user_id)->update([
            //     'user_id' => $req->user_id,
            //     'amount' => $wallet->amount - $req->amount
            // ]);
            $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'consult_trans'=>$consult_trans,
                'consult_history'=>$consult_history,
                'wallet'=> $wallet_amount,
            ]);
        }elseif($no_of_uses_left->consultation_credit ==  0){  
            $doctor = DB::table('user_details')->where('user_id',$req->doctor_id)->first();
            $consult_trans = new ConsultationTransaction;
            $consult_trans->user_id = $req->user_id;
            $consult_trans->doc_id = $req->doctor_id;
            $consult_trans->consultation_credit = $doctor->number_of_consultation;
            $consult_trans->type = $req->type; 
            $consult_trans->save();    

            $consult_history = new ConsultationHistory;
            $consult_history->user_id = $req->user_id;
            $consult_history->doc_id = $req->doctor_id;
            $consult_history->status = $req->status;
            $consult_history->type = $req->type;
            $consult_history->start_date_time =  Carbon::now(); 
            $consult_history->save();  
            
            $wallet  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            DB::table('wallets')->where('user_id', $req->user_id)->update([
                'user_id' => $req->user_id,
                'amount' => $wallet->amount - $doctor->consultation_fees
            ]);
            $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'consult_trans'=>$consult_trans,
                'consult_history'=>$consult_history,
                'wallet'=> $wallet_amount,
            ]);
        }else{
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
            ]);
        }
    }
    public function consultDoctor1(Request $req){  
        $doctor = DB::table('user_details')->where('user_id',$req->doctor_id)->first();
        $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$req->doctor_id)->orderBy('id','desc')->first(); 
        //dd($no_of_uses_left);
        $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first();
        //dd($wallet_amount);
        if(empty($doctor->consultation_fees) && empty($doctor->number_of_consultation)) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Doctor Not Available',
                'flag' => 1 
            ]); 
        }elseif($no_of_uses_left->consultation_credit > 0){ 
            $doctor = DB::table('user_details')->where('user_id',$req->doctor_id)->first();
            $consult_history = new ConsultationHistory;
            $consult_history->user_id = $req->user_id;
            $consult_history->doc_id = $req->doctor_id;
            $consult_history->status = $req->status;
            $consult_history->type = $req->type;
            $consult_history->start_date_time =  Carbon::now();  
            $consult_history->save(); 
            
            $consult_trans = new ConsultationTransaction;
            $consult_trans->user_id = $req->user_id;
            $consult_trans->doc_id = $req->doctor_id;
            $consult_trans->consultation_credit = $no_of_uses_left->consultation_credit - 1;
            $consult_trans->type = $req->type; 
            $consult_trans->save(); 

            $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first();
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'flag' => 2,
                'consult_trans'=>$consult_trans,
                'consult_history'=>$consult_history,
                'wallet'=> $wallet_amount,
            ]);
        }elseif(!empty($wallet_amount->amount) && $wallet_amount->amount >= $doctor->consultation_fees && $no_of_uses_left->consultation_credit <= 0){  
            return response()->json($data = [
                'status' => 200,
                'msg' => 'amount is available but credit is not available',
                'flag' => 3 
            ]);
        }elseif(!empty($wallet_amount->amount) && $wallet_amount->amount < $doctor->consultation_fees && $no_of_uses_left->consultation_credit <= 0){  
            return response()->json($data = [
                'status' => 200,
                'msg' => 'amount is not sufficient to contact from a doctor',
                'flag' => 4
            ]);
        }elseif(empty($wallet_amount->amount) &&  $no_of_uses_left->consultation_credit <= 0){  
            return response()->json($data = [
                'status' => 200,
                'msg' => 'amount is not available or credit is not available',
                'flag' => 4 
            ]);
        }elseif(empty($wallet_amount->amount) && empty($no_of_uses_left->consultation_credit)){  
            return response()->json($data = [
                'status' => 200,
                'msg' => 'amount add',
                'flag' => 4 
            ]);
        }elseif(empty($no_of_uses_left)) {
            $consult_trans = new ConsultationTransaction;
            $consult_trans->user_id = $req->user_id;
            $consult_trans->doc_id = $req->doctor_id;
            $consult_trans->consultation_credit = $doctor->number_of_consultation;
            $consult_trans->type = $req->type; 
            $consult_trans->save(); 

            $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first(); 

            $rest_amount = $wallet_amount ->amount - (int) $doctor->consultation_fees;

            Wallet::where('user_id',$req->user_id)->update([
                'amount'=>$rest_amount
            ]);

            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'flag' => 5,
                'consult_trans'=>$consult_trans,
                'wallet'=> $wallet_amount
            ]); 
        }  
    } 
    public function addCredit(Request $req){
        $doctor = DB::table('user_details')->where('user_id',$req->doctor_id)->first(); 
        $consult_trans = new ConsultationTransaction;
        $consult_trans->user_id = $req->user_id;
        $consult_trans->doc_id = $req->doctor_id;
        $consult_trans->consultation_credit = $doctor->number_of_consultation;
        $consult_trans->type = $req->type; 
        $consult_trans->save();   

        $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first();  
        $rest_amount = $wallet_amount ->amount - (int) $doctor->consultation_fees;

        Wallet::where('user_id',$req->user_id)->update([
            'user_id' => $req->user_id,
            'amount'=>$rest_amount
        ]);


        $wallet_amount  = DB::table('wallets')->where('user_id', $req->user_id)->first();

        if($consult_trans != null){
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'consult_trans'=>$consult_trans, 
                'wallet'=> $wallet_amount,
            ]);  
        }else{
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
            ]);
        }
    }  
    public function doctorCall(Request $req){   
        $curl = curl_init(); 
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://panelv2.cloudshope.com/api/click_to_call?from_number=".$req->from."&to_number=".$req->to." ",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS =>"{}",
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/json",
            "Authorization: Bearer BUCt3btReSZWV7aS0648huzhEpm8P75JXOkHImcZhSx83zZtxFO97S6H3qG3ziFqbCqQRk8Ze8yMeEwa"
          ),
        ));
        $error_msg = '';
        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            $error_msg = curl_error($curl);
        } 
        curl_close($curl);
        $data = json_decode($response); 
        if($data['status']!="failed") { 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success' 
            ]);
        }else{
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Failed'
            ]);
        }
             
    }   
    public function writeDoctorReview(Request $req){
        if (DoctorFeedback::where(['user_id'=>$req->user_id,'doctor_id'=>$req->doctor_id])->count()>0) {
            DoctorFeedback::where(['user_id'=>$req->user_id,'doctor_id'=>$req->doctor_id])->update([ 
                'rating' => $req->rating, 
                'feedback' => $req->feedback,
                'comment' => $req->comment,
            ]);    
            return response()->json($data = [
                'status' => 200,
                'msg' => 'You give a review to doctor',
                'data' => DoctorFeedback::where(['user_id'=>$req->user_id,'doctor_id'=>$req->doctor_id])->first()
            ]);
        }else{
            $reg = new DoctorFeedback;
            $reg->user_id = $req->user_id;
            $reg->doctor_id = $req->doctor_id;
            $reg->rating = $req->rating;
            $reg->recommendation = null;
            $reg->feedback = $req->feedback;
            $reg->comment = $req->comment;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Reviews Added Successfully',
                    'data'=>DoctorFeedback::where('id',$reg->id)->first()
                ]);
            }
            else {
                return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Something Went Wrong'
                ]);
            }
        }
    }  
    public function writeDoctorRecommendation(Request $req){
        if (DoctorFeedback::where(['user_id'=>$req->user_id,'doctor_id'=>$req->doctor_id])->count()>0) {
            DoctorFeedback::where(['user_id'=>$req->user_id,'doctor_id'=>$req->doctor_id])->update([
                'recommendation' => $req->recommendation
            ]);    
            return response()->json($data = [
                'status' => 200,
                'msg' => 'You already recomended to doctor',
                'data' => DoctorFeedback::where(['user_id'=>$req->user_id,'doctor_id'=>$req->doctor_id])->first()
            ]);
        }else{
            $reg = new DoctorFeedback;
            $reg->user_id = $req->user_id;
            $reg->doctor_id = $req->doctor_id; 
            $reg->recommendation = $req->recommendation; 
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'success',
                    'data'=>DoctorFeedback::where('id',$reg->id)->first()
                ]);
            }
            else {
                return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Something Went Wrong'
                ]);
            }
        }
    } 
}
