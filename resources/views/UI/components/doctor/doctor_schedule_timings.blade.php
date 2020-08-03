<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/ ')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Breadcrumb</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Current Page</span>
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
		<div class="row"> 
			@include('UI/components/doctor/doctor_sidebar') 
			<div class="col-md-7 col-lg-8 col-xl-9"> 
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Schedule Timings</h4>
								<div class="profile-box">
									<div class="row">
										<div class="col-lg-4">
											<div class="form-group">               
												<label>Timing Slot Duration</label>
												<select class="select form-control" name="time_slot" id="slot">
													<option>-</option>
													<option value="5">5 mins</option>
													<option selected="selected" value="10">10 mins</option>  
													<option value="15">15 mins</option>
													<option value="60">1 Hour</option>
												</select>
											</div>
										</div>

									</div>     
									<div class="row">
										<div class="col-md-12">
											<div class="card schedule-widget mb-0">
											
												<!-- Schedule Header -->
												<div class="schedule-header">
												
													<!-- Schedule Nav -->
													<div class="schedule-nav">
														<ul class="nav nav-tabs nav-justified">
															@php
																$day_of_week = array
																(
																	0 => 'monday',
																	1 => 'tuesday',
																	2 => 'wednesday',
																	3 => 'thursday',
																	4 => 'friday',
																	5 => 'saturday',
																	6 => 'sunday'
																);
															@endphp
															@foreach ($day_of_week as $item)
															<li class="nav-item">
																<a class="nav-link @if($item=='monday') active @endif" data-toggle="tab" href="#slot_{{$item}}">{{$item}}</a>
															</li>
															@endforeach
															{{-- <li class="nav-item">
																<a class="nav-link active" data-toggle="tab" href="#slot_monday">Monday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#slot_tuesday">Tuesday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#slot_wednesday">Wednesday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#slot_thursday">Thursday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#slot_friday">Friday</a>
															</li>
															<li class="nav-item">
																<a class="nav-link" data-toggle="tab" href="#slot_saturday">Saturday</a>
															</li> --}}
														</ul>
													</div>
													<!-- /Schedule Nav -->
													
												</div>
												<!-- /Schedule Header -->
												
												<!-- Schedule Content -->
												<div class="tab-content schedule-cont">
												   @php
												   if($result->count()>0){
													   foreach ($result as $key => $value) {
														  $day[]=$value->day_of_the_week;
														  $dayData[$value->day_of_the_week]= $value;
													   }
													}
													else{
												    	$day=[];
													}
												   @endphp
													@foreach ($day_of_week as $item)
													@if (in_array($item,$day))
														<div id="slot_{{$item}}" class="tab-pane fade @if($item=='monday') show active @endif">
															<h4 class="card-title d-flex justify-content-between">
																<span>Time Slots</span> 
																<a class="edit-link editslot" href="javascript:void(0);"  data-time="{{$item}}" data-id="edit_time_slot_{{$item}}"><i class="fa fa-edit mr-1"></i>Edit</a>
															</h4>
															
															<!-- Slot List -->
															<div class="doc-times">
																<div class="doc-slot-list">
																	{{date('h: i A',strtotime($dayData[$item]->m_start_time))}} - {{date('h: i A',strtotime($dayData[$item]->m_end_time))}}
																	<a href="javascript:void(0)" class="delete_schedule">
																		<i class="fa fa-times"></i>
																	</a>
																</div>
																<div class="doc-slot-list">
																	{{date('h: i A',strtotime($dayData[$item]->e_start_time))}} - {{date('h: i A',strtotime($dayData[$item]->e_end_time))}}
																	<a href="javascript:void(0)" class="delete_schedule">
																		<i class="fa fa-times"></i>
																	</a>
																</div>
																{{-- <div class="doc-slot-list">
																	3:00 pm - 5:00 pm
																	<a href="javascript:void(0)" class="delete_schedule">
																		<i class="fa fa-times"></i>
																	</a>
																</div>
																<div class="doc-slot-list">
																	6:00 pm - 11:00 pm
																	<a href="javascript:void(0)" class="delete_schedule">
																		<i class="fa fa-times"></i>
																	</a>
																</div>  --}}
															</div>
															<!-- /Slot List -->
															
														</div>
													@else
														<div id="slot_{{$item}}" class="tab-pane fade @if($item=='monday') show active @endif">
															<h4 class="card-title d-flex justify-content-between">
																<span>Time Slots</span> 
																<a class="edit-link addslot" href="javascript:void(0);" data-time="{{$item}}"  data-id="add_time_slot_{{$item}}"><i class="fa fa-plus-circle"></i> Add Slot</a>
															</h4>
															<p class="text-muted mb-0">Not Available</p>
														</div>
													@endif		
													@endforeach
												   {{-- @endforeach --}}
													<!-- Sunday Slot -->
													{{-- @foreach ($day_of_week as $item)
													<div id="slot_{{$item}}" class="tab-pane fade">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
														    <a class="edit-link" data-toggle="modal" href="#add_time_slot_{{$item}}"><i class="fa fa-plus-circle"></i> Add Slot</a>
														</h4>
														<p class="text-muted mb-0">Not Available</p>
													</div>
													@endforeach --}}
													<!-- /Sunday Slot -->

													<!-- Monday Slot -->
													{{-- <div id="slot_monday" class="tab-pane fade show active">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
															<a class="edit-link" data-toggle="modal" href="#edit_time_slot"><i class="fa fa-edit mr-1"></i>Edit</a>
														</h4>
														
														<!-- Slot List -->
														<div class="doc-times">
															<div class="doc-slot-list">
																8:00 pm - 11:30 pm
																<a href="javascript:void(0)" class="delete_schedule">
																	<i class="fa fa-times"></i>
																</a>
															</div>
															<div class="doc-slot-list">
																11:30 pm - 1:30 pm
																<a href="javascript:void(0)" class="delete_schedule">
																	<i class="fa fa-times"></i>
																</a>
															</div>
															<div class="doc-slot-list">
																3:00 pm - 5:00 pm
																<a href="javascript:void(0)" class="delete_schedule">
																	<i class="fa fa-times"></i>
																</a>
															</div>
															<div class="doc-slot-list">
																6:00 pm - 11:00 pm
																<a href="javascript:void(0)" class="delete_schedule">
																	<i class="fa fa-times"></i>
																</a>
															</div>
														</div>
														<!-- /Slot List -->
														
													</div>
													<!-- /Monday Slot -->

													<!-- Tuesday Slot -->
													<div id="slot_tuesday" class="tab-pane fade">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
															<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
														</h4>
														<p class="text-muted mb-0">Not Available</p>
													</div>
													<!-- /Tuesday Slot -->

													<!-- Wednesday Slot -->
													<div id="slot_wednesday" class="tab-pane fade">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
															<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
														</h4>
														<p class="text-muted mb-0">Not Available</p>
													</div>
													<!-- /Wednesday Slot -->

													<!-- Thursday Slot -->
													<div id="slot_thursday" class="tab-pane fade">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
															<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
														</h4>
														<p class="text-muted mb-0">Not Available</p>
													</div>
													<!-- /Thursday Slot -->

													<!-- Friday Slot -->
													<div id="slot_friday" class="tab-pane fade">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
															<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
														</h4>
														<p class="text-muted mb-0">Not Available</p>
													</div>
													<!-- /Friday Slot -->

													<!-- Saturday Slot -->
													<div id="slot_saturday" class="tab-pane fade">
														<h4 class="card-title d-flex justify-content-between">
															<span>Time Slots</span> 
															<a class="edit-link" data-toggle="modal" href="#add_time_slot"><i class="fa fa-plus-circle"></i> Add Slot</a>
														</h4>
														<p class="text-muted mb-0">Not Available</p>
													</div> --}}
													<!-- /Saturday Slot -->

												</div>
												<!-- /Schedule Content -->
												
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
					
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->

