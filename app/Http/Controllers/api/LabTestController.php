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

class LabTestController extends Controller
{
	public function labTest(Request $req){
		$lab_test = Product::where('categories',$req->category_id)->orderBy('products_id','desc')->select('*')->get();
    	if($lab_test != null) {
    		return response()->json($data = [
    			'status' => 200,
    			'msg' => $lab_test->count().' record found',
    			'lab_test' => $lab_test 
    		]);
    	}else {
            return response()->json($data = [
                'status' => 400,
                'msg' => 'Data Not Found'
             ]);
        }
	}
}