<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Blog</h3>
			<a href="{{url('view-blogs')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Blog</a> 
		</div> 
		<form action="{{url('blogs-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Blog Title</label>
					<input type="text" class="form-control" name="blog_title"> 
					@error('blog_title')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Blog Image</label>
					<input type="file" class="form-control" name="blog_image"> 
					<!-- <p style="color:red;">*Please Upload only Image size is 606 * 236 px </p> -->
					@error('blog_image')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Blog Description</label> 
					<textarea rows="4" cols="15" id="editor1"   class="form-control"  name="blog_description" required></textarea>  
				</div>   
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>