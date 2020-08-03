<?php

namespace App\Http\Controllers\admin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Mail;  
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;

class AdminController extends Controller
{
    // Categories start  
        public function addCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Categories'; 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function viewCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('type',0)->orderBy('categories_id','desc')->get(); 
            $data['save_more_category'] = Category::where('parent_id',null)->where('type',2)->orderBy('categories_id','desc')->get(); 
            $data['covid_category'] = Category::where('parent_id',null)->where('type',3)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function  deleteCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function editSaveMoreCategories($categories_id){
            $data['flag'] = 4; 
            $data['page_title'] = 'Edit Save More Care More Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function editCovidCategories($categories_id){
            $data['flag'] = 5; 
            $data['page_title'] = 'Edit Covid 19 Essential Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_categories',$data);
        }

        public function toggleCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function categoriesSubmit(Request $req){  
            if($req->categories_id) {  
                //dd($req->back_color);
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'category'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/category');
                    $file->move($destinationPath, $filename);
                    $category = 'upload/category/'.$filename;
                }
                else{
                    $category = $req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([
                    'category_name' => $req->category_name,
                    'title' => $req->title,
                    'image' => $category,
                    'type' => $req->type,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Category Edit  Successfully');
            }else{ 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'category'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/category');
                    $file->move($destinationPath, $filename);
                } 
                $data = new Category();
                $data->category_name = $req->category_name; 
                $data->image = 'upload/category/'.$filename;
                $data->title = $req->title;  
                $data->back_color = $req->back_color;  
                $data->save(); 
                return back()->with('msg','Category Add  Successfully');
            }
        }    
    // Categories End 

    // Sub Categories start
        public function addSubCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Sub Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 

            $data['sub_category'] = Category::where('category_name',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();  

            $data['sub_sub_category'] = Category::where('category_name',null)->where('sub_parent_id','!=' ,null)->where('parent_id','!=' ,null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get(); 
            
            return view('admin/webviews/admin_manage_sub_categories',$data);
        }

        public function viewSubCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Sub Categories'; 
            $data['category'] = Category::where('category_name',null)->where('type',0)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_sub_categories',$data);
        }

        public function  deleteSubCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editSubCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Sub Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 

            $data['sub_category'] = Category::where('category_name',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();  

            $data['sub_sub_category'] = Category::where('category_name',null)->where('sub_parent_id','!=' ,null)->where('parent_id','!=' ,null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get(); 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_sub_categories',$data);
        }

        public function toggleSubCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function subCategoriesSubmit(Request $req){ 
            
            if($req->categories_id) { 
                //dd($req->back_color);
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'subcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/subcategory');
                    $file->move($destinationPath, $filename);
                    $subcategory = 'upload/subcategory/'.$filename;
                }
                else{
                    $subcategory=$req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([ 
                    'title' => $req->title,
                    'image' => $subcategory,
                    'sub_category_name' => $req->sub_category_name, 
                    'parent_id' => $req->parent_id,
                    'sub_parent_id' => $req->sub_parent_id,
                    'sub_sub_parent_id' => $req->sub_sub_parent_id,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Sub Category Edit  Successfully');
            }else{ 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'subcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/subcategory');
                    $file->move($destinationPath, $filename);
                } 
                $data = new Category();
                $data->parent_id = $req->parent_id; 
                $data->sub_parent_id = $req->sub_parent_id; 
                $data->sub_sub_parent_id = $req->sub_sub_parent_id; 
                $data->sub_category_name = $req->sub_category_name; 
                $data->image = 'upload/subcategory/'.$filename;
                $data->title = $req->title; 
                $data->back_color=$req->back_color;
                //dd($req);
                $data->save(); 
                return back()->with('msg','Sub Category Add  Successfully');
            }
        }  
    // Subcategory End 

    // user Categories start 
        public function addUserCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add User Categories'; 
            return view('admin/webviews/admin_manage_user_categories',$data);
        }

        public function viewUserCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View User Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('type',1)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_categories',$data);
        }

        public function  deleteUserCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editUserCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit User Categories'; 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_user_categories',$data);
        }

        public function toggleUserCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function userCategoriesSubmit(Request $req){ 
            //dd($req->back_color);
            $req->validate([
                'category_name'=> 'required'
            ]); 
            if($req->categories_id) { 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usercategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usercategory');
                    $file->move($destinationPath, $filename);
                    $usercategory = 'upload/usercategory/'.$filename;
                }
                else{
                    $usercategory=$req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([
                    'category_name' => $req->category_name, 
                    'title' => $req->title,
                    'image' => $usercategory,
                    'type' => $req->type,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Category Edit  Successfully');
            }else{ 
                $req->validate([
                     'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usercategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usercategory');
                    $file->move($destinationPath, $filename);
                }

                $data = new Category();
                $data->category_name = $req->category_name; 
                $data->type = $req->type;  
                $data->image = 'upload/usercategory/'.$filename;
                $data->title = $req->title; 
                $data->back_color=$req->back_color;
                $data->save(); 
                return back()->with('msg','Category Add  Successfully');
            }
        }
    // User Categories End  

    // user sub Categories start 
        public function addUserSubCategories(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add User Sub Categories'; 
            $data['category'] = Category::where('parent_id',null)->where('type',1)->where('status',0)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_sub_categories',$data);
        }

        public function viewUserSubCategories(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View User Sub Categories'; 
            $data['category'] = Category::where('category_name',null)->where('type',1)->orderBy('categories_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_sub_categories',$data);
        }

        public function  deleteUserSubCategories($categories_id){ 
            $data['result']=Category::where('categories_id',$categories_id)->delete();
            return back()->with('msg','Category Delete Successfully');  
        }

        public function editUserSubCategories($categories_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit User Sub Categories'; 
            $data['sub_category'] = Category::where('parent_id',null)->where('type',1)->where('status',0)->orderBy('categories_id','desc')->get(); 
            $data['result'] = Category::where('categories_id',$categories_id)->first(); 
            return view('admin/webviews/admin_manage_user_sub_categories',$data);
        }

        public function toggleUserSubCategoriesActiveStatus($status, $categories_id) { 
            Category::where('categories_id', $categories_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

         public function userSubCategoriesSubmit(Request $req){ 
            $req->validate([
                'parent_id'=> 'required',
                'sub_category_name'=> 'required'
            ]); 
            if($req->categories_id) { 
                 if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usersubcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usersubcategory');
                    $file->move($destinationPath, $filename);
                    $usersubcategory = 'upload/usersubcategory/'.$filename;
                }
                else{
                    $usersubcategory=$req->image;
                }
                Category::where('categories_id',$req->categories_id)->update([
                    'parent_id' => $req->parent_id,
                    'sub_category_name' => $req->sub_category_name,
                    'title' => $req->title,
                    'image' => $usersubcategory,
                    'type' => $req->type,
                    'back_color'=>$req->back_color
                ]);
                return back()->with('msg','Sub Category Edit  Successfully');
            }else{ 
                $req->validate([
                     'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'usersubcategory'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/usersubcategory');
                    $file->move($destinationPath, $filename);
                }
                $data = new Category();
                $data->parent_id = $req->parent_id; 
                $data->sub_category_name = $req->sub_category_name; 
                $data->type = $req->type; 
                $data->image = 'upload/usersubcategory/'.$filename;
                $data->title = $req->title; 
                $data->back_color=$req->back_color;
                $data->save(); 
                return back()->with('msg','Sub Category Add  Successfully');
            }
        } 
    // User Subcategory End

    // Banner start  

        public function addBanner(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Banner'; 
            return view('admin/webviews/admin_manage_banners',$data);
        }

        public function viewBanner(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Banner'; 
            $data['banner'] = Banner::orderBy('banners_id','desc')->get(); 
            return view('admin/webviews/admin_manage_banners',$data);
        }

        public function  deleteBanner($banners_id){ 
            $data['result']=Banner::where('banners_id',$banners_id)->delete();
            return back()->with('msg','Banner Delete Successfully');  
        }

        public function editBanner($banners_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Banner'; 
            $data['result'] = Banner::where('banners_id',$banners_id)->first(); 
            return view('admin/webviews/admin_manage_banners',$data);
        }

        public function toggleBannerActiveStatus($status, $banners_id) { 
            Banner::where('banners_id', $banners_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function bannerSubmit(Request $req){ 
            $req->validate([
                'banner_name'=> 'required',  
                'type'=> 'required',
                'location'=> 'required',
                'image'=>'dimensions:width=606,height=236'
            ]); 
            if($req->banners_id) { 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'banner'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/banner');
                    $file->move($destinationPath, $filename);
                    $banner = 'upload/banner/'.$filename;
                }
                else{
                    $banner=$req->image;
                }

                Banner::where('banners_id',$req->banners_id)->update([
                    'banner_name' => $req->banner_name,  
                    'image' => $banner,
                    'type' => $req->type, 
                    'location' => $req->location, 
                    'page_name' => $req->page_name, 
                    'show_on' => $req->show_on, 
                    'from' => $req->from, 
                    'to' => $req->to, 
                    'banner_link' => $req->banner_link 
                ]);
                return back()->with('msg','Banner Edit  Successfully');
            }else{ 
                $req->validate([
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'banner'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/banner');
                    $file->move($destinationPath, $filename);
                }

                $data = new Banner();
                $data->banner_name = $req->banner_name; 
                $data->image = 'upload/banner/'.$filename;
                $data->type = $req->type; 
                $data->location = $req->location; 
                $data->page_name = $req->page_name; 
                $data->from = $req->from; 
                $data->to = $req->to; 
                $data->show_on = $req->show_on;
                $data->banner_link = $req->banner_link ;
                //dd($req);  
                $data->save(); 
                return back()->with('msg','Banner Add  Successfully');
            }
        }
    // banner End

    // coupon start  
        public function addCoupon(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Coupon';  
            $data['rand'] = rand(111111, 999999); 
            return view('admin/webviews/admin_manage_coupon',$data);
        }

        public function viewCoupon(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Coupon'; 
            $data['coupon'] = Coupon::orderBy('coupons_id','desc')->get(); 
            return view('admin/webviews/admin_manage_coupon',$data);
        }

        public function  deleteCoupon($coupons_id){ 
            $data['result']=Coupon::where('coupons_id',$coupons_id)->delete();
            return back()->with('msg','Coupon Delete Successfully');  
        }

        public function editCoupon($coupons_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Coupon'; 
            $data['result'] = Coupon::where('coupons_id',$coupons_id)->first(); 
            return view('admin/webviews/admin_manage_coupon',$data);
        }

        public function toggleCouponActiveStatus($status, $coupons_id) { 
            Coupon::where('coupons_id', $coupons_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

         public function couponSubmit(Request $req){  
            $req->validate([
                'copoun_name'=> 'required',  
                'amount'=> 'required',  
                'type'=> 'required',  
                'copoun_code'=> 'required','unique:coupons','max:6',
                'no_of_uses'=> 'required'  
            ]); 
            if($req->coupons_id) {  
                Coupon::where('coupons_id',$req->coupons_id)->update([
                    'copoun_name' => $req->copoun_name, 
                    'copoun_code' => $req->copoun_code, 
                    'amount' => $req->amount, 
                    'type' => $req->type, 
                    'from' => $req->from, 
                    'to' => $req->to, 
                    'no_of_uses' => $req->no_of_uses 
                ]);
                return back()->with('msg','Coupon Edit Successfully');
            }else{  
                $data = new Coupon();
                $data->copoun_name = $req->copoun_name;  
                $data->copoun_code = $req->copoun_code; 
                $data->amount = $req->amount; 
                $data->type = $req->type; 
                $data->from = $req->from; 
                $data->to = $req->to; 
                $data->no_of_uses = $req->no_of_uses;  
                $data->save(); 
                return back()->with('msg','Coupon Add Successfully');
            }
        } 
    // Coupon End

    // role start  
        public function addRole(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Role'; 
            return view('admin/webviews/admin_manage_role',$data);
        }

        public function viewRole(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Role'; 
            $data['category'] = Role::orderBy('roles_id','desc')->get(); 
            return view('admin/webviews/admin_manage_role',$data);
        }

        public function  deleteRole($roles_id){ 
            $data['result']=Role::where('roles_id',$roles_id)->delete();
            return back()->with('msg','Role Delete Successfully');  
        }

        public function editRole($roles_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Role'; 
            $data['result'] = Role::where('roles_id',$roles_id)->first(); 
            return view('admin/webviews/admin_manage_role',$data);
        }

        public function toggleRoleActiveStatus($status, $roles_id) { 
            Role::where('roles_id', $roles_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function RoleSubmit(Request $req){ 
            $req->validate([
                'role_name'=> 'required'  
            ]); 
            if($req->roles_id) { 
                Role::where('roles_id',$req->roles_id)->update([
                    'role_name' => $req->role_name 
                ]);
                return back()->with('msg','Role Edit  Successfully');
            }else{ 
                $data = new Role();
                $data->role_name = $req->role_name; 
                $data->save(); 
                return back()->with('msg','Role Add  Successfully');
            }
        } 
    // Role End  

    // language start 

        public function addLanguage(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Language'; 
            return view('admin/webviews/admin_manage_language',$data);
        }

        public function viewLanguage(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Language'; 
            $data['category'] = Language::orderBy('languages_id','desc')->get(); 
            return view('admin/webviews/admin_manage_language',$data);
        }

        public function  deleteLanguage($languages_id){ 
            $data['result']=Language::where('languages_id',$languages_id)->delete();
            return back()->with('msg','Language Delete Successfully');  
        }

        public function editLanguage($languages_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Language'; 
            $data['result'] = Language::where('languages_id',$languages_id)->first(); 
            return view('admin/webviews/admin_manage_language',$data);
        }

        public function toggleLanguageActiveStatus($status, $languages_id) { 
            Language::where('languages_id', $languages_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function LanguageSubmit(Request $req){ 
            $req->validate([
                'language_name'=> 'required'  
            ]); 
            if($req->languages_id) { 
                Language::where('languages_id',$req->languages_id)->update([
                    'language_name' => $req->language_name 
                ]);
                return back()->with('msg','Language Edit  Successfully');
            }else{ 
                $data = new Language();
                $data->language_name = $req->language_name; 
                $data->save(); 
                return back()->with('msg','Role Add  Successfully');
            }
        } 
    // Language End 

    // user details start 

        public function addUserDetails(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add User Details'; 
            $data['role'] = Role::where('status',0)->orderBy('roles_id','desc')->get();
            $data['sub_category'] = Category::where('status',0)->where('type',1)->where('category_name',null)->orderBy('categories_id','desc')->get();
            return view('admin/webviews/admin_manage_user_details',$data);
        }

        public function viewUserDetails(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View User Details'; 
            $data['user_detail'] = UserDetail::orderBy('user_details_id','desc')->get(); 
            return view('admin/webviews/admin_manage_user_details',$data);
        }

        public function  deleteUserDetails($user_details_id){ 
            $data['result']=UserDetail::where('user_details_id',$user_details_id)->delete();
            return back()->with('msg','User Details Delete Successfully');  
        }

        public function editUserDetails($user_details_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit User Details';
            $data['role'] = Role::where('status',0)->orderBy('roles_id','desc')->get(); 
            $data['sub_category'] = Category::where('status',0)->where('type',1)->where('category_name',null)->orderBy('categories_id','desc')->get();
            $data['result'] = UserDetail::where('user_details_id',$user_details_id)->first(); 
            return view('admin/webviews/admin_manage_user_details',$data);
        }

        public function toggleUserDetailsActiveStatus($status, $user_details_id) { 
            UserDetail::where('user_details_id', $user_details_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }
        
        public function userDetailsSubmit(Request $req){ 
            
            if($req->user_details_id) { 
                $req->validate([
                    'user_name'=> 'required',  
                    'address'=> 'required',
                    'city'=> 'required',  
                    'pin_code'=> 'required',  
                    'state'=> 'required',  
                    'country'=> 'required',  
                    'email'=> 'required', 'string', 'email', 'max:255', 'unique:users',
                    'mobile'=> 'required'   
                ]); 

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

                if($req->role_id == 1){
                    UserDetail::where('user_details_id',$req->user_details_id)->update([
                        'user_name' => $req->user_name,  
                        'dob' => $req->dob,  
                        'gender' => $req->gender,  
                        'image' => $userdetails,
                        'address' => $req->address, 
                        'address2' => $req->address2,  
                        'city' => $req->city, 
                        'pin_code' => $req->pin_code, 
                        'state' => $req->state, 
                        'country' => $req->country, 
                        'email' => $req->email, 
                        'mobile' => $req->mobile,  
                        'role_id' => $req->role_id, 
                        'doctor_category' => $req->doctor_category,
                        'speciality' => $req->speciality,
                        'service' => $req->service,
                        'specialization' => $req->specialization,
                        'experience_from' => $req->experience_from,
                        'experience_to' => $req->experience_to,
                        'description' => $req->description,
                        'rating_option' => $req->rating_option,
                        'consultation_fees' => $req->consultation_fees,
                        //dd($req)
                    ]);
                }elseif($req->role_id == null){
                    $role = null;
                    UserDetail::where('user_details_id',$req->user_details_id)->update([
                        'user_name' => $req->user_name,  
                        'dob' => $req->dob,  
                        'gender' => $req->gender,  
                        'image' => $userdetails,
                        'address' => $req->address, 
                        'address2' => $req->address2,
                        'city' => $req->city, 
                        'pin_code' => $req->pin_code, 
                        'state' => $req->state, 
                        'country' => $req->country, 
                        'email' => $req->email, 
                        'mobile' => $req->mobile,
                        'role_id' => $role,
                        'doctor_category' => $req->doctor_category, 
                        'speciality' => $role,
                        'service' => $role,
                        'specialization' => $role,
                        'experience_from' => $role,
                        'experience_to' => $role,
                        'description' => $role,
                        'rating_option' => $role,
                        'consultation_fees' => $role
                        //dd($req)
                    ]);
                }
                
                return back()->with('msg','User Detail Edit  Successfully');
            }else{ 
                $req->validate([
                    'user_name'=> 'required', 
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required', 
                    'address'=> 'required',
                    'city'=> 'required',  
                    'pin_code'=> 'required',  
                    'state'=> 'required',  
                    'country'=> 'required',  
                    'email'=> 'required|string|email|max:255|unique:users',
                    'mobile'=> 'required'   
                ]); 

                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'userdetails'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/userdetails');
                    $file->move($destinationPath, $filename);
                    $userdetails = 'upload/userdetails/'.$filename;
                }
                 $departmenticon = null;
                if($req->hasFile('department_icon')) {
                    $file = $req->file('department_icon');
                    $filename = 'departmenticon'.time().'.'.$req->department_icon->extension();
                    $destinationPath = storage_path('../public/upload/departmenticon');
                    $file->move($destinationPath, $filename);
                    $departmenticon = 'upload/departmenticon/'.$filename;
                }
                 $clinicimage1 = null;
                if($req->hasFile('clinic_image_one')) {
                    $file = $req->file('clinic_image_one');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_one->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage1 = 'upload/clinicimage/'.$filename;
                } 
                 $clinicimage2 = null;
                if($req->hasFile('clinic_image_two')) {
                    $file = $req->file('clinic_image_two');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_two->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage2 = 'upload/clinicimage/'.$filename;
                } 
                 $clinicimage3 = null;
                if($req->hasFile('clinic_image_three')) {
                    $file = $req->file('clinic_image_three');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_three->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage3 = 'upload/clinicimage/'.$filename;
                }
                 $clinicimage4 = null;
                if($req->hasFile('clinic_image_four')) {
                    $file = $req->file('clinic_image_four');
                    $filename = 'clinicimage'.time().'.'.$req->clinic_image_four->extension();
                    $destinationPath = storage_path('../public/upload/clinicimage');
                    $file->move($destinationPath, $filename);
                    $clinicimage4 = 'upload/clinicimage/'.$filename;
                }

                $reg2 = new User;
                $reg2->name = $req->user_name;
                $reg2->email = $req->email;
                $reg2->phone = $req->mobile;
                if($req->role_id == 1){
                    $reg2->user_type = 3;
                }else{
                    $reg2->user_type = 2;
                }  
                $password = rand(111111, 999999);
                $reg2->password = bcrypt($password);  
                $reg2->save(); 

                $data = new UserDetail();
                $data->user_id=$reg2->id;
                $data->user_name = $req->user_name;  
                $data->image = $userdetails;
                $data->address = $req->address; 
                $data->city = $req->city; 
                $data->pin_code = $req->pin_code; 
                $data->state = $req->state; 
                $data->country = $req->country; 
                $data->email = $req->email; 
                $data->mobile = $req->mobile;
                if($req->role_id == 1){
                    $data->role_id = $req->role_id; 
                    $data->department_icon = $departmenticon;
                    $data->clinic_image_one = $clinicimage1;
                    $data->clinic_image_two = $clinicimage2;
                    $data->clinic_image_three = $clinicimage3;
                    $data->clinic_image_four = $clinicimage4;
                    $data->service = $req->service; 
                    $data->doctor_category = $req->doctor_category; 
                    $data->specialization = $req->specialization; 
                    $data->degree = $req->degree; 
                    $data->department_name = $req->department_name; 
                    $data->speciality = $req->speciality; 
                    $data->experience_from = $req->experience_from; 
                    $data->experience_to = $req->experience_to; 
                    $data->description = $req->description;
                    $data->consultation_fees = $req->consultation_fees;
                }
                //dd($req); 
                $data->save(); 
                if ($req->mobile!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Dear ".$req->user_name.", \nYour Email-   ".$req->email."\n And Password is-     ".$password." \n\nThank You.");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->mobile."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                } 
                //$user1 = User::where('user_type',1)->first();
               
                if($reg2->user_type == 2){
                    $to_name = $reg2->name;
                    $to_email = $reg2->email; 
                     $user = User::where('email',$reg2->email)->first();
                    Mail::send('emails.user_reg_mail', ['user' => $user], function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('dhd@lsne.in','Drhelpdesk');
                    });
                }elseif($reg2->user_type == 3){
                    $to_name = $reg2->name;
                    $to_email = $reg2->email; 
                      $user = User::where('email',$reg2->email)->first();
                    Mail::send('emails.doctor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                        $message->to($to_email, $to_name)
                        ->subject('Registration In DHD');
                        $message->from('dhd@lsne.in','Drhelpdesk');
                    });
                } 
                // $user = User::where('email',$req->email)->first();
                // $to = $reg2['email'];
                // $subject = 'WelCome In DHD';
                // $message = "Dear ".$req->user_name.", \nYour Email-       ".$req->email."\n And Password is-     ".$password." \n\nThank You.";
                // $headers = 'From:From:info@dhd.in';        
                // if(mail($to, $subject, $message, $headers)) {
                //     echo 'Your Login Credentials Is Send To your registered email Address';
                // } 
                // else {
                //     echo 'Sorry! something went wrong, please try again.';
                // }
                return back()->with('msg','User Detail Add  Successfully');
            }
        }  
        // public function userDetailsSubmit(Request $req){ 
            
        //     if($req->user_details_id) { 
        //         $req->validate([
        //             'user_name'=> 'required',  
        //             'address'=> 'required',
        //             'city'=> 'required',  
        //             'pin_code'=> 'required',  
        //             'state'=> 'required',  
        //             'country'=> 'required',  
        //             'email'=> 'required',  
        //             'mobile'=> 'required'   
        //         ]); 

        //         if($req->hasFile('image')) {
        //             $file = $req->file('image');
        //             $filename = 'userdetails'.time().'.'.$req->image->extension();
        //             $destinationPath = storage_path('../public/upload/userdetails');
        //             $file->move($destinationPath, $filename);
        //             $userdetails = 'upload/userdetails/'.$filename;
        //         }
        //         else{
        //             $userdetails=$req->image;
        //         }

        //         UserDetail::where('user_details_id',$req->user_details_id)->update([
        //             'user_name' => $req->user_name,  
        //             'image' => $userdetails,
        //             'address' => $req->address, 
        //             'city' => $req->city, 
        //             'pin_code' => $req->pin_code, 
        //             'state' => $req->state, 
        //             'country' => $req->country, 
        //             'email' => $req->email, 
        //             'mobile' => $req->mobile, 
        //             'role_id' => $req->role_id, 
        //             'speciality' => $req->speciality,
        //             'experience_from' => $req->experience_from,
        //             'experience_to' => $req->experience_to,
        //             'description' => $req->description
        //             //dd($req)
        //         ]);
        //         return back()->with('msg','User Detail Edit  Successfully');
        //     }else{ 
        //         $req->validate([
        //             'user_name'=> 'required', 
        //             'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required', 
        //             'address'=> 'required',
        //             'city'=> 'required',  
        //             'pin_code'=> 'required',  
        //             'state'=> 'required',  
        //             'country'=> 'required',  
        //             'email'=> 'required',  
        //             'mobile'=> 'required'   
        //         ]); 

        //         if($req->hasFile('image')) {
        //             $file = $req->file('image');
        //             $filename = 'userdetails'.time().'.'.$req->image->extension();
        //             $destinationPath = storage_path('../public/upload/userdetails');
        //             $file->move($destinationPath, $filename);
        //             $userdetails = 'upload/userdetails/'.$filename;
        //         } 
        //         $data = new UserDetail();
        //         $data->user_name = $req->user_name;  
        //         $data->image = $userdetails;
        //         $data->address = $req->address; 
        //         $data->city = $req->city; 
        //         $data->pin_code = $req->pin_code; 
        //         $data->state = $req->state; 
        //         $data->country = $req->country; 
        //         $data->email = $req->email; 
        //         $data->mobile = $req->mobile; 
        //         $data->role_id = $req->role_id; 
        //         $data->speciality = $req->speciality; 
        //         $data->experience_from = $req->experience_from; 
        //         $data->experience_to = $req->experience_to; 
        //         $data->description = $req->description;
        //         //dd($req); 
        //         $data->save(); 
        //         return back()->with('msg','User Detail Add  Successfully');
        //     }
        // } 
    // user details end 

}