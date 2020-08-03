
<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<!--<li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Breadcrumb</a>
					</li>-->
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Doctor Credit History</span>
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
		<div class="row">
			@include('UI/components/doctor/doctor_sidebar')
			<div class="col-md-7 col-lg-8 col-xl-9"> 
				<div class="row">
					<div class="col-md-12">
						<h4 class="mb-4">Patient Consultation Credit</h4>
						<div class="appointment-tab">  
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
															<th>Consultation Credit</th>
														</tr>
													</thead>
													<tbody>
														<?php $count = 1; ?>
        												@foreach($consult_credit as $r)
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
																	{{$r->consultation_credit}} 
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