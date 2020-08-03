@include('UI/components/doctor/doctor_breadcrumb') 

<!-- Page Content -->
<div class="content">
	<div class="container">

		<div class="row">
			@include('UI/components/doctor/doctor_sidebar')
			<?php
				$review = DB::table('doctor_feedbacks')->where('doctor_id',$feedbacks->user_details_id)->get(); 
			?>
			<div class="col-md-7 col-lg-8 col-xl-9">
				<h4 class="mb-4">Reviews</h4>
				<div class="doc-review review-listing"> 
					<!-- Review Listing -->
					<ul class="comments-list"> 
						<!-- Comment List -->
							@foreach($review as $r)
								<?php
									$user = DB::table('users')->where('id',$r->user_id)->pluck('name')->first();
									$user1 = DB::table('user_details')->where('user_id',$r->user_id)->pluck('image')->first();

									$dt = new DateTime($r->created_at);
									$tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

									$dt->setTimezone($tz);
									$start_date = $dt->format("d-m-Y H:i:s"); 
								?>
								<li>
									<div class="comment"> 
										@if(file_exists(asset($user1)))
							                <img class="avatar avatar-sm rounded-circle" src="{{asset($user1)}}" alt="User Image">
							            @elseif($user1 == null)
							                <img class="avatar avatar-sm rounded-circle" src="{{asset('UI/images/user_icon.png')}}" alt="User Image">
							            @else 
							                <img class="avatar avatar-sm rounded-circle" src="{{asset('UI/images/user_icon.png')}}" alt="User Image">
							            @endif  
										<div class="comment-body">
											<div class="meta-data">
												<span class="comment-author">{{$user}}</span>
												@if($r->created_at != null)
												<span class="comment-date">{{$start_date}}</span>
												@endif
												<div class="review-count rating"> 
													{!! str_repeat('<i class="fa fa-star" aria-hidden="true" style="color:#ffd333;"></i>', $r->rating) !!}
                									{!! str_repeat('<i class="fa fa-star-o" aria-hidden="true" style="color:#ffd333;"></i>', 5 - $r->rating) !!} 
												</div>
											</div>
											<p class="recommended">
												@if($r->recommendation == 'yes')
													<i class="far fa-thumbs-up"></i> I recommend the doctor
												@elseif($r->recommendation == 'no')
													<i class="far fa-thumbs-down"></i> I not recommend the doctor
												@else
												@endif
											</p>
											<p class="comment-content">
												{{$r->feedback}}
											</p>
											<!-- <div class="comment-reply">
												<a class="comment-btn" href="#">
													<i class="fas fa-reply"></i> Reply
												</a>
											   <p class="recommend-btn">
												<span>Recommend?</span>
												<a href="#" class="like-btn">
													<i class="far fa-thumbs-up"></i> Yes
												</a>
												<a href="#" class="dislike-btn">
													<i class="far fa-thumbs-down"></i> No
												</a>
											</p>
											</div> -->
										</div>
									</div>  
								</li>
							@endforeach
						<!-- /Comment List --> 
					</ul> 
				</div>
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->