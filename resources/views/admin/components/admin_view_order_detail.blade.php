 <div class="box"> 
  <div class="box-header"> 
    <h3 class="box-title" style="float:left;">View Order</h3> <br>
    <h4 >Shipping Address:-</h4>
 	  <b >{{$order1->user_name}},
  	   {{$order1->user_address}}<br>
  	   {{$order1->pin_code}}, 
  	   {{$order1->user_city}}<br>
  	   {{$order1->user_state}},
	   {{$order1->user_country}},
	   {{$order1->user_phone}}</b>
  </div> 
 
  <div class="box-body  table-responsive"> 
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Sr. No.</th>
          <th>Product Image</th> 
          <th>Order Id</th>   
          <th>Sub Order Id</th>   
          <th>Product Details</th> 
          <th>Extra Discount</th> 
          <th>Total Amount</th>  
          <th>Order Status</th> 
          <th>Action</th> 
        </tr>
      </thead>
      <tbody> 
        
        @foreach($order as $r)
          <?php 
            $count = 1;  
            if($r->type == 1 ||$r->type == 2){
              $status = DB::table('order_status')->where('status_value',$r->order_status)->first(); 
             
              $image = DB::table('product_images')->where('type',2)->where('products_id' , $r->prod_id)->pluck('product_image')->first();
              $product_category = DB::table('products')->where('products_id',$r->prod_id)->first(); 
              //dd($product_category);
              $vendor = DB::table('vendors')->where('main_category',$product_category->categories)->get();   
            }elseif($r->type == 3){
              $status = DB::table('order_status')->where('status_value',$r->order_status)->first(); 
              $image= DB::table('packages')->where('id',$r->prod_id)->pluck('image')->first(); 
              $vendor = DB::table('vendors')->where('main_category',15)->get();  
            }
          ?>
        <tr>
          <td>{{$count++}}</td>
          <td>
            @if($r->type == 1 ||$r->type == 2)
            <img src="{{ asset($image) }}" style="width:80px;"> 
            @elseif($r->type == 3)
            <img src="{{ asset($image) }}" style="width:80px;"> 
            @endif
            </td>
          <td>{{$r->order_id}} </td> 
          <td>{{$r->sub_order_id}} </td>  
          <td><b>Product Name</b> : {{$r->prod_name}} <br> 
              <b>Quantity</b> :{{$r->quantity}}<br> 
              <b>Amount</b> :{{$r->sub_total}} 
          </td> 
          <td>
            @if($r->extra_discount != null)
                <?php $discount = ($r->sub_total * $r->extra_discount)/100 ; //dd($discount); ?>
            {{$r->extra_discount}} <b>% Per Item </b>
            {{$discount}} <b> Rs Per Item</b>
            @else
            0 %
            @endif
          </td> 
          <td>
            @if($r->extra_discount != null)
             
            {{$r->quantity * $r->sub_total - $discount * $r->quantity}}  
            @else
            {{$r->quantity * $r->sub_total}} 
            @endif
          </td>  
          <td>
              
            {{ucfirst($status->status_name)}}  
          </td>  
          <td> 
            <b>Order Status</b>:
            <form action="{{url('order-status-change')}}" method="post">
              {{csrf_field()}} 
              <input type="hidden" name="sub_order_id" value="{{ $r->sub_order_id }}">
              <input type="hidden" name="order_id" value="{{ $r->order_id }}" >
              <select  name="order_status" class="form-control price_sorting">
                <option>select</option>
                @foreach($order_status as $r1)
                <option value="{{$r1->id}}"  @if($r->order_status == $r1->id) selected @endif>
                  <button class="btn btn-xs bg-info">{{ucfirst($r1->status_name)}}</button>
                </option>
                @endforeach 
              </select>  
            </form> 
            <b>Vendor Assign</b>:
            <form action="{{url('vendor-assign')}}" method="post">
              {{csrf_field()}}  
              <input type="hidden" name="sub_order_id" value="{{ $r->sub_order_id }}">
              <input type="hidden" name="order_id" value="{{ $r->order_id }}" >
              <select  name="assign_vendor_id" class="form-control price_sorting1">
                <option>select</option>
                @foreach($vendor as $r2) 
                <option value="{{$r2->vendors_id}}"  @if($r->assign_vendor_id == $r2->vendors_id) selected @endif>
                  <button class="btn btn-xs bg-info">{{ucfirst($r2->vendor_name)}}</button>
                </option>
                @endforeach 
              </select>  
            </form> 
          </td>
        </tr>
        @endforeach
      </tbody> 
      <tfoot>
        <tr>
          <th>Sr. No.</th>
          <th>Product Image</th> 
          <th>Order Id</th>   
          <th>Sub Order Id</th>   
          <th>Product Details</th> 
          <th>Extra Discount</th> 
          <th>Total Amount</th>  
          <th>Order Status</th> 
          <th>Action</th> 
        </tr>
      </tfoot> 
    </table>
  </div> 
</div>  