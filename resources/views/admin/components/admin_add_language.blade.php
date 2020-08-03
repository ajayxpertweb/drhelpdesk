<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Language</h3>
			<a href="{{url('view-language')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Language</a> 
		</div> 
		<form action="{{url('language-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Language Name</label>
					<input type="text" class="form-control" name="language_name"> 
					@error('language_name')
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