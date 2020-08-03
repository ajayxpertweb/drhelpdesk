
<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--parent"><a class="breadcrumb__item-link">Doctor Page</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Doctor Details</span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>

<!-- Page Content -->
<div class="content">
	<div class="container"> 
		@if(session('msg') != null)
	      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
	        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	        {{session('msg')}}
	      </div>
	    @endif
         <style type="text/css">

#sidebar { float: right; width: 30%; }
#main { padding-right: 15px; }
.infoWindow { width: 220px; }
</style>   
            

<!-- The Modal -->
<div class="modal fade" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Direction</h4>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
       <div id="map">Comming Soon</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>
            
            
            
		<!-- Doctor Widget -->
		<div class="card">
			<div class="card-body">
				<div class="doctor-widget">
					<div class="doc-info-left">
						<div class="doctor-img">
							<img src="{{asset($doctor->image)}}" class="img-fluid" alt="User Image">
						</div>
						<div class="doc-info-cont">
							<h4 class="doc-name">Dr. {{$doctor->user_name}}</h4>
							<p class="doc-speciality">{{$doctor->degree}}</p>
							@if($doctor->department_icon != null)
									<img src="{{asset($doctor->department_icon)}}" class="img-fluid" alt="Speciality">
							@endif
							{{$doctor->department_name}}
							<div class="rating">
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star filled"></i>
								<i class="fas fa-star"></i>
								<span class="d-inline-block average-rating">({{$feedbacks->count()}})</span>
							</div>
							<div class="clinic-details">
								<p class="doc-location"><i class="fas fa-map-marker-alt"></i>{{$doctor->address}}  ,{{$doctor->city}} {{$doctor->state}} ,{{$doctor->country}} -{{$doctor->pin_code}}  <a  data-toggle="modal" style=" display:none;cursor:pointer" data-target="#myModal">Get Direction</a></p>
								<ul class="clinic-gallery">
									@if($doctor->clinic_image_one != null)
									<li>
										<a href="{{asset($doctor->clinic_image_one)}}" data-fancybox="gallery">
											<img src="{{asset($doctor->clinic_image_one)}}" alt="Feature">
										</a>
									</li>
									@endif
									@if($doctor->clinic_image_two != null)
									<li>
										<a href="{{asset($doctor->clinic_image_two)}}" data-fancybox="gallery">
											<img src="{{asset($doctor->clinic_image_two)}}" alt="Feature">
										</a>
									</li>
									@endif
									@if($doctor->clinic_image_three != null)
									<li>
										<a href="{{asset($doctor->clinic_image_three)}}" data-fancybox="gallery">
											<img src="{{asset($doctor->clinic_image_three)}}" alt="Feature">
										</a>
									</li>
									@endif
									@if($doctor->clinic_image_four != null)
									<li>
										<a href="{{asset($doctor->clinic_image_four)}}" data-fancybox="gallery">
											<img src="{{asset($doctor->clinic_image_four)}}" alt="Feature">
										</a>
									</li> 
									@endif
								</ul>
							</div>
							<div class="clinic-services">
								<span>Dental Fillings</span>
								<span>Teeth Whitneing</span>
							</div>
						</div>
					</div>
					<div class="doc-info-right">
						<div class="clini-infos">
							<ul><?php
                                                            $fper = 0;
                                                                                $posFeddback = DB::table('doctor_feedbacks')->where('doctor_id',$doctor->user_details_id)->where('recommendation','yes')->get(); 
                                                                                if($posFeddback->count()>0 && $feedbacks->count()>0){
                                                                                $fper= ($posFeddback->count()*100)/$feedbacks->count();    
                                                                                }
                                                                                ?>
								<li><i class="far fa-thumbs-up"></i> {{round($fper,2)}}%</li>
								<li><i class="far fa-comment"></i> {{$feedbacks->count()}} Feedback</li>
								@if($doctor->consultation_fees != null)		
								<li><i class="far fa-money-bill-alt"></i> <span class="fas fa-rupee-sign"></span>{{$doctor->consultation_fees}} </li>
								@endif
							</ul>
						</div>
						@if($is_has_credit)
						<div class="doctor-action">										
							<a href="#" class="btn btn-white msg-btn" title="You can consult {{$consultation_credit}} times">
								<i class="far fa-comment-alt"></i>
							</a>
							<div class="align-items-center" id="calling" style="display: none;">
								<strong>Loading...</strong>
								<div class="spinner-border ml-auto" role="status" aria-hidden="true"></div>
							</div>
							<a href="javascript:void(0)" class="btn btn-white call-btn" data-consult_call="{{$consult_call}}" data-toggle="modal" title="You can consult {{$consultation_credit}} times" id="voice_call">
								<i class="fas fa-phone"></i>
							</a>
							<!--<a href="javascript:void(0)" class="btn btn-white call-btn" data-toggle="modal" data-target="#video_call">
								<i class="fas fa-video"></i>
							</a>-->
						</div>
						@endif
						<div class="clinic-booking">
							@if(Auth::check())
							@if(!$is_doc_has_credit)
							    <div>Doctor is not avaiable for Consult</div>
							@elseif(!$is_has_credit && $is_has_amount)
							<a class="apt-btn" href="javascript:void(0)" id="consult_now_credit" data-consult_ids = "{{$user_id.'#'.$doc_id}}">Consult Now</a>
							@elseif(!$is_has_credit)
							<a class="apt-btn" href="javascript:void(0)" id="consult_now" data-toggle="modal" data-target="#consult_now_wallet">Consult Now</a>
							@endif
						@else
							<a class="apt-btn" href="javascript:void(0);" data-toggle="modal" data-doc_id="{{$doctor->user_id}}" data-target="#consult_now_login" id="consult_now_add">Consult Now</a>
						@endif
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- /Doctor Widget -->
		
		<!-- Doctor Details Tab -->
		<div class="card">
			<div class="card-body pt-0">
			
				<!-- Tab Menu -->
				<nav class="user-tabs mb-4">
					<ul class="nav nav-tabs nav-tabs-bottom nav-justified">
						<li class="nav-item">
							<a class="nav-link active" href="#doc_overview" data-toggle="tab">Overview</a>
						</li>									
						<li class="nav-item">
							<a class="nav-link" href="#doc_reviews" data-toggle="tab">Reviews</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#doc_business_hours" data-toggle="tab">Business Hours</a>
						</li>
					</ul>
				</nav>
				<!-- /Tab Menu -->
				
				<!-- Tab Content -->
				<div class="tab-content pt-0">
				
					<!-- Overview Content -->
						<div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
							<div class="row">
								<div class="col-md-12 col-lg-9">
								
									<!-- About Details -->
									<div class="widget about-widget">
										<h4 class="widget-title">About Me</h4>
										{!!$doctor->description!!}
									</div>
									<!-- /About Details -->
								

									
									<!-- Services List -->
									<div class="service-list">
										<h4>Services</h4>
										<ul class="clearfix">
											{!!$doctor->service!!}
										</ul>
									</div>
									<!-- /Services List -->
									
									<!-- Specializations List -->
									<div class="service-list">
										<h4>Specializations</h4>
										<ul class="clearfix">
											{!!$doctor->service!!}
										</ul>
									</div>
									<!-- /Specializations List -->

								</div>
							</div>
						</div>
					<!-- /Overview Content --> 
					<!-- Reviews Content -->
						<div role="tabpanel" id="doc_reviews" class="tab-pane fade"> 
							<!-- Review Listing -->
							<form action="{{url('/feedback')}}" method="post" enctype="multipart/form-data">
								@csrf
								<div class="widget review-listing"> 
									<ul class="comments-list">  
										<!-- Comment List -->
										<?php
										$ee = 0;
										?>
										@foreach($feedbacks as $r)
										@if(Auth::id() == $r->user_id)
										    @php 
										    $ee = 1;
										    @endphp
										@endif
											<?php
												$user = DB::table('users')->where('id',$r->user_id)->pluck('name')->first();
												$user1 = DB::table('user_details')->where('user_id',$r->user_id)->pluck('image')->first();	
											?>
										<li>
											<div class="comment">
											    <?php
											    if (file_exists($user1)) {?>
											    
											    <img class="avatar avatar-sm rounded-circle" alt="Image" src="{{asset($user1)}}">    
											    <?php
											        
											    }
											    ?>
												
												<div class="comment-body">
													<div class="meta-data">
														<span class="comment-author">
														    <div>
														        <h4>{{$user}}</h4>
														    </div>
														    </span>
														<span class="comment-date">
														    <?php
														    $ex = explode(" ",$r->created_at);
														    $timestamp = strtotime($ex['0']);
														    $new_date = date("d-m-Y", $timestamp);
														    ?>
														    
														    {{$new_date}}</span>
														<div style="right: -49px;" class="review-count rating"> 
															{!! str_repeat('<i class="fa fa-star" aria-hidden="true" style="color:#ffd333;"></i>', $r->rating) !!}
	                    									{!! str_repeat('<i class="fa fa-star-o" aria-hidden="true" style="color:#ffd333;"></i>', 5 - $r->rating) !!} 
														</div>
													</div>
													<p class="recommended">
														@if($r->recommendation == 'yes')
															<i class="far fa-thumbs-up"></i> I recommend the doctor
														@endif
                                                                                                                @if($r->recommendation == 'no')
															<i class="far fa-thumbs-down"></i> I don't recommend the doctor
														@endif
													</p>
													<p class="comment-content">
                                                                                                        <h6>{{$r->feedback}}:</h6><br>
                                                                                                        <i>{{$r->comment}}</i></p>
                                                                                                   
													
													<div class="comment-reply">
														<!--<a class="comment-btn" href="#">-->
														<!--	<i class="fas fa-reply"></i> Reply-->
														<!--</a><br>-->
														<br>
                                                                                                                
                                                                                                             @if(Auth::id() == $r->user_id)
                                                                                                              @if($r->recommendation == null)
                                                                                                                 <p class="recommend-btn">
														<span>Recommend?</span>
														
                                                                                                                <button type="button" name="{{$r->id}}" class="like-btn recbutton preload" value = "yes">
															<i class="far fa-thumbs-up"></i> Yes
														</button>
														<button type="button" name="{{$r->id}}" class="dislike-btn recbutton preload" value="no">
															<i class="far fa-thumbs-down"></i> No
														</button>
													</p>
                                                                                                             @endif
                                                                                                             @endif
													</div>
												</div>
											</div>  
										</li>
										@endforeach 
										<!-- /Comment List --> 
									</ul> 
									<!-- Show All -->
									<!--<div class="all-feedback text-center">-->
									<!--	<a href="#" class="btn btn-primary btn-sm">-->
									<!--		Show all feedback <strong>({{$feedbacks->count()}})</strong>-->
									<!--	</a>-->
									<!--</div> -->
									<!-- /Show All --> 
								</div>
								<!-- /Review Listing --> 
								<!-- Write Review -->
								@if($ee == 0)
								<div class="write-review">
									<h4>Write a review for <strong>Dr. {{$doctor->user_name}}</strong></h4>
									
									<!-- Write Review Form --> 
										<input type="hidden" name="doctor_id" value="{{$doctor->user_details_id}}">
										<div class="form-group">
											<label>Review</label>
											<div class="star-rating">
												<input id="star-5" type="radio" name="rating" value="5">
												<label for="star-5" title="5 stars">
													<i class="active fa fa-star"></i>
												</label>
												<input id="star-4" type="radio" name="rating" value="4">
												<label for="star-4" title="4 stars">
													<i class="active fa fa-star"></i>
												</label>
												<input id="star-3" type="radio" name="rating" value="3">
												<label for="star-3" title="3 stars">
													<i class="active fa fa-star"></i>
												</label>
												<input id="star-2" type="radio" name="rating" value="2">
												<label for="star-2" title="2 stars">
													<i class="active fa fa-star"></i>
												</label>
												<input required id="star-1" type="radio" name="rating" value="1">
												<label for="star-1" title="1 star">
													<i class="active fa fa-star"></i>
												</label>
											</div>
										</div>
										<div class="form-group">
											<label>Title of your review</label>
											<input class="form-control" required type="text" placeholder="If you could say it in one sentence, what would you say?" name="title">
										</div>
										<div class="form-group">
											<label>Your review</label>
											<textarea id="review_desc" required maxlength="100" class="form-control" name="feedback"></textarea>
										  
										  <!-- <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span id="chars">100</span> characters remaining</small></div> -->
										</div>
										<hr>
										<div class="form-group">
											<div class="terms-accept">
												<div class="custom-checkbox">
												   <input type="checkbox" required id="terms_accept">
												   <label for="terms_accept">I have read and accept <a href="{{url('term-conditions')}}">Terms &amp; Conditions</a></label>
												</div>
											</div>
										</div>
										<div class="submit-section">
											<button type="submit" class="btn btn-primary submit-btn">Add Review</button>
										</div> 
									<!-- /Write Review Form -->  
								</div>
								<!-- /Write Review --> 
                                                                <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}">
							@endif
							</form>
						</div>
					<!-- /Reviews Content -->
					
					<!-- Business Hours Content -->
						<div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
							<div class="row">
								<div class="col-md-6 offset-md-3">
								
									<!-- Business Hours Widget -->
									<div class="widget business-widget">
										<div class="widget-content">
											<div class="listing-hours">
												<div class="listing-day current">
													<div class="day">Today <span>5 Nov 2019</span></div>
													<div class="time-items">
														<span class="open-status"><span class="badge bg-success-light">Open Now</span></span>
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day">
													<div class="day">Monday</div>
													<div class="time-items">
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day">
													<div class="day">Tuesday</div>
													<div class="time-items">
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day">
													<div class="day">Wednesday</div>
													<div class="time-items">
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day">
													<div class="day">Thursday</div>
													<div class="time-items">
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day">
													<div class="day">Friday</div>
													<div class="time-items">
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day">
													<div class="day">Saturday</div>
													<div class="time-items">
														<span class="time">07:00 AM - 09:00 PM</span>
													</div>
												</div>
												<div class="listing-day closed">
													<div class="day">Sunday</div>
													<div class="time-items">
														<span class="time"><span class="badge bg-danger-light">Closed</span></span>
													</div>
												</div>
											</div>
										</div>
									</div>
									<!-- /Business Hours Widget -->
							
								</div>
							</div>
						</div>
					<!-- /Business Hours Content -->
					
				</div>
			</div>
		</div>
		<!-- /Doctor Details Tab --> 
	</div>
