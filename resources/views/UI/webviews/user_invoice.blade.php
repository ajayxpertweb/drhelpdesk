<!DOCTYPE html>
<html>
	<head>
		<title>invoice</title>
		<style>
			.invoice-top{
				width: 100%;
			}
			.invoice-l{
				width: 30%;
				float: left;
			}
			.invoice-r{
				width: 70%;
				float: right;
				text-align: right;
			}
			.invoice-r h1{
	        font-size: 22px;
	        margin-bottom: 0px;
			}
			.invoice-r h6{
				margin-top: 5px;
	            font-size: 18px;
	            font-weight: 100;
			}
			.invoice-second{
				width: 100%;
				position: relative;
				height: 305px;
			}
			.invoice-content-l{
				width: 50%;
				float: left;
			}
			.invoice-content-r{
				width: 50%;
				float: right;
				text-align: right;
			}
			.invoice-content-l h1{
				margin-bottom: 0px;
				font-size: 22px;
			}
			.invoice-content-r h1{
				margin-bottom: 0px;
				font-size: 22px;
			}
			.invoice-content-r p{
				margin-bottom: 2px;
				margin-top: 2px;
				font-size: 17px;
			}
			.invoice-content-l p{
				margin-bottom: 2px;
				margin-top: 2px;
				font-size: 17px;
			}
			.invoice-third{
				width: 100%;
				height: 120px;
			}
			.invoice-third .invoice-content-l h1 span{
				font-weight: 100;
				font-size: 14px;
			}
			.invoice-third .invoice-content-l h1{
				margin-top: 0px;
				font-size: 22px;
			}
			.invoice-four{
				width: 100%;
				height: 100px;
			} 
			.invoice-four .invoice-content-l h1 span{
				font-weight: 100;
				font-size: 14px;
			}
			.invoice-four .invoice-content-l h1{
				margin-top: 0px;
				font-size: 22px;
			}
			.invoice-four .invoice-content-r h1 span{
				font-weight: 100;
				font-size: 14px;
			}
			.invoice-four .invoice-content-r h1{
				margin-top: 0px;
				font-size: 22px;
			}
			table, th, td {
			  border: 1px solid black;
			  border-collapse: collapse;
			}
			.table th {
			  background-color: #eee;
			  color: black;
			}
		</style>
	</head>
	<body>
		<div class="invoice">
			<div class="invoice-top">
				<div class="invoice-l">
					<img src="{{asset('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk"  class="img-fluid" style="width: 100%; height: 100px;">	
				</div>
				<div class="invoice-r">
					<h1>Tax Invoice/Bill of Supply/Cash Memo</h1>
					<h6>(Original for Recipient)</h6>	
				</div>
			</div>
			<div  class="invoice-second" style="width: 100%;"> 
				<div class="invoice-content-l" style="width: 50%;">
					<h1>Billing Address:</h1>
					<p>{{$userDetail->name}}</p>
					<p>{{$orderDetails->user_address}}({{$orderDetails->user_address_type}}),</p>
					<p>{{$orderDetails->user_apartment}},{{$orderDetails->user_city}}</p>
					<p>{{$orderDetails->user_state}},{{$orderDetails->user_country}}</p>
					<p>{{$orderDetails->pin_code}}</p>
				</div>
				<div class="invoice-content-r" style="width: 50%;">
					<h1>Shipping Address:</h1>
					<p>{{$userDetail->name}}</p>
					<p>{{$orderDetails->user_address}}({{$orderDetails->user_address_type}}),</p>
					<p>{{$orderDetails->user_apartment}},{{$orderDetails->user_city}}</p>
					<p>{{$orderDetails->user_state}},{{$orderDetails->user_country}}</p>
					<p>{{$orderDetails->pin_code}}</p>
				</div>
			</div>
			<div class="invoice-third">
				<div class="invoice-content-l" style="width: 50%;">
					<h1>PAN No: <span>AALCA0171E</span></h1>
					<h1>GST Registration No: <span>06AALCA0171E1Z3</span></h1>
				</div>
				<div class="invoice-content-r" style="width: 50%;">
					<h1>Order Id: <span>{{$orderDetails->order_id}}</span></h1>
		            <h1>Order Date: <span>
		                <?php
		                    $ex = explode(" ",$orderDetails->created_at)
		                ?>
		                {{$ex['0']}}</span>
		            </h1>
				</div>
			</div>
			 
			<div>
				<table class="table">
		            <thead>
		                <tr>
		                    <th>Sr. No.</th>
		                    <th>Product Image</th> 
		                    <th>Order Id</th>   
		                    <th>Sub Order Id</th>   
		                    <th>Product Name</th> 
		                    <th>Quantity</th> 
		                    <th>Amount</th> 
		                    <th>Extra Discount</th> 
		                    <th>Total Amount</th>  
		                </tr>
		            </thead>
					<tbody>
						<?php
						$f = 0;
						$copoun1= 0;
						?>
						@if(count($order)>0)
						@foreach($order as $key=> $r)
							<?php 
								$count = $key+1;  
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
								<td>{{$r->prod_name}} </td> 
								<td>{{$r->quantity}}</td> 
								<td>{{$r->sub_total}}</td>  
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
									<?php
									$f = $f + $r->quantity * $r->sub_total - $discount * $r->quantity;
									?>
									{{$r->quantity * $r->sub_total - $discount * $r->quantity}}  
									@else
									<?php
									$f = $f+$r->quantity * $r->sub_total;
									?>
									{{$r->quantity * $r->sub_total}} 
									@endif
								</td>   
							</tr>
						@endforeach
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">SUB TOTAL:</td>
							<td style=" background-color: #eee;">₹{{$f}}</td> 
						</tr>
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">COPOUN AMOUNT:</td>
							@if($orderDetails->copoun_code != null) 
								@php
									$copoun = DB::table('coupons')->where('copoun_code',$orderDetails->copoun_code)->first();
									
								@endphp
								@if($copoun->type == 'fixed') 
								<td style=" background-color: #eee;">₹{{$copoun1 = $copoun->amount}}</td> 
								@elseif($copoun->type == 'percentage') 
								<td style=" background-color: #eee;">₹{{ $copoun1 = $f * $copoun->amount/100}}</td>
								@endif
							
							@else
							<td style=" background-color: #eee;">₹0</td> 
							@endif
						</tr>
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">DEWALLET AMOUNT:</td>
							@if($orderDetails->de_wallet_coin != null) 
							<td style=" background-color: #eee;">₹{{$orderDetails->de_wallet_coin  * 0.25}}</td> 
							@else
							<td style=" background-color: #eee;">₹0</td> 
							@endif
						</tr>
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">SHIPPING CHARGES:</td>
							@if($orderDetails->shipping_charge != null)
							<td style=" background-color: #eee;">₹{{$orderDetails->shipping_charge}}</td> 
							@else
							<td style=" background-color: #eee;">₹0</td> 
							@endif
						</tr>
						@php
							$f = $f-$orderDetails->de_wallet_coin  * 0.25 - $copoun1 + $orderDetails->shipping_charge;
						@endphp
						<tr>
							<td colspan="8" style="font-weight: 700; color: black;">TOTAL AMOUNT:</td>
							<td style=" background-color: #eee;">₹{{$f}}</td> 
						</tr>

						<tr>
							<td colspan="10" style="font-weight: 700; color: black; text-align: right;">For Appario Retail Private Ltd:<br><img src="{{asset('UI/images/signture.jpg')}}" style="width: 100px;"> <br>Authorized Signatory
							</td>
						</tr>
						<br><br>
					</tbody>
		        </table>
		        @else
		            No Record found
				@endif
		    </div>
		</div>
	</body>
</html>