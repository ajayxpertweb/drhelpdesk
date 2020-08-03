<?php 
namespace App\Http\Controllers\api; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Category;
use App\Banner;
use App\Coupon;
use App\Role;
use App\Language;
use App\UserDetail;
use App\Product;
use App\Location;
use App\Testimonial;
use App\Cart;
use DB;
use App\Package;
use App\Blog;
use App\ProductImage;
use App\Review;
use App\Brand;
use App\Order;
use App\OrderItem;
use App\ShippingCharge;
use App\DeWallet;
use App\DeliveryBoy;
use App\Vendor;
use App\Wishlist;
use App\ConsultationHistory;
use App\ConsultationTransaction;
use App\Wallet; 
use App\WalletTransactionHistory;
use App\DoctorFeedback;

class AdminController extends Controller
{
    public function category(){
    	$category = Category::where('parent_id',null)->orderBy('categories_id','desc')->select('categories_id','category_name','image','title','type')->get();
    	if($category != null) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => 'success',
    			'category' => $category 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function subCategory(Request $req){
        if ($req->sub_sub_category_id) { //level 4 subcategory
    	  $category = Category::where(['parent_id'=>$req->category_id,'sub_parent_id'=>$req->sub_category_id,'sub_sub_parent_id'=>$req->sub_sub_category_id])->orderBy('sub_category_name','asc')->select('categories_id','sub_category_name','image','title','type')->get();
        }
        elseif ($req->sub_category_id) { //level 3 subcategory
            $category = Category::where(['parent_id'=>$req->category_id,'sub_parent_id'=>$req->sub_category_id,'sub_sub_parent_id'=>null])->orderBy('sub_category_name','asc')->select('categories_id','sub_category_name','image','title','type')->get();
            foreach($category as $r){
                $category1= Category::where('sub_sub_parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1; 
                }else{
                    $r->is_category = 0; 
                }
            } 
        }
        else { //level 2 subcategory and level 1 is category 
            //dd('hj');
            $category = Category::where(['parent_id'=>$req->category_id,'sub_parent_id'=>null,'sub_sub_parent_id'=>null])->orderBy('sub_category_name','asc')->select('categories_id','sub_category_name','image','title','type')->get();
            foreach($category as $r){
                $category1= Category::where('sub_parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1; 
                }else{
                    $r->is_category = 0; 
                }
            } 
        }
    	if($category->count() > 0) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => $category->count().' record found',
    			'category' => $category 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function productBySubCategory(Request $req){ 
        $maxValue = Product::max('price'); 
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  ''; 
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        $brand = DB::table('brands')->where('status',0)->get();
        if ($req->category_id && empty($req->sub_category_id) && empty($req->sub_sub_category_id) && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat or level 1
    	   $category = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories' , $req->category_id)->select('products.*','product_images.product_image')->get();
        }
        elseif ($req->category_id && $req->sub_category_id && empty($req->sub_sub_category_id) && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat and subcategory or level 2
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id])->select('products.*','product_images.product_image')->get();
        }
        elseif ($req->category_id && $req->sub_category_id && $req->sub_sub_category_id && empty($req->sub_sub_sub_category_id)) { //product on the basis of cat and subcategory and sub_sub_category or level 3
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id,'sub_sub_categories'=>$req->sub_sub_category_id])->select('products.*','product_images.product_image')->get();
        }
        else { //product on the basis of cat and subcat and sub_sub_category and sub_sub_sub_category or level 4
            $category = Product::Join('product_images','products.products_id','product_images.products_id')->where(['type'=>2,'categories' => $req->category_id,'sub_categories'=>$req->sub_category_id,'sub_sub_categories'=>$req->sub_sub_category_id,'sub_sub_sub_categories'=>$req->sub_sub_sub_category_id])->select('products.*','product_images.product_image')->get();
        }
    	//$category = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories' , $req->category_id)->where('sub_categories' , $req->sub_category_id)->select('products.product_name','products.price','products.special_price','products.short_description','product_images.product_image')->get();
    	if($category->count() > 0) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => 'success',
    			'product' => $category,
    			'max_price' => $maxValue,
    			'tags' => $mainTags,
    			'brand' => $brand 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function productDetails(Request $req){
        $result1=Product::join('vendors','products.vendor_id','vendors.vendors_id')->where('products_id',$req->product_id)->select('products.*','vendors.vendor_name')->first();
        $result=Product::where('products_id',$req->product_id)->first();
        $product=Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->select('products.*','product_images.product_image')->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
        $review=Review::where('product_id',$req->product_id)->get();
        $image=ProductImage::where('products_id',$req->product_id)->pluck('product_image');
        if ($result!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'product details',
                'no_of_review'=>$review->count(),
                'rating'=>$review->avg('rating'),
                'image' => $image,
                'product'=>$result,
                'similar_product'=>$product
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Product Not Found'
             ]);
        }
    }  
    public function doctorListing(Request $req){
        $category = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('speciality' , $req->sub_category_id)->select('user_details.*','categories.sub_category_name')->get();
        foreach ($category as $categories) {
            $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$categories->doctor_id)->orderBy('created_at','desc')->first();
            if($no_of_uses_left != null){
                $categories->is_credit = $no_of_uses_left->consultation_credit;
            }else{
                $categories->is_credit = 0; 
            }

            $fper = 0;
            $cfeedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->get(); 
            $categories->feedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->count(); 
            $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->where('recommendation','yes')->get(); 
            if($posFeddback->count()>0 && $cfeedback->count()>0){
                $fper = ($posFeddback->count()*100)/$cfeedback->count();    
                $categories->recommendation= floor($fper);
            }else{
                $categories->recommendation = null;
            }
        }
        if($category->count() > 0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'doctor' => $category 
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function locationListing(Request $req){
        $location = Location::where('status',0)->orderBy('locations_id','desc')->select('locations_id','location_name','location_code')->get();
    	if($location != null) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => 'success',
    			'location' => $location 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function homePage(Request $req){
        $banner=Banner::where(['status'=>0,'show_on'=>'mob'])->orderBy('banners_id','desc')->select('banner_name','image','type','location','page_name')->get(); 
        $health_package = DB::table('packages')->join('products', 'products.products_id', '=', 'packages.package')->select('packages.id','packages.package_name', 'products.product_name', 'packages.package_cost' ,'packages.offer_discount' ,'packages.status','packages.image' ,'packages.type')->get();
        foreach($health_package as $r){
            if($r->offer_discount != null){ 
                $discount = ($r->offer_discount * $r->package_cost) / 100;
                $r->offer_price = round($r->package_cost - $discount);
            }
        }
        $stay_healthy = Blog::where('status',0)->get();
        $category = Category::where('category_name','!=' , null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();
         foreach($category as $r){
                $category1= Category::where('parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1; 
                }else{
                    $r->is_category = 0; 
                }
            } 
        $save_more_category = Category::where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','desc')->get();
        foreach($save_more_category as $r){
                $category1= Category::where('parent_id',$r->categories_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_category = 1; 
                }else{
                    $r->is_category = 0; 
                }
            } 
        $doctor = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('role_id' ,1)->select('user_details.user_details_id','user_details.user_name',
        'user_details.image','user_details.address','user_details.experience_from','user_details.experience_to','categories.sub_category_name')->get(); //why data not fetch from user table
        $top_selling_product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('top_selling_product' ,'top_selling_product')->select('products.products_id','products.product_name','products.price','products.special_price','products.extra_discount','products.short_description','product_images.product_image')->inRandomOrder()->limit(5)->get();
        //$covid=Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories',32)->select('products.products_id','products.product_name','products.price','products.special_price','products.short_description','product_images.product_image')->take(10)->get(); //here 32 is define fix for covid product category if cate_id change then here is also change
         $covid = Category::where('category_name' ,'!=', null)->where('type',3)->where('status',0)->orderBy('categories_id','desc')->get(); // category only if subcategory find then remove the category_name condition
         
        // $cat=Product::distinct()->pluck('categories'); // here we find the all categories of the product
        // $covid_cat=[];
        // foreach ($cat as $key => $value) {
        //     $data=Category::where(['type'=>3,'categories_id'=>$value])->first(); //find the covid category
        //     if($data !=null){
        //         $covid_cat[]=$data; 
        //     }
        // }
        // if ($covid_cat!=null) {
        //     foreach ($covid_cat as $key => $value) {  //now covid category is only one i.e.32 so we not declare the $cavid as array type if covid category may have multiple the declare it as array type i.e $covid[]
        //         $covid=Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories',$value->categories_id)->select('products.products_id','products.product_name','products.price','products.special_price','products.short_description','product_images.product_image')->take(10)->get();
        //     }
        // }
        // else {
        //     $covid=[];
        // }
        //dd($covid);
        $testimonial=Testimonial::orderBy('created_at','desc')->get();

        if($banner!=null){
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Success',
                'banner'=>$banner,
                'category'=>$category,
                'save_more_category'=>$save_more_category,
                'doctor'=>$doctor,
                'stay_healthy'=>$stay_healthy,
                'health_package'=>$health_package,
                'top_selling_product'=>$top_selling_product,
                'covid'=>$covid,
                'testimonial'=>$testimonial
             ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
                ]);
        }

    }  
    public function addToCart(Request $req){
        if (Cart::where(['product_id'=>$req->product_id,'user_id'=>$req->user_id])->count()>0) {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Item Already Present In Cart',
                'count'=>Cart::where('user_id',$req->user_id)->count()
             ]);
        }
        else{
            $reg = new Cart;
            $reg->quantity = $req->quantity;
            $reg->product_id = $req->product_id;
            $reg->user_id = $req->user_id;
            $reg->type = $req->type;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Item Added To Cart',
                    'count'=>Cart::where('user_id',$req->user_id)->count(),
                    'Item'=>Cart::where('id',$reg->id)->select('id','user_id','product_id','quantity','type')->first()
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
    public function myCart(Request $req){ 
        $cart = Cart::where('user_id',$req->user_id)->select('type','product_id')->get();
        //dd($cart);
        if ($cart->count()>0) {
           foreach ($cart as $key => $r2) { 
                if($r2->type==1){
                    $data1[]=DB::table('products')
                    ->join('carts', 'products.products_id', '=', 'carts.product_id')
                    ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                    ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price', 'products.extra_discount' ,'product_images.product_image' ,'carts.quantity' ,'carts.id' ,'carts.type')->where('products.products_id',$r2->product_id)->first();
                }
                elseif($r2->type==2){
                    $data1[]=DB::table('products')
                    ->join('carts', 'products.products_id', '=', 'carts.product_id')
                    ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                    ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price', 'products.extra_discount' ,'product_images.product_image' ,'carts.quantity' ,'carts.id' ,'carts.type')->where('products.products_id',$r2->product_id)->first();
                }

                elseif($r2->type==3){
                    $data1[]=DB::table('packages')
                    ->join('carts', 'packages.id', '=', 'carts.product_id')
                    ->join('products', 'products.products_id', '=', 'packages.package')
                    ->select('packages.id as products_id','packages.package_name as product_name','packages.package_cost as price' ,'packages.package_cost as special_price' ,'packages.offer_discount as extra_discount','packages.image as product_image','carts.quantity','carts.id','carts.type')->where('packages.id',$r2->product_id)->first();
                }
            }
           if ($data1!=null) {
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Items of Cart',
                      'count'=>Cart::where('user_id',$req->user_id)->count(),
                      'Item'=>$data1
                   ]);
              } else {
                  return response()->json($data = [
                      'status' => 404,
                      'msg' => 'Data not found'
                   ]);
              }
        } else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Your Cart is empty'
             ]);
        }
    }
    public function fetchBrand(Request $req){
        $brand=Brand::where('status',0)->get();
        if ($brand->count()>0) {
             return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Brands Of The Products',
                      'brand'=>$brand
                   ]);
        }else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    // public function doctorDetails(Request $req){
    //     $category = UserDetail::where('user_details_id',$req->doctor_id)->first();
    //     $doctor_feedback = DoctorFeedback::where('doctor_id',$req->doctor_id)->get();
    //     if($category!=null) {
    //         return response()->json($data = [
    //             'status' => 200,
    //             'msg' => 'success',
    //             'specialist'=>Category::where('categories_id',$category->speciality)->pluck('sub_category_name')->first(),
    //             'result' => $category,
    //             'doctor_feedback' => $doctor_feedback,
    //         ]);
    //     }else {
    //         return response()->json($data = [
    //             'status' => 400,
    //             'msg' => 'Data Not Found'
    //          ]);
    //     }
    // }
    public function doctorDetails(Request $req){
        $category = UserDetail::where('user_details_id',$req->doctor_id)->first();
        $doctor_feedback = DoctorFeedback::where('doctor_id',$req->doctor_id)->get();
        foreach($doctor_feedback as $r){
            $category1= UserDetail::where('user_id',$r->user_id) 
            ->first(); 
             
            if($category1 != null){
                $r->user_name = $category1->user_name;
                $r->image = $category1->image; 
            }else{
                $r->user_name = null;
                $r->image = null; 
            } 
        } 
        if($category!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'specialist'=>Category::where('categories_id',$category->speciality)->pluck('sub_category_name')->first(),
                'result' => $category,
                'doctor_feedback' => $doctor_feedback,
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function allLabTest(Request $req){
        $test=Product::where('categories',$req->category_id)->get();//here category id is lab test id
        if ($test->count()>0) {
            return response()->json($data = [
                     'status' => 200,
                     'msg' => 'test name',
                     'test'=>$test
                  ]);
       }else {
           return response()->json($data = [
               'status' => 404,
               'msg' => 'Data Not Found'
            ]);
       }
    }
    public function vendorsOrder(Request $req){ 
        $orders = OrderItem::where('assign_vendor_id',$req->vendor_id)->get();
        if ($orders->count()>0) {
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Your Assign Orders',
                      'Item'=>$orders
                   ]);
        } else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'You have not assign any order'
             ]);
        }
    }
    public function shippingCharge(Request $req){
        $charge=ShippingCharge::get();
        if ($charge->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Shipping Charge',
                'charge'=>$charge
             ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'No Data Found'
             ]);
        }
        
    }
    public function deWalletCoin(Request $req){
        $wallet=DeWallet::where('user_id',$req->user_id)->first();
        if ($wallet!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Wallet',
                'charge'=>$wallet
             ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'No Data Found'
             ]);
        }
        
    }
    public function deliveryBoyListing(Request $req){ 
        $vendor=Vendor::where('vendors_id',$req->vendor_id)->first();

        $result =DB::select(DB::raw("
        SELECT
        id, (
          3959 * acos (
            cos ( radians($vendor->latitude) )
            * cos( radians( latitude ) )
            * cos( radians( longitude ) - radians($vendor->longitude) )
            + sin ( radians($vendor->latitude) )
            * sin( radians( latitude ) )
          )
        ) AS distance
      FROM delivery_boys
      ORDER BY distance asc LIMIT 1;
        ")
        );

        if ($result!=null) {
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Assign Delivery Boy',
                      'result'=>$result
                   ]);
        } else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data not found'
             ]);
        }
    }
    public function addToWishlist(Request $req){
        if (Wishlist::where(['product_id'=>$req->product_id,'user_id'=>$req->user_id,'type'=>$req->type])->count()>0) {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Item Already Present In Wishlist',
                'count'=>Wishlist::where('user_id',$req->user_id)->count()
             ]);
        }
        else{
            $reg = new Wishlist;
            $reg->quantity = $req->quantity;
            $reg->product_id = $req->product_id;
            $reg->user_id = $req->user_id;
            $reg->type = $req->type;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Item Added To Wishlist',
                    'count'=>Wishlist::where('user_id',$req->user_id)->count(),
                    'Item'=>Wishlist::where('id',$reg->id)->select('id','user_id','product_id','quantity','type')->first()
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
    public function myWishlist(Request $req){ 
        $wishlist = Wishlist::where('user_id',$req->user_id)->select('type','product_id')->get();
        //dd($wishlist);
        if ($wishlist->count()>0) {
           foreach ($wishlist as $key => $r2) { 
                if($r2->type==1){
                    $data1[]=DB::table('products')
                    ->join('wishlists', 'products.products_id', '=', 'wishlists.product_id')
                    ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                    ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price', 'products.extra_discount' ,'product_images.product_image' ,'wishlists.quantity' ,'wishlists.id' ,'wishlists.type')->where('products.products_id',$r2->product_id)->first();
                }
                elseif($r2->type==2){
                    $data1[]=DB::table('products')
                    ->join('wishlists', 'products.products_id', '=', 'wishlists.product_id')
                    ->join('product_images', 'products.products_id', '=', 'product_images.products_id')
                     ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price', 'products.extra_discount' ,'product_images.product_image' ,'wishlists.quantity' ,'wishlists.id' ,'wishlists.type')->where('products.products_id',$r2->product_id)->first();
                }
                elseif($r2->type==3){
                    $data1[]=DB::table('packages')
                    ->join('wishlists', 'packages.id', '=', 'wishlists.product_id')
                    ->join('products', 'products.products_id', '=', 'packages.package')
                     ->select('packages.id as products_id','packages.package_name as product_name','packages.package_cost as price' ,'packages.package_cost as special_price' ,'packages.offer_discount as extra_discount','packages.image as product_image','wishlists.quantity','wishlists.id','wishlists.type')->where('packages.id',$r2->product_id)->first();
                }
            }
           if ($data1!=null) {
                  return response()->json($data = [
                      'status' => 200,
                      'msg' => 'Items of Wishlist',
                      'count'=>Wishlist::where('user_id',$req->user_id)->count(),
                      'Item'=>$data1
                   ]);
              } else {
                  return response()->json($data = [
                      'status' => 404,
                      'msg' => 'Data not found'
                   ]);
              }
        } else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Your Wishlist is empty'
             ]);
        }
    }
    public function productFilter(Request $req){
        $maxValue = Product::max('price'); 
        $ptags = DB::table('products')->select('tags')->get(); 
        $mainTags =  ''; 
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        $brand1 = DB::table('brands')->where('status',0)->get();
        //dd($mainTags); 
        $minpr = $req->minpr;  
        $maxpr = $req->maxpr; 
        $tags = !empty($req->tags);    
        $brand_array = explode(',', $req->brand);
        $brand = !empty($brand_array)?$brand_array:[];
        $rating_array = explode(',', $req->rating); 
        $rating = !empty($rating_array)?$rating_array:[];
        //dd($rating);
        $price_sort = $req->price_sort; 
        $subcategories = (int) $req->sub_category_id;
        $subsubcategories = (int) $req->sub_sub_category_id;
        $subsubsubcategories = (int) $req->sub_sub_sub_category_id; 
        
        
        if($subcategories == null){
            $subcategories = Category::where('parent_id', $req->categories_id)->where('status',0)->select('categories_id')->get();
            //dd($subcategories);
        }

        if($subsubcategories == null  &&  !empty($subcategories) && is_array($subcategories) ){  
            $parent = [];
            foreach($subcategories as $r) {
                $parent[]  = Category::where('sub_parent_id', $r->categories_id)->where('status',0)->select('categories_id')->get(); 
            }  
        }   
        if($subsubsubcategories == null &&  !empty($subcategories) &&  !empty($subsubcategories) && is_array($subsubcategories) ){  
            $parent1 = [];
            foreach($subsubcategories as $r1) {
                $parent1[]  = Category::where('sub_sub_parent_id', $r1->categories_id)->where('status',0)->select('categories_id')->get(); 
            }  
        }    
        //dd($subsubcategories , $subsubsubcategories);
        if (!is_array($subcategories) && is_int($subcategories)) { 
            //dd($subcategories);
            $subcategories = (array) $subcategories;
        }
        if (!is_array($subsubcategories) && is_int($subsubcategories)  && $subsubcategories > 0) { 
            $subsubcategories = (array) $subsubcategories;
        }
        if (!is_array($subsubsubcategories) && is_int($subsubsubcategories)  && $subsubsubcategories > 0 ) { 
            $subsubsubcategories = (array) $subsubsubcategories;
        }
        if (!is_array($brand) && is_int($brand)  && $brand > 0 ) { 
            $brand = (array) $brand;
        }
        if (!is_array($rating) && is_int($rating)  && $rating > 0 ) { 
            $rating = (array) $rating;
        }
         
        if (!is_array($tags) && is_int($tags)  && $tags > 0 ) { 
            $tags = (array) $tags;
        }  
        //dd($price_sort);
         if (!empty($price_sort) && $price_sort == 1) {
               $sortP = 'desc';
            }else{
                 $sortP = 'asc';
            }
        //dd($rating);
        //dd(json_decode(json_encode($subcategories)));
        $product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories',$req->categories_id)
            ->where(function($query) use ($subcategories){
            $tessub = json_decode(json_encode($subcategories), true);
            if($subcategories!='' && !empty($tessub)){
                return $query->whereIn('sub_categories',$subcategories); 
            }})
            ->where(function($query) use ($subsubcategories){
            $tessubsub = json_decode(json_encode($subsubcategories), true);
            if($subsubcategories!='' && !empty($tessubsub)){
                return $query->whereIn('sub_sub_categories',$subsubcategories);
            }})
            ->where(function($query) use ($subsubsubcategories){
            $tessubsubsub = json_decode(json_encode($subsubsubcategories), true);
            if($subsubsubcategories!='' && !empty($tessubsubsub)){
                return $query->whereIn('sub_sub_sub_categories',$subsubsubcategories);
            }})  
            ->where(function($query) use ($brand){
            if (!empty($brand)) {
                return $query->whereIn('brand',$brand);
            }})  
            ->where(function($query) use ($rating){
            if (!empty($rating)) {
                return $query->whereIn('rating',$rating);
            }})
            ->where(function($query) use ($tags){
            if (!empty($tags)) {
                return $query->where('tags', 'LIKE', '%' . $tags . '%');
            }}) 
            ->where(function($query) use ($minpr ,$maxpr){
            if($minpr != '' && $maxpr != '' && $minpr >= 0 && $maxpr >= 0) {
                return $query->whereBetween('price', [$minpr, $maxpr]);
            }})
            
        ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();   
        //dd($product);
    	if($req->categories_id != null) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => 'success',
    			'product' => $product,
    			'max_price' => $maxValue,
    			'tags' => $mainTags,
    			'brand' => $brand1 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function allCities(){
        $city = DB::table('cities')->orderby('city_id','asc')->get();
        if($city !=null){
            return response()->json($data = [
                'msg'=>'success',
                'status'=>200,
                'city'=>$city
            ]);
        }else{
             return response()->json($data = [
                'msg'=>'Data Not Found',
                'status'=>400 
            ]);
        }
    } 
    // public function sexualWelnessDetail(Request $req){
    //     $result1=Category::where('parent_id',$req->id)->where('categories_id',438)->orwhere('categories_id',439)->get(); 
    //     $doctor = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('speciality',438)->orwhere('speciality',439)->orderBy(DB::raw('RAND()'))->select('user_details.*','categories.sub_category_name')->get();
    //     if ($result1!=null) {
    //         return response()->json($data = [
    //             'status' => 200,
    //             'msg' => 'product details', 
    //             'product'=>$result1,
    //             'doctor'=>$doctor,
    //          ]);
    //     }
    //     else {
    //         return response()->json($data = [
    //             'status' => 404,
    //             'msg' => 'Product Not Found'
    //          ]);
    //     }
    // }  
    public function sexualWelnessDetail(Request $req){
        $result1=Category::where('parent_id',$req->id)->where('categories_id',438)->orwhere('categories_id',439)->get(); 
        $doctor = UserDetail::Join('categories','user_details.speciality','categories.categories_id')->where('speciality',438)->orwhere('speciality',439)->orderBy(DB::raw('RAND()'))->select('user_details.*','categories.sub_category_name')->get();
        foreach ($doctor as $categories) {
            $no_of_uses_left = ConsultationTransaction::where('user_id',$req->user_id)->where('doc_id',$categories->doctor_id)->orderBy('created_at','desc')->first();
            if($no_of_uses_left != null){
                $categories->is_credit = $no_of_uses_left->consultation_credit;
            }else{
                $categories->is_credit = 0; 
            }

            $fper = 0;
            $cfeedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->get(); 
            $categories->feedback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->count(); 
            $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id',$categories->user_details_id)->where('recommendation','yes')->get(); 
            if($posFeddback->count()>0 && $cfeedback->count()>0){
                $fper = ($posFeddback->count()*100)/$cfeedback->count();    
                $categories->recommendation= floor($fper);
            }else{
                $categories->recommendation = null;
            }
        }
        if ($result1!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'product details', 
                'product'=>$result1,
                'doctor'=>$doctor,
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Product Not Found'
             ]);
        }
    } 
    public function productFilterSortBy(Request $req){ 
        $maxValue = Product::max('price'); 
        $ptags = DB::table('products')->select('tags')->get(); 
        $mainTags =  ''; 
        foreach($ptags as $tags){
            $mainTags =   $tags->tags.',';
        }
        $mainTags = array_unique(array_filter(explode(',',$mainTags)));
        $brand1 = DB::table('brands')->where('status',0)->get();  
        $price_sort = $req->price_sort; 
        $subcategories = (int) $req->sub_category_id;
        $subsubcategories = (int) $req->sub_sub_category_id;
        $subsubsubcategories = (int) $req->sub_sub_sub_category_id;  
        if($subcategories == null){
            $subcategories = Category::where('parent_id', $req->categories_id)->where('status',0)->select('categories_id')->get(); 
        }

        if($subsubcategories == null  &&  !empty($subcategories) && is_array($subcategories) ){  
            $parent = [];
            foreach($subcategories as $r) {
                $parent[]  = Category::where('sub_parent_id', $r->categories_id)->where('status',0)->select('categories_id')->get(); 
            }  
        }   
        if($subsubsubcategories == null &&  !empty($subcategories) &&  !empty($subsubcategories) && is_array($subsubcategories) ){  
            $parent1 = [];
            foreach($subsubcategories as $r1) {
                $parent1[]  = Category::where('sub_sub_parent_id', $r1->categories_id)->where('status',0)->select('categories_id')->get(); 
            }  
        }   
        if (!is_array($subcategories) && is_int($subcategories)) {  
            $subcategories = (array) $subcategories;
        }
        if (!is_array($subsubcategories) && is_int($subsubcategories)  && $subsubcategories > 0) { 
            $subsubcategories = (array) $subsubcategories;
        }
        if (!is_array($subsubsubcategories) && is_int($subsubsubcategories)  && $subsubsubcategories > 0 ) { 
            $subsubsubcategories = (array) $subsubsubcategories;
        } 

        if (!empty($price_sort) && $price_sort == 1) {
           $sortP = 'desc';
        }elseif (!empty($price_sort) && $price_sort == 3) {
           $newest = 'desc';
        }else{
             $sortP = 'asc';
        } 

        $product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories',$req->categories_id)
        ->where(function($query) use ($subcategories){
        $tessub = json_decode(json_encode($subcategories), true);
        if($subcategories!='' && !empty($tessub)){
            return $query->whereIn('sub_categories',$subcategories); 
        }})
        ->where(function($query) use ($subsubcategories){
        $tessubsub = json_decode(json_encode($subsubcategories), true);
        if($subsubcategories!='' && !empty($tessubsub)){
            return $query->whereIn('sub_sub_categories',$subsubcategories);
        }})
        ->where(function($query) use ($subsubsubcategories){
        $tessubsubsub = json_decode(json_encode($subsubsubcategories), true);
        if($subsubsubcategories!='' && !empty($tessubsubsub)){
            return $query->whereIn('sub_sub_sub_categories',$subsubsubcategories);
        }})   
        ->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();   
        if($req->categories_id != null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'success',
                'product' => $product,
                'max_price' => $maxValue,
                'tags' => $mainTags,
                'brand' => $brand1 
            ]);
        }else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function searchData(Request $req){
        // if($req->keyword){
        //     $search= DB::table('search_tables')->where('keyword',$req->keyword)->first(); 
        //     //dd($search);
        //     if($search==null){
        //         DB::table('search_tables')->insert([
        //             'keyword' => $req->keyword
        //         ]);
        //     } 
        //     $filters = explode(' ', $req->keyword); 

        //     $where = "product_name = '".$req->keyword."' || product_name like '%".$req->keyword."%' || brand = '".$req->keyword."' || brand like '%".$req->keyword."%' || short_description = '".$req->keyword."' || short_description like '%".$req->keyword."%'long_description = '".$req->keyword."' || long_description like '%".$req->keyword."%'key_features = '".$req->keyword."' || key_features like '%".$req->keyword."%'product_code = '".$req->keyword."' || product_code like '%".$req->keyword."%'tags = '".$req->keyword."' || tags like '%".$req->keyword."%'";
            

        //     foreach($filters as $filter) { 
        //         $where.=" || product_name like '%".$filter."%' || brand like '%".$filter."%' || short_description like '%".$filter."%' || long_description like '%".$filter."%' || key_features like '%".$filter."%'|| product_code like '%".$filter."%' || tags like '%".$filter."%'"; 
        //         //dd($where);
        //     } 
             
        //     //dd($where);

        //     $result=Product::whereRaw($where)->get(); 
        //     dd($result);
        //     return response()->json($data = [
        //         'status' => 200,
        //         'msg' => 'success',
        //         'search-keywords'=>$result
        //     ]);
        // }
        // else{
        //     return response()->json($data = [
        //         'status' => 201,
        //         'msg' => 'failed' 
        //     ]);
        // }

        if($req->keyword){
            $search= DB::table('search_tables')->where('keyword',$req->keyword)->first(); 
            //dd($search);
            if($search==null){
                DB::table('search_tables')->insert([
                    'keyword' => $req->keyword
                ]);
            } 
            $maxValue = Product::max('price'); 
            $ptags = DB::table('products')->select('tags')->get(); 
            $mainTags =  ''; 
            foreach($ptags as $tags){
                  $mainTags =   $tags->tags.',';
            }
            $mainTags = array_unique(array_filter(explode(',',$mainTags)));
            $brand1 = DB::table('brands')->where('status',0)->get();
            //dd($mainTags); 
            $minpr = $req->minpr;  
            $maxpr = $req->maxpr; 
            $tags = !empty($req->tags);    
            $brand_array = explode(',', $req->brand);
            $brand = !empty($brand_array)?$brand_array:[];
            $rating_array = explode(',', $req->rating); 
            $rating = !empty($rating_array)?$rating_array:[];
            //dd($rating);
            $price_sort = $req->price_sort; 
            $subcategories = (int) $req->sub_category_id;
            $subsubcategories = (int) $req->sub_sub_category_id;
            $subsubsubcategories = (int) $req->sub_sub_sub_category_id; 
        
        
            if($subcategories == null){
                $subcategories = Category::where('parent_id', $req->categories_id)->where('status',0)->select('categories_id')->get();
                //dd($subcategories);
            }

            if($subsubcategories == null  &&  !empty($subcategories) && is_array($subcategories) ){  
                $parent = [];
                foreach($subcategories as $r) {
                    $parent[]  = Category::where('sub_parent_id', $r->categories_id)->where('status',0)->select('categories_id')->get(); 
                }  
            }   
            if($subsubsubcategories == null &&  !empty($subcategories) &&  !empty($subsubcategories) && is_array($subsubcategories) ){  
                $parent1 = [];
                foreach($subsubcategories as $r1) {
                    $parent1[]  = Category::where('sub_sub_parent_id', $r1->categories_id)->where('status',0)->select('categories_id')->get(); 
                }  
            }    
            //dd($subsubcategories , $subsubsubcategories);
            if (!is_array($subcategories) && is_int($subcategories)) { 
                //dd($subcategories);
                $subcategories = (array) $subcategories;
            }
            if (!is_array($subsubcategories) && is_int($subsubcategories)  && $subsubcategories > 0) { 
                $subsubcategories = (array) $subsubcategories;
            }
            if (!is_array($subsubsubcategories) && is_int($subsubsubcategories)  && $subsubsubcategories > 0 ) { 
                $subsubsubcategories = (array) $subsubsubcategories;
            }
            if (!is_array($brand) && is_int($brand)  && $brand > 0 ) { 
                $brand = (array) $brand;
            }
            if (!is_array($rating) && is_int($rating)  && $rating > 0 ) { 
                $rating = (array) $rating;
            }
             
            if (!is_array($tags) && is_int($tags)  && $tags > 0 ) { 
                $tags = (array) $tags;
            }  
            //dd($price_sort);
             if (!empty($price_sort) && $price_sort == 1) {
                   $sortP = 'desc';
                }else{
                     $sortP = 'asc';
                }
            //dd($rating);
            //dd(json_decode(json_encode($subcategories)));
            $product = Product::Join('product_images','products.products_id','product_images.products_id')->where('type',2)->where('categories',$req->categories_id)
                ->where(function($query) use ($subcategories){
                $tessub = json_decode(json_encode($subcategories), true);
                if($subcategories!='' && !empty($tessub)){
                    return $query->whereIn('sub_categories',$subcategories); 
                }})
                ->where(function($query) use ($subsubcategories){
                $tessubsub = json_decode(json_encode($subsubcategories), true);
                if($subsubcategories!='' && !empty($tessubsub)){
                    return $query->whereIn('sub_sub_categories',$subsubcategories);
                }})
                ->where(function($query) use ($subsubsubcategories){
                $tessubsubsub = json_decode(json_encode($subsubsubcategories), true);
                if($subsubsubcategories!='' && !empty($tessubsubsub)){
                    return $query->whereIn('sub_sub_sub_categories',$subsubsubcategories);
                }})  
                ->where(function($query) use ($brand){
                if (!empty($brand)) {
                    return $query->whereIn('brand',$brand);
                }})  
                ->where(function($query) use ($rating){
                if (!empty($rating)) {
                    return $query->whereIn('rating',$rating);
                }})
                ->where(function($query) use ($tags){
                if (!empty($tags)) {
                    return $query->where('tags', 'LIKE', '%' . $tags . '%');
                }}) 
                ->where(function($query) use ($minpr ,$maxpr){
                if($minpr != '' && $maxpr != '' && $minpr >= 0 && $maxpr >= 0) {
                    return $query->whereBetween('price', [$minpr, $maxpr]);
                }}) 
            ->where('product_name', 'LIKE', "%$req->keyword%")->orWhere('brand', 'LIKE', "%$req->keyword%")->orWhere('short_description', 'LIKE', "%$req->keyword%")->orWhere('long_description', 'LIKE', "%$req->keyword%")->orWhere('key_features', 'LIKE', "%$req->keyword%")->orWhere('product_code', 'LIKE', "%$req->keyword%")->orWhere('tags', 'LIKE', "%$req->keyword%")->where('status',0)->orderBy('price',$sortP)->select('products.*','product_images.product_image')->get();    

            // $result=Product::where('product_name', 'LIKE', "%$req->keyword%")->orWhere('brand', 'LIKE', "%$req->keyword%")->orWhere('short_description', 'LIKE', "%$req->keyword%")->orWhere('long_description', 'LIKE', "%$req->keyword%")->orWhere('key_features', 'LIKE', "%$req->keyword%")->orWhere('product_code', 'LIKE', "%$req->keyword%")->orWhere('tags', 'LIKE', "%$req->keyword%")->get(); 
            if($product->count()>0){
                return response()->json($data=[
                    'status'=>200, 
                    'msg'=>count($product).' record found',
                    'product'=>($product),
                    'max_price' => $maxValue,
                    'tags' => $mainTags,
                    'brand' => $brand1 
                ]);
            } else {
                return response()->json($data=[
                    'status'=>201,
                    'msg'=>'no record found'
                ]);
            }
        }} 
    public function search(Request $req){
        return response()->json($data = [
            'status' => 200,
            'msg' => 'success',
            'search-keyword'=>DB::table('search_tables')->select('keyword')->get()
        ]); 
        
    }
} 
