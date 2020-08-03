<?php

namespace App\Http\Controllers\UI;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input; 
use Auth;
use DB;
use Mail; 
use redirect;
use Session;
use Validator;
use Carbon\carbon;
use App\User;  
use App\TempCart;
use App\Cart;
use App\UserAddress;
use App\Order;
use App\OrderItem;
use App\UserDetail;
use App\Product;
use App\Vendor;
use App\Review;
use App\Prescription;
use App\DeWallet;
use App\Package;
use App\OrderAssignHistory;
use App\OrderStatusHistory;
use App\OrderCouponHistory;
use App\PasswordReset;
use App\Register;
use App\OrderPaymentTransaction;
use Paykun\Checkout\Payment;

class PaymentController extends Controller
{
    public function getPayment()
    {
        $obj = new Payment('770238538573163', '5E8CDDCEA0FB2C45211E45CED7F4F6CF', 'E09FEB10D06E8C3D4A2FCDA43BCB1BB3', false, false);

        return $obj;
    }
    
    public function showPayment($order_id){  
       
        $obj = $this->getPayment();
        $orderData = Order::where('order_id',$order_id)->first();
        $userDeatils = UserDetail::where('user_id', $orderData->user_id)->first();
        
        // default currency is 'INR'
        $obj->initOrder($order_id, 'all', $orderData->amount, route('payment_success'),  route('payment_fail'), 'INR');

        // Add Customer
        $obj->addCustomer($orderData->user_name, $userDeatils->email, $orderData->user_phone);

        // Add Shipping address
        $obj->addShippingAddress($orderData->user_country, $orderData->user_state, $orderData->user_city, $orderData->pin_code, $orderData->user_address);

        // Add Billing Address
        $obj->addBillingAddress($orderData->user_country, $orderData->user_state, $orderData->user_city, $orderData->pin_code, $orderData->user_address);

        echo $obj->submit();
    }

    public function paymentSucccess(Request $req)
    { 

        $obj = $this->getPayment();

        $response = $obj->getTransactionInfo($req['payment-id']);
        
        if(is_array($response) && !empty($response)) {

            if($response['status'] && $response['data']['transaction']['status'] == "Success") {
                $order_id = $response['data']['transaction']['order']['order_id'];
                Order::where('order_id', $order_id)->update([ 
                    'order_status' => 1
                ]);
                OrderItem::where('order_id', $order_id)->update([ 
                    'order_status' => 1
                ]);
                $reg = new OrderPaymentTransaction;
                $reg->order_id = $order_id;
                $reg->payment_id = $req['payment-id'];   
                $reg->status = 1;  
                $reg->response_data = json_encode($response); 
                $reg->save();
                return redirect('order-suceess/'.$order_id);
            } else {
                $order_id = $response['data']['transaction']['order']['order_id'];
                Order::where('order_id', $order_id)->update([ 
                    'order_status' => 6
                ]);
                OrderItem::where('order_id', $order_id)->update([ 
                'order_status' => 6
                ]);
                $reg = new OrderPaymentTransaction;
                $reg->order_id = $order_id;
                $reg->payment_id = $req['payment-id'];  
                $reg->status = 2;  
                $reg->response_data = json_encode($response); 
                $reg->save();
                return redirect('order-fail/'.$order_id);
            }
        }
        
        
    }

    public function paymentFail(Request $req)
    { 
        $obj = $this->getPayment();

        $response = $obj->getTransactionInfo($req['payment-id']);

        $order_id = $response['data']['transaction']['order']['order_id'];
        
        Order::where('order_id', $order_id)->update([ 
            'order_status' => 6
        ]);
        OrderItem::where('order_id', $order_id)->update([ 
            'order_status' => 6
        ]);
      
        $reg = new OrderPaymentTransaction;
        $reg->order_id = $order_id;
        $reg->payment_id = $req['payment-id']; 
        $reg->status = 2;  
        $reg->response_data = json_encode($response); 
        $reg->save();
        return redirect('order-fail/'.$order_id);
    }
     
     
} 