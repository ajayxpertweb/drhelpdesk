<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use App\ProductImage;
use App\Product;
use App\Cart;
use App\DoctorAppointment;
use App\User;
use App\Vendor;
use App\Prescription;
use App\Package;
use App\DeWallet;
use App\VendorStatus;
use App\OrderStatusHistory;
use DB;
use App\OrderCouponHistory;
use App\Coupon;
use App\ShippingCharge;
use App\OrderAssignHistory;
use App\Wishlist;
use App\DeliveryTracking;
class BookingController extends Controller
{
    public function addAddress(Request $req){
        $reg = new UserAddress;
        $reg->user_id = $req->user_id;
        $reg->name = $req->name;
        $reg->phone = $req->phone;
        $reg->email = $req->email;
        //$reg->alternate_no = $req->alternate_no;
        $reg->address_type = $req->address_type;
        $reg->address = $req->address;
        $reg->apartment = $req->apartment;
        $reg->city = $req->city;
        $reg->state = $req->state;
        $reg->pin_code = $req->pin_code;
        $reg->country = $req->country;
        $reg->save();
        if ($reg) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Address Add Successfully',
                'Address'=>UserAddress::where('id',$reg->id)->select('*')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function userAddresses(Request $req){
        $result=UserAddress::where('user_id',$req->user_id)->get();
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Addresses',
                'Address'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function placeOrderSingle(Request $req){ 

        $shipping = 0;
        $count = 0;
        $sub_total = 0;

        $order_id = "DHD".$req->user_id.time();
        $sub_order_id = "DHD".$req->user_id.$count.time(); 
        $address = DB::table('user_addresses')->where('id',$req->address_id)->first();  
        $product=Product::where('products_id',$req->product_id)->first();
      
        if($req->quick_delivery==1){
            $p_cat=Product::where('products_id',$req->product_id)->pluck('categories')->first(); 
            $match = Vendor::where('main_category', $p_cat)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();  
            //shipping charge 
             
            $reg = new Order;
            $reg->user_id = $req->user_id; 
            $reg->order_id = $order_id; 
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;  
            $reg->total_discount = $req->total_discount;  
            $reg->order_status = 1;  
            $reg->quick_delivery = $req->quick_delivery; 
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price;  
            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code; 
            }
            $reg->prescription_id = $req->prescription_id; 
            $reg->payment_mode = $req->payment_mode; 
            $reg->payment_id = $req->payment_id; 
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;  
            $reg->user_name = $address->name;  
            $reg->user_phone  = $address->phone;   
            $reg->user_email  = $address->email;   
            $reg->user_address = $address->address; 
            $reg->user_apartment = $address->apartment; 
            $reg->user_country  = $address->country;  
            $reg->user_state  = $address->state; 
            $reg->user_city = $address->city;  
            $reg->pin_code  = $address->pin_code; 
            $reg->save();    //order item table 
            
            
            $reg1 = new OrderItem;
            $reg1->order_id = $reg->order_id;
            $reg1->sub_order_id = $sub_order_id;
            $reg1->order_status = 1;  
            $special_price=Product::where('products_id',$req->product_id)->pluck('special_price')->first();
            $price=Product::where('products_id',$req->product_id)->pluck('price')->first();
            if($special_price != null){
                $reg1->sub_total=$special_price; 
            }else{
                $reg1->sub_total=$price;  
            }
            $reg1->prod_name=Product::where('products_id',$req->product_id)->pluck('product_name')->first(); 
            $reg1->product_image=ProductImage::where('products_id',$req->product_id)->pluck('product_image')->first();  
            $reg1->prod_id = $req->product_id;
            $reg1->quantity =$req->quantity;
            $reg1->extra_discount =Product::where('products_id',$req->product_id)->pluck('extra_discount')->first();
            $reg1->assign_vendor_id = $match; 
            $reg1->quick_delivery = 1; 
            $reg1->type= 1; 
            $reg1->save();

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id; 
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
                $total = $coin - $req->de_wallet_coin; 
                DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]); 
            } 
            
            $order_assign = new OrderAssignHistory;
            $order_assign->order_id = $reg->order_id; 
            $order_assign->sub_order_id = $reg1->sub_order_id;
            $order_assign->assign_vendor_id = $reg1->assign_vendor_id; 
            $order_assign->save();

