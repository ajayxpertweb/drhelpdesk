<?php

namespace App\Http\Controllers\UI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Banner;
use App\Category;
use App\UserDetail;
use App\Product;
use App\ProductImage; 
use App\Blog; 
use App\Location; 
use App\Testimonial; 
use App\DoctorFeedback; 
use App\Package; 
use DB;
use Session;

class MainController extends Controller
{
    
       public function checkaddress(Request $request){  

             $name    =  $request->name;
             $request->session()->put('location_name', $name );
             
             $location = DB::table("locations")->where("location_name",$name)->count();
             return $location; 
    }
    public function homePage(Request $request){  
        // $latitude = 26.4947;
        // $longitude =  77.9940;
        // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyCx7vsP8llZYTAmjxBD6-yM6z_UJvff2W4";
        // $geocodeResponseData = file_get_contents($googleMapUrl);
        // $responseData = json_decode($geocodeResponseData, true);
        // if($responseData['status']=='OK') 
        // {  
        //     foreach ($responseData['results'][0]['address_components'] as $r) { 
        //         if ($r['types'][0]== 'locality') {
        //             $city = $r['long_name'];
        //             break;   
        //         } 
        //     }  
           
        // } 
        // session(['city'=>$city]); 
        $data['session']=session('city');  
        // $data['location'] = Location::get(); 
        $data['banner1'] = Banner::where('page_name','homepage')->where('status',0)->get();
        $data['category'] = Category::where('category_name','!=' , null)->where('type',0)->where('status',0)->orderBy('categories_id','desc')->get();
        $data['save_more_category'] = Category::where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','desc')->get();
        $data['doctor'] = UserDetail::where('role_id' , 1)->where('status',0)->orderBy('user_details_id','desc')->get();
        $data['top_selling_product'] = Product::where('top_selling_product' , '!=', null)->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get();
        $data['blog'] = Blog::where('status',0)->orderBy('blogs_id','desc')->get();
        $data['packages'] = Package::where('status',0)->orderBy('id','desc')->get();
        $data['testimonial'] = Testimonial::where('status',0)->orderBy('testimonials_id','desc')->get();
        //dd($data['banner']);
        return view('UI/webviews.main_home_page',$data);
    } 
    
    public function productFilter3(Request $req , $categories_id , $subcategories = null ,$subsubcategories = null ,$subsubsubcategories = null){
        $data['maxValue'] = Product::max('price'); 
        $ptags = DB::table('products')->select('tags')->get();
        $mainTags =  ''; 
        foreach($ptags as $tags){
              $mainTags =   $tags->tags.',';
        }
        $data['mainTags'] = array_unique(array_filter(explode(',',$mainTags)));
        //dd($mainTags);
        $data['parameter'] = [$categories_id , $subcategories ,$subsubcategories ,$subsubsubcategories]; 
        $minpr = $req->minpr;  
        $maxpr = $req->maxpr; 
        $tags = !empty($req->tags);    
        $brand = !empty($req->brand)?$req->brand:[]; 
        $rating = !empty($req->rating)?$req->rating:[];
        $price_sort = $req->price_sort; 
        $subcategories = (int) $subcategories;
        $subsubcategories = (int) $subsubcategories;
        $subsubsubcategories = (int) $subsubsubcategories;
        $data['page'] = $req->all();
        
        $data['r'] = Category::where('categories_id', $categories_id)->where('category_name','!=' , null)->where('status',0)->first();

        if($subcategories == null){
            $subcategories = Category::where('parent_id', $categories_id)->where('status',0)->select('categories_id')->get();
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

        //dd(json_decode(json_encode($subcategories)));
        $data['product'] = Product::where('categories',$categories_id)
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
        ->where('status',0)->orderBy('price',$sortP)->paginate(20);   
        //dd($data['product']); 
        return view('UI/webviews.main_product_page')->with('data', $data)->with('sortP',$sortP)->with('tags' ,$tags)->with('brand' ,$brand)->with('rating' ,$rating)->with('minpr' ,$minpr)->with('maxpr' ,$maxpr);   
    }  
    
    public function productDetail($products_id){  
        $data['product'] = Product::where('products_id',$products_id)->first();
        $data['top_selling_product'] = Product::where('top_selling_product' , '!=', null)->where('status',0)->orderBy(DB::raw('RAND()'))->take(30)->get(); 
        return view('UI/webviews.main_product_detail_page',$data);
    } 


    public function doctorListing(Request $req){  
        $data['flag'] = 1;
        $data['page'] = $req->all(); 
        $data['feedbacks'] = DoctorFeedback::where('doctor_id' , $req->id)->count();
        $data['doctor'] = UserDetail::where('role_id' , '!=' , null)->where('status',0)->orderBy(DB::raw('RAND()'))->get();
        return view('UI/webviews.doctor.manage_doctor',$data); 
    }

    public function doctorDetails(Request $req){  
        $data['flag'] = 2; 
        $data['feedbacks'] = DoctorFeedback::where('doctor_id' , $req->id)->get();
        $data['doctor'] = UserDetail::where('user_details_id' , $req->id)->first();
        return view('UI/webviews.doctor.manage_doctor',$data); 
    }

    public function uploadPrescription(){ 
        $data['flag'] = 1;
        return view('UI/webviews/order_prescription',$data);
    }
   public function aboutUs()
    {
        $data['flag'] = 1; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    public function privacyPolicy()
    {
        $data['flag'] = 2; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function contactUs()
    {
        $data['flag'] = 3; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function blog()
    {
        $data['flag'] = 4; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
}