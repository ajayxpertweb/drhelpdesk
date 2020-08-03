<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Auth;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use DB;
use App\User;
use App\DeWallet;
use App\OrderAssignHistory;
use App\OrderStatusHistory;
class OrderController extends Controller
{ 

    Public function viewOrderDetail($order_id){
    	$data['flag'] = 2; 
    	$data['page_title'] = 'View Order Details'; 
        $data['order1'] = Order::where('order_id',$order_id)->first(); 
    	$data['order'] = OrderItem::where('order_id',$order_id)->orderBy('id','desc')->get(); 
    	$data['order_status'] = DB::table('order_status')->get(); 
    	return view('admin/webviews/admin_manage_order',$data);
    } 

    Public function viewOrder(){
        $data['flag'] = 1; 
        $data['page_title'] = 'View Order'; 
        $data['order'] = Order::orderBy('id','desc')->get(); 
        $data['order_status'] = DB::table('order_status')->get(); 
        return view('admin/webviews/admin_manage_order',$data);
    } 

    public function orderStatusUpdate(Request $req)
    {   
        $total_sub_order = OrderItem::where('order_id',$req->order_id)->get();
        OrderItem::where('sub_order_id',$req->sub_order_id)->update([
         'order_status'=>$req->order_status
        ]); 

        $order = new OrderStatusHistory;
        $order->order_id = $req->order_id;
        $order->sub_order_id = $req->sub_order_id;
        $order->order_status = $req->order_status;
        $order->change_by = Auth::user()->id; 
        $order->save();

        $user_id = DB::table('orders')->where('order_id',$req->order_id)->first();
        $vendor_id = DB::table('order_items')->where('sub_order_id',$req->sub_order_id)->first(); 

        $data = DB::table('de_wallets')->where('user_id',$user_id->user_id)->first(); 
        $data1 = $data->coin;
        if ($vendor_id->extra_discount != null) {
            $total = $vendor_id->quantity * $vendor_id->sub_total - ($vendor_id->quantity * $vendor_id->sub_total) / $vendor_id->extra_discount;
        }else{
             $total = $vendor_id->quantity * $vendor_id->sub_total - ($vendor_id->quantity * $vendor_id->sub_total) ;
        }
       
        //dd($total);
        if ($req->order_status == 6){ 
            DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
                'coin' => 0.50 * $total + $data1 
            ]);
        }
       

        
         
		// $user = User::where('id',$user_id->user_id)->first();
		// $to = $user['email'];
		// $subject = 'Order Status Change';
		// $message = "Dear ".$user->name.", \nYour OrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
		// $headers = 'From:info@dhd.in';        
		// if(mail($to, $subject, $message, $headers)) {
		//     echo 'Your Order Status is Send To your registered email Address';
		// } 
		// else {
		//     echo 'Sorry! something went wrong, please try again.';
		// }  

		// $user1 = User::where('user_type',1)->first();
		// $to = $user1['email'];
		// $subject = 'Order Status Change';
		// $message = "Dear ".$user1->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
		// $headers = 'From:info@dhd.in';              
		// if(mail($to, $subject, $message, $headers)) {
		//     echo 'Your Order Status is Send To your registered email Address';
		// } 
		// else {
		//     echo 'Sorry! something went wrong, please try again.';
		// }       

		// $user2 = User::where('id',$vendor_id->assign_vendor_id)->first();
		// $to = $user2['email'];
		// $subject = 'Order Status Change';
		// $message = "Dear ".$user2->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
		// $headers = 'From:info@dhd.in';              
		// if(mail($to, $subject, $message, $headers)) {
		//     echo 'Your Order Status is Send To your registered email Address';
		// } 
		// else {
		//     echo 'Sorry! something went wrong, please try again.';
		// }          
        return back()->with('msg','Order Status Change successfully');
    }

    public function vendorAssign(Request $req)
    {
        OrderItem::where('sub_order_id',$req->sub_order_id)->update([
         'assign_vendor_id'=>$req->assign_vendor_id,
         'update_status_id'=>Auth::user()->id
        ]);

        $vendor = new OrderAssignHistory;
        $vendor->order_id = $req->order_id;
        $vendor->sub_order_id = $req->sub_order_id;
        $vendor->assign_vendor_id = $req->assign_vendor_id;
        $vendor->comment = $req->comment;
        $vendor->assign_by = Auth::user()->id; 
        $vendor->save();
        return back()->with('msg','Order Status Change successfully');
    }
}
































