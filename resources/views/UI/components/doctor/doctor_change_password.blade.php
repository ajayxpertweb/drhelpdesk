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
				<h4 class="mb-4">Change Password</h4>
				<div class="card">
					<div class="card-body">
						<div class="row">
							<div class="col-md-12 col-lg-6">
							
								<!-- Change Password Form -->
								<form  method="post" action="{{ url('change-password') }}">
                   					{{ csrf_field() }}
									<div class="form-group">
										<label>Old Password</label>
										<input type="password" name="old_pwd" class="form-control" required>
									</div>
									<div class="form-group">
										<label>New Password</label>
										<input type="password" class="form-control" name="new_pwd" required>
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<input type="password" class="form-control" name="cnf_pwd" required>
									</div>
									<div class="submit-section">
										<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
									</div>
								</form>
								<!-- /Change Password Form -->
								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

</div>		
<!-- /Page Content -->