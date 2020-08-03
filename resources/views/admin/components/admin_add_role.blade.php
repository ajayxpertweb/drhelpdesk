<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Role</h3>
			<a href="{{url('view-role')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Role</a> 
		</div> 
		<form action="{{url('role-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Role Name</label>
					<input type="text" class="form-control" name="role_name"> 
					@error('role_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>