// <?php

// namespace App\Http\Controllers\admin;
// use App\Http\Controllers\Controller; 
// use Illuminate\Http\Request;
// use Auth;
// use App\UserAddress;
// use App\Order;
// use App\OrderItem;
// use DB;
// use App\User;
// use App\DeWallet;
// use App\OrderAssignHistory;
// use App\OrderStatusHistory;
// class OrderController extends Controller
// { 

//     Public function vendorViewOrder(){
//     	$data['flag'] = 1; 
//     	$data['page_title'] = 'View Order'; 
//     	$data['order'] = OrderItem::get(); 
//     	$data['order_status'] = DB::table('order_status')->get(); 
//     	return view('admin/webviews/admin_manage_order',$data);
//     } 

//     public function orderStatusUpdate(Request $req)
//     {
//         OrderItem::where('sub_order_id',$req->sub_order_id)->update([
//          'order_status'=>$req->order_status
//         ]);

//         $order = new OrderStatusHistory;
//         $order->order_id = $req->order_id;
//         $order->sub_order_id = $req->sub_order_id;
//         $order->order_status = $req->order_status;
//         $order->change_by = Auth::user()->id; 
//         $order->save();

//         $user_id = DB::table('orders')->where('order_id',$req->order_id)->first();
//         $vendor_id = DB::table('order_items')->where('sub_order_id',$req->sub_order_id)->first();
         
//         if ($req->order_status == 6) {
//             DB::table('de_wallets')->where('user_id',$user_id->user_id)->update([
//                 'coin' => 0.50 * $user_id->amount
//             ]);
//         }
       

        
         
// 		// $user = User::where('id',$user_id->user_id)->first();
// 		// $to = $user['email'];
// 		// $subject = 'Order Status Change';
// 		// $message = "Dear ".$user->name.", \nYour OrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
// 		// $headers = 'From:info@dhd.in';        
// 		// if(mail($to, $subject, $message, $headers)) {
// 		//     echo 'Your Order Status is Send To your registered email Address';
// 		// } 
// 		// else {
// 		//     echo 'Sorry! something went wrong, please try again.';
// 		// }  

// 		// $user1 = User::where('user_type',1)->first();
// 		// $to = $user1['email'];
// 		// $subject = 'Order Status Change';
// 		// $message = "Dear ".$user1->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
// 		// $headers = 'From:info@dhd.in';              
// 		// if(mail($to, $subject, $message, $headers)) {
// 		//     echo 'Your Order Status is Send To your registered email Address';
// 		// } 
// 		// else {
// 		//     echo 'Sorry! something went wrong, please try again.';
// 		// }       

// 		// $user2 = User::where('id',$vendor_id->assign_vendor_id)->first();
// 		// $to = $user2['email'];
// 		// $subject = 'Order Status Change';
// 		// $message = "Dear ".$user2->name.", \nOrderId-       ".$req->order_id."\n The Status is changed of that suborderId  is-     ".$req->order_status." \n\nThank You.";
// 		// $headers = 'From:info@dhd.in';              
// 		// if(mail($to, $subject, $message, $headers)) {
// 		//     echo 'Your Order Status is Send To your registered email Address';
// 		// } 
// 		// else {
// 		//     echo 'Sorry! something went wrong, please try again.';
// 		// }          
//         return back()->with('msg','Order Status Change successfully');
//     }

//     public function vendorAssign(Request $req)
//     {
//         OrderItem::where('sub_order_id',$req->sub_order_id)->update([
//          'assign_vendor_id'=>$req->assign_vendor_id,
//          'update_status_id'=>Auth::user()->id
//         ]);

//         $vendor = new OrderAssignHistory;
//         $vendor->order_id = $req->order_id;
//         $vendor->sub_order_id = $req->sub_order_id;
//         $vendor->assign_vendor_id = $req->assign_vendor_id;
//         $vendor->comment = $req->comment;
//         $vendor->assign_by = Auth::user()->id; 
//         $vendor->save();
//         return back()->with('msg','Order Status Change successfully');
//     }
// }
