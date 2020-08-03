<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Vendor</h3>
			<a href="{{url('view-delivery-boy')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Delivery Boy</a> 
		</div> 
		<form action="{{url('delivery-boy-submit')}}" method="post"  enctype="multipart/form-data" onsubmit="return myFun()">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="delivery_boy_name">  
					@error('delivery_boy_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>    
				<div class="form-group">
					<label>Logo</label>
					<input type="file" class="form-control" name="logo">  
					@error('logo')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" name="address"> 
					@error('address')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				
				<div class="form-group">
					<label>City</label>
					<input type="text" class="form-control" name="city">  
					@error('city')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Pin Code</label>
					<input type="text" class="form-control" name="pin_code">  
					@error('pin_code')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>State</label>
					<input type="text" class="form-control" name="state"> 
					@error('state')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email"> 
					@error('email')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Mobile</label>
					<input type="number" class="form-control" name="mobile">  
					<span id="message" style="color: red;"></span>  
					@error('mobile')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>
				<div class="form-group">
					<label>Landline Number</label>
					<input type="number" class="form-control" name="landline">  
				</div>  
				<div class="form-group"> 
					<label>Website Url</label>
					<input type="url" class="form-control" name="website_url"> 
				</div> 
				<div class="form-group">
					<label>Description</label> 
					<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="description"></textarea>  
				</div>   
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div> 