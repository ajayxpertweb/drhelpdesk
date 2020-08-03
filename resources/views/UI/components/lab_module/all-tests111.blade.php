<div class="block-space block-space--layout--divider-xs"></div>
<div class="block block-brands block-brands--layout--columns-6-full">
	<div class="container">
		@if(session('message1') != null)
	      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        {{session('message1')}}
	      </div>
	    @endif 
		<div class="row">
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-12">
						<div class="float-left">
						<h3>Lab Tests</h3>
						</div>
						<div class="float-right">
							<h5>{{$test->count()}} Tests</h5>
						</div>
					</div>
				</div>
				@foreach($test as $r) 
					@php  
	                    $session = Session::getId();  
	                    $data1=DB::table('temp_carts')->where('product_id',$r->products_id)->where('session_id',$session)->where('type',2)->first();  
	                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',2)->get();  
	                
                         @endphp   
                            
<?php
$per = 0;
if($r->special_price >0 && $r->price > 0){
    $s = $r->price - $r->special_price;
    $per = round(($s*100)/$r->price,2);
    $per = round($per,2);
    
}
                
                          
?>
                            <div class="alltest-box">
						<!--  -->
						<div>
							@if($r->product_image == null)
                            <img  src="{{asset('UI/images/lab.png')}}" alt="Test" width="150px">
							@else
							<img  src="{{asset($r->product_image)}}" alt="Test" width="150px">
							@endif
							<div class="alltest-content">
                                                            <div class="alltest-heading"><a href="{{url('lab-test-detail/'.$r->products_id)}}">{{$r->product_name}}</a></div>
								<div style="width:300px;white-space: nowrap;overflow:hidden;text-overflow: ellipsis;" class="alltest-p">
                                                                    {!!$r->short_description!!}
                                                                </div>
								
                                                                    <div class="_3EF-x _3BZ_8">
								@if($r['special_price'] == null)
                                                                <div class="alltest-h">₹{{$r->price}}</div> 
				                @else
				                    <span class="_3eI77">₹{{$r->special_price}}</span>				                    
				                    <span class="_20PV9">₹{{$r->price}}</span>
				                    <span class="_3NghB">save {{$per}}%</span>
				                @endif
                                                                    
                                                                    <div class="_1amQ5">onwards</div></div>
							</div>
						</div> 
						@guest  
							@if($data1 == null)
						 		@if(Session::get('location_name')!='notfound')
						 		<a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@else
						 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@endif
						 	@else
						 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
						 	@endif
						@else 
							@php
							$cart=DB::table('carts')->where('product_id',$r->products_id)->where('user_id',Auth::user()->id)->where('type',2)->first();  
							$check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',2)->get();   
							@endphp
							@if($cart==null)
								@if(Session::get('location_name')!='notfound')
						 		<a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@else
						 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@endif
						 	@else
						 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
						 	@endif  
						@endif
					</div>
				
				@endforeach 
				<div class="products-view__pagination"> 
					<nav aria-label="Page navigation example"> 
						<ul class="pagination">  
							 {{ $test->appends($page)->links() }} 
						</ul> 
					</nav> 
				</div>
			</div>
			
			<div class="col-md-5">
				<div>
				    <h5 class="_2zKF7">Proceed To Cart</h5>
					<div class=""><div class="_31z1j">Please select a test to proceed</div>
					<a href="{{url('/my-cart')}}"  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">View</a>  
					</div> 
					<!--@guest  -->
					<!--	@if($temp_carts->count() <= 0)  -->
					<!--		<h5 class="_2zKF7">Order Summary</h5>-->
					<!--		<div class=""><div class="_31z1j">Please select a test to proceed<button class="_2FE4Z _2Jc-Z _2Jc-Z ZHQJn _2N8KX _3LBfS">View Cart</button></div></div> -->
					<!-- 	@elseif($temp_carts->count() > 0) -->
					<!--		<h5 class="_2zKF7">Order Summary</h5>-->
					<!--		<div class=""><div class="_31z1j">Please select a test to proceed</div>-->
					<!--		<a href="{{url('/my-cart')}}"  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">View</a>  -->
					<!--		</div>  -->
					<!-- 	@endif-->
					<!--@else  -->
					<!--	@if($check_cart->count() <= 0) -->
					<!--		<h5 class="_2zKF7">Order Summary</h5>-->
					<!--		<div class=""><div class="_31z1j">Please select a test to proceed<button class="_2FE4Z _2Jc-Z _2Jc-Z ZHQJn _2N8KX _3LBfS">View Cart</button></div></div> -->
					<!-- 	@elseif($check_cart->count() > 0)  -->
					<!--		<h5 class="_2zKF7">Order Summary</h5>-->
					<!--		<div class=""><div class="_31z1j">Please select a test to proceed</div>-->
					<!--		<a href="{{url('/my-cart')}}"  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">View</a>  -->
					<!--		</div>  -->
					<!-- 	@endif  -->
					<!--@endif -->
				</div>
			</div>
		<div class="block-space block-space--layout--divider-xs"></div>
		<div class="row">
			<div class="col-md-3">
				<div>
					<div class="_34lUB"><img src="{{asset('UI/images/trusted.png')}}" alt="Trusted Labs" class="pdcGW "></div>
					<div class="qrwng"><strong>Trusted Labs</strong></div>
					<div class="_2XOfq">Every test booked via Drhelpdesk is conducted by an ISO or NABL certified lab that are 100% verified and trustworthy.</div>
				</div>
			</div>
			<div class="col-md-3">
				<div>
					<div class="_34lUB"><img src="{{asset('UI/images/homevist.png')}}" alt="Home Visit" class="pdcGW "></div>
					<div class="qrwng"><strong>Home Visit</strong></div>
					<div class="_2XOfq">With Drhelpdesk, you get a FREE sample pick-up* by professional phlebotomists from your home or preferred location.</div>
				</div>
			</div>
			<div class="col-md-3">
				<div>
					<div class="_34lUB"><img src="{{asset('UI/images/timely.png')}}" alt="Timely and Accurate Reports" class="pdcGW "></div>
					<div class="qrwng"><strong>Timely and Accurate Reports</strong></div>
					<div class="_2XOfq">Once collected, samples will be sent to labs for processing. Detailed reports will be shared within a stipulated timeline.</div>
				</div>
			</div>
			<div class="col-md-3">
				<div>
					<div class="_34lUB"><img src="{{asset('UI/images/upto.png')}}" alt="Up to 70% OFF" class="pdcGW benefitIcon--small"></div>
					<div class="qrwng"><strong>Up to 70% OFF</strong></div>
					<div class="_2XOfq">At Drhelpdesk, you save at every step! On diagnostic tests, get up to 70% OFF on various tests and test packages.</div>
				</div>
			</div>
		</div>
		<div class="block-space block-space--layout--divider-xl"></div>
		<div class="row">
			<div class="col-md-5">
				<div class="_1RHQr">
					<img alt="footer_mobile" src="{{asset('UI/images/DHD02.png')}}">
				</div>
			</div>
			<div class="col-md-7">
				<div>
					<div>Download the App for Free</div>
					<div class="_19UrT"><a href="https://app.appsflyer.com/com.phonegap.rxpal?c=Footer&amp;pid=Web" class="_3G8YN" target="_blank" rel="noopener noreferrer"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/3380aedc.png" alt="Google Play" class="iQq1x"><div class="Ut8SA">Google Play</div></a><a href="https://app.appsflyer.com/id982432643?c=Footer&amp;pid=Web" class="_3G8YN" target="_blank" rel="noopener noreferrer"><img src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/9bf5c576.png" alt="App Store" class="iQq1x"><div class="Ut8SA">App Store</div></a></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>