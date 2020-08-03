<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\DoctorSchedule;
use App\UserDetail; 
use App\ConsultationHistory; 
use App\ConsultationTransaction; 
use DB;
class DoctorController extends Controller
{
    public function doctorTimeSlot(Request $req){
    	$doctor_time_slot = DoctorSchedule::where('doctor_id',$req->doctor_id)->orderBy('id','desc')->get();
    	if($doctor_time_slot != null) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => 'success',
    			'doctor_time_slot' => $doctor_time_slot 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    
     public function doctorDashboard(Request $req){
        $doctor_detail = UserDetail::where('user_id',$req->doctor_user_id)->first();
        $doctor_experience = DB::table('experiance')->where('user_id',$req->doctor_user_id)->get();
        $sum = 0;
        $rating = 0;
        if($doctor_experience !=  null){
            foreach($doctor_experience as $r){ 
                $date1 = strtotime($r->fromstart);  
                $date2 = strtotime($r->toend);   
                $diff = abs($date2 - $date1);   
                $years = floor($diff / (365*60*60*24));   
                $months = floor(($diff - $years * 365*60*60*24) 
                / (30*60*60*24));   
                $days = floor(($diff - $years * 365*60*60*24 -  
                $months*30*60*60*24)/ (60*60*24));  
                $hours = floor(($diff - $years * 365*60*60*24  
                - $months*30*60*60*24 - $days*60*60*24) 
                / (60*60));   
                $minutes = floor(($diff - $years * 365*60*60*24  
                - $months*30*60*60*24 - $days*60*60*24  
                - $hours*60*60)/ 60);   
                $seconds = floor(($diff - $years * 365*60*60*24  
                - $months*30*60*60*24 - $days*60*60*24 
                - $hours*60*60 - $minutes*60));  
                $sum+= $years; 
            } 
        }
        $patient_detail = ConsultationTransaction::where('doc_id',$req->doctor_user_id)->orderBy('id','desc')->get();
        foreach($patient_detail as $r){
            $patient_name = UserDetail::where('user_id',$r->user_id)->first();
            if($patient_name != null){
                $r->name = $patient_name->user_name;
                $r->image = $patient_name->image;
            }else{
                $r->name = null;
                $r->image = null;
            }
        }
        $fper = 0;
        $cfeedback = DB::table('doctor_feedbacks')->where('doctor_id',$doctor_detail->user_details_id)->get();
        foreach($cfeedback as $r){
            $category1= UserDetail::where('user_id',$r->user_id) 
            ->first(); 
            if($category1 != null){
                $r->user_name = $category1->user_name;
                $r->image = $category1->image; 
            }else{
                $r->user_name = null;
                $r->image = null; 
            } 
            $rating+= $r->rating;
        }
        // $doctor_detail->feedback = DB::table('doctor_feedbacks')->where('doctor_id',$doctor_detail->user_details_id)->count(); 
        $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id',$doctor_detail->user_details_id)->where('recommendation','yes')->get(); 
        if($posFeddback->count()>0 && $cfeedback->count()>0){
            $fper = ($posFeddback->count()*100)/$cfeedback->count();    
            $recommendation= floor($fper);
        }else{
            $recommendation = null;
        }
        if($doctor_detail != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'patient_count' => $patient_detail->count(),
                'ratings' => $rating/$cfeedback->count(),
                'feedback' =>  $cfeedback->count(),
                'experience' =>  $sum,
                'doctor_experience' =>  $doctor_experience,
                'doctor_detail' => $doctor_detail, 
                'patient_detail' => $patient_detail,
                'recommendation' => $recommendation,
                'cfeedback' => $cfeedback, 
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    
    public function clinicDetailsSubmit(Request $req) {
        if ($req->user_id) { 
            if ($req->hasFile('department_icon')) {
                $file = $req->file('department_icon');
                $filename = 'departmenticon' . time() . '.' . $req->department_icon->extension();
                $destinationPath = storage_path('../public/upload/departmenticon');
                $file->move($destinationPath, $filename);
                $departmenticon = 'upload/departmenticon/' . $filename;
            } else {
                $departmenticon = $req->image;
            }
            if ($req->hasFile('clinic_image_one')) {
                $file = $req->file('clinic_image_one');
                $filename = 'clinicimage' . time() . '.' . $req->clinic_image_one->extension();
                $destinationPath = storage_path('../public/upload/clinicimage');
                $file->move($destinationPath, $filename);
                $clinicimage1 = 'upload/clinicimage/' . $filename;
            } else {
                $clinicimage1 = $req->clinic_image_one;
            }
            if ($req->hasFile('clinic_image_two')) {
                $file = $req->file('clinic_image_two');
                $filename = 'clinicimage' . time() . '.' . $req->clinic_image_two->extension();
                $destinationPath = storage_path('../public/upload/clinicimage');
                $file->move($destinationPath, $filename);
                $clinicimage2 = 'upload/clinicimage/' . $filename;
            } else {
                $clinicimage2 = $req->clinic_image_two;
            }
            if ($req->hasFile('clinic_image_three')) {
                $file = $req->file('clinic_image_three');
                $filename = 'clinicimage' . time() . '.' . $req->clinic_image_three->extension();
                $destinationPath = storage_path('../public/upload/clinicimage');
                $file->move($destinationPath, $filename);
                $clinicimage3 = 'upload/clinicimage/' . $filename;
            } else {
                $clinicimage3 = $req->clinic_image_three;
            }
            if ($req->hasFile('clinic_image_four')) {
                $file = $req->file('clinic_image_four');
                $filename = 'clinicimage' . time() . '.' . $req->clinic_image_four->extension();
                $destinationPath = storage_path('../public/upload/clinicimage');
                $file->move($destinationPath, $filename);
                $clinicimage4 = 'upload/clinicimage/' . $filename;
            } else {
                $clinicimage4 = $req->clinic_image_four;
            }
            
            
           $data = UserDetail::where('user_id',$req->user_id)->first();
           $departmenticon = ($departmenticon != false)?$departmenticon:$data->department_icon;
           $clinicimage1 = ($clinicimage1 != false)?$clinicimage1:$data->clinic_image_one;
           $clinicimage2 = ($clinicimage2 != false)?$clinicimage2:$data->clinic_image_two;
           $clinicimage3 = ($clinicimage3 != false)?$clinicimage3:$data->clinic_image_three;
           $clinicimage4 = ($clinicimage4 != false)?$clinicimage4:$data->clinic_image_four;
           
            UserDetail::where('user_id', $req->user_id)->update([
                'department_name' => $req->department_name,
                'department_icon' => $departmenticon,
                'clinic_image_one' => $clinicimage1,
                'clinic_image_two' => $clinicimage2,
                'clinic_image_three' => $clinicimage3,
                'clinic_image_four' => $clinicimage4
            ]); 
            if ($req->user_id) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'success',
                    'data' =>UserDetail::where('user_id', $req->user_id)->select('department_name','department_icon','clinic_image_one','clinic_image_two','clinic_image_three','clinic_image_four')->first()
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
