<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Packages</h3>
			<a href="{{url('view-packages')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Packages</a> 
		</div> 
		<form action="{{url('packages-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Package Name</label>
					<input type="text" class="form-control" name="package_name"> 
					@error('package_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<?php
				    $testing = DB::table('products')->where('categories',$test->categories_id)->get();
				?>
				<div class="form-group">
					<label>All Package</label>
					<select name="package[]" multiple class="chosen-select form-control"  required>
						 
						@foreach($testing as $r) 
							<option value="{{$r->products_id}}">{{$r->product_name}}</option> 
						@endforeach
					</select> 
				</div> 
				 
				<div class="form-group">
					<label>Package Price</label>
					<input type="number" class="form-control" name="package_cost"> 
					@error('package_cost')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Package Offer Discount</label>
					<input type="number" class="form-control" name="offer_discount"> 
					@error('offer_discount')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
                            <div class="form-group">
					<label>Short Description</label>
					<input type="text" class="form-control" name="short_disc"> 
					@error('short_disc')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
                            <div class="form-group">
					<label>Long Description</label>
                                        <textarea class="form-control" name="long_disc"></textarea> 
					@error('long_disc')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
                            
				<div class="form-group">
					<label>Package Type</label><br>
					<input type="radio" name="type" value="1"> Affordable &nbsp;&nbsp;&nbsp;
					<input type="radio" name="type" value="0" checked> Non Affordable
					@error('type')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Main Image</label>
					<input type="file" class="form-control" name="image"> 
					@error('image')
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
 
<script>
  $(".chosen-select").chosen({
  no_results_text: "Oops, nothing found!"
})
</script>