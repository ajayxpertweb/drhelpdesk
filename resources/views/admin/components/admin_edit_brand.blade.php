<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Brand</h3>
			<a href="{{url('view-brand')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Brand</a> 
		</div> 
		<form action="{{url('brand-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="id" value="{{$result->id}}"> 
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Brand Name</label>
					<input type="text" class="form-control" name="brand_name" value="{{$result->brand_name}}" required> 
					@error('brand_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->image)}}"><br>
		            <input type="hidden" name="image" value="{{$result->image}}"><br>
		            <input type="file" class="form-control" name="image"> 
		            <p style="color:red;">*Please Upload only Image size is   px </p> 
				</div>  
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>