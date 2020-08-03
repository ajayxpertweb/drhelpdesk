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
				<div class="alltest-box">
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
				</div>
				<div class="block-space block-space--layout--divider-xs"></div>
				<ul class="nav nav-tabs" role="tablist">
				  <li class="nav-item">
				    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Test Requirement</a>
				  </li>
				  <li class="nav-item">
				    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Description</a>
				  </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="profile" style="opacity: inherit;">
				  	<div>
				  		<p><!-- Sample Type: <strong>Blood</strong></p>
				  		<p>Fasting Required: <strong>Not Required</strong> -->
				  			{!!$test->short_description!!} 
				  		</p>
				  	</div>

				  </div>
				  <div role="tabpanel" class="tab-pane fade" id="buzz">
				  	{!!$test->long_description!!}
				  	<!-- <p style="font-size: 14px;">17 OHP along with Cortisol and Androstenedione constitutes the best screening test for Congenital adrenal hyperplasia caused by either 11 or 21 hydroxylase deficiency. It is also useful to evaluate females with hirsutism and infertility.</p> -->
				  </div>
				  <div role="tabpanel" class="tab-pane fade" id="references">ccc</div>
				</div>
			</div>
			<div class="col-md-5">
				<div>
					<h5 class="_2zKF7">Order Summary</h5>
					<div class=""><div class="_31z1j">Please select a test to proceed<button class="_2FE4Z _2Jc-Z _2Jc-Z ZHQJn _2N8KX _3LBfS">View Cart</button></div></div>
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