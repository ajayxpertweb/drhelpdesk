<?php

namespace App\Http\Controllers\admin; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;  
use App\User;
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;
use App\Blog;
use App\Product;
use App\ProductImage;
use App\Vendor; 
use App\Location; 
use App\Package; 
use App\Testimonial;  
use App\Brand;
use App\SocialIcon;  

class VendorController extends Controller
{
    // vendors function start  
        public function addVendors(){
        	$data['flag'] = 1; 
        	$data['page_title'] = 'Add Vendors'; 
        	 $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
        	return view('admin/webviews/admin_manage_vendor',$data);
        }

        public function viewVendors(){
        	$data['flag'] = 2; 
        	$data['page_title'] = 'View Vendors'; 
            $data['vendor'] = Vendor::orderBy('vendors_id','desc')->get(); 
        	return view('admin/webviews/admin_manage_vendor',$data);
        }

        public function  deleteVendors($vendors_id){ 
            $data['result']=Vendor::where('vendors_id',$vendors_id)->delete();
            return back()->with('msg','Vendor Delete Successfully');  
        }

        public function editVendors($vendors_id){
        	$data['flag'] = 3; 
        	$data['page_title'] = 'Edit Vendors'; 
        	$data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
            $data['result'] = Vendor::where('vendors_id',$vendors_id)->first(); 
        	return view('admin/webviews/admin_manage_vendor',$data);
        }

