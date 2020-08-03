<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.jquery.min.js"></script>
<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Packages</h3>
			<a href="{{url('view-packages')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Packages</a> 
		</div> 
		<form action="{{url('packages-submit')}}" method="post"  enctype="multipart/form-data">
			<input type="hidden" name="id" value="{{$result->id}}">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Package Name</label>
					<input type="text" class="form-control" name="package_name" value="{{$result->package_name}}"> 
					@error('package_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>All Package</label>
					<?php
					    $testing = DB::table('products')->where('categories',$test->categories_id)->get();
					?>
					<select name="package[]" multiple class="chosen-select form-control"  required>
					 
						@foreach($testing as $r) 
							<option value="{{$r->products_id}}" @if($result->package == $r->products_id)Selected @endif>{{$r->product_name}}</option> 
						@endforeach
					</select> 
					<!-- <select class="form-control select2" multiple="multiple" data-placeholder="Select a State" style="width: 100%;">
                      <option>Alabama</option>
                      <option>Alaska</option>
                      <option>California</option>
                      <option>Delaware</option>
                      <option>Tennessee</option>
                      <option>Texas</option>
                      <option>Washington</option>
                    </select> -->
				</div> 
				 
				<div class="form-group">
					<label>Package Price</label>
					<input type="number" class="form-control" name="package_cost" value="{{$result->package_cost}}"> 
					@error('package_cost')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Package Offer Discount</label>
					<input type="number" class="form-control" name="offer_discount" value="{{$result->offer_discount}}"> 
					@error('offer_discount')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
                            <div class="form-group">
					<label>Short Description</label>
					<input type="text" class="form-control" name="short_disc" value="{{$result->short_disc}}"> 
					@error('short_disc')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
                            <div class="form-group">
					<label>Long Description</label>
                                        <textarea class="form-control" name="long_disc">{{$result->long_disc}}</textarea> 
					@error('long_disc')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>Package Type</label><br>
					<input type="radio" name="type" value="1" @if ($result->type=='1')
					 checked @endif > Affordable &nbsp;&nbsp;&nbsp;
					<input type="radio" name="type" value="0" @if ($result->type=='0')
					 checked @endif > Non Affordable
				</div>  
				<div class="form-group">
					<label>Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($result->image)}}"><br>
		            <input type="hidden" name="image" value="{{$result->image}}"><br>
		            <input type="file" class="form-control" name="image"> 
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
