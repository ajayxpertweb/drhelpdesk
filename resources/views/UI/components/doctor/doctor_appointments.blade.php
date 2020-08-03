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
						<h4 class="mb-4">Patient Appoinment</h4>
						<div class="appointment-tab"> 
							<!-- Today Appointment Tab -->
							<div  class="all-appointments">
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
						</div>
						<!-- /Today Appointment Tab -->
					</div>
				</div>
			</div> 
		</div>
	</div> 
</div>

</div>		
<!-- /Page Content -->