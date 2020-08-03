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
use App\Wallet;
use App\Brand;
use App\Newslatters;
use App\OrderItem;
use Session;
use Auth;
use DB;
use Mail;
use App\Prescription;
use App\ConsultationTransaction;
use App\ConsultationHistory;
use App\ContactUs;

class MainController extends Controller
{
       public function checkaddress(Request $request){  

             $name    =  $request->name;
             
             
             $location = DB::table("locations")->where("location_name",$name)->count();
        
             $request->session()->put('set_location_name', $name );
             if($location > 0){
                $request->session()->put('location_name', $name );
             }else{
                 $request->session()->put('location_name', 'notfound' );
             }
             
            
             return $location; 
    }
    public function checkcheckoutaddress(Request $request){  

             $name    =  $request->name;
             $location = DB::table("locations")->where("location_name",$name)->count();
             $request->session()->put('set_location_name', $name );
             if($location > 0){
                $request->session()->put('location_name', $name );
             }else{
                 $request->session()->put('location_name', 'notfound' );
                 $session = Session::getId();
                 DB::Select(DB::raw("delete from temp_carts where session_id='".$session."' and (type=2 || type=3)"));
                 if(Auth::check()){
                    DB::Select(DB::raw("delete from carts where user_id='".Auth::id()."' and (type=2 || type=3)"));
                 }
             }
             return $location; 
    }
    public function homePage(Request $request){  
        // $latitude = 26.4947;
        // $longitude =  77.9940;
        // $googleMapUrl = "https://maps.googleapis.com/maps/api/geocode/json?latlng=".$latitude.",".$longitude."&result_type=locality&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM";
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
        
        if(empty($request->session()->get('location_name'))){
            $request->session()->put('location_name', 'no_location');
            $data['session']= '';
        }else{
            $data['session']= $request->session()->get('location_name');
        }
         
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
        $user_id = Auth::id(); 
        $prescription_list = [];
        
        $temp_prescription_list = Prescription::where('user_id', $user_id)->get();
        if($temp_prescription_list) {
            $prescription_list = $temp_prescription_list->toArray();
        }
        $data['user_id'] = $user_id;
        $data['prescription_list'] = $prescription_list;
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
        $data['blog'] = Blog::where('status',0)->orderBy('blogs_id','desc')->get();
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function refundPolicy()
    {
        $data['flag'] = 5; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function returnPolicy()
    {
        $data['flag'] = 6; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function cancellationPolicy()
    {
        $data['flag'] = 7; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function termCondition()
    {
        $data['flag'] = 8; 
        return view('UI/webviews.user.manage_pages',$data); 
    }

    public function disclaimer()
    {
        $data['flag'] = 9; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    public function appContactUs()
    { 
        return view('UI/components.user.app_contact_us'); 
    }
    public function addPrescTocheckout(Request $req)
    {
        return redirect('/checkout1/'.$req->user_id.'/'.$req->prescription_list);
    }
    
    public function saveWallet(Request $req)
    {
        $totalAmt = 0;
        if(!empty($req->user_id) && $req->user_id > 0) {
            $wallet_details = DB::table('wallets')->where('user_id', Auth::user()->id)->first();
            if(empty($wallet_details)) {
                $wallet = new Wallet;
                $wallet->user_id = $req->user_id;
                $wallet->amount = $req->amount; 
                $totalAmt = $req->amount;
                $wallet->save();
            } else {
                $alAmt = (int) $wallet_details->amount;
                $currentAmt = (int) $req->amount;
                $totalAmt = $alAmt+$currentAmt;
                Wallet::where('user_id',$req->user_id)->update([
                'amount'=>$totalAmt
                ]);
            }

            $doctor = UserDetail::where('user_id', $req->doc_id)->first();
            $cunsultRes = ConsultationTransaction::where('user_id', $req->user_id)->where('doc_id', $req->doc_id)->orderBy('id', 'DESC')->first();

            
            if(empty($cunsultRes)) {
                $cultTxn = new ConsultationTransaction();
                $cultTxn->user_id = $req->user_id;
                $cultTxn->doc_id = $req->doc_id; 
                $cultTxn->consultation_credit = $doctor->number_of_consultation; 
                $cultTxn->save();

                $rest_amount = $totalAmt - (int) $doctor->consultation_fees;

                Wallet::where('user_id',$req->user_id)->update([
                'amount'=>$rest_amount
                ]);

            }
            
            return back();
        } else {
            return back();
        }
    }

    public function callToConnect(Request $req){
        
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://panelv2.cloudshope.com/api/click_to_call?from_number=9971035955&to_number=8218054879",
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
            if(!empty($error_msg) ){
                echo '2';
              
            } else {

                $consultDetail = explode("#", $req->consult_call);
                $data = json_decode($response, true);
                
                if($data['status']!="failed") {
                
                    $culthst = new ConsultationHistory();
                    $culthst->user_id = $consultDetail[0];
                    $culthst->doc_id = $consultDetail[1]; 
                    $culthst->status = '1';
                    $culthst->type = '2'; 
                    $culthst->save();
    
                    $credit = (int) $consultDetail[2];
                    $cultTxn = new ConsultationTransaction();
                    $cultTxn->user_id = $consultDetail[0];
                    $cultTxn->doc_id =  $consultDetail[1];
                    $cultTxn->consultation_credit = $credit-1;
                    $cultTxn->type = '2';  
                    $cultTxn->save();
                
                    echo '1';
                } else {
                   echo '2';
                }
                
            }
            exit;
            
        } catch(Exception $e){
            echo '2';
            exit;
        }
            
    }
    /**
     * @input form
     * @param Request $request
     */
    
    public function submitContactUs(Request $request){
        
         $culthst = new ContactUs();
                $culthst->name	 = $request->name;
                $culthst->email =  $request->email;
                $culthst->phone_number	 = $request->phone_number;
                $culthst->message =  $request->message;
                $culthst->save();
                //fire mail to support
                 $to = $request->email;
                   $to_name = $request->name;
                $data = array('user'=>$culthst->name);
                 $to_email = $request->email;
            $subject = 'WelCome In DHD';
            $message = "Dear ".$request->name.", \n. Thanking you for contact us we will contact you shortly!";
            $headers = 'From:$request->email';        
           
            
            Mail::send('emails.user_contact_mail', $data, function($message) use ($to_name, $to_email){
                    $message->to($to_email, $to_name)
                    ->subject('Submiting Contact-Us In DHD');
                    $message->from('info@drhelpdesk.in','Drhelpdesk');
                });
   
 
        return back()->with('msg', 'Thanks for Contact us , We will contact you Soon.');
    }
    
    /**
     * @view page for brand
     */
    public function brands(){
         $data['flag'] = 10; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    /**
     * 
     * @param Request $request
     * @return type
     */
    public function submitNewslatter(Request $request){
        $n = new Newslatters();
                $n->newslatter_email =  $request->get('newslatter_email');
                $n->save();
                return 1;
    }
    
    public function deliveryInfo(){
         $data['flag'] = 11; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    
     public function storeLocation(){
         $data['flag'] = 12; 
        return view('UI/webviews.user.manage_pages',$data); 
    }
    /*
     * get Invoice
     */
    public function userInvoice($order_id){
        $userDetail = Auth::user();
         $orderDetails = DB::table('orders')->where('user_id', $userDetail->id)->where('order_id', $order_id)->first();
         $orders = OrderItem::where('order_id',$order_id)->get(); 
       $orderStatus = DB::table('order_status')->get(); 
        
         return view ('UI/webviews.user_invoice')
                ->with('userDetail',$userDetail)
                ->with('orderDetails',$orderDetails)
                ->with('order',$orders)
                ->with('orderStatus',$orderStatus);
    }
}