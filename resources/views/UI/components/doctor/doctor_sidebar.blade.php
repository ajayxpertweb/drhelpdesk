<div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar"> 
	<!-- Profile Sidebar -->
	<div class="profile-sidebar">
		@if(Auth::check())
            <?php
              $image = DB::table('user_details')->where('user_id',Auth::user()->id)->first();
            ?>
		<div class="widget-profile pro-widget-content">
			<div class="profile-info-widget">
				<a class="booking-doc-img">
			    	@if(file_exists(asset($image->image)))
                        <img  src="{{asset($image->image)}}" alt="User Image">
                    @elseif($image->image == null)
                        <img  src="{{asset('upload/userdetails/profile1568027001.jpeg	')}}" alt="User Image">
                    @else 
                        <img  src="{{asset('upload/userdetails/profile1568027001.jpeg	')}}" alt="User Image">
                    @endif   
				</a>
				<div class="profile-det-info">
					<h3>{{Auth::user()->name}}</h3> 
					<div class="patient-details">
						<h5 class="mb-0">{{$image->degree}}</h5>
					</div>
				</div>
			</div>
		</div>
		<div class="dashboard-widget">
			<nav class="dashboard-menu">
			    <?php
			        $url = $_SERVER['REQUEST_URI'];
			        $exploded_url = explode("/", $url);
			        $current_url = end($exploded_url);
			    ?>
				<ul>
				    <?php
				    if($current_url=='doctor-dashboard') {
					echo '<li class="active">';
				    } else {
				     echo '<li>';
				    }
					?>
						<a href="{{url('doctor-dashboard')}}">
							<i class="fas fa-columns"></i>
							<span>Dashboard</span>
						</a>
					</li>
					<?php
					    if($current_url=='doctor-appointment') {
						echo '<li class="active">';
					    } else {
					     echo '<li>';
					    }
					?>
						<a href="{{url('doctor-appointment')}}"> 
							<i class="fas fa-calendar-check"></i>
							<span>Appointments</span> 
						</a> 
					</li> 
					
					<!--<li>-->
					<!--	<a href="{{url('doctor-schedule-timing')}}">-->
					<!--		<i class="fas fa-hourglass-start"></i>-->
					<!--		<span>Schedule Timings</span>-->
					<!--	</a>-->
					<!--</li>-->
					{{-- <li>
						<a href="{{url('doctor-invoices')}}">
							<i class="fas fa-file-invoice"></i>
							<span>Invoices</span>
						</a>
					</li> --}}
					 <?php
				    if($current_url=='doctor-review') {
					echo '<li class="active">';
				    } else {
				     echo '<li>';
				    }
					?>
						<a href="{{url('doctor-review')}}">
							<i class="fas fa-star"></i>
							<span>Reviews</span>
						</a>
					</li>
					<!--<li>-->
					<!--	<a href="{{url('doctor-chat')}}">-->
					<!--		<i class="fas fa-comments"></i>-->
					<!--		<span>Message</span>-->
					<!--		<small class="unread-msg">23</small>-->
					<!--	</a>-->
					<!--</li>-->
					<?php
				    if($current_url=='doctor-profile-setting') {
					echo '<li class="active">';
				    } else {
				     echo '<li>';
				    }
					?>
						<a href="{{url('doctor-profile-setting')}}">
							<i class="fas fa-user-cog"></i>
							<span>Profile Settings</span>
						</a>
					</li>
				<?php
				    if($current_url=='doctor-clinic-setting') {
					echo '<li class="active">';
				    } else {
				     echo '<li>';
				    }
					?>
						<a href="{{url('doctor-clinic-setting')}}">
							<i class="fas fa-user-cog"></i>
							<span>Clinic Settings</span>
						</a>
					</li>
					
					<?php
				    if($current_url=='doctor-change-password') {
					echo '<li class="active">';
				    } else {
				     echo '<li>';
				    }
					?>
						<a href="{{url('doctor-change-password')}}">
							<i class="fas fa-lock"></i>
							<span>Change Password</span>
						</a>
					</li>
				<?php
				    if($current_url=='logout') {
					echo '<li class="active">';
				    } else {
				     echo '<li>';
				    }
					?>
						<a href="{{ route('logout') }}" onclick="event.preventDefault();
				            document.getElementById('logout-form').submit();">
				            <i class="fas fa-sign-out-alt"></i>
							<span>Logout</span>
			          	</a>
			          	<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
			            	{{ csrf_field() }}
			          	</form> 
					</li>
				</ul>
			</nav>
		</div>
		@endif
	</div>
	<!-- /Profile Sidebar --> 
</div> 