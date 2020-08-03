<div class="block-space block-space--layout--divider-xs"></div>
<div class="block block-brands block-brands--layout--columns-6-full"> 
	<div class="container">
		<div class="row">
			<div class="col-md-7">
				<div class="row">
					<div class="col-md-12">
						<div class="float-left">
						<h3>Lab Tests</h3>
						</div>
					</div>
				</div>
                            
				@php 
                                        
	                    $session = Session::getId();  
	                    $data1=DB::table('temp_carts')->where('product_id',$test['products_id'])->where('session_id',$session)->where('type',2)->first();  
	                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',2)->get();  
	                @endphp
                        
                        <?php
$per = 0;
if($test['special_price'] >0 && $test['price'] > 0){
    $s = $test['price'] - $test['special_price'];
    $per = round(($s*100)/$test['price'],2);
    $per = round($per,2);
    
}
                
                          
?>
    
					<div class="alltest-box">
						<!--  -->
						<div>
							@if($test['product_image'] == null)
                            <img class="alltest-img" src="{{asset('UI/images/lab.png')}}" alt="Test" width="150px">
							@else
							<img class="alltest-img" src="{{asset($test['product_image'])}}" alt="Test" width="150px">
							@endif
							<div class="alltest-content">
                                                            <div class="alltest-heading">{{ $test['product_name']}}</a></div>
								<div class="alltest-p">{!!$test->short_description!!}</div>
                                                                            <div class="_3EF-x _3BZ_8">
								@if($test['special_price'] == null)
                                                                <div class="alltest-h">₹{{$test->price}}</div> 
				                @else
				                    <span class="_3eI77">₹{{$test->special_price}}</span>				                    
				                    <span class="_20PV9">₹{{$test->price}}</span>
				                    <span class="_3NghB">save {{$per}}%</span>
				                @endif
                                                                    
                                                                    
                                                                    <div class="_1amQ5">onwards</div></div>
							
                                                        
                                                        </div>
						</div> 
						@guest  
							@if($data1 == null)
						 		@if(Session::get('location_name')!='notfound')
						 		<a href="{{url('cart-details/'.$test['products_id'].'/'.$test['categories'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@else
						 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@endif
						 	@else
						 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
						 	@endif
						@else 
							@php
							$cart=DB::table('carts')->where('product_id',$test['products_id'])->where('user_id',Auth::user()->id)->where('type',2)->first();  
							$check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',2)->get();   
							@endphp
							@if($cart==null)
								@if(Session::get('location_name')!='notfound')
						 		<a href="{{url('cart-details/'.$test['products_id'].'/'.$test['categories'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@else
						 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@endif
						 	@else
						 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
						 	@endif  
						@endif
					</div>
				
			
<!--				<div class="alltest-box">
					@php  
					$image = DB::table('product_images')->where('type',2)->where('products_id',$test->products_id)->first();  
					 
					@endphp
					<div>
						@if($image->product_image == null)

						@else
						<img class="alltest-img" src="{{asset($image->product_image)}}" alt="Test">
						@endif
						<div class="alltest-content alltest-content-details">
							<div class="alltest-heading">{{$test->product_name}}</div>
							<div class="alltest-p">Available at 10 certified labs</div>
							<div class="alltest-h">₹{{$test->price}}<div class="_1amQ5">onwards</div></div>
						</div>
					    <button class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L alltest-select">Select</button>
					</div>
				</div>-->
				<div class="block-space block-space--layout--divider-xs"></div>
				<ul class="nav nav-tabs" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Description</a>
				  </li>
				 
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="profile" style="opacity: inherit;">
				  	<div>
				  		<p>
				  			 {!!$test->long_description!!}
				  		</p>
				  	</div>

				  </div>
				 
				  <div role="tabpanel" class="tab-pane fade" id="references">ccc</div>
				</div>
			</div>
			<div class="col-md-5">
				<div>
					<h5 class="_2zKF7">Proceed To Cart</h5>
					<div class=""><div class="_31z1j">Please select a test to proceed</div>
					<a href="{{url('/my-cart')}}"  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">View</a>  
					</div> 
				
				</div>
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