<?php

namespace App\Http\Controllers\admin;
use Mail; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\DeliveryBoy;
use App\User;

class DeliveryBoyController extends Controller
{
    // vendors function start  
    public function addDeliveryBoy(){
        $data['flag'] = 1; 
        $data['page_title'] = 'Add Delivery Boy'; 
         $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
        return view('admin/webviews/admin_manage_delivery_boy',$data);
    }

    public function viewDeliveryBoy(){
        $data['flag'] = 2; 
        $data['page_title'] = 'View Delivery Boy'; 
        $data['vendor'] = DeliveryBoy::orderBy('id','desc')->get(); 
        return view('admin/webviews/admin_manage_delivery_boy',$data);
    }

    public function  deleteDeliveryBoy($id){ 
        $data['result']=DeliveryBoy::where('id',$id)->delete();
        return back()->with('msg','Delivery Boy Delete Successfully');  
    }

    public function editDeliveryBoy($id){
        $data['flag'] = 3; 
        $data['page_title'] = 'Edit Delivery Boy'; 
        $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
        $data['result'] = DeliveryBoy::where('id',$id)->first(); 
        return view('admin/webviews/admin_manage_delivery_boy',$data);
    }

    public function toggleDeliveryBoyActiveStatus($status, $id) { 
        DeliveryBoy::where('id', $id)->update(['status' => $status]); 
        return back()->with('msg','Status Change Successfully'); 
    } 
     
    public function deliveryBoySubmit(Request $req){  
        if($req->id) { 
            $req->validate([
                'delivery_boy_name'=> 'required',    
                'address'=> 'required',    
                'city'=> 'required',    
                'pin_code'=> 'required',    
                'state'=> 'required',    
                'email'=> 'required',    
                'mobile'=> 'required',    
                'description'=> 'required'
            ]);  
            if($req->hasFile('logo')) {
                $file = $req->file('logo');
                $filename = 'delivery'.time().'.'.$req->logo->extension();
                $destinationPath = storage_path('../public/upload/delivery');
                $file->move($destinationPath, $filename);
                $delivery = 'upload/delivery/'.$filename;
            }
            else{
                $delivery=$req->logo;
            } 
            $address1 = $req->address.','.$req->city.','.$req->state; // Address
            // $apiKey = 'AIzaSyCkiuqHl7PnQjySEFTKBasVgT6oxQpsIeY'; // Google maps now requires an API key.
            // Get JSON results from this request
            $geo1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address1)."&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM"; 
            $geo = file_get_contents($geo1);
            $geo = json_decode($geo, true); // Convert the JSON to an array 
            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
            }
            DeliveryBoy::where('id',$req->id)->update([
                'delivery_boy_name' => $req->delivery_boy_name,  
                'latitude' => $req->latitude,  
                'longitude' => $req->longitude,  
                'logo' => $delivery,
                'address' => $req->address, 
                'city' => $req->city, 
                'pin_code' => $req->pin_code, 
                'state' => $req->state,  
                'email' => $req->email, 
                'mobile' => $req->mobile, 
                'landline' => $req->landline, 
                'website_url' => $req->website_url, 
                'description' => $req->description, 
                'latitude'=>$latitude,
                'longitude'=>$longitude 
                //   dd($req)
            ]);
            return back()->with('msg','Delivery Boy Edit Successfully');
        }else{  
            $req->validate([
                'delivery_boy_name'=> 'required',    
                'address'=> 'required',    
                'city'=> 'required',    
                'pin_code'=> 'required',    
                'state'=> 'required',    
                'email'=> 'required',    
                'mobile'=> 'required',    
                'description'=> 'required',     
                'logo' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'      
            ]); 

            if($req->hasFile('logo')) {
                $file = $req->file('logo');
                $filename = 'delivery'.time().'.'.$req->logo->extension();
                $destinationPath = storage_path('../public/upload/delivery');
                $file->move($destinationPath, $filename);
                $delivery = 'upload/delivery/'.$filename;
            } 

            $address1 = $req->address.','.$req->city.','.$req->state; // Address
            // $apiKey = 'AIzaSyCkiuqHl7PnQjySEFTKBasVgT6oxQpsIeY'; // Google maps now requires an API key.
            // Get JSON results from this request
            $geo1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address1)."&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM"; 
            $geo = file_get_contents($geo1);
            $geo = json_decode($geo, true); // Convert the JSON to an array 
            if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                $latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                $longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
            }

            $reg = new User;
            $reg->name = $req->delivery_boy_name;
            $reg->email = $req->email;
            $reg->phone = $req->mobile; 
            $reg->user_type = 5; 
            $password =rand(111111,999999);
            $reg->password = bcrypt($password);  
            $reg->save();  
            
            $data = new DeliveryBoy();
            $data->user_id = $reg->id;  
            $data->delivery_boy_name = $req->delivery_boy_name;  
            $data->latitude = $req->latitude;  
            $data->longitude = $req->longitude;  
            $data->logo  = $delivery;
            $data->address = $req->address; 
            $data->city = $req->city; 
            $data->pin_code = $req->pin_code; 
            $data->state = $req->state;  
            $data->email = $req->email; 
            $data->mobile = $req->mobile; 
            $data->landline = $req->landline; 
            $data->website_url = $req->website_url; 
            $data->description = $req->description; 
            $data->latitude = $req->latitude; 
            $data->longitude = $req->longitude;  
            $data->save(); 
            $user = User::where('email',$req->email)->first();
            if ($req->mobile!=null) {
                $otp = rand (1000, 9999);
                $msg=urlencode("Dear ".$req->delivery_boy_name.", \nYour Email-   ".$req->email."\n And Password is-     ".$password." \n\nThank You.");
                $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->mobile."&message=".$msg);
                curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                $response=curl_exec($curl);
                curl_close($curl);
            }  
            $to_name = $data->delivery_boy_name;
            $to_email = $data->email; 
            Mail::send('emails.delivery-boy-reg_mail', ['user' => $user], function($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)
                ->subject('Registration In DHD');
                $message->from('dhd@lsne.in','Drhelpdesk');
            });
            return back()->with('msg','Delivery Boy Add Successfully');
        }
    } 
    // vendors function End 
    public function getLetLong(Request $req)
    {
            //google api
            $url="https://maps.googleapis.com/maps/api/geocode/json?address=kampoo gwalior&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM";
            //open connection
            $ch = curl_init();
            // $msg=urlencode("Thank you for your registration. Please Varify the given OTP to Complete the proccess.".$otp);
            // $curl = curl_init("https://maps.googleapis.com/maps/api/geocode/json?address=kampoo gwalior&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM");
            // curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
            // $response=curl_exec($curl);
            // curl_close($curl);

            //set the url, number of POST vars, POST data
            $r=curl_setopt($ch,CURLOPT_URL, $url);
            //curl_setopt($ch,CURLOPT_POST, count($fields));
            //curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

            //execute post
            $result = curl_exec($ch);
            //$info = curl_getinfo($ch);
            //dd(curl_error($ch));
            //close connection
            curl_close($ch);

    }
}
