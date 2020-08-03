<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add User Sub Categories</h3>
			<a href="{{url('view-user-sub-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View User Sub Categories</a> 
		</div> 
		<form action="{{url('user-sub-categories-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="type" value="1"> 
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="parent_id" required>
						<option value="">select</option>
						@foreach($category as $r)
							<option value="{{$r->categories_id}}">{{$r->category_name}}</option>
							@error('parent_id')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>  
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Category Name</label>
					<input type="text" class="form-control" name="sub_category_name"> 
					@error('sub_category_name')
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