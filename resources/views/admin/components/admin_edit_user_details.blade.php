<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit User Details</h3>
			<a href="{{url('view-user-details')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View User Details</a> 
		</div> 
		<form action="{{url('user-details-submit')}}" method="post"  enctype="multipart/form-data" onsubmit="return myFun()">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="user_details_id" value="{{$result->user_details_id}}">
			<div class="box-body"> 
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="user_name" value="{{$result->user_name}}"> 
					@error('user_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->image)}}"><br>
		            <input type="hidden" name="image" value="{{$result->image}}"><br>
		            <input type="file" class="form-control" name="image">  
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
					<input type="number" class="form-control" name="pin_code" value="{{$result->pin_code}}"> 
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
					<label>Country</label>
					<input type="text" class="form-control" name="country" value="{{$result->country}}"> 
					@error('country')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Email</label>
					<input type="email" class="form-control" name="email" value="{{$result->email}}"> 
					@error('email')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Mobile</label>
					<input type="number" class="form-control" name="mobile" value="{{$result->mobile}}">
					<span id="message" style="color: red;"></span>  
					@error('mobile')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label for="exampleInputEmail1">Role</label> 
					<select class="form-control" name="role_id">
						<option value="disabled">select</option>
						@foreach($role as $r) 
							<option value="{{$r->roles_id}}" @if($result->role_id == $r->roles_id)Selected @endif>{{$r->role_name}}</option>
							@error('role_id')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>
				<div id="color" style='display:none;'/>
					<div class="form-group">
						<label for="exampleInputEmail1">Speciality</label> 
						<select class="form-control" name="speciality">
							<option value="disabled">select</option>
							@foreach($sub_category as $r) 
								<option value="{{$r->categories_id}}" @if($result->speciality == $r->categories_id)Selected @endif>{{$r->sub_category_name}}</option>
								@error('speciality')
			                     	<p>* {{ $message }}</p>
			                	@enderror
							@endforeach
						</select> 
					</div>   
					<?php $doctor = DB::table('categories')->where('categories_id',16)->first(); ?>
					<input type="hidden"  value ="{{$doctor->categories_id}}" name="doctor_category">   
					<div class="form-group"> 
						<label>Experience From</label>
						<input type="date" class="form-control" name="experience_from" value="{{$result->experience_from}}">  
					</div>  
					<div class="form-group">
						<label>Experience TO</label>
						<input type="date" class="form-control" name="experience_to" value="{{$result->experience_to}}">  
					</div>  
					<div class="form-group">
						<label>Description</label> 
						<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="description">{{ $result->description }}</textarea> 
					</div>
				</div>      
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div> 
<script type="text/javascript">
    function CheckColors(val){
        var element=document.getElementById('color');
          if(val=='select'||val==1)
           element.style.display='block'; 
          else  
           element.style.display='none'; 
    }  
</script>  