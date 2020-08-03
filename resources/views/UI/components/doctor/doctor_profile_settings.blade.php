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
				<form action="{{url('doctor-detail-submit')}}" method="post"  enctype="multipart/form-data" autocomplete="off">
					{{ csrf_field() }}  
					<input type="hidden" name="user_details_id" value="{{$image->user_details_id}}"><br>

					<!-- Basic Information -->
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Basic Information</h4>
								<div class="row form-row">
									<div class="col-md-12">
										<div class="form-group">
											<div class="change-avatar">
												<div class="profile-img">
													<img src="{{asset($image->image)}}" alt="User Image">
												</div>
												<div class="upload-img">
													<div class="change-photo-btn">
														<span><i class="fa fa-upload"></i> Upload Photo</span> 
														<input type="file" class="upload" name="image">
	                                                    <input type="hidden" name="image" value="{{$image->image}}"><br>
													</div>
													<small class="form-text text-muted">Allowed JPG, GIF or PNG. Max size of 2MB</small>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control" name="user_name" value="{{$image->user_name}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Email <span class="text-danger">*</span></label>
											<input type="email" class="form-control" name="email" value="{{$image->email}}">
										</div>
									</div>
									<!-- <div class="col-md-6">
										<div class="form-group">
											<label>First Name <span class="text-danger">*</span></label>
											<input type="text" class="form-control">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name <span class="text-danger">*</span></label>
											<input type="text" class="form-control">
										</div>
									</div> -->
									<div class="col-md-6">
										<div class="form-group">
											<label>Phone Number</label>
											<input type="number" class="form-control" name="mobile" value="{{$image->mobile}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Gender</label>
											<select class="form-control select" name="gender">
												<option>Select</option>
												<option value="male" @if($image->gender == 'male')Selected @endif>Male</option>
												<option value="female" @if($image->gender == 'female')Selected @endif>Female</option>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group mb-0">
											<label>Date of Birth</label>
											<input type="date" class="form-control" name="dob" value="{{$image->dob}}">
										</div>
									</div>
								</div>
							</div>
						</div>
					<!-- /Basic Information -->
					
					<!-- About Me -->
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">About Me</h4>
								<div class="form-group mb-0">
									<label>Biography</label>
									<textarea class="form-control" rows="5" name="description">{{$image->description}}</textarea>
								</div>
							</div>
						</div>
					<!-- /About Me --> 

					<!-- Contact Details -->
						<div class="card contact-card">
							<div class="card-body">
								<h4 class="card-title">Contact Details</h4>
								<div class="row form-row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Address Line 1</label>
											<input type="text" class="form-control" name="address" value="{{$image->address}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Address Line 2</label>
											<input type="text" class="form-control" name="address2" value="{{$image->address2}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">City</label>
											<input type="text" class="form-control" name="city" value="{{$image->city}}">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">State / Province</label>
											<input type="text" class="form-control" name="state" value="{{$image->state}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Country</label>
											<input type="text" class="form-control" name="country" value="{{$image->country}}">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Postal Code</label>
											<input type="number" class="form-control" name="pin_code" value="{{$image->pin_code}}">
										</div>
									</div>
								</div>
							</div>
						</div>
					<!-- /Contact Details -->
					
					<!-- Pricing -->
						<!--<div class="card">
							<div class="card-body">
								<h4 class="card-title">Pricing</h4>

								<div class="form-group mb-0">
									<div id="pricing_select">
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" id="price_free" name="rating_option" class="custom-control-input" value="price_free" @if($image->rating_option == 'price_free')checked @endif>
											<label class="custom-control-label" for="price_free">Free</label>
										</div>
										<div class="custom-control custom-radio custom-control-inline">
											<input type="radio" id="price_custom" name="rating_option" value="custom_price" class="custom-control-input" @if($image->rating_option == 'custom_price')checked @endif>
											<label class="custom-control-label" for="price_custom">Custom Price (per hour)</label>
										</div>
									</div> 
								</div>
								 
								<div class="row custom_price_cont" id="custom_price_cont" style="display: none;">
									<div class="col-md-4">
										<input type="text" class="form-control" id="custom_rating_input" name="consultation_fees" value="{{$image->consultation_fees}}" placeholder="20">
										<small class="form-text text-muted">Custom price you can add</small>
									</div>
								</div> 
								 
							</div>
						</div>-->
						
						<div class="card">
							<div class="card-body">
								<h4 class="card-title">Consultation</h4>

									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Fees</label>
											<input type="number" class="form-control" name="consultation_fees" value="{{$image->consultation_fees}}" min="0">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Number Of Consultation</label>
											<input type="number" class="form-control" name="number_of_consultation" value="{{$image->number_of_consultation}}" min="0">
										</div>
									</div>
								
							</div>
						</div>
					<!-- /Pricing -->
					
					<!-- Services and Specialization -->
						<div class="card services-card">
							<div class="card-body">
								<h4 class="card-title">Speciality and Services and Specialization</h4>
								<div class="form-group">
									<label>Speciality</label>
									<select class="form-control select" name="speciality">
										<option>Select</option>
										@foreach($sub_category as $r) 
											<option value="{{$r->categories_id}}" @if($image->speciality == $r->categories_id)Selected @endif>{{$r->sub_category_name}}</option> 
										@endforeach
									</select>
								</div> 
								<div class="form-group">
									<label>Services</label>
									<input type="text" data-role="tagsinput" class="input-tags form-control" placeholder="Enter Services" name="service"  value="{{$image->service}}" id="services" autocomplete="off">
									<small class="form-text text-muted">Note : Type & Press enter to add new services</small>
								</div> 
								<div class="form-group mb-0">
									<label>Specialization </label>
									<input class="input-tags form-control" type="text" data-role="tagsinput" placeholder="Enter Specialization" name="specialization"  value="{{$image->specialization}}" id="specialist">
									<small class="form-text text-muted">Note : Type & Press  enter to add new specialization</small>
								</div> 
							</div>              
						</div>
							<div class="submit-section submit-btn-bottom">
						<button type="submit" class="btn btn-primary submit-btn">Save Changes</button>
					</div>
				</form>
					<!-- /Services and Specialization -->
				 	<?php
				 		$education = DB::table('education')->where('user_id',Auth::user()->id)->get(); 
				 		$experience = DB::table('experiance')->where('user_id',Auth::user()->id)->get();
				 		$award = DB::table('awards')->where('user_id',Auth::user()->id)->get();
				 		$registration = DB::table('ragistration')->where('user_id',Auth::user()->id)->get();
				 	?>
					<!-- Education -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Education</h4>
							<div class="education-info">
								<div class="row form-row education-cont">
									<div class="col-12 col-md-10 col-lg-11">
									
											@foreach($education as $r1) 
										<form  action="{{url('doctor-education-submit')}}" method="post">
											<div class="row form-row"> 
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Degree</label>
														<input type="text" class="form-control" name="degree1" value="{{$r1->degree}}">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>College/Institute</label>
														<input type="text" class="form-control" name="college1" value="{{$r1->college}}">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Year of Completion</label>
														<input type="text" class="form-control" name="completed_year1" value="{{$r1->year}}">
													</div> 
												</div> 
											
												
											</div>
											</form>
												<a href="{{url('delete-education-detail/'.$r1->id)}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
											@endforeach 
									
											<form  action="{{url('doctor-education-submit')}}" method="post">
											<div class="row form-row" id="textboxDiv">
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Degree</label>
														<input type="text" class="form-control"  name="degree[]">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>College/Institute</label>
														<input type="text" class="form-control"  name="college[]">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Year of Completion</label>
														<input type="text" class="form-control"  name="completed_year[]">
													</div> 
												</div>
											</div>
												<input type="submit"   name ="submit" value="submit" >
												</form>
									
									</div>
								</div>
							</div>
							<div class="add-more">
							    <button id="Add">Click to add textbox</button> <button id="Remove">Click to remove textbox</button>
							<!--	<a id="id="Add" class="add-education"><i class="fa fa-plus-circle"></i> Add More</a>-->
							</div>
						</div>
					</div>
					<!-- /Education -->
				
					<!-- Experience -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Experience</h4>
							<div class="experience-info">
								<div class="row form-row experience-cont">
									<div class="col-12 col-md-10 col-lg-11">
									
											@foreach($experience as $r2) 
											
											<div class="row form-row">
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Hospital Name</label>
														<input type="text" class="form-control" name="hospital_name[]" value="{{$r2->hospital}}">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>From</label>
														<input type="text" class="form-control" name="experience_from[]" value="{{$r2->fromstart}}">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>To</label>
														<input type="text" class="form-control" name="experience_to[]" value="{{$r2->toend}}">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Designation</label>
														<input type="text" class="form-control" name="designation[]" value="{{$r2->designation}}">
													</div> 
												</div>
												<a href="{{url('delete-experiance-detail/'.$r2->id)}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
											</div>
											@endforeach
									
											<form  action="{{url('doctor-experiance-submit')}}" method="post">
											<div class="row form-row" id="items3">
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Hospital Name</label>
														<input type="text" class="form-control" name="hospital_name[]">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>From</label>
														<input type="text" class="form-control" name="experience_from[]">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>To</label>
														<input type="text" class="form-control" name="experience_to[]">
													</div> 
												</div>
												<div class="col-12 col-md-6 col-lg-4">
													<div class="form-group">
														<label>Designation</label>
														<input type="text" class="form-control" name="designation[]">
													</div> 
												</div>
											</div>
												<input type="submit"   name ="submit" value="submit" >
												</form>
											</form>
									
									</div>
								</div>
							</div>
							<div class="add-more">
			 <button id="add3" class="btn add-more button-yellow uppercase" type="button">+ Add another</button> <button class="delete btn button-white uppercase">- Remove referral</button>				    
								<a href="javascript:void(0);" class="add-experience"><i class="fa fa-plus-circle"></i> Add More</a>
							</div>
						</div>
					</div>
					<!-- /Experience -->
					
					<!-- Awards -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Awards</h4>
							<div class="awards-info">
							
									@foreach($award as $r3) 
										
										<div class="row form-row awards-cont">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Awards</label>
													<input type="text" class="form-control" name="awards[]" value="{{$r3->award}}">
												</div> 
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" class="form-control" name="award_year[]" value="{{$r3->year}}">
												</div> 
											</div>
										</div>
										<a href="{{url('delete-award-detail/'.$r3->id)}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a> 
									@endforeach
								<form  action="{{url('doctor-award-submit')}}" method="post">
									<div class="row form-row awards-cont" id="items1">
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>Awards</label>
												<input type="text" class="form-control" name="awards[]">
											</div> 
										</div>
										<div class="col-12 col-md-5">
											<div class="form-group">
												<label>Year</label>
												<input type="text" class="form-control" name="award_year[]">
											</div> 
										</div>
									</div>
									<input type="submit"   name ="submit" value="submit" >
									</form>
								
							</div>
							<div class="add-more">
							    <button id="add2" class="btn add-more button-yellow uppercase" type="button">+ Add another</button> <button class="delete btn button-white uppercase">- Remove referral</button>
								<a href="javascript:void(0);" class="add-award"><i class="fa fa-plus-circle"></i> Add More</a>
							</div>
						</div>
					</div>
					<!-- /Awards --> 


					<!-- Registrations -->
					<div class="card">
						<div class="card-body">
							<h4 class="card-title">Registrations</h4>
							<div class="registrations-info">
								
									@foreach($registration as $r4) 
										
										<div class="row form-row reg-cont">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Registrations</label>
													<input type="text" class="form-control" name="registration[]" value="{{$r4->registration}}">
												</div> 
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" class="form-control" name="registration_year[]" value="{{$r4->year}}">
												</div> 
											</div>
										</div>
										<a href="{{url('delete-registration-detail/'.$r4->id)}}" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
									@endforeach
							
									<form  action="{{url('doctor-ragistration-submit')}}" method="post">
									<div class="registrations-info" id="items">
										<div class="row form-row reg-cont">
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Registrations</label>
													<input type="text" class="form-control"  name="registration[]">
												</div> 
											</div>
											<div class="col-12 col-md-5">
												<div class="form-group">
													<label>Year</label>
													<input type="text" class="form-control" name="registration_year[]">
												</div> 
											</div>
										</div>
									</div>
										<input type="submit"   name ="submit" value="submit" >
									</form>
									<div class="add-more">
									    <button id="add1" class="btn add-more button-yellow uppercase" type="button">+ Add another</button> <button class="delete btn button-white uppercase">- Remove referral</button>
										<a href="javascript:void(0);" class="add-reg"><i class="fa fa-plus-circle"></i> Add More</a>
									</div>
							

							</div> 
						</div>
					</div>
					<!-- /Registrations -->
					
				
			</div> 
		</div>

	</div>

</div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
  <script>
    $(document).ready(function() {
  $(".delete").hide();
  //when the Add Field button is clicked
  $("#add3").click(function(e) {
    $(".delete").fadeIn("1500");
    //Append a new row of code to the "#items" div
    $("#items3").append(
      '<div class="next-referral col-6"><input id="textinput" name="hospital_name[]" type="text" placeholder="Enter name of hospital" class="form-control input-md"><input id="textinput" name="experience_from[] type="text" placeholder="Enter from" class="form-control input-md"><input id="textinput" name="experience_to[] type="text" placeholder="Enter to" class="form-control input-md"><input id="textinput" name="designation[] type="text" placeholder="Enter designation" class="form-control input-md"></div>'
    );
  });
  $("body").on("click", ".delete", function(e) {
    $(".next-referral").last().remove();
  });
});

</script>
  
<script>
    $(document).ready(function() {
  $(".delete").hide();
  //when the Add Field button is clicked
  $("#add1").click(function(e) {
    $(".delete").fadeIn("1500");
    //Append a new row of code to the "#items" div
    $("#items").append(
      '<div class="next-referral col-6"><input id="textinput" name="registration[]" type="text" placeholder="Enter name of registration" class="form-control input-md"><input id="textinput" name="registration_year[]" type="text" placeholder="Enter year" class="form-control input-md"></div>'
    );
  });
  $("body").on("click", ".delete", function(e) {
    $(".next-referral").last().remove();
  });
});

</script>

<script>
    $(document).ready(function() {
  $(".delete").hide();
  //when the Add Field button is clicked
  $("#add2").click(function(e) {
    $(".delete").fadeIn("1500");
    //Append a new row of code to the "#items" div
    $("#items1").append(
      '<div class="next-referral col-6"><input id="textinput" name="awards[]" type="text" placeholder="Enter name of award" class="form-control input-md"><input id="textinput" name="award_year[]" type="text" placeholder="Enter year" class="form-control input-md"></div>'
    );
  });
  $("body").on("click", ".delete", function(e) {
    $(".next-referral").last().remove();
  });
});

</script>
  <script>  
        $(document).ready(function() {  
            $("#Add").on("click", function() {  
    $("#textboxDiv").append("<div><br><input type='text' name='degree[]'/><input type='text' name='college[]'/><input type='text' name='completed_year[]'/><br></div>");             });  
            $("#Remove").on("click", function() {  
                $("#textboxDiv").children().last().remove();  
            });  
        });  
    </script>
<!-- /Page Content -->