<!-- Add Time Slot Modal -->
   @foreach ($day_of_week as $item)
	<div class="modal fade custom-modal" id="add_time_slot_{{$item}}">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Add Time Slots</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{url('doctor-schedule-submit')}}" enctype="multipart/form-data" method="POST"> 
						@csrf
						<div class="hours-info">
							<input type="hidden" id="timing_{{$item}}" name="t_slot">
							<input type="hidden" value="{{$item}}" id="day_of_the_week" name="day_of_the_week">
							<div class="row form-row hours-cont">
								<div class="col-12 col-md-10">
									<div class="row form-row">
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Morning Start Time</label>
												<input type="time" class="form-control" name="m_start_time">
											</div> 
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Morning End Time</label>
												<input type="time" class="form-control" name="m_end_time">
											</div> 
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Evening Start Time</label>
												<input type="time" class="form-control" name="e_start_time">
											</div> 
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Evening End Time</label>
												<input type="time" class="form-control" name="e_end_time">
											</div> 
										</div>
									</div>
								</div>
							</div>
						</div>
						
						{{-- <div class="add-more mb-3">
							<a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
						</div> --}}
						<div class="submit-section text-center">
							<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	@endforeach
<!-- /Add Time Slot Modal -->

<!-- Edit Time Slot Modal -->
@foreach ($result as $r)
	<div class="modal fade custom-modal" id="edit_time_slot_{{$r->day_of_the_week}}">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Time Slots</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="{{url('doctor-schedule-submit')}}" enctype="multipart/form-data" method="POST"> 
						@csrf
						<div class="hours-info">
							<input type="hidden" id="edit_timing_{{$r->day_of_the_week}}" name="t_slot">
							<input type="hidden" value="{{$r->day_of_the_week}}" id="day_of_the_week" name="day_of_the_week">
							<input type="hidden" value="{{$r->id}}" name="id">
							<div class="row form-row hours-cont">
								<div class="col-12 col-md-10">
									<div class="row form-row">
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Morning Start Time</label>
												<input type="time" class="form-control" value="{{$r->m_start_time}}" name="m_start_time">
											</div> 
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Morning End Time</label>
												<input type="time" class="form-control" value="{{$r->m_end_time}}" name="m_end_time">
											</div> 
										</div>
									</div>
								</div>
							</div>
							
							<div class="row form-row hours-cont">
								<div class="col-12 col-md-10">
									<div class="row form-row">
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Evening Start Time</label>
												<input type="time" class="form-control" value="{{$r->e_start_time}}" name="e_start_time">
											</div>
										</div>
										<div class="col-12 col-md-6">
											<div class="form-group">
												<label>Evening End Time</label>
												<input type="time" class="form-control" value="{{$r->e_end_time}}" name="e_end_time">
											</div>
										</div>
									</div>
								</div>
								{{-- <div class="col-12 col-md-2"><label class="d-md-block d-sm-none d-none">&nbsp;</label><a href="#" class="btn btn-danger trash"><i class="far fa-trash-alt"></i></a></div> --}}
							</div>
						</div>
						
						{{-- <div class="add-more mb-3">
							<a href="javascript:void(0);" class="add-hours"><i class="fa fa-plus-circle"></i> Add More</a>
						</div> --}}
						<div class="submit-section text-center">
							<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
@endforeach
<!-- /Edit Time Slot Modal -->
@section('extra-script')
<script type="text/javascript">
	$(document).ready(function(){
		$('.addslot').click(function(){
			var time_slot=document.getElementById('slot').value;
			document.getElementById('timing_'+$(this).attr('data-time')).value=time_slot;
			$('#'+$(this).attr('data-id')).modal({show: true});
	
		});
		$('.editslot').click(function(){
			var time_slot=document.getElementById('slot').value;
			document.getElementById('edit_timing_'+$(this).attr('data-time')).value=time_slot;
			$('#'+$(this).attr('data-id')).modal({show: true});
	
		});
	});		
</script>	
@endsection
