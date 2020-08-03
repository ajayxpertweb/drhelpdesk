@include('UI/components/doctor/doctor_breadcrumb') 
<!-- Page Content -->
<div class="content">
	<div class="container"> 
		@if(session('msg') != null)
            <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('msg')}}
            </div>
        @endif 
		<div class="row">
			@include('UI/components/doctor/doctor_sidebar')
			<div class="col-md-7 col-lg-8 col-xl-9"> 
				<div class="row">
					<div class="col-md-12">
						<div class="card dash-card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12 col-lg-3">
										<a href="{{url('/doctor-appointment')}}">
											<div class="dash-widget dct-border-rht">
												<div class="circle-bar circle-bar1">
													<div class="circle-graph1" data-percent="75">
														<img src="{{asset('UI/images/icon-01.png')}}" class="img-fluid" alt="patient">
													</div>
												</div>
												<div class="dash-widget-info">
													<h6>Total Patient</h6>
													<h3 class="text-center">{{$appointment->count()}}</h3>
													<!-- <p class="text-muted">Till Today</p> -->
												</div>
											</div>
										</a>
									</div>
									
									<div class="col-md-12 col-lg-3">
										<a href="{{url('/doctor-review')}}">
											<div class="dash-widget dct-border-rht">
												<div class="circle-bar circle-bar2">
													<div class="circle-graph2" data-percent="65">
														<img src="{{asset('UI/images/icon-02.png')}}" class="img-fluid" alt="Patient">
													</div>
												</div>
												<div class="dash-widget-info">
													<h6>Total User Ratings</h6>
													<h3 class="text-center">{{$rating}}</h3>
													<!-- <p class="text-muted">{{ date('d-m-Y') }}</p> -->
												</div>
											</div>
										</a>
									</div>
									
									<div class="col-md-12 col-lg-3">
										<a href="{{url('/doctor-review')}}">
											<div class="dash-widget">
												<div class="circle-bar circle-bar3">
													<div class="circle-graph3" data-percent="50">
														<img src="{{asset('UI/images/icon-03.png')}}" class="img-fluid" alt="Patient">
													</div>
												</div>
												<div class="dash-widget-info">
													<h6>Recommendations</h6>
													<h3 class="text-center">{{$recommendation}} %</h3> 
												</div>
											</div>
										</a>
									</div> 
									<div class="col-md-12 col-lg-3">
										<a href="{{url('/doctor-review')}}">
											<div class="dash-widget">
												<div class="circle-bar circle-bar3">
													<div class="circle-graph3" data-percent="50">
														<img src="{{asset('UI/images/icon-03.png')}}" class="img-fluid" alt="Patient">
													</div>
												</div>
												<div class="dash-widget-info">
													<h6>Feedbacks</h6>
													<h3 class="text-center">{{$feedbacks->count()}}</h3> 
												</div>
											</div>
										</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div> 
				<div class="row">
					<div class="col-md-12">
						<h4 class="mb-4">Patient Appoinment</h4>
						<div class="appointment-tab"> 
							<!-- Appointment Tab -->
							<ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
								<li class="nav-item">
									<a class="nav-link active" data-toggle="tab">Patient Details</a>
								</li> 
							</ul>
							<!-- /Appointment Tab --> 
							<div class="tab-content"> 
								<!-- Upcoming Appointment Tab -->
								<div class="tab-pane show active" id="upcoming-appointments">
									<div class="card card-table mb-0">
										<div class="card-body">
											<div class="table-responsive">
												<table class="table table-hover table-center mb-0">
													<thead>
														<tr>
															<th>S.No.</th>
															<th>Patient Image</th>
															<th>Patient Name</th> 
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php $count = 1; ?>
        												@foreach($appointment as $r)
        													<?php 
        														$p = DB::table('user_details')->where('user_id',$r->user_id)->first(); 
        													?> 
															<tr>
																<td>
																	{{$count++}}
																</td>
																<td>
																	<h2 class="table-avatar">
																		<a  class="avatar avatar-sm mr-2">
																			@if(file_exists(asset($p->image)))
																                <img class="avatar-img rounded-circle" src="{{asset($p->image)}}" alt="User Image">
																            @elseif($p->image == null)
																                <img class="avatar-img rounded-circle" src="{{asset('UI/images/user_icon.png')}}" alt="User Image">
																            @else 
																                <img class="avatar-img rounded-circle" src="{{asset('UI/images/user_icon.png')}}" alt="User Image">
																            @endif  
																		</a> 
																	</h2>
																</td>
																<td> 
																	{{$p->user_name}} 
																</td>
																 
																<td>
																	<div class="table-action">
																		<a href="{{url('/doctor-consult-history/'.$r->user_id)}}" class="btn btn-sm btn-primary" >
																			<i class="far fa-eye"></i> View Consult History
																		</a>
																		<a href="{{url('/doctor-credit-history/'.$r->user_id)}}" class="btn btn-sm btn-success" >
																			<i class="far fa-eye"></i> View Credit History
																		</a> 
																	</div>
																</td>
															</tr>
														@endforeach 
														 
													</tbody>
												</table>		
											</div>
										</div>
									</div>
								</div>
								<!-- /Upcoming Appointment Tab --> 
							</div>
						</div>
					</div>
				</div> 
			</div>
		</div> 
	</div> 
</div>		
<!-- /Page Content -->