        public function toggleVendorsActiveStatus($status, $vendors_id) { 
            Vendor::where('vendors_id', $vendors_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }  
        // public function vendorsSubmit(Request $req){  
        //     if($req->vendors_id) { 
        //         $req->validate([
        //             'vendor_name'=> 'required',    
        //             'address'=> 'required',    
        //             'city'=> 'required',    
        //             'pin_code'=> 'required',    
        //             'state'=> 'required',    
        //             'email'=> 'required',    
        //             'phone'=> 'required',    
        //             'description'=> 'required'
        //         ]);  
        //         if($req->hasFile('logo')) {
        //             $file = $req->file('logo');
        //             $filename = 'vendor'.time().'.'.$req->logo->extension();
        //             $destinationPath = storage_path('../public/upload/vendor');
        //             $file->move($destinationPath, $filename);
        //             $vendor = 'upload/vendor/'.$filename;
        //         }
        //         else{
        //             $vendor=$req->logo;
        //         } 
        //         Vendor::where('vendors_id',$req->vendors_id)->update([
        //             'vendor_name' => $req->vendor_name,  
        //             'assign_priority' => $req->assign_priority,  
        //             'main_category' => $req->main_category,  
        //             'logo' => $vendor,
	       //         'address' => $req->address, 
	       //         'city' => $req->city, 
	       //         'pin_code' => $req->pin_code, 
	       //         'state' => $req->state,  
	       //         'email' => $req->email, 
	       //         'mobile' => $req->phone, 
	       //         'landline' => $req->landline, 
	       //         'website_url' => $req->website_url, 
	       //         'description' => $req->description, 
        //             //   dd($req)
        //         ]);
        //         return back()->with('msg','Vendor Edit Successfully');
        //     }else{  
        //         $req->validate([
        //             'vendor_name'=> 'required',    
        //             'address'=> 'required',    
        //             'city'=> 'required',    
        //             'pin_code'=> 'required',    
        //             'state'=> 'required',    
        //             'email'=> 'required|unique:users',    
        //             'phone'=> 'required|unique:users',   
        //             'description'=> 'required',     
        //             'logo' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'      
        //         ]); 

        //         if($req->hasFile('logo')) {
        //             $file = $req->file('logo');
        //             $filename = 'vendor'.time().'.'.$req->logo->extension();
        //             $destinationPath = storage_path('../public/upload/vendor');
        //             $file->move($destinationPath, $filename);
        //             $vendor = 'upload/vendor/'.$filename;
        //         } 

        //         $reg = new User;
        //         $reg->name = $req->vendor_name;
        //         $reg->email = $req->email;
        //         $reg->phone = $req->phone; 
        //         $reg->user_type = 4; 
        //         $password = rand(111111, 999999);
        //         $reg->password = bcrypt($password);  
        //         $reg->save(); 

        //         $data = new Vendor();
        //         $data->user_id=$reg->id;
        //         $data->vendor_name = $req->vendor_name;  
        //         $data->assign_priority = $req->assign_priority;  
        //         $data->main_category = $req->main_category;  
        //         $data->logo  = $vendor;
        //         $data->address = $req->address; 
        //         $data->city = $req->city; 
        //         $data->pin_code = $req->pin_code; 
        //         $data->state = $req->state;  
        //         $data->email = $req->email; 
        //         $data->mobile = $req->phone; 
        //         $data->landline = $req->landline; 
        //         $data->website_url = $req->website_url; 
        //         $data->description = $req->description; 
        //         $data->save(); 

        //         $user = User::where('email',$req->email)->first();
        //         if ($req->phone!=null) {
        //             $otp = rand (1000, 9999);
        //             $msg=urlencode("Dear ".$req->vendor_name.", \nYour Email-   ".$req->email."\n And Password is-     ".$password." \n\nThank You.");
        //             $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->phone."&message=".$msg);
        //             curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
        //             $response=curl_exec($curl);
        //             curl_close($curl);
        //         }  
        //         $to_name = $data->vendor_name;
        //         $to_email = $data->email; 
        //         Mail::send('emails.vendor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
        //             $message->to($to_email, $to_name)
        //             ->subject('Registration In DHD');
        //             $message->from('dhd@lsne.in','Drhelpdesk');
        //         });
        //         return back()->with('msg','Vendor Add Successfully');
        //     }
        // } 
        public function vendorsSubmit(Request $req){  
            if($req->vendors_id) { 
                $req->validate([
                    'vendor_name'=> 'required',    
                    'address'=> 'required',    
                    'city'=> 'required',    
                    'pin_code'=> 'required',    
                    'state'=> 'required',    
                    'email'=> 'required',    
                    'phone'=> 'required',    
                    'description'=> 'required'
                ]);  
                if($req->hasFile('logo')) {
                    $file = $req->file('logo');
                    $filename = 'vendor'.time().'.'.$req->logo->extension();
                    $destinationPath = storage_path('../public/upload/vendor');
                    $file->move($destinationPath, $filename);
                    $vendor = 'upload/vendor/'.$filename;
                }
                else{
                    $vendor=$req->logo;
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
                Vendor::where('vendors_id',$req->vendors_id)->update([
                    'vendor_name' => $req->vendor_name,  
                    'assign_priority' => $req->assign_priority,  
                    'main_category' => $req->main_category,  
                    'logo' => $vendor,
	                'address' => $req->address, 
	                'city' => $req->city, 
	                'pin_code' => $req->pin_code, 
	                'state' => $req->state,  
	                'email' => $req->email, 
	                'mobile' => $req->phone, 
	                'landline' => $req->landline, 
	                'website_url' => $req->website_url, 
	                'description' => $req->description,
                    'latitude'=>$latitude,
                    'longitude'=>$longitude 
                    //   dd($req)
                ]);
                return back()->with('msg','Vendor Edit Successfully');
            }else{  
                $req->validate([
                    'vendor_name'=> 'required',    
                    'address'=> 'required',    
                    'city'=> 'required',    
                    'pin_code'=> 'required',    
                    'state'=> 'required',    
                    'email'=> 'required|unique:users',    
                    'phone'=> 'required|unique:users',   
                    'description'=> 'required',     
                    'logo' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'      
                ]); 

                if($req->hasFile('logo')) {
                    $file = $req->file('logo');
                    $filename = 'vendor'.time().'.'.$req->logo->extension();
                    $destinationPath = storage_path('../public/upload/vendor');
                    $file->move($destinationPath, $filename);
                    $vendor = 'upload/vendor/'.$filename;
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
                $reg->name = $req->vendor_name;
                $reg->email = $req->email;
                $reg->phone = $req->phone; 
                $reg->user_type = 4; 
                $password = rand(111111, 999999);
                $reg->password = bcrypt($password);  
                $reg->save(); 

                $data = new Vendor();
                $data->user_id=$reg->id;
                $data->vendor_name = $req->vendor_name;  
                $data->assign_priority = $req->assign_priority;  
                $data->main_category = $req->main_category;  
                $data->logo  = $vendor;
                $data->address = $req->address; 
                $data->city = $req->city; 
                $data->pin_code = $req->pin_code; 
                $data->state = $req->state;  
                $data->email = $req->email; 
                $data->mobile = $req->phone; 
                $data->landline = $req->landline; 
                $data->website_url = $req->website_url; 
                $data->description = $req->description; 
                $data->latitude = $req->latitude; 
                $data->longitude = $req->longitude;  
                $data->save(); 

                $user = User::where('email',$req->email)->first();
                if ($req->phone!=null) {
                    $otp = rand (1000, 9999);
                    $msg=urlencode("Dear ".$req->vendor_name.", \nYour Email-   ".$req->email."\n And Password is-     ".$password." \n\nThank You.");
                    $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$req->phone."&message=".$msg);
                    curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
                    $response=curl_exec($curl);
                    curl_close($curl);
                }  
                $to_name = $data->vendor_name;
                $to_email = $data->email; 
                Mail::send('emails.vendor-reg', ['user' => $user], function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)
                    ->subject('Registration In DHD');
                    $message->from('dhd@lsne.in','Drhelpdesk');
                });
                return back()->with('msg','Vendor Add Successfully');
            }
        } 
    // vendors function End 