</div>		
<!-- /Page Content -->

<!--- Login Model Popup --->

<div class="modal fade" id="consult_now_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
	  <form method="POST" action="{{ url('user-login') }}" role="form"  class="account-menu__form" id="login_form" enctype="multipart/form-data">

                  @csrf

                  <div class="account-menu__form-title">Log In to Your Account</div>

                  <div class="form-group">

                    <label for="header-signin-email" class="sr-only">Email address</label>

                    <input id="header-signin-email" type="email" class="form-control @error('email') is-invalid @enderror form-control-sm" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> 

                    @error('email')

                        <span class="invalid-feedback" role="alert">

                            <strong>{{ $message }}</strong>

                        </span>

                    @enderror

                  </div>

                  <div class="form-group">

                    <label for="header-signin-password" class="sr-only">Password</label>

                    <div class="account-menu__form-forgot">

                      <input id="header-signin-password" type="password" class="form-control @error('password') is-invalid @enderror form-control-sm" placeholder="Password" name="password" required autocomplete="current-password"> <a href="{{url('/forget-password')}}" class="account-menu__form-forgot-link">Forgot?</a>

                      @error('password')

                          <span class="invalid-feedback" role="alert">

                              <strong>{{ $message }}</strong>

                          </span>

                      @enderror

                    </div>
                  </div>
                    <div class="form-group">
                      <div class="radio radio-inline mr-3">                      
                        <input type="radio" name="user_type" id="user" value="2" required>
                        <label for="user">User</label>
                      </div>
                      <div class="radio radio-inline">
                        <input type="radio" name="user_type" value="3" id="doctor" required>
                        <label for="doctor">Doctor</label>
                      </div>
                  </div> 

                  <div class="form-group account-menu__form-button">

                    <button type="submit" class="btn btn-primary btn-sm">Login</button>

                  </div>

                  <div class="account-menu__form-link"><a href="{{url('/registration')}}">Create An Account</a>

                  </div>

                </form>

      </div>
    </div>
  </div>
</div>



<!--- Wallet Model Popup --->

<div class="modal fade" id="consult_now_wallet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      
      <div class="modal-body">
	  <form method="POST" action="{{ url('wallet') }}" role="form"  class="account-menu__form" id="login_form" enctype="multipart/form-data">
	  <input type="hidden" id="doc_id" name="doc_id" value="{{!empty($doc_id) ? $doc_id:''}}">
		<input type="hidden" id="user_id" name="user_id" value="{{!empty($user_id) ? $user_id:''}}">
          @csrf

		<div class="account-menu__form-title">Add Amount</div>

		<div class="form-group">

		<label for="header-amount" class="sr-only">Amount</label>

		<input id="header-amount" type="number" class="form-control form-control-sm" placeholder="Amount" name="amount" value="" autofocus> 

		</div>

		<div class="form-group account-menu__form-button">

		<button type="submit" class="btn btn-primary btn-sm">Add</button>

		</div>
		</div>
		</form>

      </div>
    </div>
  </div>
</div>
