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
                                            <div id="amountPending" style="font-weight: 600;font-size: 17px;color:red;"></div>
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
                                                                        $totaltype1Amount = 0;
									$extra_discount = 0;
									$shipping_percent = 0;
									$total=0; 
								@endphp
								@foreach($result as  $details)
    								@if($details->type == 1)
    								    @if($details->special_price != null) 
                                        <?php $totaltype1Amount +=  
                                        ($details->special_price  * $details->quantity);   
                                        ?>
                                        @else
                                        <?php $totaltype1Amount +=  
                                        ($details->price  * $details->quantity); ?>
                                        @endif
                                        
                                        @if($details->special_price != null && $details->extra_discount != null) 
												<?php
												$extra_discount_1 = ($details->special_price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@elseif($details->price != null && $details->extra_discount != null) 
												<?php
												$extra_discount_1 = ($details->price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@endif 
												<?php $totaltype1Amount =  
                                        ($totaltype1Amount  - $extra_discount_1); 
                                     ?>
    								@endif
								@endforeach
								
								@foreach($result as  $details)
									
									@if($details->type == 1 || $details->type == 2)
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
													{{ $details->special_price}} 
													@else
													{{ $details->price}} 
													@endif
													
												</span> 
											</td>
											<td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
											    @if(!in_array($details->type, ['2', '3']))
											    
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
												@endif
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
									@elseif($details->type == 3)
									    @if($details->offer_discount != null)
									    
											@php
					                          $discount = ($details->offer_discount * $details->package_cost) / 100;
                                                                 
					                          $discount1 = $details->package_cost - $discount;
					                        @endphp 
				                        @endif
										<tr class="cart-table__row" id="record-{{$details->id}}">
											<td class="cart-table__column cart-table__column--image">
												<a href="{{url('/package-detail/'.$details->id)}}">
													<img src="{{$details->image}}" alt="">
												</a>
											</td>
											<td class="cart-table__column cart-table__column--product"><a href="{{url('/package-detail/'.$details->id)}}" class="cart-table__product-name">	{{ $details->package_name }}</a> 
											</td>
											<td class="cart-table__column cart-table__column--price" data-title="Price"><i class="fas fa-rupee-sign"></i>
												<span id="price-{{$details->id}}">
													 
													@if($details->offer_discount == null) 
													{{ $details->package_cost}} 
													@else
													{{ $discount1}} 
													@endif
													
												</span> 
											</td>
											<td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
											    <!-- @if(!in_array($details->type, ['2', '3']))
											    
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
												@endif -->
											</td>
											<td class="cart-table__column cart-table__column--total" data-title="Total"><i class="fas fa-rupee-sign"></i> 
												<span id="sub-total-{{$details->id}}">
												@if($details->offer_discount == null)
			                                    	 {{$details->quantity  *   $details->package_cost}} 
			                                  	@else
			                                     	{{$details->quantity  *  $discount1 }} 
			                                  	@endif

											 	@if($details->offer_discount == null) 
						                          <?php $total_amount+=  
						                          $details->package_cost  * $details->quantity;   
						                          ?>
						                        @else
						                          <?php $total_amount+=  
						                          $discount1  * $details->quantity;   
						                          ?>
						                        @endif  
											</td> 
											<td class="cart-table__column cart-table__column--remove"> 
												<a href="javascript:void(0);" class="text-danger" onclick="removeProduct({{$details->id}})" cl><i class="icon-cross"></i></a>
											</td> 
										</tr> 
									@endif
								@endforeach 
							</tbody>
							<tfoot class="cart-table__foot">
								<tr>
									<td colspan="6">
									     @if($copoun_amount == null)
										<div class="cart-table__actions">
											<form class="cart-table__coupon-form form-row" action="{{url('my-cart')}}" method="get">
												<div class="form-group mb-0 col flex-grow-1">
													<input type="text" class="form-control form-control-sm" placeholder="Coupon Code" name="coupon_code" value="{{old('coupon_code')}}">
												</div>
												<div class="form-group mb-0 col-auto">
													<button type="submit" class="btn btn-sm btn-primary">Apply Coupon</button>
												</div>
											</form> 
											<!--<div class="cart-table__update-button"><a class="btn btn-sm btn-primary" href="{{url('/my-cart')}}">Update Cart</a>-->
											</div> 
										@endif
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
													$tamount = $total_amount - $extra_discount - $copoun_amount;
                                                                                                        $totaltype1Amount = $totaltype1Amount - $copoun_amount;
												?>
											@elseif($type =='percentage')
												<?php
												$desdiscount = ($total_amount - $extra_discount) * $copoun_amount/ 100;
													$tamount = ($total_amount - $extra_discount) - $desdiscount;
                    $totaltype1Amount = $totaltype1Amount - ($totaltype1Amount * $copoun_amount/ 100); 
												?>
											@endif
                                                                                        
										@else 
											<?php
												$tamount+= $total_amount - $extra_discount; 
											?>
										@endif 
										@php 
                                           	$tamount = $tamount > 0 ? $tamount : 0;
                                           	
                                                $totaltype1Amount = $totaltype1Amount > 0 ? $totaltype1Amount : 1;
                                                
											$shipping = DB::table('shipping_charges')->where('min','<=',  $totaltype1Amount)->where('max','>=',$totaltype1Amount)->first();
                                                                                   if($totaltype1Amount <= 800 ){
												if($map_location!='notfound' ){
                                                                                                    $shipping_percent = ($totaltype1Amount * $shipping->percent)/100;
                                                                                                }else{
                                                                                                    $shipping_percent = 60;
                                                                                                }
											}else{
												$shipping_percent = 0;
											}
                                                                                        
                                                                                        if($type1totalitem == 0){
                                                                                          $shipping_percent = 0;
                                                                                        }
										@endphp 
										@if($shipping_percent != null)
										<tr>
											<th>Shipping</th>
											<td><i class="fas fa-rupee-sign"></i>{{  round($shipping_percent,2) }}</td>
										</tr>
										@elseif($shipping_percent == 0)
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
									<a class="btn btn-primary" href="{{url('checkout/')}}">Proceed to checkout</a>
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
					    <div id="amountPending" style="font-weight: 600;font-size: 17px;color:red;"></div>
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
                                                                        $totaltype1Amount = 0;
									$total=0; 
								@endphp
                                @foreach($result as  $details)
    								@if($details->type == 1)
    								    @if($details->special_price != null) 
                                        <?php $totaltype1Amount +=  
                                        ($details->special_price  * $details->quantity);   
                                        ?>
                                        @else
                                        <?php $totaltype1Amount +=  
                                        ($details->price  * $details->quantity); ?>
                                        @endif
                                        
                                        @if($details->special_price != null && $details->extra_discount != null) 
												<?php
												$extra_discount_1 = ($details->special_price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@elseif($details->price != null && $details->extra_discount != null) 
												<?php
												$extra_discount_1 = ($details->price * $details->quantity *  $details->extra_discount)/100; 
												?>
												@endif 
												<?php $totaltype1Amount =  
                                        ($totaltype1Amount  - $extra_discount_1); 
                                     ?>
    								@endif
								@endforeach   
								
								@foreach($result as  $details)
								@php  $details->id = !empty($details->id) ? $details->id : $details->temp_carts_id; @endphp
									@if($details->type == 1 || $details->type == 2)
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
											    @if(!in_array($details->type, ['2', '3']))
											    
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
												@endif
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
												<a href="javascript:void(0);" class="text-danger" onclick="removeProduct({{$details->temp_carts_id}})" cl><i class="icon-cross"></i></a>
											</td> 
										</tr> 
									@elseif($details->type == 3) 
										@if($details->offer_discount != null)
										@php
				                          $discount = ($details->offer_discount * $details->package_cost) / 100;
				                          $discount1 = $details->package_cost - $discount;
				                        @endphp 
				                        @endif
				                        <tr class="cart-table__row" id="record-{{$details->id}}">
											<td class="cart-table__column cart-table__column--image">
												<a href="{{url('/package-detail/'.$details->id)}}">
													<img src="{{$details->image}}" alt="">
												</a>
											</td>
											<td class="cart-table__column cart-table__column--product"><a href="{{url('/package-detail/'.$details->id)}}" class="cart-table__product-name">	{{ $details->package_name }}</a> 
											</td>
											<td class="cart-table__column cart-table__column--price" data-title="Price"><i class="fas fa-rupee-sign"></i>
												<span id="price-{{$details->id}}">
													@if($details->offer_discount != null) 
													@if($details->offer_discount != null) 
													{{ $details->package_cost}} 
													@else
													{{ $discount1}} 
													@endif
													@else
													{{ $discount1}} 
													@endif
												</span> 
											</td>
											<td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
											    <!-- @if(!in_array($details->type, ['2', '3']))
											    
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
												@endif -->
												1
											</td>
											<td class="cart-table__column cart-table__column--total" data-title="Total"><i class="fas fa-rupee-sign"></i> 
												<span id="sub-total-{{$details->id}}">
												@if($details->offer_discount == null)
			                                    	 {{$details->quantity  *   $details->package_cost}} 
			                                  	@else
			                                     	{{$details->quantity  *  $discount1 }} 
			                                  	@endif

											 	@if($details->offer_discount == null) 
						                          <?php $total_amount+=  
						                          $details->package_cost  * $details->quantity;   
						                          ?>
						                        @else
						                          <?php $total_amount+=  
						                          $discount1  * $details->quantity;   
						                          ?>
						                        @endif  
											</td> 
											<td class="cart-table__column cart-table__column--remove"> 
												<a href="javascript:void(0);" class="text-danger" onclick="removeProduct({{$details->temp_carts_id}})" cl><i class="icon-cross"></i></a>
											</td> 
										</tr>  
									@endif   
								@endforeach 
							</tbody> 
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
                                                                                        
												$shipping = DB::table('shipping_charges')->where('min','<=', $totaltype1Amount)->where('max','>=',$totaltype1Amount)->first();
												if($totaltype1Amount <= 799 ){ 
													if($location_name){
														$shipping_percent = ($totaltype1Amount * $shipping->percent)/100;
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
    @if(!empty($totaltype1Amount))
    
    @if($totaltype1Amount < 799 && $type1totalitem != 0)
        var pendingamount = {{ceil(799 - $totaltype1Amount)}};
        document.getElementById('amountPending').innerHTML = 'You add Rs.'+pendingamount+' products for free shipping.';
    @endif
    @endif
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
                    window.location.reload();
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
                    window.location.reload();
  			//alert('product successfully deleted from cart');
  		}
  	});
  	document.getElementById('record-'+id).style.display="none";
  //for total cart amount calculation
  document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
  document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
}
</script> 