            $order_status = new OrderStatusHistory;
            $order_status->order_id = $reg->order_id; 
            $order_status->sub_order_id = $reg1->sub_order_id;
            $order_status->order_status = 1; 
            $order_status->save(); 

        }
        elseif($req->quick_delivery==2){  
            $reg = new Order;
            $reg->user_id = $req->user_id; 
            $reg->order_id = $order_id; 
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;  
            $reg->total_discount = $req->total_discount;  
            $reg->order_status = 1;  
            $reg->quick_delivery = $req->quick_delivery; 
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price;  
            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code; 
            }
            $reg->prescription_id = $req->prescription_id; 
            $reg->payment_mode = $req->payment_mode; 
            $reg->payment_id = $req->payment_id; 
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;  
            $reg->user_name = $address->name;  
            $reg->user_phone  = $address->phone;   
            $reg->user_email  = $address->email;   
            $reg->user_address = $address->address; 
            $reg->user_apartment = $address->apartment; 
            $reg->user_country  = $address->country;  
            $reg->user_state  = $address->state; 
            $reg->user_city = $address->city;  
            $reg->pin_code  = $address->pin_code; 
            $reg->save();    //order item table 

            $reg1 = new OrderItem;
            $reg1->order_id = $reg->order_id;
            $reg1->sub_order_id = $sub_order_id;
            $reg1->order_status = 1;  
            $special_price=Product::where('products_id',$req->product_id)->pluck('special_price')->first();
            $price=Product::where('products_id',$req->product_id)->pluck('price')->first();
            if($special_price != null){
                $reg1->sub_total=$special_price; 
            }else{
                $reg1->sub_total=$price;  
            }
            $reg1->prod_name=Product::where('products_id',$req->product_id)->pluck('product_name')->first(); 
            $reg1->product_image=ProductImage::where('products_id',$req->product_id)->pluck('product_image')->first(); 
            $reg1->prod_id = $req->product_id;
            $reg1->quantity =$req->quantity;
            $reg1->extra_discount =Product::where('products_id',$req->product_id)->pluck('extra_discount')->first(); 
            $reg1->quick_delivery = 2; 
            $reg1->type= 1; 
            $reg1->save(); 
            
            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id; 
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
                $total = $coin - $req->de_wallet_coin; 
                DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]); 
            } 
            
            $curl1 = curl_init(); 
            curl_setopt_array($curl1, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
              ),
            ));
            
            $response1 = curl_exec($curl1);
            
            curl_close($curl1);
            $data1 = json_decode($response1);  
            $curl = curl_init();
            $token =   $data1->token; 
            //dd($token);
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n  \"order_id\": \"$reg->order_id\",\n  \"order_date\": \"2019-07-24 11:11\",\n  \"pickup_location\": \"aensa\",\n  \"channel_id\": \"custom\",\n  \"comment\": \"Reseller: M/s Goku\",\n  \"billing_customer_name\": \"$address->name\",\n  \"billing_last_name\": \"$address->name\",\n  \"billing_address\": \" $address->name\",\n  \"billing_address_2\": \"$address->name\",\n  \"billing_city\": \"$address->city\",\n  \"billing_pincode\": \"$address->pin_code\",\n  \"billing_state\": \"$address->state\",\n  \"billing_country\": \"India\",\n  \"billing_email\": \"$address->email\",\n  \"billing_phone\": \"9315626818\",\n  \"shipping_is_billing\": true,\n  \"shipping_customer_name\": \"\",\n  \"shipping_last_name\": \"\",\n  \"shipping_address\": \"\",\n  \"shipping_address_2\": \"\",\n  \"shipping_city\": \"\",\n  \"shipping_pincode\": \"\",\n  \"shipping_country\": \"\",\n  \"shipping_state\": \"\",\n  \"shipping_email\": \"\",\n  \"shipping_phone\": \"\",\n  \"order_items\": [\n    {\n      \"name\": \" $reg1->prod_name\",\n      \"sku\": \"chakra123\",\n      \"units\": 10,\n      \"selling_price\": \" $reg1->sub_total\",\n      \"discount\": \"\",\n      \"tax\": \"\",\n      \"hsn\": 441122\n    }\n  ],\n  \"payment_method\": \"Prepaid\",\n  \"shipping_charges\": $req->shipping_charge,\n  \"giftwrap_charges\": 0,\n  \"transaction_charges\": 0,\n  \"total_discount\": 0,\n  \"sub_total\": $sub_total,\n  \"length\": 10,\n  \"breadth\": 15,\n  \"height\": 20,\n  \"weight\": 2.5\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $token"
                ),
            ));

            $response = curl_exec($curl); 
            curl_close($curl);
            $data = json_decode($response); 
            $Shiprocket_Order_Id     =   $data->order_id; 
            $Shiprocket_Shipment_Id      =   $data->shipment_id; 
            DB::table('order_items')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>$Shiprocket_Order_Id ,
                'Shiprocket_Shipment_Id'=>$Shiprocket_Shipment_Id
            ]); 
            DB::table('orders')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>$Shiprocket_Order_Id ,
                'Shiprocket_Shipment_Id'=>$Shiprocket_Shipment_Id
            ]); 
        }  
        if ($reg && $reg1) { 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Order Place Successfully',
                'user'=>Order::where('id',$reg->id)->select('id','user_id','order_id')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }  
    public function placeOrderCart(Request $req){   
        if($req->quick_delivery==1){ 
            $data=Cart::where('user_id',$req->user_id)->get();   
            $address = DB::table('user_addresses')->where('id',$req->address_id)->first();   
            $order_id = "DHD".$req->user_id.time();
            
            $total_amount1=0;  
            $sub_total= 0;
            $extra_discount = 0;
            $balance=0;
            $total_amount_with_shipping = 0;  
            
             
            $reg = new Order;
            $reg->user_id = $req->user_id; 
            $reg->order_id = $order_id; 
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;  
            $reg->total_discount = $req->total_discount;  
            $reg->order_status = 1;  
            $reg->quick_delivery = $req->quick_delivery; 
             
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price; 
         
            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code; 
            }
            
            $reg->prescription_id = $req->prescription_id; 
            $reg->payment_mode = $req->payment_mode; 
            $reg->payment_id = $req->payment_id; 
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;  
            $reg->user_name = $address->name;  
            $reg->user_phone  = $address->phone;   
            $reg->user_email  = $address->email;   
            $reg->user_address = $address->address; 
            $reg->user_apartment = $address->apartment; 
            $reg->user_country  = $address->country;  
            $reg->user_state  = $address->state; 
            $reg->user_city = $address->city;  
            $reg->pin_code  = $address->pin_code; 
            $reg->save();    //order item table 
            //dd($reg);
            $count=0; 
            
            foreach ($data as $r) {  
                $sub_order_id = "DHD".$req->user_id.$count.time();  
                $reg1 = new OrderItem;
                $reg1->order_id = $reg->order_id; 
                $reg1->sub_order_id = $sub_order_id; 
                if($r->type == 1 || $r->type == 2){
                    $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
                    $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();  
                    $reg1->assign_vendor_id = $match;  
                    $reg1->quick_delivery = $req->quick_delivery; 
                    $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();  
                    $reg1->product_image=ProductImage::where('products_id',$r->product_id)->pluck('product_image')->first();
                    $reg1->prod_id = $r->product_id;  
                    $reg1->quantity =$r->quantity; 
                    $reg1->type =$r->type; 
                    $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
                    $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
                    if($special_price != null){
                        $reg1->sub_total = $special_price; 
                    }else{
                        $reg1->sub_total = $price;  
                    }
                    $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();  
                    $reg1->order_status = 1;  
                }elseif($r->type == 3){
                    $categories = 15;
                    $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();  
                    $reg1->assign_vendor_id = $match;
                    $reg1->quick_delivery = $req->quick_delivery; 
                    $reg1->prod_name=Package::where('id',$r->product_id)->pluck('package_name')->first();
                    $reg1->product_image=Package::where('id',$r->product_id)->pluck('image')->first();
                    $reg1->prod_id = $r->product_id;  
                    $reg1->quantity =$r->quantity; 
                    $reg1->type =$r->type; 
                    $price=Package::where('id',$r->product_id)->pluck('package_cost')->first(); 
                    $discount = ($r->offer_discount * $price) / 100;
                    $discount1 =  $price - $discount;  
                    $special_price = $discount1; 
                    if($special_price != null){
                        $reg1->sub_total=$special_price; 
                    }else{
                        $reg1->sub_total=$price;  
                    }
                    $reg1->extra_discount=Package::where('id',$r->product_id)->pluck('offer_discount')->first();  
                    $reg1->order_status = 1;  
                }
                $sub_order[] = $reg1->sub_order_id;
                $vendor[] = $reg1->assign_vendor_id;
                $count++;
                $reg1->save();

                $order_assign = new OrderAssignHistory;
                $order_assign->order_id = $reg->order_id; 
                $order_assign->sub_order_id = $reg1->sub_order_id;
                $order_assign->assign_vendor_id = $reg1->assign_vendor_id;
                $order_assign->save();
        
                $order_status = new OrderStatusHistory;
                $order_status->order_id = $reg->order_id; 
                $order_status->sub_order_id = $reg1->sub_order_id;
                $order_status->order_status = 1; 
                $order_status->save();  
            } 

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id; 
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
                $total = $coin - $req->de_wallet_coin;  
                
                DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
                
            } 
        }
        elseif($req->quick_delivery==2){ 

            $data=Cart::where('user_id',$req->user_id)->get();   
            $address = DB::table('user_addresses')->where('id',$req->address_id)->first();   
            $order_id = "DHD".$req->user_id.time();
            
            $total_amount1=0;  
            $sub_total= 0;
            $extra_discount = 0;
            $balance=0;
            $total_amount_with_shipping = 0;  

            $reg = new Order;
            $reg->user_id = $req->user_id; 
            $reg->order_id = $order_id; 
            $reg->address_id = $req->address_id;
            $reg->amount = $req->net_amount;  
            $reg->total_discount = $req->total_discount;  
            $reg->order_status = 1;  
            $reg->quick_delivery = $req->quick_delivery; 
            $reg->de_wallet_coin = $req->de_wallet_coin;
            $reg->de_wallet_price = $req->de_wallet_price; 
         
            if($req->copoun_code != null){
                $reg->copoun_code = $req->copoun_code; 
            }
            $reg->prescription_id = $req->prescription_id; 
            $reg->payment_mode = $req->payment_mode; 
            $reg->payment_id = $req->payment_id; 
            $reg->payment_status = $req->payment_status;
            $reg->payment_req_id = $req->payment_req_id;
            $reg->shipping_charge = $req->shipping_charge;  
            $reg->user_name = $address->name;  
            $reg->user_phone  = $address->phone;   
            $reg->user_email  = $address->email;   
            $reg->user_address = $address->address; 
            $reg->user_apartment = $address->apartment; 
            $reg->user_country  = $address->country;  
            $reg->user_state  = $address->state; 
            $reg->user_city = $address->city;  
            $reg->pin_code  = $address->pin_code; 
            $reg->save();    //order item table  
             
            $prod_name = [];
            $sub = [];
            $count=0; 

            foreach ($data as $r) {  
                $sub_order_id = "DHD".$req->user_id.$count.time();
                $reg1 = new OrderItem;
                $reg1->order_id = $reg->order_id; 
                $reg1->sub_order_id = $sub_order_id;
                $reg1->type=$r->type;
                $categories = Product::where('products_id', $r->product_id)->pluck('categories')->first();
                $match = Vendor::where('main_category', $categories)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first(); 
                $reg1->assign_vendor_id = $match; 
                $reg1->prod_name=Product::where('products_id',$r->product_id)->pluck('product_name')->first();  
                $reg1->product_image=ProductImage::where('products_id',$r->product_id)->pluck('product_image')->first();
                $reg1->prod_id = $r->product_id;  
                $reg1->quantity =$r->quantity; 
                $special_price=Product::where('products_id',$r->product_id)->pluck('special_price')->first();
                $price=Product::where('products_id',$r->product_id)->pluck('price')->first();
                if($special_price != null){
                    $reg1->sub_total=$special_price; 
                }else{
                    $reg1->sub_total=$price;  
                }
                $reg1->quick_delivery = $req->quick_delivery;
                $reg1->extra_discount=Product::where('products_id',$r->product_id)->pluck('extra_discount')->first();  
                $reg1->order_status = 1;  
                //dd($reg1);
                $prod_name[] = $reg1->prod_name;
                $sub[] = $reg1->sub_total;
                $count++;
                $reg1->save(); 
            } 

            if($req->copoun_code != null){
                $coupon=Coupon::where('copoun_code',$req->copoun_code)->first();
                if($coupon != null){
                    $data=new OrderCouponHistory();
                    $data->user_id = $req->user_id;
                    $data->order_id = $reg->order_id; 
                    $data->coupon_code =$req->copoun_code;
                    $data->coupon_price =$coupon->amount;
                    $data->coupon_type = $coupon->type;
                    $data->save();
                }
            }

            if($req->de_wallet_coin >=  0){
                $coin=DeWallet::where('user_id',$req->user_id)->pluck('coin')->first();
                $total = $coin - $req->de_wallet_coin;  
                 
                DeWallet::where('user_id',$req->user_id)->update(['coin'=>$total]);
                
            } 

            $p = implode("", $prod_name);
            $s  = implode("", $sub);
            $curl1 = curl_init(); 
            curl_setopt_array($curl1, array(
                CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS =>"{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json"
                ),
            )); 
            $response1 = curl_exec($curl1); 
            curl_close($curl1); 
            $data1 = json_decode($response1);   
            $curl = curl_init();
            $token =   $data1->token;   
            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/create/adhoc",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n  \"order_id\": \"$reg->order_id\",\n  \"order_date\": \"2019-07-24 11:11\",\n  \"pickup_location\": \"aensa\",\n  \"channel_id\": \"custom\",\n  \"comment\": \"Reseller: M/s Goku\",\n  \"billing_customer_name\": \"$address->name\",\n  \"billing_last_name\": \"$address->name\",\n  \"billing_address\": \" $address->name\",\n  \"billing_address_2\": \"$address->name\",\n  \"billing_city\": \"$address->city\",\n  \"billing_pincode\": \"$address->pin_code\",\n  \"billing_state\": \"$address->state\",\n  \"billing_country\": \"India\",\n  \"billing_email\": \"$address->email\",\n  \"billing_phone\": \"9315626818\",\n  \"shipping_is_billing\": true,\n  \"shipping_customer_name\": \"\",\n  \"shipping_last_name\": \"\",\n  \"shipping_address\": \"\",\n  \"shipping_address_2\": \"\",\n  \"shipping_city\": \"\",\n  \"shipping_pincode\": \"\",\n  \"shipping_country\": \"\",\n  \"shipping_state\": \"\",\n  \"shipping_email\": \"\",\n  \"shipping_phone\": \"\",\n  \"order_items\": [\n    {\n      \"name\": \" $p\",\n      \"sku\": \"chakra123\",\n      \"units\": 10,\n      \"selling_price\": \" $s\",\n      \"discount\": \"\",\n      \"tax\": \"\",\n      \"hsn\": 441122\n    }\n  ],\n  \"payment_method\": \"Prepaid\",\n  \"shipping_charges\": $req->shipping_charge,\n  \"giftwrap_charges\": 0,\n  \"transaction_charges\": 0,\n  \"total_discount\": 0,\n  \"sub_total\": $sub_total,\n  \"length\": 10,\n  \"breadth\": 15,\n  \"height\": 20,\n  \"weight\": 2.5\n}",
                CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $token"
                ),
            ));

            $response = curl_exec($curl); 
            curl_close($curl); 
            $data = json_decode($response);  
            $Shiprocket_Order_Id     =   $data->order_id ;  
            $Shiprocket_Shipment_Id      =   $data->shipment_id ;

            DB::table('order_items')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>$Shiprocket_Order_Id ,
                'Shiprocket_Shipment_Id'=>$Shiprocket_Shipment_Id
            ]);  
            DB::table('orders')->where('order_id',$reg->order_id)->update([
                'Shiprocket_Order_Id'=>$Shiprocket_Order_Id ,
                'Shiprocket_Shipment_Id'=>$Shiprocket_Shipment_Id
            ]); 
        }
        Cart::where('user_id',$req->user_id)->delete(); 
        if ($reg != null) { 
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Order Place Successfully',
                'user'=>Order::where('id',$reg->id)->select('id','user_id','order_id')->first()
            ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
            ]);
        }
    }  
    public function cartUpdate(Request $req){ 
        $r=Cart::where('id',$req->cart_id)->update([
            'quantity'=>$req->quantity
        ]);
        if ($r) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Cart Quantity Update',
                'cart_item'=>Cart::where('id',$req->cart_id)->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    } 
    public function removeProduct(Request $req){   
        $r=Cart::where('id',$req->cart_id)->delete();
        if ($r) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Product Remove From Cart'
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }  
    public function orderDetails(Request $req){
        $data=OrderItem::where('sub_order_id',$req->order_id)->first();
        //dd($data);
        $address_id=Order::where('order_id',$data->order_id)->pluck('address_id')->first();
        $category1= Order::where('order_id',$data->order_id)->first(); 
        if($category1 !=  null){
            $extra_discount = ($data->sub_total * $data->quantity *  $data->extra_discount)/100; 
            $sub_total = $data->sub_total * $data->quantity;
            $data->total = round($sub_total-$extra_discount);  
            $t = OrderItem::where('order_id',$data->order_id)->where('type',1)->count(); 
            if($t > 0 ){
                if($category1->shipping_charge != null){
                    $ship = $category1->shipping_charge/$t; 
                }else{
                    $ship = 0;
                }
                if($category1->de_wallet_coin != null){
                    $coin = ($category1->de_wallet_coin * 0.25)/$t;
                }else{
                    $coin = 0;
                }
                $data->complete_total =  round($data->total + $ship + $coin);
            } 
        }else{
            $extra_discount = ($data->sub_total * $data->quantity *  $data->extra_discount)/100; 
            //dd($extra_discount);
            $sub_total = $data->sub_total * $data->quantity;
            $data->total = round($sub_total-$extra_discount);  
            //dd($total);
        } 
        $details=Order::where('order_id',$data->order_id)->first();
        if($details->de_wallet_coin != null){
            $dewllet_ruppee = $details->de_wallet_coin * 0.25; 
        }else{
            $dewllet_ruppee = 0;
        }
        $coupen=OrderCouponHistory::where('order_id',$data->order_id)->first();
        $address=UserAddress::where('id',$address_id)->first();
        if (!empty($data)) {
            return response()->json($data=[
                'status'=>200,
                'msg'=>'success',
                 'address'=>$address,
                'details'=>$details,
                'coupen'=>$coupen,
                'result'=>$data,
                'dewallet'=>$dewllet_ruppee
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    } 
    public function myOrder(Request $req){
        $order=Order::Join('order_items','orders.order_id','order_items.order_id')->where('type', 1)->where('user_id',$req->user_id)->select('orders.*')->orderBy('orders.id','desc')->get(); 
        // $result=[];
        // foreach($data as $r) {
        //     $users=OrderItem::where('order_id',$r)->where('type',1)->select('order_id','sub_order_id','Shiprocket_Order_Id','Shiprocket_Shipment_Id','prod_name','prod_id','sub_total','quantity','order_status','product_image','type','quick_delivery')->get();
        //         //dd($users);
        //         $result[]=$users;
        // }
        // $hk=[];
        // foreach ($result as $r) {
        //     foreach ($r as $key => $value) {
        //     $hk=$value;
        //     }
        // }
        //dd($hk);
        if ($order!=null) {
           return response()->json($data=[
               'status'=>200,
               'msg'=>count($order).' order found',
               'result'=>($order)
           ]);
        }
        else{
           return response()->json($data=[
               'status'=>404,
               'msg'=>'No order Found'
           ]);
       }
    } 
    public function myBooking(Request $req){
        $order=Order::Join('order_items','orders.order_id','order_items.order_id')->where('type','!=' , 1)->where('user_id',$req->user_id)->select('orders.*')->orderBy('orders.id','desc')->get(); 
        //dd($data);
        //  $result=[];
        //  foreach($data as $r) {
        //      $users=OrderItem::where('order_id',$r)->where('type',' !=', null)->where('type',' !=', 1)->orwhere('type',2)->orwhere('type',3)->select('order_id','sub_order_id','Shiprocket_Order_Id','Shiprocket_Shipment_Id','prod_name','prod_id','sub_total','quantity','order_status','product_image','type','quick_delivery')->get();
        //     $result[]=$users;
        // }
        //  $hk=[];
        //  foreach ($result as $r) {
        //      foreach ($r as $key => $value) {
        //      $hk[]=$value;
        //      }
        //  }
        //dd($hk);
        if ($order!=null) {
           return response()->json($data=[
               'status'=>200,
               'msg'=>count($order).' Booking found',
               'result'=>($order)
           ]);
        }
        else{
           return response()->json($data=[
               'status'=>404,
               'msg'=>'No Booking Found'
           ]);
       }
    } 
    public function subOrderDetails(Request $req){
        $data=OrderItem::where('order_id',$req->order_id)->Where('type',1)->orderBy('id','desc')->get(); 
        //dd($data);
        // $address_id=Order::where('order_id',$req->order_id)->pluck('address_id')->first();
        $details=Order::where('order_id',$req->order_id)->first();
        if($details->de_wallet_coin != null){
            $dewllet_ruppee = $details->de_wallet_coin * 0.25; 
        }else{
            $dewllet_ruppee = 0;
        }
        $coupen=OrderCouponHistory::where('order_id',$req->order_id)->first();
        // $address=UserAddress::where('id',$address_id)->first();
        if (!empty($data)) {
            return response()->json($data=[
                'status'=>200,
                'msg'=>'success',
                // 'address'=>$address,
                'details'=>$details,
                'coupen'=>$coupen,
                'result'=>$data,
                'dewallet'=>$dewllet_ruppee
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    } 
    public function subBookingDetails(Request $req){
        $data=OrderItem::where('order_id',$req->order_id)->where('type','!=',1)->orderBy('id','desc')->get(); 
        //dd($data);
        // $address_id=Order::where('order_id',$req->order_id)->pluck('address_id')->first();
        $details=Order::where('order_id',$req->order_id)->first();
        if($details->de_wallet_coin != null){
            $dewllet_ruppee = $details->de_wallet_coin * 0.25; 
        }else{
            $dewllet_ruppee = 0;
        }
        $coupen=OrderCouponHistory::where('order_id',$req->order_id)->first();
        // $address=UserAddress::where('id',$address_id)->first();
        if (!empty($data)) {
            return response()->json($data=[
                'status'=>200,
                'msg'=>'success',
                // 'address'=>$address,
                'details'=>$details,
                'coupon'=>$coupen,
                'result'=>$data,
                'dewallet'=>$dewllet_ruppee
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'booking not found'
            ]);
        }
    }
    public function cancleOrder(Request $req){
        //dd($req->order_id);

        $data=OrderItem::where('sub_order_id',$req->order_id)->first();
        $amount=Order::where('order_id',$data->order_id)->pluck('amount')->first();
        $r=OrderItem::where('sub_order_id',$req->order_id)->update([
            'order_status'=>5
        ]);
        if($r!=null){
            Order::where('order_id',$data->order_id)->update([
                'amount'=>$amount-$data->sub_total
            ]);
            $data1=OrderItem::where('sub_order_id',$req->order_id)->first();
            return response()->json($data=[
                'status'=>200,
                'msg'=>'order cancle successfully',
                'result'=>$data1
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    }
    public function doctorAppointment(Request $req){
        //$appointment_id = "DHDDoc".$req->user_id.time();
        $reg = new DoctorAppointment;
        $reg->user_id = $req->user_id;
        //$reg->order_id = $order_id;
        $reg->doctor_id = $req->doctor_id;
        $reg->appointment_date = $req->appointment_date;
        $reg->description = $req->description;
        $reg->status = 0; //0 for recieve and 1 for confirm
        // $reg->payment_id = $req->payment_id;
        // $reg->payment_mode = $req->age_of_pet;
        // $reg->payment_status = $req->payment_status;
        // $reg->payment_req_id = $req->payment_req_id;
        $reg->save();
        //email send to doctor 
        // $docor=user::where('id',$req->doctor_id)->first();
        // $user=user::where('id',$req->user_id)->first();

        //     $to = $doctor->email;
        //     $subject = 'New Appointment Enquery';
        //     $message = "You have new appointment from which name is- ".$user->name." and Email and Phone No are ".$user->email." , ".$user->phone." and which have the following problem ".$reg->description."";
        //     $headers = 'From: noreply@tklpvtltd.com';        
        //     if(mail($to, $subject, $message, $headers)) {
               
        //     } else {
                
        //     }

        if ($reg) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Appointment Fixed',
                'user'=>DoctorAppointment::where('id',$reg->id)->select('id','user_id','doctor_id')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function uploadPrescription(Request $req){
        if($req->hasFile('image')) {
            $file = $req->file('image');
            $filename = 'prescription'.time().'.'.$req->image->extension();
            $destinationPath = storage_path('../public/upload/prescription');
            $file->move($destinationPath, $filename);
            $prescription = 'upload/prescription/'.$filename;
        }
        $reg = new Prescription;
        $reg->user_id = $req->user_id;
        $reg->prescription_image = $prescription;
        $reg->comment = $req->comment;
        $reg->save();
        
        $user = User::where('id',$req->user_id)->first();
        $msg=urlencode("Your refer code is ".$prescription." Thank you for registering with DrHelpDesk.Enjoy Online Shopping.Stay Home !!!  Stay safe !!!");
        $curl = curl_init("http://nimbusit.co.in/api/swsendSingle.asp?username=t1drhelpdesk&password=28307130&sender=DRHELP&sendto=".$user->phone."&message=".$msg);
        curl_setopt ($curl,CURLOPT_RETURNTRANSFER,true);
        $response=curl_exec($curl);
        curl_close($curl);
        
        if ($reg) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'prescription upload Successfully',
                'result'=>Prescription::where('id',$reg->id)->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    }
    public function userPrescription(Request $req){
        $result=Prescription::where('user_id',$req->user_id)->get();
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Prescription',
                'prescription'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function userPrescriptionDelete(Request $req){
        $result=Prescription::where('id',$req->id)->delete();
        if ($result != null)  {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'User Prescription Delete Successfully' 
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function vendorList(Request $req){
        $result=Vendor::where('main_category',$req->category_id)->get();
        $affordable=Package::where('type',1)->get();
        if ($result->count()>0 || $affordable->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Lab Test Vendor',
                'affordable_package'=>$affordable,
                'certified_lab'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function HealthPackage(Request $req){
        $result=Package::orderBy('id','desc')->get();
        foreach($result as $r){
            if($r->offer_discount != null){ 
                $discount = ($r->offer_discount * $r->package_cost) / 100;
                $r->offer_price = round($r->package_cost - $discount);
            }
        }
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Health Packages',
                'packages'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function myCartCount(Request $req){
        $data=Cart::where('user_id',$req->user_id)->count();  
        if ($data > 0) {
           return response()->json($data=[
               'status'=>200,
               'msg'=>$data. '  Item Found In Cart',
               'count'=>$data
           ]);
       }
       else{
           return response()->json($data=[
               'status'=>404,
               'msg'=>'No Item Found In Cart'
           ]);
       }
    }
    public function vendorOrderList(Request $req){
        $result=OrderItem::where('assign_vendor_id',$req->vendor_id)->orderby('id','desc')->get();
            foreach($result as $r){
                $category1= VendorStatus::where('sub_order_id',$r->sub_order_id)
                ->first();
                //dd($catalogue2);
                if($category1 != null){
                    $r->is_accept = 1; 
                }else{
                    $r->is_accept = 0; 
                }
            } 
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Vendor Order',
                'order'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    }
    public function vendorOrderAccept(Request $req){
        if (VendorStatus::where(['sub_order_id'=>$req->sub_order_id,'vendor_id'=>$req->vendor_id])->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Already Save Status'
             ]);
        }
        else {
            if($req->type==2){
                //assign order to another vendor
                $p_cat=Product::where('products_id',$req->product_id)->pluck('categories')->first();
                  $match = Vendor::where('main_category', $p_cat)->where('user_id','!=',$req->vendor_id)->orderBy('assign_priority','asc')->limit(1)->pluck('user_id')->first();
                  //update status on the order item 
                 $r= OrderItem::where('sub_order_id',$req->sub_order_id)->update(['assign_vendor_id'=>$match]);
                 //insert the code for order assign history table
                if($r){//here history assign order save at time of order place time assign vendor code time.
                       $vendor = new OrderAssignHistory;
                        $vendor->order_id = $req->order_id;
                        $vendor->sub_order_id = $req->sub_order_id;
                        $vendor->assign_vendor_id = $match;
                        $vendor->save();
                        
                        $reg=new VendorStatus();
                        $reg->vendor_id=$req->vendor_id;
                        $reg->order_id=$req->order_id;
                        $reg->sub_order_id=$req->sub_order_id;
                        $reg->is_accept=$req->type;
                        $reg->save();
                        //status change
                        return response()->json($data = [
                            'status' => 200,
                            'msg' => 'Status Changes'
                         ]);
                 }
            }
            else{
                //assign delivery boy to the orders;
                 $vendor=Vendor::where('user_id',$req->vendor_id)->first();
                    //dd($vendor);
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
                    //dd($result);
                    $result1 = DB::table('delivery_boys')->where('id',$result[0]->id)->pluck('user_id')->first();
                    //dd($result1);
                    //delivery boy id update on the table
                    OrderItem::where('sub_order_id',$req->sub_order_id)->update(['assign_delivery_boy_id'=>$result1 
                    ]);
                
                $reg=new VendorStatus();
                $reg->vendor_id=$req->vendor_id;
                $reg->order_id=$req->order_id;
                $reg->sub_order_id=$req->sub_order_id;
                $reg->is_accept=$req->type;
                $reg->save();
                if($reg){
                    return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Status Changes'
                 ]);
                }
            }
        }
    }
    public function orderStatusUpdate(Request $req){   
        $total_sub_order = OrderItem::where('order_id',$req->order_id)->get();
        $r=OrderItem::where('sub_order_id',$req->sub_order_id)->update([
         'order_status'=>$req->order_status,
         'status_updated_by'=>$req->user_id
        ]); 

        $order = new OrderStatusHistory;
        $order->order_id = $req->order_id;
        $order->sub_order_id = $req->sub_order_id;
        $order->order_status = $req->order_status;
        $order->change_by = $req->user_id; 
        $order->save();
        
        $user_id = Order::where('order_id',$req->order_id)->first();
        if ($req->order_status == 6){ 
            DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
                'coin' => 0.50 * $total + $data1 
            ]);
        }
        if($r){
             return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Status Changes'
                 ]);
        }
        else{
             return response()->json($data = [
                    'status' => 201,
                    'msg' => 'Status Does Not Changes'
                 ]);
        }
    }
    public function DeliveryBoyOrderList(Request $req){
        // $result=OrderItem::where('assign_delivery_boy_id',$req->delivery_boy_id)->where('order_status','!=',5)->orderby('id','desc')->get();
        $result=OrderItem::where('assign_delivery_boy_id',$req->delivery_boy_id)->orderby('id','desc')->get();
            // foreach($result as $r){
            //     $category1= VendorStatus::where('sub_order_id',$r->sub_order_id)
            //     ->first();
            //     //dd($catalogue2);
            //     if($category1 != null){
            //         $r->is_accept = 1; 
            //     }else{
            //         $r->is_accept = 0; 
            //     }
            // } 
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Delivery Boy Orders',
                'order'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function userCancelOrder(Request $req){    
        $order_data =  DB::table('orders')->where('order_id',$req->order_id)->orwhere('Shiprocket_Order_Id',$req->ship_id)->first();
        //dd($order_data);
        if($req->quick_delivery == 1){
            DB::table('order_items')->where('order_id',$req->order_id)->update([
                'order_status'=> 5 
            ]);
            DB::table('orders')->where('order_id',$req->order_id)->update([
                'order_status'=> 5 
            ]);
            DB::table('order_status_histories')->where('order_id',$req->order_id)->update([
                'order_status'=> 5 
            ]);
        }elseif($req->quick_delivery == 2){
            $Shiprocket_Order_Id  =  $order_data->Shiprocket_Order_Id;
            $Shiprocket_Shipment_Id  =  $order_data->Shiprocket_Shipment_Id;
            
            $curl1 = curl_init();

            curl_setopt_array($curl1, array(
              CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/auth/login",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>"{\n    \"email\": \"anujkumarrathoor2020@gmail.com\",\n    \"password\": \"apraj143@\"\n}",
              CURLOPT_HTTPHEADER => array(
                "Content-Type: application/json"
              ),
            ));
            
            $response1 = curl_exec($curl1);
            
            curl_close($curl1);
            $data = json_decode($response1); 
            //  print_r( $data) ; die; 
            
            $curl = curl_init();
            $token =   $data->token; 
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://apiv2.shiprocket.in/v1/external/orders/cancel",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS =>"{\n  \"ids\": [$Shiprocket_Order_Id]\n}",
            CURLOPT_HTTPHEADER => array(
                    "Content-Type: application/json",
                    "Authorization: Bearer $token"
                ),
            )); 
            $response = curl_exec($curl); 
            curl_close($curl);
            echo $response;
            //dd($order_data);
            DB::table('order_items')->where('order_id',$req->order_id)->update([
                'order_status'=> 5 
            ]);
            DB::table('orders')->where('order_id',$req->order_id)->update([
                'order_status'=> 5 
            ]);
            DB::table('order_status_histories')->where('order_id',$req->order_id)->update([
                'order_status'=> 5 
            ]);
        } 
        
        if($order_data!=null){ 
            return response()->json($data=[
                'status'=>200,
                'msg'=>'This ' .  $req->order_id  . ' Order Cancelled Successfully'
            ]);
        }
        else{
            return response()->json($data=[
                'status'=>404,
                'msg'=>'order not found'
            ]);
        }
    } 
    public function userAddressDelete(Request $req){ 
        $result = UserAddress::where('id',$req->id)->delete();
        if ($result!=null) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Address Delete Successfully', 
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Address Not Found'
             ]);
        }
    }  
    public function editAddress(Request $req){   
        UserAddress::where('id',$req->id)->update([ 
            'user_id' => $req->user_id,
            'name' => $req->name,
            'phone' => $req->phone,
            'email' => $req->email, 
            'address_type' => $req->address_type,
            'address' => $req->address,
            'apartment' => $req->apartment,
            'city' => $req->city,
            'state' => $req->state,
            'pin_code' => $req->pin_code,
            'country' => $req->country 
        ]);
        if ($req->id) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Address Edit Successfully',
                'Address'=>UserAddress::where('id',$req->id)->select('id','user_id','name','email','phone','address_type','address','apartment','city','state','pin_code','country')->first()
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    } 
    public function removeProductFromWishlist(Request $req){   
        $r=Wishlist::where('id',$req->wishlist_id)->delete();
        if ($r) {
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Product Remove From Wishlist'
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
             ]);
        }
    } 
    public function allHealthPackage(Request $req){
        $result=DB::table('packages')->join('products', 'products.products_id', '=', 'packages.package')->select('packages.id','packages.package_name', 'products.product_name', 'packages.package_cost' ,'packages.offer_discount' ,'packages.status','packages.image' ,'packages.type')->get();
        if ($result->count()>0) {
            return response()->json($data = [
                'status' => 200,
                'msg' =>  $result->count(). ' Health Packages',
                'packages'=>$result
             ]);
        }
        else {
            return response()->json($data = [
                'status' => 404,
                'msg' => 'Data Not Found'
             ]);
        }
    } 
    public function packageDetailById(Request $req){
        $result=DB::table('packages')->where('id',$req->id)->select('packages.id','packages.package_name', 'packages.package_cost' ,'packages.offer_discount' ,'packages.status','packages.image' ,'packages.type','packages.package')->first();                  
        $package_id = explode(",", $result->package);  
        foreach ($package_id as  $value) {  
            $package = DB::table('products')->where('products_id', $value)->pluck('product_name')->first(); 
            //print_r($package);
            $total[] = $package;
        }
         $testing1= json_decode(json_encode($total),true);
        //dd($total);
        if ($result != null) {
            return response()->json($data = [
                 'status' => 200,
                 'msg' => 'Success',
                 'test'=>$result,
                 'testing_name'=>$testing1
              ]);
       }else {
           return response()->json($data = [
               'status' => 404,
               'msg' => 'Data Not Found'
            ]);
       }
    }
    
    public function updateDeliveryBoyLocation(Request $req){   
        if (DeliveryTracking::where('delivery_boy_id' , $req->delivery_boy_id)->count()>0) {
            DeliveryTracking::where('delivery_boy_id', $req->delivery_boy_id)->update([
                'latitude' => $req->latitude,
                'longitude' => $req->longitude
            ]);    
            return response()->json($data = [
                'status' => 200,
                'msg' => 'Location Update Successfully',
                'data' => DeliveryTracking::where('delivery_boy_id', $req->delivery_boy_id)->first()
            ]);
        }else{
            $reg = new DeliveryTracking;
            $reg->delivery_boy_id = $req->delivery_boy_id;
            $reg->latitude =  $req->latitude;
            $reg->longitude =  $req->longitude;
            $reg->save();
            if ($reg) {
                return response()->json($data = [
                   'status' => 200,
                    'msg' => 'Location Update Successfully',
                    'data' => DeliveryTracking::where('delivery_boy_id', $req->delivery_boy_id)->first()
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
    public function trackOrderRoute(Request $req){
        ini_set("allow_url_fopen", 1);
        if(OrderItem::where('sub_order_id' , $req->sub_order_id)->count()>0) {
            $delivery_boy = OrderItem::where('sub_order_id' , $req->sub_order_id)->first(); 
            if  (DeliveryTracking::where('delivery_boy_id', $delivery_boy->assign_delivery_boy_id)->count()>0){
                $location = DeliveryTracking::Join('delivery_boys','delivery_trackings.delivery_boy_id','delivery_boys.user_id')->where('delivery_boy_id', $delivery_boy->assign_delivery_boy_id)->select('delivery_trackings.*','delivery_boys.delivery_boy_name','delivery_boys.logo as image')->first();
                
                
                $pickup_latitude = "";
                $pickup_longitude = "";
                if(!empty($delivery_boy->assign_vendor_id)) {
                    $data = Vendor::where('user_id', $delivery_boy->assign_vendor_id)->first();
                    if(!empty($data->latitude)) {
                        $pickup_latitude = $data->latitude;
                        $pickup_longitude = $data->longitude;
                    }
                }
                $location['pickup_latitude'] = $pickup_latitude;
                $location['pickup_longitude'] = $pickup_longitude;
                
                $drop_latitude = "";
                $drop_longitude = "";
                $order_data = Order::where('order_id', $delivery_boy->order_id)->first();
                
                $address1 = $order_data->user_address.','.$order_data->user_city.','.$order_data->user_state;
                
                $geo1 = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($address1)."&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM"; 
                
                $curl = curl_init();
                
                curl_setopt_array($curl, array(
                CURLOPT_URL => $geo1,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "GET",
                CURLOPT_HTTPHEADER => array(
                ),
                ));
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                
                curl_close($curl);
                
                $geo = json_decode($response, true); // Convert the JSON to an array 
                if (isset($geo['status']) && ($geo['status'] == 'OK')) {
                    $drop_latitude = $geo['results'][0]['geometry']['location']['lat']; // Latitude
                    $drop_longitude = $geo['results'][0]['geometry']['location']['lng']; // Longitude
                }
                
                $location['drop_latitude'] = $drop_latitude;
                $location['drop_longitude'] = $drop_longitude;
                
                return response()->json($data = [
                    'status' => 200,
                    'msg' => 'Delivery Current Location',
                    'data' => $location 
                ]);
            }else{
                return response()->json($data = [
                    'status' => 400,
                    'msg' => 'Delivery Boy Location Not Found' 
                ]);
            }
            
        }else{ 
            return response()->json($data = [
                'status' => 201,
                'msg' => 'Something Went Wrong'
            ]); 
        }
    } 
}
