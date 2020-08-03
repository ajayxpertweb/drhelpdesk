<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Vendor</h3>
			<a href="{{url('view-vendors')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Vendor</a> 
		</div> 
		<form action="{{url('vendors-submit')}}" method="post"  enctype="multipart/form-data" onsubmit="return myFun()">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="vendor_name" value="{{old('vendor_name')}}"> 
					@error('vendor_name')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Assign Priority</label>
					<select class="form-control" name="assign_priority">
						<option value="">Select</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
						<option value="6">6</option>
						<option value="7">7</option>
						<option value="8">8</option>
						<option value="9">9</option>
						<option value="10">10</option>
					</select>
				</div>  
				<div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="main_category" required>
						<option>select</option>
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}">{{$r->category_name}}</option> 
						@endforeach
					</select> 
				</div>    
				<div class="form-group">
					<label>Logo</label>
					<input type="file" class="form-control" name="logo">  
					@error('logo')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" name="address" value="{{old('address')}}"> 
					@error('address')
                     <p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>City</label>
					<input type="text" class="form-control" name="city" value="{{old('city')}}">  
					@error('city')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Pin Code</label>
					<input type="text" class="form-control" name="pin_code" value="{{old('pin_code')}}">  
					@error('pin_code')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>State</label>
					<input type="text" class="form-control" name="state" value="{{old('state')}}"> 
					@error('state')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="{{old('email')}}"> 
					@error('email')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Mobile</label>
					<input type="number" class="form-control" name="phone" value="{{old('mobile')}}"> 
					<span id="message" style="color: red;"></span>  
					@error('phone')
                     	<p style="color:red; font-size:15px;">* {{ $message }}</p>
                	@enderror
				</div>
				<div class="form-group">
					<label>Landline Number</label>
					<input type="number" class="form-control" name="landline" value="{{old('landline')}}">  
				</div>  
				<div class="form-group"> 
					<label>Website Url</label>
					<input type="url" class="form-control" name="website_url" value="{{old('website_url')}}"> 
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