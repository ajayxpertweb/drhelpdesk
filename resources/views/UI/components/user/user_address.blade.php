<div class="block-header block-header--has-breadcrumb block-header--has-title">
	<div class="container">
		<div class="block-header__body">
			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">
				<ol class="breadcrumb__list">
					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>
					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>
					</li>
					
					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">User Address </span>
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
				<div class="user-address">								
					<div class="card mb-lg-0">
					<div class="card-body card-body--padding--1">
						<h3 class="card-title">Shipping Address</h3>
						<div class="addresses-list">	 
							@if($user->count()>0) 
								@php $count=1; @endphp
		                        @foreach($user as $r)  						
									<div class="addresses-list__item card address-card"> 
										<!-- <div class="address-card__badge tag-badge tag-badge--theme">Default</div>  -->
										<div class="address-card__body">
											<label class="input-radio">
												<span class="input-radio__body">
													<input class="input-radio__input" name="address_id" type="radio" value="{{$r->id}}"> 
													<span class="input-radio__circle"></span>
												</span>
											</label>
											<div class="address-card__name">{{$r->name}}</div>
											<div class="address-card__row">{{$r->address}}
												<br>{{$r->pin_code}}, {{$r->city}}
												<br>{{$r->state}},{{$r->country}}</div>
											<div class="address-card__row">
												<div class="address-card__row-title">Phone Number</div>
												<div class="address-card__row-content">{{$r->phone}}</div>
											</div>
											
											<div class="address-card__footer"><a href="{{url('/user-address-edit/'.$r->id)}}">Edit</a>&nbsp;&nbsp; <a href="{{url('/user-address-delete/'.$r->id)}}">Remove</a>
											</div>
										</div> 
									</div>
								<?php $count++ ?>
		                        @endforeach 
							@endif 

							<div class="addresses-list__divider"></div>
							<a href="javascript:void(0);" id="addNewaddress" class="addresses-list__item addresses-list__item--new">
								<div class="addresses-list__plus"></div>
								<div class="btn btn-secondary btn-sm">Add New</div>
							</a>
							<div class="addresses-list__divider"></div>
						</div>
					</div>
				</div> 
				<div class="card mb-lg-0 mt-2 new-address"  style="display: none;">
				  	<form action="{{url('/user-address-submit')}}" method="post" enctype="multipart/form">
					    @csrf
					     <input type="hidden" name="url" value="{{url()->previous()}}">
					    <div class="card-body card-body--padding--1">
					      <h3 class="card-title">New Shipping Address</h3> 
					      <div class="form-row">
					        <div class="form-group col-md-6">
					          <label for="checkout-full-name">Full Name</label>
					          <input type="text" class="form-control" id="checkout-full-name" placeholder="Full Name" name="name" required>
					        </div>
					        <div class="form-group col-md-6">
					          <label for="checkout-phone">Phone</label>
					          <input type="text" class="form-control" id="checkout-phone" placeholder="Phone"name="phone" required>
					        </div>
					      </div> 
					      <div class="form-group">
					        <label for="checkout-street-address">Street Address</label>
					        <input type="text" class="form-control" id="checkout-street-address" placeholder="Street Address"name="address" required>
					      </div>
					      <div class="form-group">
					        <label for="checkout-address">Apartment, suite, unit etc. <span class="text-muted">(Optional)</span>
					        </label>
					        <input type="text" class="form-control" id="checkout-address" name="apartment">
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
			                    <option value="andaman_nicobar_island">Andaman &amp; Nicobar Islands</option>
			                    <option value="andhra_pradesh">Andhra Pradesh</option>
			                    <option value="arunachal_pradesh" >Arunachal Pradesh</option>
			                    <option value="assam">Assam</option>
			                    <option value="bihar">Bihar</option>
			                    <option value="chandigarh" >Chandigarh</option>
			                    <option value="chhattisgarh"  >Chhattisgarh</option>
			                    <option value="dadra_nagar_haveli" >Dadra &amp; Nagar Haveli</option>
			                    <option value="daman_and_diu" >Daman and Diu</option><option value="delhi">Delhi</option>
			                    <option value="goa">Goa</option>
			                    <option value="gujarat" >Gujarat</option>
			                    <option value="haryana">Haryana</option>
			                    <option value="himachal_pradesh" >Himachal Pradesh</option>
			                    <option value="jammu_kashmir">Jammu &amp; Kashmir</option>
			                    <option value="jharkhand" >Jharkhand</option>
			                    <option value="karnataka">Karnataka</option>
			                    <option value="kerala">Kerala</option>
			                    <option value="lakshadweep">Lakshadweep</option>
			                    <option value="madhya_pradesh">Madhya Pradesh</option>
			                    <option value="maharashtra" >Maharashtra</option>
			                    <option value="manipur">Manipur</option>
			                    <option value="meghalaya">Meghalaya</option>
			                    <option value="mizoram">Mizoram</option>
			                    <option value="nagaland">Nagaland</option>
			                    <option value="odisha">Odisha</option>
			                    <option value="puducherry">Puducherry</option>
			                    <option value="punjab">Punjab</option>
			                    <option value="rajasthan">Rajasthan</option>
			                    <option value="sikkim">Sikkim</option>
			                    <option value="tamil_nadu">Tamil Nadu</option>
			                    <option value="telangana">Telangana</option>
			                    <option value="tripura">Tripura</option>
			                    <option value="uttarakhand">Uttarakhand</option>
			                    <option value="uttar_pradesh">Uttar Pradesh</option>
			                    <option value="west_bengal">West Bengal</option>
							</select>
					      </div>
					      <div class="form-group col-md-6">
					        <label for="checkout-city">Town / City</label>
					        <input type="text" class="form-control" id="checkout-city" name="city" required>
					      </div>
					      
					      <div class="form-group col-md-6">
					        <label for="checkout-postcode">Postcode / ZIP</label>
					        <input type="text" class="form-control" id="checkout-postcode" minlength="6" name="pin_code" required>
					      </div>
					      </div>
					      <button type="submit" class="btn btn-primary">Add New Address</button>        
					    </div>
				  	</form>
				</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--before-footer"></div>