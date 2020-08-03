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
					
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Checkout </span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<style>
	.answer { display:none }
</style>


<div class="checkout block">
	<div class="container">
	   <form action="{{url('checkout-submit')}}" method="POST" enctype="multipart/form-data"  onsubmit="return checkForm(this);">
	     @csrf
		<div class="row">
			<!-- <div class="col-12 mb-3">
				<div class="alert alert-lg alert-primary">Returning customer? <a href="#">Click here to login</a>
				</div>
			</div> -->
			
				<div class="col-12 col-lg-8 col-xl-8">
					@if(session('msg') != null)
				      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
				        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				        {{session('msg')}}
				      </div>
				    @endif
					<div class="card mb-lg-0">
						<div class="card-body card-body--padding--1">
							<h3 class="card-title">Shipping Address</h3>
							<div class="addresses-list">		
								@php 
		                        	$user = DB::table('user_addresses')->where('user_id' , Auth::user()->id)->orderby('id','desc')->get(); 
		                        @endphp 
								@if($user->count()>0) 
									@php 
										$count=1; 
										$i = 0;
									@endphp
			                        @foreach($user as $r)   
                                        @php $defaultadd = $i==0?'checked="checked"':''; @endphp
										<div class="addresses-list__item card address-card">  
											<div class="address-card__body">
												<label class="input-radio">
													<span class="input-radio__body"> 
                                                    	<input class="input-radio__input"  name="address_id" data-city='{{$r->city}}' type="radio" value="{{$r->id}}" {{$defaultadd}}>  
														<span class="input-radio__circle"></span>
													</span>
												</label>
												<div class="address-card__name">{{$r->name}}</div>
												<div class="address-card__row">{{$r->address}}
													<br>{{$r->pin_code}}, {{$r->city}}
													<br>{{$r->state}},{{$r->country}}</div>
												<div class="address-card__row">
													<div class="address-card__row-title">Phone Number</div>
													<div class="address-card__row-content">{{$r->phone}}</div>
												</div>
												
												<div class="address-card__footer"><a href="{{url('/user-address-edit/'.$r->id)}}">Edit</a>&nbsp;&nbsp; <a href="{{url('/user-address-delete/'.$r->id)}}">Remove</a>
												</div>
											</div> 
										</div>
										@php
										  $i++;
									 	  $count++ 
									    @endphp
			                        @endforeach 
								@endif 
								<div class="addresses-list__divider"></div> 
								<a href="{{url('/user-address')}}" id="addNewaddress" class="addresses-list__item addresses-list__item--new">
									<div class="addresses-list__plus"></div>
									<div class="btn btn-secondary btn-sm">Add New</div>
								</a>
								<div class="addresses-list__divider"></div>
							</div>
						</div>
					</div>  
					<div class="card mb-lg-0 mt-2">
						<div class="card-body card-body--padding--1">
							<h3 class="card-title">Payment Details</h3>
							<div class="checkout__payment-methods payment-methods">
								<ul class="payment-methods__list"> 
									<li class="payment-methods__item"> 
										<label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="payment_mode" type="radio"> <span class="input-radio__circle"></span> </span>
											</span><span class="payment-methods__item-title">Paytm</span>
										</label>
										<div class="payment-methods__item-container">
											<div class="payment-methods__item-details text-muted">Pay via paytm; you can pay with your credit card if you don’t have a paytm account.</div>
										</div>
									</li>
									<li class="payment-methods__item">
										<label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="payment_mode" type="radio"> <span class="input-radio__circle"></span> </span>
											</span><span class="payment-methods__item-title">Direct bank transfer</span>
										</label>
										<div class="payment-methods__item-container">
											<div class="payment-methods__item-details text-muted">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</div>
										</div>
									</li>
									<li class="payment-methods__item">
										<label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="payment_mode" type="radio"> <span class="input-radio__circle"></span> </span>
											</span><span class="payment-methods__item-title">Check payments</span>
										</label>
										<div class="payment-methods__item-container">
											<div class="payment-methods__item-details text-muted">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</div>
										</div>
									</li>
									<li class="payment-methods__item payment-methods__item--active">
										<label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="payment_mode" type="radio" value="COD" checked="checked"> <span class="input-radio__circle"></span> </span>
											</span><span class="payment-methods__item-title">Cash on delivery</span>
										</label>
										<div class="payment-methods__item-container">
											<div class="payment-methods__item-details text-muted">Pay with cash upon delivery.</div>
										</div>
									</li> 
								</ul>
							</div>
							<div class="checkout__agree form-group">
								<div class="form-check"><span class="input-check form-check-input"><span class="input-check__body"><input class="input-check__input"  id="field_terms" onchange="this.setCustomValidity(validity.valueMissing ? 'Please check this to accept the Terms and Conditions' : '');" type="checkbox" required id="checkout-terms"> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>
									</span>
									<label class="form-check-label" for="checkout-terms">I have read and agree to the website <a target="_blank">terms and conditions</a>
									</label>
								</div>
							</div>  
						</div>
					</div>
				</div>
				@php 
		            $total_amount=0;
		            $total_amount_no_ship=0;
		            $extra_discount = 0;
			        $shipping_percent = 0;
		            $total=0; 
		            $total1 = 0;
		            $tamount = 0;
		            $shipamount = 0;
	            @endphp
				<div class="col-12 col-lg-4 col-xl-4 mt-4 mt-lg-0">
					<div class="card mb-0">
						<div class="card-body card-body--padding--1">
							<h3 class="card-title">Your Order Summary</h3>
							<!-- <form class="cart-table__coupon-form form-row" action="{{url('checkout/'.Auth::user()->id)}}" method="get">
								<div class="form-group mb-0 col flex-grow-1">
									<input type="text" class="form-control form-control-sm" placeholder="Coupon Code" name="coupon_code" value="{{old('coupon_code')}}">
								</div><br>
								<div class="form-group mb-0 col-auto">
									<button type="button" class="btn btn-sm btn-primary">Apply Coupon</button>
								</div>
							</form>  -->
							<table class="checkout__totals">
								<thead class="checkout__totals-header">
									<tr>
										<th>Product</th>
										<th>Total</th>
									</tr>
								</thead>
								<tbody class="checkout__totals-products">
									@php
										$wallet = DB::table('de_wallets')->where('user_id',Auth::user()->id)->pluck('coin')->first(); 
									@endphp
									@if($wallet > 0) 
										<tr>
											<th>D Wallet</th>
											<td><input  type="checkbox" id="coupon_question" name="coin"></td> 
										</tr>
									@endif
									@foreach ($result as $r)
									@if($r->type == 1)
    									 
    									    @php $data = $r->prescription; @endphp  
    									 
									<tr> 
										<td>{{$r->product_name}} × {{$r->quantity}}</td>
										<td><i class="fas fa-rupee-sign"></i>
											@if($r->special_price != null) 
												{{ $r->special_price  * $r->quantity }}
											@else
												{{ $r->price  * $r->quantity }}
											@endif 
										</td> 
										@if($r->special_price != null) 
											@php $total_amount+=$r->special_price  * $r->quantity;  
											    
											@endphp
										@else
											@php $total_amount+=$r->price  * $r->quantity; 
											@endphp
										@endif 

										@if($r->special_price != null && $r->extra_discount != null) 
											@php
											    $extra_discount+= ($r->special_price * $r->quantity *  $r->extra_discount)/100; 
											@endphp
										@elseif($r->price != null && $r->extra_discount != null) 
											@php
											    $extra_discount+= ($r->price * $r->quantity *  $r->extra_discount)/100; 
											@endphp
										@endif 
									</tr>
									@elseif($r->type == 2)
									@php $data = $r->prescription; @endphp  
    									 
									<tr> 
										<td>{{$r->product_name}} × {{$r->quantity}}</td>
										<td><i class="fas fa-rupee-sign"></i>
											@if($r->special_price != null) 
												{{ $r->special_price  * $r->quantity }}
											@else
												{{ $r->price  * $r->quantity }}
											@endif 
										</td> 
										@if($r->special_price != null) 
											@php $total_amount+=$r->special_price  * $r->quantity;  
											    $total_amount_no_ship+=$r->special_price  * $r->quantity;
											@endphp
										@else
											@php $total_amount+=$r->price  * $r->quantity;  
											     $total_amount_no_ship+=$r->price  * $r->quantity;
											@endphp
										@endif 

										@if($r->special_price != null && $r->extra_discount != null) 
											@php
											    $extra_discount+= ($r->special_price * $r->quantity *  $r->extra_discount)/100; 
											@endphp
										@elseif($r->price != null && $r->extra_discount != null) 
											@php
											    $extra_discount+= ($r->price * $r->quantity *  $r->extra_discount)/100; 
											@endphp
										@endif 
									</tr>
									@elseif($r->type == 3)  
    									@php $data = $r->prescription; @endphp  
									    @if($r->offer_discount != null)
    										@php
    				                          $discount = ($r->offer_discount * $r->package_cost) / 100;
    				                          $discount1 = $r->package_cost - $discount;
    				                        @endphp
				                        @endif
										<tr> 	
											<td>{{$r->package_name}} × {{$r->quantity}}</td>
											<td><i class="fas fa-rupee-sign"></i>
												@if($r->offer_discount == null)
			                                    	 {{$r->quantity  *   $r->package_cost}} 
			                                  	@else
			                                     	{{$r->quantity  *  $discount1 }} 
			                                  	@endif
											</td> 
											@if($r->offer_discount == null) 
					                          <?php $total_amount+=  
					                          $r->package_cost  * $r->quantity;  
					                          $total_amount_no_ship+=$r->package_cost  * $r->quantity; 
					                          ?>
					                        @else
					                          <?php $total_amount+=  
					                          $discount1  * $r->quantity; 
					                           $total_amount_no_ship+=$discount1  * $r->quantity;
					                          ?>
					                        @endif   
										</tr>
									@endif
									@endforeach  
								</tbody>
								<tbody class="checkout__totals-subtotals">
									<tr>
										<th>Subtotal</th>
										<td><i class="fas fa-rupee-sign"></i> {{$total_amount}}</td>
									</tr>  
									<tr class="answer">
										<th>D Wallet</th>
										<td id="damount">  
											<i class="fas fa-rupee-sign"></i>{{$wallet * 0.25}}
										</td>
									</tr>
									<?php
									 	$coupon = Session::get('couponData')?Session::get('couponData')['amount']:0;
									 	$type1 = Session::get('couponData')?Session::get('couponData')['type1']:0;
									?>
									@if($coupon != null) 
									<tr>
										<th>Copoun</th>
										<td> 
											@if($type1 =='fixed')
												<i class="fas fa-rupee-sign"></i> {{ $coupon }}
											@elseif($type1 =='percentage')
												{{ $coupon }}<b> % Off</b>
											@endif
										</td>
									</tr>
									@endif
									<tr>
										<th>Extra Discount</th>
										<td><i class="fas fa-rupee-sign"></i>  {{$extra_discount}}</td>
									</tr>
									
									@if($coupon != null)
										@if($type1 =='fixed')
										    @php
				                                $tamount+= $total_amount - $extra_discount - $coupon;  
				                            @endphp 
				                        @elseif($type1 =='percentage')
			                        	    @php
			                                	$tamount+= $total_amount - $extra_discount - ($total_amount * $coupon / 100);  
			                                @endphp 
				                        @endif
									@else 
									    @php
			                                $tamount+= $total_amount - $extra_discount;  
			                            @endphp 
			                        @endif   
			                                
									@php
									    $shipamount = abs($tamount-$total_amount_no_ship);
									    $shipamount = $shipamount > 0 ? $shipamount : 0;
									    
										$shipping = DB::table('shipping_charges')->where('min','<=',  $shipamount)->where('max','>=',$shipamount)->first();
									    if($shipamount < 800 ){
						                     if($map_location!='notfound' ){
					                            $shipping_percent = round(($shipamount * $shipping->percent)/100, 2);
						                    }else{
                                               $shipping_percent = 60;
						                    }
						                }else{
						                    $shipping_percent = 0;
						                }
									@endphp
									@if($shipping_percent != null)
									<tr>
										<th>Shipping</th>
										<td><i class="fas fa-rupee-sign"></i>{{  $shipping_percent }}</td>
									</tr>
									@else($shipping_percent == 0)
									<tr>
										<th>Shipping</th>
										<td>Free</td>
									</tr>
									@endif 
								
								
								</tbody>   
								<tfoot class="checkout__totals-footer"> 
								 
										<tr>
											@php
			                                	$total1+= $tamount + $shipping_percent;   
			                                @endphp 
											<th>Total</th>
											<td id="gdtotal"><i class="fas fa-rupee-sign"></i>{{round($total1,2)}}</td> 
										</tr>
								 
									<tr>
										<th>&nbsp;</th>
										<td style="padding-top:20px;"> 
    									     @if($data != null && $url == null) 
        										<a href="{{url('/upload-prescription')}}" class="btn btn-primary">Place Order </a>
        									 @else
        										<input type="hidden" name="prescription_id" value="{{$url}}">
        										@if('a' == 'on')
        										<input type="button" onClick="confSubmit(this.form);" value="Place Order" class="btn btn-primary"> 
        										@else 
                                                    <input type="button" onclick="confSubmit(this.form);" value="Place Order" class="btn btn-primary"> 
        										@endif
									        @endif  
										</td> 
									</tr>   
									<input  name="amount" id="amount" type="hidden"  value="{{round($total1,2)}}">  
								</tfoot> 
							</table> 
						</div>
					</div>
				</div>
			
		</div>
		</form>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
    var sessCityName = "{{strtolower(Session::get('location_name'))}}";
    function confSubmit(form){
        var cityName = $("input[name='address_id']:checked").attr('data-city').toLowerCase();
        if(cityName != sessCityName )
        {
           if(confirm("Your selected address will affect lab test, health package and shipping charge.")){
               $.ajax({
                    type: "post",
                     url: "http://lsne.in/dhd/public/checkcheckoutaddress",
                    dataType: "json",
                    data: {name:cityName},
                    success : function(data){
                        form.submit();
                        //alert(data)
//                      if(data == 0){
//                        $("#rs_phoneno1").html("Your Order Will Be deliver in 24 to 48 hours..!").show()
//                      }else{
//                        $("#rs_phoneno1").html("Your Order Will Be deliver in 60 Min to 90 Min..!").show()
//                      }
                      //window.location.href = "http://localhost/dhd/public/checkout";
                    }
                });
           }
        }else{
            form.submit();
        }
    }
    function CheckColors(val){
        var element=document.getElementById('color');
          if(val=='input'||val=={{$wallet * 0.25}})
           element.style.display='block'; 
          else  
           element.style.display='none'; 
    }  
