<div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Order</h3> 
  </div> 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th> 
          <th>Order Details</th> 
          <th>Order Status</th>   
          <th>Delivery Type</th>   
          <th>De-Wallet</th>  
          <th>Copoun</th>  
          <th>Shipping Charge</th>
          <th>Prescription</th>  
          <th>Payment</th>   
          <th>Amount</th>  
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        @php 
        $count = 1;  

        @endphp 
        @foreach($order as $r)

        <tr>
          <td>{{$count++}}</td> 
          <td>
            <b>Order Id</b>:- {{$r->order_id}}<br>
            <b style="color:red;">Order Date</b>:- {{$r->created_at->format('d-m-Y')}}<br>
            @if($r->Shiprocket_Order_Id != null)
              <b>Shiprocket Order Id</b>:- {{$r->Shiprocket_Order_Id}}<br>
            @endif
            @if($r->Shiprocket_Shipment_Id != null)
              <b>Shiprocket Shipment Id</b>:- {{$r->Shiprocket_Shipment_Id}}<br> 
            @endif
          </td>
          <td>
            @if($r->order_status == 1)
              In Procesed  
            @elseif($r->order_status == 6)
              Delivered 
            @endif
          </td>  
          <td> 
            @if($r->quick_delivery == 1)
              <b style="color:red;">Quick Delivery</b> <br>
              <b>Delivery Time</b> <b style="color:red;">(60 min to 90 min)</b>
            @endif
            @if($r->quick_delivery == 2)
              <b style="color:red;">Shiprocket  Delivery</b> <br>
              <b>Delivery Time</b> <b style="color:red;">(24 hours to 48 hours)</b>
            @endif
          </td>
          <td> 
            @if($r->de_wallet_coin != null)
              <b>Coin</b>:-  {{$r->de_wallet_coin}}<br>
              <b>Amount</b>:-  ₹{{$r->de_wallet_coin  * 0.25}}
            @else
              <b>Coin</b>:-  0<br>
              <b>Amount</b>:-  ₹0
            @endif 
          </td>
          <td> 
            @if($r->copoun_code != null)
              @php
                $copoun = DB::table('coupons')->where('copoun_code',$r->copoun_code)->first();
              @endphp
              @if($copoun  != null)
                @if($copoun->type == 'fixed') 
                  ₹{{$copoun->amount}} 
                @elseif($copoun->type == 'percentage') 
                  {{ $copoun->amount }} % of total amount
                @endif 
              @endif 
            @else
              ₹0 
            @endif 
          </td> 
          <td>
            @if($r->shipping_charge != null)
              ₹{{$r->shipping_charge}} 
            @else 
             ₹0 
            @endif  
          </td> 
          <td>
            @if($r->prescription_id != null)
            <?php
            $presciption = DB::table('prescriptions')->where('id',$r->prescription_id)->pluck('prescription_image')->first(); 

            ?>
              @if(file_exists(asset($presciption)))
                <img src="{{asset($presciption)}}" alt=""  style="width:70px; height:70px;">
              @else
                <img src="{{asset('UI/images/product_default1.png')}}" alt=""  style="width:70px; height:70px;">
              @endif 
            @else
            <b>No Prescription Found</b>
            @endif
          </td>
          <td><b>Payment Mode</b> : {{$r->payment_mode}} <br> 
            <b>Payment Id</b> : @if($r->payment_id != null){{$r->payment_id}}@else No Payment Id @endif <br> 
            <b>Payment Status</b> : {{$r->payment_status}} <br> 
            <b>Payment Request Id</b> : {{$r->payment_req_id}} <br> 
          </td>  
          <td>
            @if($r->amount != null)
              ₹{{$r->amount}} 
            @else 
             ₹0 
            @endif  
          </td>  
          <td>  
            <a href="{{url('/view-order-details/'.$r->order_id)}}"><button class="btn btn-sm bg-info">Order Details</button></a> 
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th> 
          <th>Order Details</th> 
          <th>Order Status</th>   
          <th>Delivery Type</th>   
          <th>De-Wallet</th>  
          <th>Copoun</th>  
          <th>Shipping Charge</th>
          <th>Prescription</th>  
          <th>Payment</th>   
          <th>Amount</th>  
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>    