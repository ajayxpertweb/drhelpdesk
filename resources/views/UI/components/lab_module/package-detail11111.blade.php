<style>
    .bs-example{
        margin: 20px;
    }
    .accordion .fa{
        right: 20px;
        position: absolute;
    }
    .includelab li{
        font-size: 14px;
        list-style: none;
        margin-bottom: 5px;
    }
</style>
<div class="block-space block-space--layout--divider-xs"></div>
<div class="block block-brands block-brands--layout--columns-6-full">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
				<div class="row">
					<div class="col-md-12">
						<div class="float-left">
						<h3>Affordable Packages</h3>
						</div>
					</div>
				</div>
				
				@php  
                    $session = Session::getId();  
                    $data1=DB::table('temp_carts')->where('product_id',$pck['id'])->where('session_id',$session)->where('type',3)->first();  
                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',3)->get();  
	               
                    $discount = ($pck['offer_discount'] * $pck['package_cost']) / 100;
                    $discount1 = $pck['package_cost'] - $discount;

                    $package_id = array($pck['package']); 
                     
               @endphp
				
					<div class="alltest-box">
						<!--  -->
						<div>
							@if($pck['image'] == null) 
							@else
							<img class="_1xG27" src="{{asset($pck['image'])}}" alt="Package" width="150px">
							@endif 
							<div class="alltest-content">
                                                            <div class="alltest-heading"><a href="{{url('package-detail/'.$pck['id'])}}">{{$pck['package_name']}}</a></div>
								<!-- <div class="alltest-p">By Apple diagnostics by Ambrish Mehta </div> -->
								<div style="font-size: 10px;" class="">{{ $pck['short_disc']}} </div>
								<div class="tKMWl"></div>
								<div class="_3EF-x _3BZ_8">
								@if($pck['offer_discount'] == null)
				                   <span class="_3eI77">₹{{$pck['package_cost']}}</span> 
				                @else
				                    <span class="_3eI77">₹{{$discount1}}</span>				                    
				                    <span class="_20PV9">₹{{$pck['package_cost']}}</span>
				                    <span class="_3NghB">save {{$pck['offer_discount']}}%</span>
				                @endif
				                </div>  
							</div>
						</div>
						<!-- </a> -->
						@guest  
							@if($data1 == null)
							    @if(Session::get('location_name')!='notfound')
						 		<a href="{{url('package-add-cart/'.$pck['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 	    @else
						 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@endif
						 	@else
						 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
						 	@endif
						@else 
							@php
								$cart=DB::table('carts')->where('product_id',$pck['id'])->where('user_id',Auth::user()->id)->where('type',3)->first();  
								$check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',3)->get();   
							@endphp
							@if($cart==null)
							    @if(Session::get('location_name')!='notfound')
						 		<a href="{{url('package-add-cart/'.$pck['id'])}}" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 	    @else
						 		<a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Select</button></a>
						 		@endif
						 	@else
						 		<a  class="_2FE4Z _2Jc-Z _1JBjj _5YN3Z _7M65L" style="color:white;">Selected</button></a>
						 	@endif  
						@endif
					</div>
				
				 
			</div>
            <div class="col-md-7">
                
              
                <div class="block-space block-space--layout--divider-xs"></div>
                <div class="accordion" id="accordionExample">
                    <div class="card">
                        <div class="card-header" id="headingTwo" style="padding: 10px 30px;">
                            <h2 class="mb-0">
                                <button type="button" class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseTwo" style="color: black; font-weight: 700; font-size: 18px;"><i class="fa fa-plus"></i>Profile Includes following tests</button>
                            </h2>
                        </div>
                        <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                          <?php
                          
                           
?>                            <div class="card-body" style="padding: 0px 30px;">
                                <ul class="includelab">
                                    <?php
                                    $datas = explode(',',$pck['package']);
                                    foreach($datas as $data){
                           $testing = DB::table('products')->where('products_id',$data)->get();
                             
                                    ?>       
                                    <li>{{$testing[0]->product_name}}</li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" href="#profile" role="tab" data-toggle="tab">Description</a>
                  </li>
<!--                  <li class="nav-item">
                    <a class="nav-link" href="#buzz" role="tab" data-toggle="tab">Test Requirement</a>
                  </li>-->
                </ul>
 
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane fade in active" id="profile" style="opacity: inherit;">
                    <div>
                        <p>{{$pck['long_disc']}}</strong></p>
                       
                    </div>
                  </div>
                  <div role="tabpanel" class="tab-pane fade" id="buzz">
                    <p style="font-size: 14px;">Fever panel test is a group of tests performed to detect the reasons for fever. This test is preferred when an individual is suffering from long-term fever or chronic fever.</p>
                  </div>
                </div>
            </div>
            <div class="col-md-5">
                <div>
                    <h5 class="_2zKF7">Proceed To Cart</h5>
                    <div class=""><div class="_31z1j">Please select a Package to proceed</div>
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