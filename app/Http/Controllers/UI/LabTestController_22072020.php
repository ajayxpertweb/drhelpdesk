<?php

namespace App\Http\Controllers\UI; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Location; 
use App\Testimonial; 

use App\Package; 
use App\Vendor;
use App\Product; 
class LabTestController extends Controller{
        
   	Public function popularPackages(){
      $data['packages'] = Package::where('status',0)->orderBy('id','desc')->get();
   		$data['vendor'] = Vendor::orderBy('vendors_id','desc')->where('status',0)->get();
      $data['testimonial'] = Testimonial::where('status',0)->orderBy('testimonials_id','desc')->get();
    	return view('UI.webviews/lab_module/popular_package',$data);
  	}

   	Public function allTest(Request $req){ 
      $data['page'] = $req->all();
      $data['test'] = Product::Join('product_images','products.products_id','product_images.products_id')->where('products.categories',15)->where('product_images.type',2)->select('products.*','product_images.product_image')->orderBy('products_id','desc')->where('status',0)->paginate(10);
    	return view('UI.webviews/lab_module/all-tests',$data);
    }

    Public function testDetail(Request $req){ 
      $data['test'] = Product::where('products_id',$req->id)->first(); 
    	return view('UI.webviews/lab_module/test-detail',$data);
    }

    Public function allPackage(Request $req){ 
       $data['page'] = $req->all();
        $data['package'] = Package::orderBy('id','desc')->where('status',0)->paginate(10);
    	return view('UI.webviews/lab_module/all-package',$data);
    }

    Public function packageDetail(Request $req){
        $data['pck'] = Package::where('id',$req->id)->first();
        return view('UI.webviews/lab_module/package-detail', $data);
    }
}
