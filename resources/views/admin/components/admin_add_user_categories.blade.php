<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add User Categories</h3>
			<a href="{{url('view-user-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View User Categories</a> 
		</div> 
		<form action="{{url('user-categories-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="type" value="1"> 
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Category Name</label>
					<input type="text" class="form-control" name="category_name"> 
					@error('category_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" name="title">  
				</div>  
				<div class="form-group">
					<label>Image</label>
					<input type="file" class="form-control" name="image"> 
					<p style="color:red;">*Please Upload only Image size is 606 * 236 px </p>
					@error('image')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Background Color</label>
					<input type="color" class="form-control" name="back_color">  
				</div>
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>