    // Blogs function start
        public function addBlogs(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Blogs'; 
            return view('admin/webviews/admin_manage_blog',$data);
        }

        public function viewBlogs(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Blogs'; 
            $data['blog'] = Blog::orderBy('blogs_id','desc')->get(); 
            return view('admin/webviews/admin_manage_blog',$data);
        }

        public function  deleteBlogs($blogs_id){ 
            $data['result']=Blog::where('blogs_id',$blogs_id)->delete();
            return back()->with('msg','Blog Delete Successfully');  
        }

        public function editBlogs($blogs_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Blogs'; 
            $data['result'] = Blog::where('blogs_id',$blogs_id)->first(); 
            return view('admin/webviews/admin_manage_blog',$data);
        }

        public function toggleBlogsActiveStatus($status, $blogs_id) { 
            Blog::where('blogs_id', $blogs_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
         
        public function blogsSubmit(Request $req){ 
            
            if($req->blogs_id) { 
                $req->validate([
                    'blog_title'=> 'required',
                    'blog_image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]);    
                if($req->hasFile('blog_image')) {
                    $file = $req->file('blog_image');
                    $filename = 'blog'.time().'.'.$req->blog_image->extension();
                    $destinationPath = storage_path('../public/upload/blog');
                    $file->move($destinationPath, $filename);
                    $blog = 'upload/blog/'.$filename;
                }
                else{
                    $blog=$req->blog_image;
                } 
                Blog::where('blogs_id',$req->blogs_id)->update([
                    'blog_title' => $req->blog_title,  
                    'blog_image' => $blog,
                    'blog_description' => $req->blog_description 
                ]);
                return back()->with('msg','Blog Edit Successfully');
            }else{  
                $req->validate([
                    'blog_title'=> 'required',   
                    'blog_image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 

                if($req->hasFile('blog_image')) {
                    $file = $req->file('blog_image');
                    $filename = 'blog'.time().'.'.$req->blog_image->extension();
                    $destinationPath = storage_path('../public/upload/blog');
                    $file->move($destinationPath, $filename);
                    $blog = 'upload/blog/'.$filename;
                } 
                $data = new Blog();
                $data->blog_title = $req->blog_title;  
                $data->blog_image  = $blog;
                $data->blog_description = $req->blog_description;  
                $data->save(); 
                return back()->with('msg','Blog Add Successfully');
            }
        } 
    // Blogs function end

    // product start  
        // public function addProduct(){
        //     $data['flag'] = 1; 
        //     $data['page_title'] = 'Add Product'; 
        //     $data['category'] = Category::where('parent_id',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->orwhere('type',3)->where('status',0)->orderBy('categories_id','desc')->get();  
        //     $data['sub_category'] = Category::where('category_name',null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();  
        //     $data['sub_sub_category'] = Category::where('category_name',null)->where('parent_id','!=',null)->where('sub_parent_id','!=',null)->where('sub_sub_parent_id',null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();
        //     $data['sub_sub_sub_category'] = Category::where('category_name',null)->where('sub_parent_id','!=' ,null)->where('parent_id','!=' ,null)->where('sub_sub_parent_id' ,'!=' ,null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();  
        //     $data['vendor'] = Vendor::where('status',0)->orderBy('vendors_id','desc')->get();  
        //     return view('admin/webviews/admin_manage_product',$data);
        // }
        public function addProduct(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Product'; 
            $data['test'] = Brand::get();  
            $data['category'] = Category::where('category_name', '!=' , null)->where('type',0)->orwhere('type',2)->orwhere('type',3)->where('status',0)->orderBy('category_name','asc')->get();   

            $data['sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get();    

            $data['sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get(); 

            $data['sub_sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',  '!=' , null)->where('status',0)->orderBy('sub_category_name','asc')->get(); 

            $data['vendor'] = Vendor::where('status',0)->orderBy('vendors_id','desc')->get();  
            return view('admin/webviews/admin_manage_product',$data);
        }

        public function viewProduct(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Product'; 
            $data['product'] = Product::orderBy('products_id','desc')->get(); 
            //dd($data['product']);
            return view('admin/webviews/admin_manage_product',$data);
        }

        public function  deleteProduct($products_id){ 
            $data['result']=Product::where('products_id',$products_id)->delete();
            return back()->with('msg','Product Delete Successfully');  
        }

        public function editProduct($products_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Product'; 
             $data['test'] = Brand::get();
            $data['category'] = Category::where('category_name', '!=' , null)->where('type',0)->orwhere('type',2)->orwhere('type',3)->where('status',0)->orderBy('category_name','asc')->get();   

            $data['sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get();    

            $data['sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',null)->where('status',0)->orderBy('sub_category_name','asc')->get(); 

            $data['sub_sub_sub_category'] = Category::where('category_name', null)->where('sub_category_name',  '!=' , null)->where('parent_id',  '!=' , null)->where('sub_parent_id',  '!=' , null)->where('sub_sub_parent_id',  '!=' , null)->where('status',0)->orderBy('sub_category_name','asc')->get();
            
            $data['vendor'] = Vendor::where('status',0)->orderBy('vendors_id','desc')->get();
            $data['result'] = Product::where('products_id',$products_id)->first(); 
            return view('admin/webviews/admin_manage_product',$data);
        }

        public function toggleProductActiveStatus($status, $products_id) { 
            Product::where('products_id', $products_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
         
        // public function productSubmit(Request $req){   
          
        //     $count = 1; 
        //     if($req->products_id){ 
        //         $req->validate([
        //             'product_name'=> 'required',
        //             'product_code'=> 'required',      
        //             'price'=> 'required',     
        //             'categories'=> 'required' 
        //         ]);
        //         Product::where('products_id',$req->products_id)->update([
        //             'product_name' =>  $req->product_name,   
        //             'price' =>  $req->price, 
        //             'quantity' =>  $req->quantity, 
        //             'special_price' =>  $req->special_price, 
        //             'extra_discount' =>  $req->extra_discount, 
        //             'key_features' =>  $req->key_features, 
        //             'short_description' =>  $req->short_description, 
        //             'long_description' =>  $req->long_description,  
        //             'brand' =>   $req->brand,
        //             'tags' =>   $req->tags,  
        //             'categories' =>  $req->categories, 
        //             'sub_categories' =>  $req->sub_categories, 
        //             'sub_sub_categories' =>  $req->sub_sub_categories, 
        //             'sub_sub_sub_categories'=> $req->sub_sub_sub_categories, 
        //             'product_code'=> $req->product_code,  
        //              'featured_product' => $req->featured_product,
        //             'top_selling_product' => $req->top_selling_product,
        //             'vendor_id' =>  $req->vendor_id 
        //         ]); 

        //         if($req->hasFile('product_image_one')) {
        //             $file = $req->file('product_image_one');
        //             $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
        //             $destinationPath = storage_path('../public/upload/product');
        //             $file->move($destinationPath, $filename);
        //             $product = 'upload/product/'.$filename;

        //             ProductImage::where('product_images_id',$req->product_images_id)->update([
        //                 'product_image' => $product 
        //             ]); 
        //         }  
                
        //         //dd($req->all());

        //         if($req->hasfile('product_image_two')) {           //here i got product_image_twos
        //             $file = $req->product_image_two;
        //             $file_count= count($file);              //for updating multiple product_image_twos  
        //             for ($i=0; $i < $file_count; $i++) {  
        //                 if(is_object($file[$i])){
        //                     //dd($file[$i]->tmp_name());
        //                     $imagesize  = $file[$i]->getClientSize();
        //                     // dd($imagesize);
        //                     $imageexten = $file[$i]->getClientOriginalExtension();
        //                     $name = $file[$i]->getClientOriginalName();
        //                     //dd($name); 

        //                     $new_name = 'product_two'.time().$count++.'.'.$name;
        //                     //$new_name = $req->product_image_two[$i].".".$imageexten;
        //                     $destinationPath = storage_path('../public/upload/product');
        //                     $file[$i]->move($destinationPath, $new_name);
        //                     $product_image_path ='upload/product/'.$new_name;
        //                     ProductImage::where('product_images_id',$req->product_images_id1[$i])->update([
        //                         'product_image' => $product_image_path 
        //                     ]); 
        //                 }else{
        //                     $product_image_path = $file[$i];
        //                     // foreach ($product->images as $key => $value) {       
        //                     ProductImage::where('product_images_id',$req->product_images_id1[$i])->update([
        //                         'product_image' => $product_image_path
                               
        //                     ]);  
        //                 } 
        //             }  
        //         } 
        //         return back()->with('msg','Product Edit Successfully');
        //     }else{  
        //         $req->validate([
        //             'product_name'=> 'required',
        //             'product_code'=> 'required',      
        //             'price'=> 'required',     
        //             'categories'=> 'required',     
        //             'product_image_one' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' ,    
        //             'product_image_two' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required',     
        //             'product_image_three' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' ,    
        //             'product_image_four' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'     
        //         ]); 
        //         $role = null;
        //         $data = new Product();
        //         $data->product_name = $req->product_name;   
        //         $data->price = $req->price; 
        //         $data->special_price = $req->special_price; 
        //         $data->extra_discount = $req->extra_discount; 
        //         $data->key_features = $req->key_features; 
        //         $data->short_description = $req->short_description; 
        //         $data->prescription = $req->prescription; 
        //         $data->long_description = $req->long_description;  
        //         $data->brand =  $req->brand;  
        //         $data->tags =  $req->tags;  
        //         $data->categories = $req->categories; 
        //         $data->sub_categories = $req->sub_categories; 
        //         $data->sub_sub_categories = $req->sub_sub_categories; 
        //         $data->sub_sub_sub_categories = $req->sub_sub_sub_categories; 
        //         $data->product_code = $req->product_code; 
        //         $data->quantity = $req->quantity; 
        //         if($req->featured_product != null){
        //             $data->featured_product = $req->featured_product; 
        //         }else{
        //             $data->featured_product = $role;
        //         }
        //         if($req->top_selling_product != null){
        //             $data->top_selling_product = $req->top_selling_product; 
        //         }else{
        //             $data->top_selling_product = $role;
        //         } 
        //         $data->vendor_id = $req->vendor_id;
                 
        //         $data->save();
        //         //dd($data->id);  
        //         if($req->hasFile('product_image_one')) {
        //             $file = $req->file('product_image_one');
        //             $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
        //             $destinationPath = storage_path('../public/upload/product');
        //             $file->move($destinationPath, $filename);
        //             $product = 'upload/product/'.$filename;
        //         } 
        //         if($req->hasFile('product_image_two')) {
        //             $file = $req->file('product_image_two');
        //             $filename = 'product_two'.time().$count++.'.'.$req->product_image_two->extension();
        //             $destinationPath = storage_path('../public/upload/product');
        //             $file->move($destinationPath, $filename);
        //             $product1 = 'upload/product/'.$filename;
        //         } 
        //         if($req->hasFile('product_image_three')) {
        //             $file = $req->file('product_image_three');
        //             $filename = 'product_three'.time().$count++.'.'.$req->product_image_three->extension();
        //             $destinationPath = storage_path('../public/upload/product');
        //             $file->move($destinationPath, $filename);
        //             $product2 = 'upload/product/'.$filename;
        //         } 

        //         if($req->hasFile('product_image_four')) {
        //             $file = $req->file('product_image_four');
        //             $filename = 'product_four'.time().$count++.'.'.$req->product_image_four->extension();
        //             $destinationPath = storage_path('../public/upload/product');
        //             $file->move($destinationPath, $filename);
        //             $product3 = 'upload/product/'.$filename;
        //         } 

        //         $data1 = new ProductImage();
        //         $data1->products_id = $data->id; 
        //         $data1->product_image  = $product; 
        //         $data1->type  = 2; 
        //         $data1->save(); 

        //         $data2 = new ProductImage();
        //         $data2->products_id = $data->id;  
        //         $data2->product_image  = $product1; 
        //         $data1->type  = 1; 
        //         $data2->save();

        //         $data3 = new ProductImage();
        //         $data3->products_id = $data->id;  
        //         $data3->product_image  = $product2; 
        //         $data1->type  = 1; 
        //         $data3->save(); 

        //         $data4 = new ProductImage();
        //         $data4->products_id = $data->id;  
        //         $data4->product_image  = $product3; 
        //         $data1->type  = 1;  
        //         $data4->save(); 
        //         return back()->with('msg','Product Add Successfully'); 
        //     }
        // } 
        public function productSubmit(Request $req){    
            //dd($req->all());
            $count = 1; 
            if($req->products_id){ 
                $req->validate([
                    'product_name'=> 'required',
                    'product_code'=> 'required',      
                    'price'=> 'required',     
                    'categories'=> 'required' 
                ]);
                Product::where('products_id',$req->products_id)->update([
                    'product_name' =>  $req->product_name,   
                    'price' =>  $req->price, 
                    'quantity' =>  $req->quantity, 
                    'special_price' =>  $req->special_price, 
                    'extra_discount' =>  $req->extra_discount, 
                    'key_features' =>  $req->key_features, 
                    'short_description' =>  $req->short_description, 
                    'long_description' =>  $req->long_description,  
                    'brand' =>   $req->brand,
                    'tags' =>   $req->tags,  
                    'categories' =>  $req->categories, 
                    'sub_categories' =>  $req->sub_categories, 
                    'sub_sub_categories' =>  $req->sub_sub_categories, 
                    'sub_sub_sub_categories'=> $req->sub_sub_sub_categories, 
                    'product_code'=> $req->product_code,  
                     'featured_product' => $req->featured_product,
                    'top_selling_product' => $req->top_selling_product,
                    'vendor_id' =>  $req->vendor_id 
                ]); 

                if($req->hasFile('product_image_one')) {
                    $file = $req->file('product_image_one');
                    $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product = 'upload/product/'.$filename;

                    ProductImage::where('product_images_id',$req->product_images_id)->update([
                        'product_image' => $product 
                    ]); 
                }  
                
                //dd($req->all());

                if($req->hasfile('product_image_two')) {           //here i got product_image_twos
                    $file = $req->product_image_two;
                    $file_count= count($file);              //for updating multiple product_image_twos  
                    for ($i=0; $i < $file_count; $i++) {  
                        if(is_object($file[$i])){
                            //dd($file[$i]->tmp_name());
                            $imagesize  = $file[$i]->getClientSize();
                            // dd($imagesize);
                            $imageexten = $file[$i]->getClientOriginalExtension();
                            $name = $file[$i]->getClientOriginalName();
                            //dd($name); 

                            $new_name = 'product_two'.time().$count++.'.'.$name;
                            //$new_name = $req->product_image_two[$i].".".$imageexten;
                            $destinationPath = storage_path('../public/upload/product');
                            $file[$i]->move($destinationPath, $new_name);
                            $product_image_path ='upload/product/'.$new_name;
                            ProductImage::where('product_images_id',$req->product_images_id1[$i])->update([
                                'product_image' => $product_image_path 
                            ]); 
                        }else{
                            $product_image_path = $file[$i];
                            // foreach ($product->images as $key => $value) {       
                            ProductImage::where('product_images_id',$req->product_images_id1[$i])->update([
                                'product_image' => $product_image_path
                               
                            ]);  
                        } 
                    }  
                } 
                return back()->with('msg','Product Edit Successfully');
            }else{  
                $req->validate([
                    'product_name'=> 'required',
                    'product_code'=> 'required',      
                    'price'=> 'required',     
                    'categories'=> 'required',     
                    'product_image_one' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' ,    
                    'product_image_two' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required',     
                    'product_image_three' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' ,    
                    'product_image_four' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'     
                ]); 
                $role = null;
                $data = new Product();
                $data->product_name = $req->product_name;   
                $data->price = $req->price; 
                $data->special_price = $req->special_price; 
                $data->extra_discount = $req->extra_discount; 
                $data->key_features = $req->key_features; 
                $data->short_description = $req->short_description; 
                $data->prescription = $req->prescription; 
                $data->long_description = $req->long_description;  
                $data->brand =  $req->brand;  
                $data->tags =  $req->tags;  
                $data->categories = $req->categories; 
                $data->sub_categories = $req->sub_categories; 
                $data->sub_sub_categories = $req->sub_sub_categories; 
                $data->sub_sub_sub_categories = $req->sub_sub_sub_categories; 
                $data->product_code = $req->product_code; 
                $data->quantity = $req->quantity; 
                if($req->featured_product != null){
                    $data->featured_product = $req->featured_product; 
                }else{
                    $data->featured_product = $role;
                }
                if($req->top_selling_product != null){
                    $data->top_selling_product = $req->top_selling_product; 
                }else{
                    $data->top_selling_product = $role;
                } 
                $data->vendor_id = $req->vendor_id;
                 
                $data->save();
                //dd($data->id);  
                if($req->hasFile('product_image_one')) {
                    $file = $req->file('product_image_one');
                    $filename = 'product_one'.time().$count++.'.'.$req->product_image_one->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product = 'upload/product/'.$filename;
                } 
                if($req->hasFile('product_image_two')) {
                    $file = $req->file('product_image_two');
                    $filename = 'product_two'.time().$count++.'.'.$req->product_image_two->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product1 = 'upload/product/'.$filename;
                } 
                if($req->hasFile('product_image_three')) {
                    $file = $req->file('product_image_three');
                    $filename = 'product_three'.time().$count++.'.'.$req->product_image_three->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product2 = 'upload/product/'.$filename;
                } 

                if($req->hasFile('product_image_four')) {
                    $file = $req->file('product_image_four');
                    $filename = 'product_four'.time().$count++.'.'.$req->product_image_four->extension();
                    $destinationPath = storage_path('../public/upload/product');
                    $file->move($destinationPath, $filename);
                    $product3 = 'upload/product/'.$filename;
                } 

                $data1 = new ProductImage();
                $data1->products_id = $data->id; 
                $data1->product_image  = $product; 
                $data1->type  = 2; 
                $data1->save(); 

                $data2 = new ProductImage();
                $data2->products_id = $data->id;  
                $data2->product_image  = $product1; 
                $data1->type  = 1; 
                $data2->save();

                $data3 = new ProductImage();
                $data3->products_id = $data->id;  
                $data3->product_image  = $product2; 
                $data1->type  = 1; 
                $data3->save(); 

                $data4 = new ProductImage();
                $data4->products_id = $data->id;  
                $data4->product_image  = $product3; 
                $data1->type  = 1;  
                $data4->save(); 
                return back()->with('msg','Product Add Successfully'); 
            }
        } 
    // product end

    // location start  
        public function addLocation(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Location'; 
            return view('admin/webviews/admin_manage_location',$data);
        }

        public function viewLocation(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Location'; 
            $data['category'] = Location::orderBy('locations_id','desc')->get(); 
            return view('admin/webviews/admin_manage_location',$data);
        }

        public function  deleteLocation($locations_id){ 
            $data['result']=Location::where('locations_id',$locations_id)->delete();
            return back()->with('msg','Location Delete Successfully');  
        }

        public function editLocation($locations_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Location'; 
            $data['result'] = Location::where('locations_id',$locations_id)->first(); 
            return view('admin/webviews/admin_manage_location',$data);
        }

        public function toggleLocationActiveStatus($status, $locations_id) { 
            Location::where('locations_id', $locations_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function locationSubmit(Request $req){ 
            $req->validate([
                'location_name'=> 'required',  
                'location_code'=> 'required'  
            ]); 
            if($req->locations_id) { 
                Location::where('locations_id',$req->locations_id)->update([
                    'location_name' => $req->location_name, 
                    'location_code' => $req->location_code, 
                ]);
                return back()->with('msg','Location Edit  Successfully');
            }else{ 
                $data = new Location();
                $data->location_name = $req->location_name; 
                $data->location_code = $req->location_code; 
                $data->save(); 
                return back()->with('msg','Location Add  Successfully');
            }
        } 
    // Location End

    // Testimonial function start
        public function addTestimonial(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Testimonial'; 
            return view('admin/webviews/admin_manage_testimonial',$data);
        }

        public function viewTestimonial(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Testimonial'; 
            $data['testimonial'] = Testimonial::orderBy('testimonials_id','desc')->get(); 
            return view('admin/webviews/admin_manage_testimonial',$data);
        }

        public function  deleteTestimonial($testimonials_id){ 
            $data['result']=Testimonial::where('testimonials_id',$testimonials_id)->delete();
            return back()->with('msg','Testimonial Delete Successfully');  
        }

        public function editTestimonial($testimonials_id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Testimonial'; 
            $data['result'] = Testimonial::where('testimonials_id',$testimonials_id)->first(); 
            return view('admin/webviews/admin_manage_testimonial',$data);
        }

        public function toggleTestimonialActiveStatus($status, $testimonials_id) { 
            Testimonial::where('testimonials_id', $testimonials_id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
         
        public function testimonialSubmit(Request $req){ 
            
            if($req->testimonials_id) { 
                $req->validate([
                    'name'=> 'required',
                    'position'=> 'required',
                    'description'=> 'required',
                    'rating'=> 'required',
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]);    
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'testimonial'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/testimonial');
                    $file->move($destinationPath, $filename);
                    $testimonial = 'upload/testimonial/'.$filename;
                }
                else{
                    $testimonial=$req->image;
                } 
                Testimonial::where('testimonials_id',$req->testimonials_id)->update([
                    'name' => $req->name,  
                    'position' => $req->position,  
                    'description' => $req->description,  
                    'rating' => $req->rating,  
                    'image' => $testimonial 
                ]);
                return back()->with('msg','Testimonial Edit Successfully');
            }else{  
                $req->validate([
                    'name'=> 'required',
                    'position'=> 'required',
                    'description'=> 'required',
                    'rating'=> 'required',
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required' 
                ]); 

                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'testimonial'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/testimonial');
                    $file->move($destinationPath, $filename);
                    $testimonial = 'upload/testimonial/'.$filename;
                } 
                $data = new Testimonial();
                $data->name = $req->name; 
                $data->position = $req->position; 
                $data->description = $req->description; 
                $data->rating = $req->rating; 
                $data->image =  $testimonial;   
                $data->save(); 
                return back()->with('msg','Testimonial Add Successfully');
            }
        } 
    // Testimonial function end

    //package function start
        public function addPackages(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Packages'; 
            $data['test'] = Category::where('categories_id',15)->first();  
            return view('admin/webviews/admin_manage_package',$data);
        }

        public function viewPackages(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Packages'; 
            $data['vendor'] = Package::orderBy('id','desc')->get(); 
            return view('admin/webviews/admin_manage_package',$data);
        }

        public function  deletePackages($id){ 
            $data['result']=Package::where('id',$id)->delete();
            return back()->with('msg','Vendor Delete Successfully');  
        }

        public function editPackages($id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Packages'; 
            $data['test'] = Category::where('categories_id',15)->first();   
            $data['result'] = Package::where('id',$id)->first(); 
            return view('admin/webviews/admin_manage_package',$data);
        }

        public function togglePackagesActiveStatus($status, $id) { 
            Package::where('id', $id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        } 
         
        public function packagesSubmit(Request $req){  
            if($req->id) { 
                $req->validate([
                    'package_name'=> 'required',    
                    'package_cost'=> 'required',    
                    'offer_discount'=> 'required', 
                    'type'=> 'required', 
                    'short_disc'=> 'required', 
                    'long_disc'=> 'required' 
                ]);  
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'package'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/package');
                    $file->move($destinationPath, $filename);
                    $package = 'upload/package/'.$filename;
                }
                else{
                    $package=$req->image;
                } 
                Package::where('id',$req->id)->update([
                    'package_name' => $req->package_name,  
                    'image' => $package,
                    'package' => implode(',', $req->package), 
                    'package_cost' => $req->package_cost, 
                    'offer_discount' => $req->offer_discount,
                     'type' => $req->type,
                     'short_disc' => $req->short_disc,
                     'long_disc' => $req->long_disc
                    //   dd($req)
                ]);
                return back()->with('msg','Package Edit Successfully');
            }else{  
                $req->validate([
                    'package_name'=> 'required',    
                    'package_cost'=> 'required',    
                    'offer_discount'=> 'required',
                     'short_disc'=> 'required', 
                    'long_disc'=> 'required', 
                    'image' => 'image|mimes:jpeg,jpg,png,gif,svg|max:2048|required'    
                ]); 

                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'package'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/package');
                    $file->move($destinationPath, $filename);
                    $package = 'upload/package/'.$filename;
                } 
                $data = new Package();
                $data->package_name = $req->package_name;
                $data->image = $package;
                $data->package = implode(',', $req->package); 
                $data->package_cost = $req->package_cost; 
                $data->offer_discount = $req->offer_discount; 
                $data->type = $req->type; 
                $data->long_disc = $req->long_disc; 
                $data->short_disc = $req->short_disc; 
               
                $data->save();
                return back()->with('msg','Package Add Successfully');
            }
        } 
    //package function end
    
    // brand start  
        public function addBrand(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Add Brand'; 
            return view('admin/webviews/admin_manage_brand',$data);
        }

        public function viewBrand(){
            $data['flag'] = 2; 
            $data['page_title'] = 'View Brand'; 
            $data['brand'] = Brand::orderBy('id','desc')->get(); 
            return view('admin/webviews/admin_manage_brand',$data);
        }

        public function  deleteBrand($id){ 
            $data['result']=Brand::where('id',$id)->delete();
            return back()->with('msg','Brand Delete Successfully');  
        }

        public function editBrand($id){
            $data['flag'] = 3; 
            $data['page_title'] = 'Edit Brand'; 
            $data['result'] = Brand::where('id',$id)->first(); 
            return view('admin/webviews/admin_manage_brand',$data);
        }

        public function toggleBrandActiveStatus($status, $id) { 
            Brand::where('id', $id)->update(['status' => $status]); 
            return back()->with('msg','Status Change Successfully'); 
        }

        public function BrandSubmit(Request $req){ 
            $req->validate([
                'brand_name'=> 'required'  
            ]); 
            if($req->id) { 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'brand'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/brand');
                    $file->move($destinationPath, $filename);
                    $brand = 'upload/brand/'.$filename;
                }
                else{
                    $brand=$req->image;
                } 
                Brand::where('id',$req->id)->update([
                    'brand_name' => $req->brand_name,
                    'image' => $brand,
                ]);
                return back()->with('msg','Brand Edit  Successfully');
            }else{ 
                if($req->hasFile('image')) {
                    $file = $req->file('image');
                    $filename = 'brand'.time().'.'.$req->image->extension();
                    $destinationPath = storage_path('../public/upload/brand');
                    $file->move($destinationPath, $filename);
                    $brand = 'upload/brand/'.$filename;
                }
                $data = new Brand();
                $data->brand_name = $req->brand_name; 
                $data->image  = $brand;
                $data->save(); 
                return back()->with('msg','Brand Add  Successfully');
            }
        } 
    // brand End 
    //social icon start
        public function editSocialIcon(){
            $data['flag'] = 1; 
            $data['page_title'] = 'Social Icon';
            $data['result'] = SocialIcon::where('id',1)->first();   
            return view('admin/webviews/admin_manage_social',$data); 
        } 
         
        public function updateSocialIcon(Request $req){
            SocialIcon::where('id',$req->id)->update([ 
                'facebook' => $req->facebook, 
                'twitter' => $req->twitter,
                'youtube' => $req->youtube,
                'instagram' => $req->instagram,
                'skype'=> $req->skype 
            ]);  
            return back()->with('msg','Social Icon Add Successfully'); 
        }

    //social icon end
}