</script>  
<script>
  function myFun() {
    var a = document.getElementById("mobile").value;
    if(a==""){
    document.getElementById("message").innerHTML="** Please Fill mobile number";
    return false;
     }
     
    if(isNaN(a)){
    //is not anumber
    document.getElementById("message").innerHTML="** only numbers are allowed"
      return false;
   }

  if(a.length<10){
    document.getElementById("message").innerHTML="** Mobile Number must be 10 digit";
   return false;  
  }

  if(a.length>10){
    document.getElementById("message").innerHTML="** Mobile Number must be 10 digit"
   return false;
  }

  if((a.charAt(0)!=9)&&(a.charAt(0)!=8)&&(a.charAt(0)!=7)){

    document.getElementById("message").innerHTML="** Mobile Number must start with 9, 8 and 7";
       return false;
  }

}
</script>
<script> 
  document.getElementById("field_terms").setCustomValidity("Please check this to accept the Terms and Conditions"); 
</script>
<script>
	var a = $('#field_terms').val()
</script>
<script type="text/javascript">
	$(function() {
	  $("#coupon_question").on("click",function() {
	  	if($("#coupon_question").prop('checked') == true){
	  		var paytotal = parseFloat($('#amount').val());
	  		var wallet = parseFloat('<?php echo($wallet * 0.25); ?>');
	  		var balance = paytotal - wallet;
	  		if(balance < 0){
	  			balance = 0.0;
	  			$('#damount').html('<i class="fas fa-rupee-sign"></i> '+paytotal);
	  		}
	  		$('#gdtotal').html('<i class="fas fa-rupee-sign"></i> '+balance);
	  		$('.answer').show();
	  	}else{
	  		var paytotal = parseFloat($('#amount').val());  
	  		$('#gdtotal').html('<i class="fas fa-rupee-sign"></i> '+paytotal);
	  		$('.answer').hide();
	  	}
	    
	  });
	});
</script> 