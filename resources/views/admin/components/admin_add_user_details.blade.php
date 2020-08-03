<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add User Details</h3>
			<a href="{{url('view-user-details')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View User Details</a> 
		</div> 
		<form action="{{url('user-details-submit')}}" method="post"  enctype="multipart/form-data"  onsubmit="return myFun()">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Name</label>
					<input type="text" class="form-control" name="user_name"> 
					@error('user_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Image</label>
					<input type="file" class="form-control" name="image"> 
					@error('image')
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
					<input type="number" class="form-control" name="pin_code"> 
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
					<label>Country</label>
					<input type="text" class="form-control" name="country"> 
					@error('country')
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
					<label for="exampleInputEmail1">Role</label> 
					<select class="form-control" name="role_id" onchange='CheckColors(this.value);'>
						<option></option>
						@foreach($role as $r) 
							 <option value="{{$r->roles_id}}">{{$r->role_name}}</option> 
						@endforeach
					</select> 
				</div> 
				<div id="color" style='display:none;'/>
					<?php $doctor = DB::table('categories')->where('categories_id',16)->pluck('categories_id')->first(); ?>
					<input type="hidden"  value ="{{$doctor}}" name="doctor_category">    
					<div class="form-group">
						<label>Speciality</label> 
						<select class="form-control" name="speciality">
							<option></option>
							@foreach($sub_category as $r) 
								<option value="{{$r->categories_id}}">{{$r->sub_category_name}}</option> 
							@endforeach
						</select> 
					</div>    
					<div class="form-group"> 
						<label>Experience From</label>
						<input type="date" class="form-control" name="experience_from">  
					</div>  
					<div class="form-group">
						<label>Experience TO</label>
						<input type="date" class="form-control" name="experience_to">  
					</div>  
					<div class="form-group">
						<label>Description</label> 
						<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="description"></textarea> 
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