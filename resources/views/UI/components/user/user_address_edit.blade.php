<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Address Edit </span>
					</li>
					<li class="breadcrumb__title-safe-area" role="presentation"></li>
				</ol>
			</nav>
		</div>
	</div>
</div>
@php 
	$user = DB::table('user_addresses')->where('user_id' , Auth::user()->id)->get(); 
@endphp 
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
				<div class="card mb-lg-0">
				  	<form action="{{url('/user-address-submit')}}" method="post" enctype="multipart/form">
					    @csrf
					    <input type="hidden" name="url" value="{{url()->previous()}}">
					    <input type="hidden" name="id" value="{{$address->id}}">
					    <div class="card-body card-body--padding--1">
					      <h3 class="card-title">Edit Shipping Address</h3> 
					      <div class="form-row">
					        <div class="form-group col-md-6">
					          <label for="checkout-full-name">Full Name</label>
					          <input type="text" class="form-control" id="checkout-full-name" placeholder="Full Name" name="name"  value="{{$address->name}}" required>
					        </div>
					        <div class="form-group col-md-6">
					          <label for="checkout-phone">Phone</label>
					          <input type="text" class="form-control" id="checkout-phone" placeholder="Phone" name="phone" value="{{$address->phone}}" required>
					        </div>
					      </div> 
					      <div class="form-group">
					        <label for="checkout-street-address">Street Address</label>
					        <input type="text" class="form-control" id="checkout-street-address" placeholder="Street Address" name="address" value="{{$address->address}}" required>
					      </div>
					      <div class="form-group">
					        <label for="checkout-address">Apartment, suite, unit etc. <span class="text-muted">(Optional)</span>
					        </label>
					        <input type="text" class="form-control" id="checkout-address" name="apartment" value="{{$address->apartment}}">
					      </div>
					      <div class="form-row">
					      <div class="form-group col-md-6">
					        <label for="checkout-country">Country</label>
					        <select id="checkout-country"  name="country" class="form-control form-control-select2">
					          <option>Select a country...</option>
					          <option value="india" selected="">India</option> 
					        </select>
					      </div>
					      <div class="form-group col-md-6">
					        <label for="checkout-state">State</label>
					       <select id="checkout-state" class="form-control form-control-select2" name="state" required>
								<option value="" disabled="">Select State</option>
			                    <option value="andaman_nicobar_island" @if($address->state == 'andaman_nicobar_island')Selected @endif>Andaman &amp; Nicobar Islands</option>
			                    <option value="andhra_pradesh" @if($address->state == 'andhra_pradesh')Selected @endif>Andhra Pradesh</option>
			                    <option value="arunachal_pradesh" @if($address->state == 'arunachal_pradesh')Selected @endif>Arunachal Pradesh</option>
			                    <option value="assam" @if($address->state == 'assam')Selected @endif>Assam</option>
			                    <option value="bihar" @if($address->state == 'bihar')Selected @endif>Bihar</option>
			                    <option value="chandigarh" @if($address->state == 'chandigarh')Selected @endif>Chandigarh</option>
			                    <option value="chhattisgarh" @if($address->state == 'chhattisgarh')Selected @endif>Chhattisgarh</option>
			                    <option value="dadra_nagar_haveli" @if($address->state == 'dadra_nagar_haveli')Selected @endif>Dadra &amp; Nagar Haveli</option>
			                    <option value="daman_and_diu" @if($address->state == 'daman_and_diu')Selected @endif>Daman and Diu</option><option value="delhi" @if($address->state == 'delhi')Selected @endif>Delhi</option>
			                    <option value="goa" @if($address->state == 'goa')Selected @endif>Goa</option>
			                    <option value="gujarat" @if($address->state == 'gujarat')Selected @endif>Gujarat</option>
			                    <option value="haryana" @if($address->state == 'haryana')Selected @endif>Haryana</option>
			                    <option value="himachal_pradesh" @if($address->state == 'himachal_pradesh')Selected @endif>Himachal Pradesh</option>
			                    <option value="jammu_kashmir" @if($address->state == 'jammu_kashmir')Selected @endif>Jammu &amp; Kashmir</option>
			                    <option value="jharkhand" @if($address->state == 'jharkhand')Selected @endif>Jharkhand</option>
			                    <option value="karnataka" @if($address->state == 'karnataka')Selected @endif>Karnataka</option>
			                    <option value="kerala" @if($address->state == 'kerala')Selected @endif>Kerala</option>
			                    <option value="lakshadweep" @if($address->state == 'lakshadweep')Selected @endif>Lakshadweep</option>
			                    <option value="madhya_pradesh" @if($address->state == 'madhya_pradesh')Selected @endif>Madhya Pradesh</option>
			                    <option value="maharashtra" @if($address->state == 'maharashtra')Selected @endif>Maharashtra</option>
			                    <option value="manipur" @if($address->state == 'manipur')Selected @endif>Manipur</option>
			                    <option value="meghalaya" @if($address->state == 'meghalaya')Selected @endif>Meghalaya</option>
			                    <option value="mizoram" @if($address->state == 'mizoram')Selected @endif>Mizoram</option>
			                    <option value="nagaland" @if($address->state == 'nagaland')Selected @endif>Nagaland</option>
			                    <option value="odisha" @if($address->state == 'odisha')Selected @endif>Odisha</option>
			                    <option value="puducherry" @if($address->state == 'puducherry')Selected @endif>Puducherry</option>
			                    <option value="punjab" @if($address->state == 'punjab')Selected @endif>Punjab</option>
			                    <option value="rajasthan" @if($address->state == 'rajasthan')Selected @endif>Rajasthan</option>
			                    <option value="sikkim" @if($address->state == 'sikkim')Selected @endif>Sikkim</option>
			                    <option value="tamil_nadu" @if($address->state == 'tamil_nadu')Selected @endif>Tamil Nadu</option>
			                    <option value="telangana" @if($address->state == 'telangana')Selected @endif>Telangana</option>
			                    <option value="tripura" @if($address->state == 'tripura')Selected @endif>Tripura</option>
			                    <option value="uttarakhand" @if($address->state == 'uttarakhand')Selected @endif>Uttarakhand</option>
			                    <option value="uttar_pradesh" @if($address->state == 'uttar_pradesh')Selected @endif>Uttar Pradesh</option>
			                    <option value="west_bengal" @if($address->state == 'west_bengal')Selected @endif>West Bengal</option>
							</select>
					      </div>
					      <div class="form-group col-md-6">
					        <label for="checkout-city">Town / City</label>
					        <input type="text" class="form-control" id="checkout-city" name="city" value="{{$address->city}}" required>
					      </div>
					      
					      <div class="form-group col-md-6">
					        <label for="checkout-postcode">Postcode / ZIP</label>
					        <input type="text" class="form-control" id="checkout-postcode" name="pin_code" minlength="6" value="{{$address->pin_code}}" required>
					      </div>
					      </div>
					      <button type="submit" class="btn btn-primary">Edit Address</button>        
					    </div>
				  	</form> 
				 </div>

			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>