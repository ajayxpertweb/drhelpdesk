<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Role</h3>
			<a href="{{url('view-role')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Role</a> 
		</div> 
		<form action="{{url('role-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="roles_id" value="{{$result->roles_id}}" required> 
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Role Name</label>
					<input type="text" class="form-control" name="role_name" value="{{$result->role_name}}" required>
				</div>  
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>