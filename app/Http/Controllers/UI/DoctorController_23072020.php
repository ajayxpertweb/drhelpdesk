<?php

namespace App\Http\Controllers\UI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Auth;
use DB;
use App\Banner;
use App\Category;
use App\UserDetail;
use App\Product;
use App\User;
use App\ProductImage;
use App\Blog;
use App\Location;
use App\Testimonial;
use App\DoctorAppointment;
use App\DoctorFeedback;
use App\DoctorProfile;
use App\DoctorSchedule;
use App\ConsultationTransaction;
use Illuminate\Support\Carbon;

class DoctorController extends Controller {

    public function doctorDashboard1() {
        $data['flag'] = 1;
        $data['appointment'] = DoctorAppointment::where('doctor_id', Auth::user()->id)->get();
        $data['feedbacks'] = DoctorFeedback::where('doctor_id', Auth::user()->id)->get();
        dd($data['appointment']);
    }

    public function doctorAppointmentSubmit(Request $req) {
        $data = new DoctorAppointment;
        $data->user_id = Auth::id();
        $data->doctor_id = $req->doctor_id;
        $data->appointment_date = $req->appointment_date;
        $data->description = $req->description;
        $data->save();
        return back()->with('msg', 'Your Appointment Booking Successfully');
    }

    public function doctoreducation(Request $req) {

        $degree = $req->degree;
        $college = $req->college;
        $completed_year = $req->completed_year;
        $getcreditCount = count($completed_year);
        for ($i = 0; $i < $getcreditCount; $i++) {
            DB::table('education')->insert(['user_id' => Auth::user()->id, 'degree' => $degree[$i], 'college' => $college[$i], 'year' => $completed_year[$i]]);
        }
        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function doctorexperiance(Request $req) {

        $hospital_name = $req->hospital_name;
        $experience_from = $req->experience_from;
        $experience_to = $req->experience_to;
        $designation = $req->designation;
        $getcreditCount = count($hospital_name);
        for ($i = 0; $i < $getcreditCount; $i++) {
            DB::table('experiance')->insert(['user_id' => Auth::user()->id, 'hospital' => $hospital_name[$i], 'fromstart' => $experience_from[$i], 'toend' => $experience_to[$i], 'designation' => $designation[$i]]);
        }
        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function doctoraward(Request $req) {

        $awards = $req->awards;
        $award_year = $req->award_year;

        $getcreditCount = count($award_year);
        for ($i = 0; $i < $getcreditCount; $i++) {
            DB::table('awards')->insert(['user_id' => Auth::user()->id, 'award' => $awards[$i], 'year' => $award_year[$i]]);
        }
        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function deleteexperiance($id) {
        DB::table('experiance')->where('id', $id)->delete();

        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function deleteaward($id) {
        DB::table('awards')->where('id', $id)->delete();

        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function deleteeducation($id) {
        DB::table('education')->where('id', $id)->delete();

        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function deleteragistration($id) {
        DB::table('ragistration')->where('id', $id)->delete();

        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function doctorragistration(Request $req) {

        $registration = $req->registration;
        $registration_year = $req->registration_year;

        $getcreditCount = count($registration_year);
        for ($i = 0; $i < $getcreditCount; $i++) {
            DB::table('ragistration')->insert(['user_id' => Auth::user()->id, 'registration' => $registration[$i], 'year' => $registration_year[$i]]);
        }
        return redirect('http://lsne.in/dhd/public/doctor-profile-setting');
    }

    public function doctorFeedback(Request $req) {
        if ($req->id) {
            DoctorFeedback::where('id', $req->id)->update([
                'recommendation' => $req->recommendation
            ]);
        } else {
            $data = new DoctorFeedback;
            $data->user_id = Auth::id();
            $data->doctor_id = $req->doctor_id;
            $data->rating = $req->rating;
            $data->recommendation = $req->recommendation;
            $data->feedback = $req->feedback;
            $data->comment = $req->title;
            $data->save();
        }
        return back()->with('msg', 'Feedback Given Successfully');
    }

    public function doctorAppointment(Request $req) {
        $data['flag'] = 1;
        $data['appointment'] = DoctorAppointment::where('doctor_id', Auth::user()->id)->orderBy('appointment_date', 'desc')->get();
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorChangePassword(Request $req) {
        $data['flag'] = 2;
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorChatDoctor(Request $req) {
        $data['flag'] = 3;
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorDashboard(Request $req) {
        $data['flag'] = 4;
        $data['appointment'] = DoctorAppointment::where('doctor_id', Auth::user()->id)->orderBy('appointment_date', 'desc')->get();
        $data['today_appointment'] = DoctorAppointment::where('doctor_id', Auth::user()->id)->whereDate('appointment_date', Carbon::today())->get();
        $data['upcoming_appointment'] = DoctorAppointment::where('doctor_id', Auth::user()->id)->where('appointment_date', '>=', Carbon::now())->get();
        //dd($data['appointment']);
        $data['feedbacks'] = DoctorFeedback::where('doctor_id', Auth::user()->id)->get();
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorInvoices(Request $req) {
        $data['flag'] = 5;
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorProfileSettings(Request $req) {
        $data['flag'] = 6;
        $data['sub_category'] = Category::where('status', 0)->where('type', 1)->where('category_name', null)->orderBy('categories_id', 'desc')->get();
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorClinicSettings(Request $req) {
        $data['flag'] = 11;
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorReviews(Request $req) {
        $data['flag'] = 7;
        $data['feedbacks'] = UserDetail::where('user_id', Auth::user()->id)->first();
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorScheduleTimings(Request $req) {
        $data['flag'] = 8;
        $data['db_days'] = DoctorSchedule::where('doctor_id', Auth::user()->id)->pluck('day_of_the_week');
        $data['result'] = DoctorSchedule::where('doctor_id', Auth::user()->id)->get();
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function doctorListing(Request $req, $categories_id, $subcategories = null) {
        $data['parameter'] = [$categories_id, $subcategories];
        $category = !empty($req->category) ? $req->category : [];
        $gender = !empty($req->gender) ? $req->gender : [];
        $data['page'] = $req->all();
        $data['feedbacks'] = DoctorFeedback::where('doctor_id', $req->id)->count();
        $data['category'] = DB::table('categories')->where('parent_id', 16)->orderBy('sub_category_name', 'asc')->get();
        if (!is_array($category) && is_int($category) && $category > 0) {
            $category = (array) $category;
        }
        if (!is_array($gender) && is_int($gender) && $gender > 0) {
            $gender = (array) $gender;
        }
        $data['doctor'] = UserDetail::where('role_id', 1)
                        ->where(function($query) use ($category) {
                            if (!empty($category)) {
                                return $query->whereIn('speciality', $category);
                            }
                        })
                        ->where(function($query) use ($gender) {
                            if (!empty($gender)) {
                                return $query->whereIn('gender', $gender);
                            }
                        })
                        ->where('status', 0)->orderBy('user_details_id', 'desc')->paginate(8);
        return view('UI/webviews.doctor.doctor_listing')->with('data', $data)->with('gender', $gender)->with('category', $category);
    }

    public function doctorDetails(Request $req) {
        $data['flag'] = 10;
        $data['feedbacks'] = DoctorFeedback::where('doctor_id', $req->id)->get();
        $doctor = UserDetail::where('user_details_id', $req->id)->first();
        $data['doctor'] = $doctor;

        $data['is_has_credit'] = false;
        $data['consultation_credit'] = 0;
        $data['consult_call'] = '';
        if (Auth::user()) {
            $wallet_details = DB::table('wallets')->where('user_id', Auth::user()->id)->first();
            $cunsultRes = ConsultationTransaction::where('user_id', Auth::user()->id)->where('doc_id', $doctor->user_id)->orderBy('id', 'DESC')->first();
            if (!empty($cunsultRes->consultation_credit) && $cunsultRes->consultation_credit > 0) {
                $data['is_has_credit'] = true;
                $data['consultation_credit'] = $cunsultRes->consultation_credit;
                $data['consult_call'] = Auth::user()->id . '#' . $doctor->user_id . '#' . $cunsultRes->consultation_credit;
            }

            $data['doc_id'] = $doctor->user_id;
            $data['user_id'] = Auth::user()->id;
        }
        return view('UI/webviews.doctor.manage_doctor', $data);
    }

    public function changePassword(Request $req) {
        $password = Auth::user()->password;
        $new = $req->new_pwd;
        $cnf = $req->cnf_pwd;
        if (Hash::check($req->old_pwd, $password)) {
            if ($new == $cnf) {
                user::where('id', auth::user()->id)->update([
                    'password' => bcrypt($req->new_pwd),
                ]);
                return back()->with('msg', 'Your Password Reset Successfull');
            } else {
                return back()->with('msg', 'Confirm Password Not Match');
            }
        } else {
            return back()->with('msg', 'Your Credential Not Match');
        }
    }

    public function doctorDetailsSubmit(Request $req) {

        //dd($req->all());
        if ($req->user_details_id) {
            if ($req->hasFile('image')) {
                $file = $req->file('image');
                $filename = 'userdetails' . time() . '.' . $req->image->extension();
                $destinationPath = storage_path('../public/upload/userdetails');
                $file->move($destinationPath, $filename);
                $userdetails = 'upload/userdetails/' . $filename;
            } else {
                $userdetails = $req->image;
            }
            UserDetail::where('user_details_id', $req->user_details_id)->update([
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
                'country' => $req->country,
                'role_id' => $req->role_id,
                'speciality' => $req->speciality,
                'service' => $req->service,
                'specialization' => $req->specialization,
                'description' => $req->description,
                'rating_option' => $req->rating_option,
                'consultation_fees' => $req->consultation_fees,
                'number_of_consultation' => $req->number_of_consultation
            ]);
            return back()->with('msg', 'Doctor Profile Edit  Successfully');
        } elseif ($req->id) {
            DoctorProfile::where('id', $req->id)->update([
                'degree' => $req->degree,
                'college' => $req->college,
                'completed_year' => $req->completed_year,
                'hospital_name' => $req->hospital_name,
                'experience_from' => $req->experience_from,
                'experience_to' => $req->experience_to,
                'designation' => $req->designation,
                'awards' => $req->awards,
                'award_year' => $req->award_year,
                'registration' => $req->registration,
                'registration_year' => $req->registration_year,
                    //dd($req)
            ]);
        } else {
            $degree = $req->degree;
            $college = $req->college;
            $completed_year = $req->completed_year;
            $hospital_name = $req->hospital_name;
            $experience_from = $req->experience_from;
            $experience_to = $req->experience_to;
            $designation = $req->designation;
            $awards = $req->awards;
            $award_year = $req->award_year;
            $registration = $req->registration;
            $registration_year = $req->registration_year;
            foreach ($degree as $row) {
                $data = new DoctorProfile;
                $data->user_id = Auth::user()->id;
                $data->degree = $row;
                foreach ($college as $row1) {
                    $data->college = $row1;
                }foreach ($completed_year as $row2) {
                    $data->completed_year = $row2;
                }
                $data->save();
            }
            foreach ($hospital_name as $row3) {
                $data = new DoctorProfile;
                $data->user_id = Auth::user()->id;
                $data->hospital_name = $row3;
                foreach ($experience_from as $row4) {
                    $data->experience_from = $row4;
                } foreach ($experience_to as $row5) {
                    $data->experience_to = $row5;
                } foreach ($designation as $row6) {
                    $data->designation = $row6;
                }
                $data->save();
            }

            foreach ($awards as $row7) {
                $data = new DoctorProfile;
                $data->user_id = Auth::user()->id;
                $data->awards = $row7;
                foreach ($award_year as $row8) {
                    $data->award_year = $row8;
                }
                $data->save();
            }
            foreach ($registration as $row9) {
                $data = new DoctorProfile;
                $data->user_id = Auth::user()->id;
                $data->registration = $row9;
                foreach ($registration_year as $row10) {
                    $data->registration_year = $row10;
                }
                $data->save();
            }
        }
    }

    public function clinicDetailsSubmit(Request $req) {
        if ($req->user_details_id) {

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
            UserDetail::where('user_details_id', $req->user_details_id)->update([
                'department_name' => $req->department_name,
                'department_icon' => $departmenticon,
                'clinic_image_one' => $clinicimage1,
                'clinic_image_two' => $clinicimage2,
                'clinic_image_three' => $clinicimage3,
                'clinic_image_four' => $clinicimage4
            ]);
            return back()->with('msg', 'Doctor Profile Edit  Successfully');
        }
    }

    public function deletePatientData($id) {
        $data['result'] = DoctorAppointment::where('id', $id)->delete();
        return back()->with('msg', 'Patient Appointment Delete Successfully');
    }

    public function togglePatientActiveStatus($status, $id) {
        DoctorAppointment::where('id', $id)->update(['status' => $status]);
        return back()->with('msg', 'Status Change Successfully');
    }

    public function deleteProfileData($id) {
        DoctorProfile::where('id', $id)->delete();
        return back()->with('msg', 'Details Delete Successfully');
    }

    public function scheduleSubmit(Request $req) {
        // $day_of_week =DoctorSchedule::where('doctor_id',Auth::user()->id)->pluck('day_of_the_week');
        // foreach ($day_of_week as $key => $value) {
        if ($req->id) {
            //dd($req->m_start_time);
            DoctorSchedule::where('id', $req->id)->update([
                'doctor_id' => Auth::user()->id,
                'day_of_the_week' => $req->day_of_the_week,
                'm_start_time' => $req->m_start_time,
                'm_end_time' => $req->m_end_time,
                'e_start_time' => $req->e_start_time,
                'e_end_time' => $req->e_end_time,
                'slot_duration_diff' => $req->t_slot
            ]);
            return back()->with('msg', 'Time Slot Edit Successfully');
        } else {
            //dd($req->m_start_time);
            $reg = new DoctorSchedule;
            $reg->doctor_id = Auth::user()->id;
            $reg->day_of_the_week = $req->day_of_the_week;
            $reg->m_start_time = $req->m_start_time;
            $reg->m_end_time = $req->m_end_time;
            $reg->e_start_time = $req->e_start_time;
            $reg->e_end_time = $req->e_end_time;
            $reg->slot_duration_diff = $req->t_slot;
            $reg->save();
            return back()->with('msg', 'Time Slot Added Successfully');
        }
        // }
    }

    public function doctorLisetAjax(Request $req) {
        $catId = $req->catId;
        if(count($catId)>0){
        $details = UserDetail::whereIn('speciality', $catId)->where('status', 0)->get();    
        }
        $doctorList = '';
        $reting = '';
        if(count($details)>0){
        foreach ($details as $r) {
             if($r->rating_option != 'null'){
                for ($i = 1; $i <= 5; $i++) {
                if ($r->rating_option <= $i) {
                    $reting = $reting . "<i class=\"fas fa-star\"></i>";
                } else {
                    $reting = $reting . "<i class=\"fas fa-star filled\"></i>";
                }
            }
             }
            $speciality_name = DB::table('categories')->where('categories_id', $r->speciality)->first();
            $rr = '';
            if ($r->department_icon != null) {
                $rr = "<img src=\"" . asset($r->department_icon) . "\" class=\"img-fluid\" alt=\"Speciality\">";
            }
            $addresss = $r->address.',' .$r->city .','.$r->state.'-'. $r->pin_code;
            
            $doctorList = $doctorList .
                    "<div class=\"card\">
					<div class=\"card-body\">
						<div class=\"doctor-widget\">
							<div class=\"doc-info-left\">
								<div class=\"doctor-img\">
                                                                   
									<a href=\"#\">
                                                                            
										<img src=\"" . asset($r->image) . "\" class=\"img-fluid\" alt=\"User Image\">
									</a>
								</div>
								<div class=\"doc-info-cont\">
									<h4 class=\"doc-name\"><a href=\"#\">Dr. " . $r->user_name . "(" . $speciality_name->title . ")</a></h4>
									<p class=\"doc-speciality\">" . $r->degree . "</p>
									<h5 class=\"doc-department\">
                                                                        " . $r->department_name . "
									</h5>
									<div class=\"rating\">
                                                                        ".$reting."
                                                                        </div>
									<div class=\"clinic-details\">
										<p class=\"doc-location\"><i class=\"fas fa-map-marker-alt\"></i>".$addresss."</p>
										<ul class=\"clinic-gallery\">
											
										</ul>
									</div>
									<div class=\"clinic-services\">
										<span>Dental Fillings</span>
										<span> Whitneing</span>
									</div>
								</div>
							</div>
							<div class=\"doc-info-right\">
								<div class=\"clini-infos\">
									<ul>
										<li><i class=\"far fa-thumbs-up\"></i> 98%</li>
										<li><i class=\"far fa-comment\"></i> 17 Feedback</li>									
																			</ul>
								</div>
								<div class=\"clinic-booking\">
									<a class=\"view-pro-btn\" href=\"".url('doctor-details/'.$r->user_details_id)."\">View Profile</a>
								</div>
							</div>
						</div>
					</div>
				</div>
					";
        }
        }else{
            $doctorList = '';
              $doctorList = $doctorList.  "<div class=\"card\">
					<div class=\"card-body\">
						<div class=\"doctor-widget\">
							<div class=\"doc-info-left\">
							Sorry!! No Data Found	
							</div>
							
						</div>
					</div>
				</div>
					";

            }return $doctorList;
    }

}
