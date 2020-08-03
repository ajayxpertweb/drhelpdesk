<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Profile </span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
<?php
	$profile = DB::table('user_details')->where('user_id',Auth::user()->id)->first();
?>
<div class="block">
	<div class="container">
		@if(session('msg') != null)
            <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                {{session('msg')}}
            </div>
        @endif
		<div class="row">
			@include('UI/components/user/user_sidebar')
			
			<div class="col-12 col-lg-9 mt-4 mt-lg-0">
				<form action="{{url('user-profile-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
				<input type="hidden" name="user_id" value="{{$profile->user_id}}">
				<div class="user-profile">
				<div class="card mb-2">
					<div class="card-header">
						<h5>Profile Details</h5>
					</div>
					<div class="card-divider"></div>
					<div class="card-body card-body--padding--1">
						<div class="form-row">
							<div class="form-group col-md-6">
								<div class="profile-card__avatar">
									<img src="{{asset($profile->image)}}" alt="">
								</div>
								<input type="file" class="form-control" name="image">
	                            <input type="hidden" name="image" value="{{$profile->image}}"><br>
							</div>
						</div>
						<div class="form-row">
							<div class="form-group col-md-6">
								<label for="checkout-full-name">Full Name</label>
								<input type="text" class="form-control" id="checkout-full-name" name="user_name" value="{{$profile->user_name}}" placeholder="Full Name" required>
							</div>
							<div class="form-group col-md-6">
								<label for="profile-email">Email Address</label>
								<input type="email" class="form-control" id="profile-email" name="email" value="{{$profile->email}}" placeholder="Email Address" readonly>
							</div>
							<div class="form-group col-md-6">
								<label for="checkout-phone">Phone</label>
								<input type="text" class="form-control" id="checkout-phone" name="mobile" value="{{$profile->mobile}}" placeholder="Phone" readonly>
							</div>
							<div class="col-md-6">
								<div class="form-group mb-0">
									<label>Date of Birth</label>
									<input type="date" class="form-control" name="dob" value="{{$profile->dob}}">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>Gender</label>
									<select class="form-control select" name="gender" required>
										<option>Select</option>
										<option value="male" @if($profile->gender == 'male')Selected @endif>Male</option>
										<option value="female" @if($profile->gender == 'female')Selected @endif>Female</option>
									</select>
								</div>
							</div>
						</div> 
					</div>
				</div>								
					<div class="card mb-lg-0">
					<div class="card-body card-body--padding--1">
						<h3 class="card-title">Address</h3>
						<div class="form-group">
							<label for="checkout-street-address">Address Line 1</label>
							<input type="text" class="form-control" id="checkout-street-address" name="address" value="{{$profile->address}}" placeholder="Address Line 1" required>
						</div>
						<div class="form-group">
							<label for="checkout-street-address">Address Line  2</label>
							<input type="text" class="form-control" id="checkout-street-address" name="address2" value="{{$profile->address2}}" placeholder="Address Line 2">
						</div> 
						<div class="form-row">
						<div class="form-group col-md-6">
							<label for="checkout-country">Country</label>
							<select id="checkout-country" class="form-control form-control-select2" required>
								<option>Select a country...</option>
								<option value="india" selected="">India</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="checkout-state">State</label>
							<select id="checkout-state" class="form-control form-control-select2" name="state" required>
								<option value="" disabled="">Select State</option>
			                    <option value="andaman_nicobar_island" @if($profile->state == 'andaman_nicobar_island')Selected @endif>Andaman &amp; Nicobar Islands</option>
			                    <option value="andhra_pradesh" @if($profile->state == 'andhra_pradesh')Selected @endif>Andhra Pradesh</option>
			                    <option value="arunachal_pradesh" @if($profile->state == 'arunachal_pradesh')Selected @endif>Arunachal Pradesh</option>
			                    <option value="assam" @if($profile->state == 'assam')Selected @endif>Assam</option>
			                    <option value="bihar" @if($profile->state == 'bihar')Selected @endif>Bihar</option>
			                    <option value="chandigarh" @if($profile->state == 'chandigarh')Selected @endif>Chandigarh</option>
			                    <option value="chhattisgarh" @if($profile->state == 'chhattisgarh')Selected @endif>Chhattisgarh</option>
			                    <option value="dadra_nagar_haveli" @if($profile->state == 'dadra_nagar_haveli')Selected @endif>Dadra &amp; Nagar Haveli</option>
			                    <option value="daman_and_diu" @if($profile->state == 'daman_and_diu')Selected @endif>Daman and Diu</option><option value="delhi" @if($profile->state == 'delhi')Selected @endif>Delhi</option>
			                    <option value="goa" @if($profile->state == 'goa')Selected @endif>Goa</option>
			                    <option value="gujarat" @if($profile->state == 'gujarat')Selected @endif>Gujarat</option>
			                    <option value="haryana" @if($profile->state == 'haryana')Selected @endif>Haryana</option>
			                    <option value="himachal_pradesh" @if($profile->state == 'himachal_pradesh')Selected @endif>Himachal Pradesh</option>
			                    <option value="jammu_kashmir" @if($profile->state == 'jammu_kashmir')Selected @endif>Jammu &amp; Kashmir</option>
			                    <option value="jharkhand" @if($profile->state == 'jharkhand')Selected @endif>Jharkhand</option>
			                    <option value="karnataka" @if($profile->state == 'karnataka')Selected @endif>Karnataka</option>
			                    <option value="kerala" @if($profile->state == 'kerala')Selected @endif>Kerala</option>
			                    <option value="lakshadweep" @if($profile->state == 'lakshadweep')Selected @endif>Lakshadweep</option>
			                    <option value="madhya_pradesh" @if($profile->state == 'madhya_pradesh')Selected @endif>Madhya Pradesh</option>
			                    <option value="maharashtra" @if($profile->state == 'maharashtra')Selected @endif>Maharashtra</option>
			                    <option value="manipur" @if($profile->state == 'manipur')Selected @endif>Manipur</option>
			                    <option value="meghalaya" @if($profile->state == 'meghalaya')Selected @endif>Meghalaya</option>
			                    <option value="mizoram" @if($profile->state == 'mizoram')Selected @endif>Mizoram</option>
			                    <option value="nagaland" @if($profile->state == 'nagaland')Selected @endif>Nagaland</option>
			                    <option value="odisha" @if($profile->state == 'odisha')Selected @endif>Odisha</option>
			                    <option value="puducherry" @if($profile->state == 'puducherry')Selected @endif>Puducherry</option>
			                    <option value="punjab" @if($profile->state == 'punjab')Selected @endif>Punjab</option>
			                    <option value="rajasthan" @if($profile->state == 'rajasthan')Selected @endif>Rajasthan</option>
			                    <option value="sikkim" @if($profile->state == 'sikkim')Selected @endif>Sikkim</option>
			                    <option value="tamil_nadu" @if($profile->state == 'tamil_nadu')Selected @endif>Tamil Nadu</option>
			                    <option value="telangana" @if($profile->state == 'telangana')Selected @endif>Telangana</option>
			                    <option value="tripura" @if($profile->state == 'tripura')Selected @endif>Tripura</option>
			                    <option value="uttarakhand" @if($profile->state == 'uttarakhand')Selected @endif>Uttarakhand</option>
			                    <option value="uttar_pradesh" @if($profile->state == 'uttar_pradesh')Selected @endif>Uttar Pradesh</option>
			                    <option value="west_bengal" @if($profile->state == 'west_bengal')Selected @endif>West Bengal</option>
							</select>
						</div>
						<div class="form-group col-md-6">
							<label for="checkout-city">Town / City</label>
							<input type="text" class="form-control" id="checkout-city" name="city" value="{{$profile->city}}" required>
						</div>
						<div class="form-group col-md-6">
							<label for="checkout-postcode">Postcode / ZIP</label>
							<input type="text" class="form-control" id="checkout-postcode" name="pin_code" value="{{$profile->pin_code}}" required>
						</div>
						</div>
						<button type="submit" class="btn btn-primary">Update Profile</button>						
					</div>
				</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>