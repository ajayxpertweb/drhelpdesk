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
			<?php
              	$image = DB::table('user_details')->where('user_id',Auth::user()->id)->first();
            ?>
            
			<div class="col-md-7 col-lg-8 col-xl-9"> 
				<form action="{{url('clinic-detail-submit')}}" method="post"  enctype="multipart/form-data">
					{{ csrf_field() }}  
					<input type="hidden" class="form-control"  name="user_details_id" value="{{$image->user_details_id}}"> 
					<input type="hidden" class="form-control" name="role_id" value="{{$image->role_id}}"> 
					<!-- Basic Information -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Clinic Information</h4>
							<div class="row form-row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Department Name<span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="department_name" value="{{$image->department_name}}">
									</div>
									<div class="form-group">
										<label>Department Icon</label><br>
										<img src="{{asset($image->department_icon)}}" style="width:100px;"><br><br>
										<input type="file" class="form-control" name="department_icon">  
									</div>  
									<div class="form-group">
										<label>Clinic Image 1</label><br>
										<img src="{{asset($image->clinic_image_one)}}" style="width:100px;"><br><br>
										<input type="file" class="form-control" name="clinic_image_one">  
									</div>  
									<div class="form-group">
										<label>Clinic Image 2</label><br>
										<img src="{{asset($image->clinic_image_two)}}" style="width:100px;"><br><br>
										<input type="file" class="form-control" name="clinic_image_two">  
									</div>  
									<div class="form-group">
										<label>Clinic Image 3</label><br>
										<img src="{{asset($image->clinic_image_three)}}" style="width:100px;"><br><br>
										<input type="file" class="form-control" name="clinic_image_three">  
									</div>  
									<div class="form-group">
										<label>Clinic Image 4</label><br>
										<img src="{{asset($image->clinic_image_four)}}" style="width:100px;"><br><br>
										<input type="file" class="form-control" name="clinic_image_four">  
									</div>  
								</div> 
							</div>
						</div>
					</div> 
					<div class="submit-section submit-btn-bottom">
						<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
					</div>
				</form>
			</div> 
		</div>

	</div>

</div>		
<!-- /Page Content -->