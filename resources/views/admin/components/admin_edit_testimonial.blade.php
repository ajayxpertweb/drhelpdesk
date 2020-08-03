<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Blog</h3>
			<a href="{{url('view-blogs')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Blog</a> 
		</div> 
		<form action="{{url('blogs-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="blogs_id" value="{{$result->blogs_id}}"> 
			<div class="box-body"> 
				<div class="form-group">
					<label>Blog Title</label>
					<input type="text" class="form-control" name="blog_title" value="{{$result->blog_title}}"> 
					@error('blog_title')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Blog Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->blog_image)}}"><br>
		            <input type="hidden" name="blog_image" value="{{$result->blog_image}}"><br>
		            <input type="file" class="form-control" name="blog_image"> 
		            <!-- <p style="color:red;">*Please Upload only Image size is 606 * 236 px </p> --> 
				</div>   
				<div class="form-group">
					<label>Blog Description</label> 
					<textarea rows="4" cols="15" id="editor1"  class="form-control"  name="blog_description" required>{{$result->blog_description}}</textarea>  
				</div>   
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>


<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Testimonial</h3>
			<a href="{{url('view-testimonials')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Testimonial</a> 
		</div> 
		<form action="{{url('testimonials-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="blogs_id" value="{{$result->blogs_id}}"> 
			<div class="box-body"> 
				<div class="form-group">
					<label>User Name</label>
					<input type="text" class="form-control" name="name"  value="{{$result->blog_title}}"> 
					@error('name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>User Position</label>
					<input type="text" class="form-control" name="position"  value="{{$result->blog_title}}"> 
					@error('position')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>User Image</label>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->image)}}"><br>
		            <input type="hidden" name="image" value="{{$result->image}}"><br>
		            <input type="file" class="form-control" name="image"> 
					<!-- <p style="color:red;">*Please Upload only Image size is 606 * 236 px </p> --> 
				</div>  
				<div class="form-group">
					<label>Description</label> 
					<textarea rows="4" cols="15" id="editor1"   class="form-control"  name="description" required>{!!$result->blog_description!!}</textarea> 
				</div>   
				<div class="form-group">
					<label>Rating</label>
					<input type="text" class="form-control" name="rating"  value="{{$result->blog_title}}"> 
					@error('rating')
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