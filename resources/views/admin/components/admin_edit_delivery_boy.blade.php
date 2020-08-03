<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Delivery Boy</h3>
			<a href="{{url('view-delivery-boy')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Vendor</a> 
		</div> 
		<form action="{{url('delivery-boy-submit')}}" method="post"  enctype="multipart/form-data" onsubmit="return myFun()">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="id" value="{{$result->id}}"> 
			<div class="box-body"> 
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="delivery_boy_name" value="{{$result->delivery_boy_name}}" readonly>  
					@error('delivery_boy_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Logo</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->logo)}}"><br>
		            <input type="hidden" name="logo" value="{{$result->logo}}"><br> 
		            <input type="file" class="form-control" name="logo">  
				</div>  
				<div class="form-group">
					<label>Assign Priority</label>
					<select class="form-control" name="assign_priority">
						<option value="">Select</option>
						<option value="1" @if($result->assign_priority == 1)selected @endif>1</option>
						<option value="2" @if($result->assign_priority == 2)selected @endif>2</option>
						<option value="3" @if($result->assign_priority == 3)selected @endif>3</option>
						<option value="4" @if($result->assign_priority == 4)selected @endif>4</option>
						<option value="5" @if($result->assign_priority == 5)selected @endif>5</option>
						<option value="6" @if($result->assign_priority == 6)selected @endif>6</option>
						<option value="7" @if($result->assign_priority == 7)selected @endif>7</option>
						<option value="8" @if($result->assign_priority == 8)selected @endif>8</option>
						<option value="9" @if($result->assign_priority == 9)selected @endif>9</option>
						<option value="10" @if($result->assign_priority == 10)selected @endif>10</option>
					</select>
				</div>  
				<div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="main_category" required>
						<option>select</option>
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}" @if($result->main_category == $r->categories_id)selected @endif>{{$r->category_name}}</option> 
						@endforeach
					</select> 
				</div>    
				<div class="form-group">
					<label>Address</label>
					<input type="text" class="form-control" name="address" value="{{$result->address}}">  
					@error('address')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>City</label>
					<input type="text" class="form-control" name="city" value="{{$result->city}}">  
					@error('city')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Pin Code</label>
					<input type="text" class="form-control" name="pin_code" value="{{$result->pin_code}}"> 
					@error('pin_code')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>State</label>
					<input type="text" class="form-control" name="state" value="{{$result->state}}">  
					@error('state')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Email</label>
					<input type="text" class="form-control" name="email" value="{{$result->email}}" readonly>  
					@error('email')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" name="mobile" value="{{$result->mobile}}" readonly>
					<span id="message" style="color: red;"></span> 
					@error('mobile')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>
				<div class="form-group">
					<label>Landline Number</label>
					<input type="text" class="form-control" name="landline" value="{{$result->landline}}">  
				</div>  
				<div class="form-group"> 
					<label>Website Url</label>
					<input type="text" class="form-control" name="website_url" value="{{$result->website_url}}">  
				</div> 
				<div class="form-group">
					<label>Description</label> 
					<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="description">{{$result->description}}</textarea> 
				</div>   
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div> 