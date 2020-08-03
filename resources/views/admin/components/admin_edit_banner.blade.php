<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Banner</h3>
			<a href="{{url('view-banner')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Banner</a> 
		</div> 
		<form action="{{url('banner-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="banners_id" value="{{$result->banners_id}}"> 
			<div class="box-body"> 
				<div class="form-group">
					<label>Banner Name</label>
					<input type="text" class="form-control" name="banner_name" value="{{$result->banner_name}}"> 
					@error('banner_name')
                     	<p>* {{ $message }}</p>
                	@enderror
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
					<label>Type</label>
					<input type="text" class="form-control" name="type" value="{{$result->type}}"> 
					@error('type')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>
                            <div class="form-group">
					<label>Banner Link</label>
					<input type="text" class="form-control" name="banner_link" value="{{$result->banner_link}}"> 
					
                	
				</div>
				<div class="form-group">
					<label>Location</label>
					<input type="text" class="form-control" name="location" value="{{$result->location}}"> 
					@error('location')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Page Name</label>
					<input type="text" class="form-control" name="page_name" value="{{$result->page_name}}"> 
					@error('page_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<p style="color:red;">* If You Want to do limit of a banner choose from or to below</p>
					<label>From</label>
					<input type="date" class="form-control" name="from" value="{{$result->from}}">  
				</div>  
				<div class="form-group">
					<label>TO</label>
					<input type="date" class="form-control" name="to" value="{{$result->to}}">  
				</div>  
				<div class="form-group">
					<label>Shown on</label><br>
					<input type="radio" name="show_on" value="web" {{ ($result->show_on=="web")? "checked" : "" }}>  Website
					<input type="radio" name="show_on" value="mob" {{ ($result->show_on=="mob")? "checked" : "" }}>  Mobile
				</div>  
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>