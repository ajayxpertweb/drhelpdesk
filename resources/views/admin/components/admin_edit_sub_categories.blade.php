<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Sub Categories</h3>
			<a href="{{url('view-sub-categories')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Sub Categories</a> 
		</div> 
		<form action="{{url('sub-categories-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}   
			<input type="hidden" class="form-control" name="categories_id" value="{{$result->categories_id}}" required>
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="parent_id" required>
						<option value="">select</option>
						@foreach($category as $r)
							<option value="{{$r->categories_id}}" @if($result->parent_id == $r->categories_id)Selected @endif>{{$r->category_name}}</option>
							@error('parent_id')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Category</label> 
					<select class="form-control" name="sub_parent_id">
						<option value="">select</option>
						@foreach($sub_category as $r1)
							<option value="{{$r1->categories_id}}" @if($result->sub_parent_id == $r1->categories_id)Selected @endif>{{$r1->sub_category_name}}</option> 
						@endforeach
					</select> 
				</div>  
				<div class="form-group">
					<label>Sub Sub Category</label> 
					<select class="form-control" name="sub_sub_parent_id">
						<option value="">select</option>
						@foreach($sub_sub_category as $r2) 
							<option value="{{$r2->categories_id}}" @if($result->sub_sub_parent_id == $r2->categories_id)Selected @endif>{{$r2->sub_category_name}}</option> 
						@endforeach
					</select> 
				</div> 
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Category Name</label>
					<input type="text" class="form-control" name="sub_category_name" value="{{$result->sub_category_name}}" > 
					@error('sub_category_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Title</label>
					<input type="text" class="form-control" name="title" value="{{$result->title}}">  
				</div>  
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->image)}}"><br>
		            <input type="hidden" name="image" value="{{$result->image}}"><br>
		            <input type="file" class="form-control" name="image"> 
		            <p style="color:red;">*Please Upload only Image size is 606 * 236 px </p>
					@error('image')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Background Color</label>
					<input type="color" class="form-control" name="back_color" value="{{$result->back_color}}">  
				</div> 
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>