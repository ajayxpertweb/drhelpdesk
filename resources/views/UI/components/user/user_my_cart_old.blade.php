<?php  
$location_name = DB::table('locations')->where('location_name',$map_location)->first(); 
?>

<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current"><a href="{{url('/my-cart')}}" class="breadcrumb__item-link">Shopping cart</a>
					</li> 
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>

<div class="block">
	<div class="container"> 
		<div class="row cart">
			@if(Auth::check())
				@if(is_array($result))
					<div class="col-md-8 cart__table cart-table">
						<table class="cart-table__table">
							<thead class="cart-table__head">
								<tr class="cart-table__row">										
									<th class="cart-table__column cart-table__column--product" colspan="2">Product</th>
									<th class="cart-table__column cart-table__column--price">Price</th>
									<th class="cart-table__column cart-table__column--quantity">Quantity</th>
									<th class="cart-table__column cart-table__column--total">Total</th>
									<th class="cart-table__column cart-table__column--remove"></th>
								</tr>
							</thead>
							<tbody class="cart-table__body">
								@php 
									$total_amount=0; 
									$extra_discount = 0;
									$shipping_percent = 0;
									$total=0; 
								@endphp
								@foreach($result as  $details)
									<?php 
									$category = DB::table('product_images')->where('type',2)->where('products_id' , $details->products_id)->pluck('product_image')->first();  
									?>
									<tr class="cart-table__row" id="record-{{$details->id}}">
										<td class="cart-table__column cart-table__column--image">
											<a href="{{url('/product-detail/'.$details->products_id)}}">
												<img src="{{asset($category)}}" alt="">
											</a>
										</td>
										<td class="cart-table__column cart-table__column--product"><a href="{{url('/product-detail/'.$details->products_id)}}" class="cart-table__product-name">	{{ $details->product_name }}</a> 
										</td>
										<td class="cart-table__column cart-table__column--price" data-title="Price"><i class="fas fa-rupee-sign"></i>
											<span id="price-{{$details->id}}">
												@if($details->special_price != null) 
												@if($details->special_price != null) 
												{{ $details->special_price}} 
												@else
												{{ $details->price}} 
												@endif
												@else
												{{ $details->price}} 
												@endif
											</span> 
										</td>
										<td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
											<div class="cart-table__quantity input-number">
												<div class="input-group">
													<span class="input-group-prepend" onclick="counterUpdate(1,{{$details->id}})">
														<button type="button" class="quantity-left-minus btn btn-info btn-sm btn-number"  data-type="minus" data-field="">
															<span class="fa fa-minus"></span>
														</button>
													</span>
													<input type="text" name="quantity" class="form-control input-number" id="input-quantity-{{$details->id}}" value="{{$details->quantity}}"  readonly>
													<span class="input-group-append" onclick="counterUpdate(2,{{$details->id}})">
														<button type="button" class="quantity-right-plus btn btn-info btn-sm btn-number" data-type="plus" data-field="">
															<span class="fa fa-plus"></span>
														</button>
													</span>  
												</div>  
											</div>
										</td>
										<td class="cart-table__column cart-table__column--total" data-title="Total"><i class="fas fa-rupee-sign"></i> 
											<span id="sub-total-{{$details->id}}">
											@if($details->special_price != null) 
											{{ $details->special_price  * $details->quantity }}
											@else
											{{ $details->price  * $details->quantity }}
											@endif

											@if($details->special_price != null) 
											<?php $total_amount+=  
											$details->special_price  * $details->quantity;   
											?>
											@else
											<?php $total_amount+=  
											$details->price  * $details->quantity;   
											?>
											@endif

											@if($details->special_price != null && $details->extra_discount != null) 
											<?php
											$extra_discount+= ($details->special_price * $details->quantity *  $details->extra_discount)/100; 
											?>
											@elseif($details->price != null && $details->extra_discount != null) 
											<?php
											$extra_discount+= ($details->price * $details->quantity *  $details->extra_discount)/100; 
											?>
											@endif 
										</td>
										<td class="cart-table__column cart-table__column--remove"> 
											<a href="javascript:void(0);" class="text-danger" onclick="removeProduct({{$details->id}})" cl><i class="icon-cross"></i></a>
										</td> 
									</tr> 
								@endforeach 
							</tbody>
							<tfoot class="cart-table__foot">
								<tr>
									<td colspan="6">
										<div class="cart-table__actions">
											<form class="cart-table__coupon-form form-row" action="{{url('my-cart')}}" method="get">
												<div class="form-group mb-0 col flex-grow-1">
													<input type="text" class="form-control form-control-sm" placeholder="Coupon Code" name="coupon_code" value="{{old('coupon_code')}}">
												</div>
												<div class="form-group mb-0 col-auto">
													<button type="submit" class="btn btn-sm btn-primary">Apply Coupon</button>
												</div>
											</form> 
											<div class="cart-table__update-button"><a class="btn btn-sm btn-primary" href="{{url('/my-cart')}}">Update Cart</a>
											</div>  
										</div>
										@if($copoun_amount != null)
										{{$result1}}
										@else
										{{$result1}}
										@endif
									</td>

								</tr>
							</tfoot>
						</table>
					</div>
					@php  
						$total=0;  
						$tamount = 0;
					@endphp 
					<div class="col-md-4 cart__totals">
						<div class="card">
							<div class="card-body card-body--padding--1">
								<h3 class="card-title">Cart Summary</h3>
								<table class="cart__totals-table">
									<thead>
										<tr>
											<th>Subtotal</th>
											<td><i class="fas fa-rupee-sign"></i><span id="total">{{round($total_amount ?? '',2)}}</span></td>
										</tr>
									</thead> 
									<tbody> 
										<tr>
											<th>Extra Discount</th>
											<td><i class="fas fa-rupee-sign"></i> {{round($extra_discount,2) }}</td>
										</tr> 
										@if($copoun_amount != null)
										<tr>
											<th>Copoun</th>
											<td>
												@if($type =='fixed')
												<i class="fas fa-rupee-sign"></i> {{ round($copoun_amount,2) }}
												@elseif($type =='percentage')
												{{ $copoun_amount }}<b> % Off</b>
												@endif
											</td>
										</tr> 
										@endif
										<!--<tr>-->
										<!--	<th>GST</th>-->
										<!--	<td><i class="fas fa-rupee-sign"></i> 0</td>-->
										<!--</tr>  -->
										@if($copoun_amount != null)
											@if($type =='fixed')
												<?php
													$tamount+= $total_amount - $extra_discount - $copoun_amount;
												?>
											@elseif($type =='percentage')
												<?php
													$tamount+= $total_amount - $extra_discount - ($total_amount * $copoun_amount/ 100);
												?>
											@endif
										@else 
											<?php
												$tamount+= $total_amount - $extra_discount; 
											?>
										@endif 
										@php 
											$shipping = DB::table('shipping_charges')->where('min','<=',  $tamount)->where('max','>=',$tamount)->first();
											if($tamount <= 800 ){
												$shipping_percent = ($tamount * $shipping->percent)/100;
											}else{
												$shipping_percent = 0;
											}
										@endphp 
										@if($shipping_percent != null)
										<tr>
											<th>Shipping</th>
											<td><i class="fas fa-rupee-sign"></i>{{  round($shipping_percent,2) }}</td>
										</tr>
										@else($shipping_percent == 0)
										<tr>
											<th>Shipping</th>
											<td>Free</td>
										</tr>
										@endif
									</tbody>
									<tfoot> 
										<tr>
											<?php
											$total+= $tamount + $shipping_percent;
											?>
											<th>Total</th>
											<td><i class="fas fa-rupee-sign"></i><span id="grand-total">{{round($total ,2)}}</span></td>
										</tr> 
									</tfoot>
								</table>
								<div class="text-center">
									<a class="btn btn-primary" href="{{url('checkout/'.Auth::id())}}">Proceed to checkout</a>
								</div>
							</div>
						</div>
					</div> 
				@else
					<div class="ps-section__cart-bottom p-4 mb-4" style="text-align:center;">
						<h4 class="text-danger">{{$result}}</h4> 
						<a class="ps-btn" href="{{url('/')}}"><i class="icon-arrow-right"></i> Continue Shopping</a>
					</div>
					<div class="col-md-4 cart__totals">
						<div class="card">
							<div class="card-body card-body--padding--1">
								<h3 class="card-title">Cart Summary</h3>
								<table class="cart__totals-table">
									<thead>
										<tr>
											<th>Subtotal</th>
											<td><i class="fas fa-rupee-sign"></i><span id="total"> 00.00</span></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>Shipping</th>
											<td><i class="fas fa-rupee-sign"></i> 00.00

											</td>
										</tr>
										<!--<tr>-->
										<!--	<th>GST</th>-->
										<!--	<td><i class="fas fa-rupee-sign"></i> 00.00 </td>-->
										<!--</tr>-->
										<tr>
											<th>Extra Discount</th>
											<td><i class="fas fa-rupee-sign"></i> 00.00 </td>
										</tr>
									</tbody>
									<tfoot>
										<tr>

											<th>Total</th>
											<td><i class="fas fa-rupee-sign"></i><span id="grand-total"> 00.00</span></td>
										</tr>
									</tfoot>
								</table>
								<div class="text-center">
									<a class="btn btn-primary" href="" value="disabled">Proceed to checkout</a>
								</div>
							</div>
						</div>
					</div> 
				@endif  
			@else
				@if(is_array($result))
						<div class="col-md-8 cart__table cart-table">
						<table class="cart-table__table">
							<thead class="cart-table__head">
								<tr class="cart-table__row">										
									<th class="cart-table__column cart-table__column--product" colspan="2">Product</th>
									<th class="cart-table__column cart-table__column--price">Price</th>
									<th class="cart-table__column cart-table__column--quantity">Quantity</th>
									<th class="cart-table__column cart-table__column--total">Total</th>
									<th class="cart-table__column cart-table__column--remove"></th>
								</tr>
							</thead>
							<tbody class="cart-table__body">
								@php 
									$total_amount=0; 
									$extra_discount = 0;
									$shipping_percent = 0;
									$total=0; 
								@endphp
								@foreach($result as  $details)
									<?php 
									$category = DB::table('product_images')->where('type',2)->where('products_id' , $details->products_id)->pluck('product_image')->first();  
									?>
									<tr class="cart-table__row" id="record-{{$details->temp_carts_id}}">
										<td class="cart-table__column cart-table__column--image">
											<a href="{{url('/product-detail/'.$details->products_id)}}">
												<img src="{{asset($category)}}" alt="">
											</a>
										</td>
										<td class="cart-table__column cart-table__column--product"><a href="{{url('/product-detail/'.$details->products_id)}}" class="cart-table__product-name">{{ $details->product_name }}</a> 
										</td>
										<td class="cart-table__column cart-table__column--price" data-title="Price"><i class="fas fa-rupee-sign"></i>
											<span id="price-{{$details->temp_carts_id}}">		
												@if($details->special_price != null) 
												{{ $details->special_price}} 
												@else
												{{ $details->price}} 
												@endif
											</span> 
										</td>
										<td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
											<div class="cart-table__quantity input-number">
												<div class="input-group">
													<span class="input-group-prepend" onclick="counterUpdate(1,{{$details->temp_carts_id}})">
														<button type="button" class="quantity-left-minus btn btn-info btn-sm btn-number"  data-type="minus" data-field="">
															<span class="fa fa-minus"></span>
														</button>
													</span>
													<input type="text" name="quantity" class="form-control input-number" id="input-quantity-{{$details->temp_carts_id}}" value="{{$details->quantity}}"  readonly>
													<span class="input-group-append" onclick="counterUpdate(2,{{$details->temp_carts_id}})">
														<button type="button" class="quantity-right-plus btn btn-info btn-sm btn-number" data-type="plus" data-field="">
															<span class="fa fa-plus"></span>
														</button>
													</span>  
												</div>  
											</div>
										</td>
										<td class="cart-table__column cart-table__column--total" data-title="Total"><i class="fas fa-rupee-sign"></i> 
											<span id="sub-total-{{$details->temp_carts_id}}"> 
											@if($details->special_price != null) 
											{{ $details->special_price  * $details->quantity }}
											@else
											{{ $details->price  * $details->quantity }}
											@endif

											@if($details->special_price != null) 
											<?php $total_amount+=  
											$details->special_price  * $details->quantity;   
											?>
											@else
											<?php $total_amount+=  
											$details->price  * $details->quantity;   
											?>
											@endif

											@if($details->special_price != null && $details->extra_discount != null) 
											<?php
											$extra_discount+= ($details->special_price * $details->quantity *  $details->extra_discount)/100; 
											?>
											@elseif($details->price != null && $details->extra_discount != null) 
											<?php
											$extra_discount+= ($details->price * $details->quantity *  $details->extra_discount)/100; 
											?>
											@endif 
										</td>
										<td class="cart-table__column cart-table__column--remove"> 
											<a href="javascript:void(0);" class="text-danger" onclick="removeProduct({{$details->temp_carts_id}})" cl><i class="icon-cross"></i></a>
										</td>
									</tr> 
								@endforeach 
							</tbody>
							<tfoot class="cart-table__foot">
								<tr>
									<td colspan="6">
										<div class="cart-table__actions"> 
											<div class="cart-table__update-button"><a class="btn btn-sm btn-primary" href="{{url('/my-cart')}}">Update Cart</a>
											</div> 
										</div>
									</td>
								</tr>
							</tfoot>
						</table>
					</div>
					@php  
						$total=0; 
						$tamount =0; 
					@endphp 
					<div class="col-md-4 cart__totals">
						<div class="card">
							<div class="card-body card-body--padding--1">
								<h3 class="card-title">Cart Summary</h3>
									<table class="cart__totals-table">
										<thead>
											<tr>
												<th>Subtotal</th>
												<td><i class="fas fa-rupee-sign"></i><span id="total"> {{$total_amount ?? ''}}</span></td>
											</tr>
										</thead>
										
										<tbody>
											<tr>
												<th>Extra Discount</th>
												<td><i class="fas fa-rupee-sign"></i> {{$extra_discount }}</td>
											</tr> 
											<!--<tr>-->
											<!--	<th>GST</th>-->
											<!--	<td><i class="fas fa-rupee-sign"></i> 0</td>-->
											<!--</tr>-->
											@php
												$tamount+= $total_amount - $extra_discount;
											@endphp
											@php
												$shipping = DB::table('shipping_charges')->where('min','<=', $tamount)->where('max','>=',$tamount)->first();
												if($tamount <= 799 ){ 
													if($location_name){
														$shipping_percent = ($tamount * $shipping->percent)/100;
													}else{
														$shipping_percent = 60;
													} 
												}else{
													$shipping_percent = 0;
												}
											@endphp
											<tr>
												<th>Shipping</th>
												<td><i class="fas fa-rupee-sign"></i> {{$shipping_percent}}

												</td>
											</tr>
											
											
										</tbody>
										<tfoot>
											<tr>
											<?php
												$total+= $tamount + $shipping_percent;
											?>
												<th>Total</th>
												<td><i class="fas fa-rupee-sign"></i><span id="grand-total">{{round($total ,2)}}</span></td>
											</tr>
										</tfoot>
									</table>
								@if(Auth::check())
									<div class="text-center">
										<a class="btn btn-primary" href="{{url('checkout/'.Auth::id())}}">Proceed to checkout</a>
									</div>
								@else
									<div class="text-center">
										<a class="btn btn-primary" href="{{url('/login-user')}}">Proceed to checkout</a>
									</div>
								@endif
							</div>
						</div>
					</div> 
				@else
					<div class="ps-section__cart-bottom p-4 mb-4" style="text-align:center;">
						<h4 class="text-danger">{{$result}}</h4> 
						<a class="ps-btn" href="{{url('/')}}"><i class="icon-arrow-right"></i> Continue Shopping</a>
					</div>
					<div class="col-md-4 cart__totals">
						<div class="card">
							<div class="card-body card-body--padding--1">
								<h3 class="card-title">Cart Summary</h3>
								<table class="cart__totals-table">
									<thead>
										<tr>
											<th>Subtotal</th>
											<td><i class="fas fa-rupee-sign"></i><span id="total"> 00.00 </span></td>
										</tr>
									</thead>
									<tbody>
										<tr>
											<th>Shipping</th>
											<td><i class="fas fa-rupee-sign"></i> 00.00

											</td>
										</tr>
										<!--<tr>-->
										<!--	<th>GST</th>-->
										<!--	<td><i class="fas fa-rupee-sign"></i> 00.00</td>-->
										<!--</tr>-->
										<tr>
											<th>Extra Discount</th>
											<td><i class="fas fa-rupee-sign"></i> 00.00</td>
										</tr>
									</tbody>
									<tfoot>
										<tr>

											<th>Total</th>
											<td><i class="fas fa-rupee-sign"></i><span id="grand-total"> 00.00</span></td>
										</tr>
									</tfoot>
								</table>
								<div class="text-center">
									<a class="btn btn-primary" href="" value="disabled">Proceed to checkout</a>
								</div>
							</div>
						</div>
					</div> 
				@endif  
		    @endif
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
<script type="text/javascript"> 
	function counterUpdate(type, id) {
    	//console.log(id);
    	if(type == 1) {
    		if(parseInt(document.getElementById('input-quantity-'+id).value) > 1) {
    			document.getElementById('input-quantity-'+id).value = parseInt(document.getElementById('input-quantity-'+id).value) - 1;
                //for total cart amount calculation
                document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
                document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
            }
        } else {
        	document.getElementById('input-quantity-'+id).value = parseInt(document.getElementById('input-quantity-'+id).value) + 1;
                //for total cart amount calculation
                document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) + parseInt(document.getElementById('price-'+id).innerHTML);
                document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) + parseInt(document.getElementById('price-'+id).innerHTML);
            }
            save_to_db(id);
        //for amount calculation in row on the basis of id/product quantity incre/decre.
        document.getElementById('sub-total-'+id).innerHTML =  parseInt(document.getElementById('input-quantity-'+id).value) * parseInt(document.getElementById('price-'+id).innerHTML);
    }

    function save_to_db(cart_id) {
        //console.log(document.getElementById('input-quantity-'+cart_id).value);
        $.ajax({
        	url : "cart-update",
        	data : "cart_id="+cart_id+"&new_quantity="+document.getElementById('input-quantity-'+cart_id).value,
        	type : 'get',
        	success : function(response) {
                //alert(response);
            }
        });
    }

    function removeProduct(id) {
  	//console.log(id);
  	$.ajax({
  		url: "remove-product",
  		data:"cart_id="+id,
  		type: 'get',
  		success: function(response){
  			alert('product successfully deleted from cart');
  		}
  	});
  	document.getElementById('record-'+id).style.display="none";
  //for total cart amount calculation
  document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
  document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
}
</script> 