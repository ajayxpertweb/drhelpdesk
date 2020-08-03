<div class="col-md-8"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Products</h3>
			<a href="{{url('view-product')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Products</a> 
		</div> 
		<?php  
			$image = DB::table('product_images')->where('products_id' , $result->products_id)->where('type',2)->first();
			$image1 = DB::table('product_images')->where('products_id' , $result->products_id)->where('type',1)->get();
		?>
		<form action="{{url('products-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="products_id" value="{{$result->products_id}}"> 
			<div class="box-body"> 
				<div class="form-group">
					<label>Product Name</label>
					<input type="text" class="form-control" name="product_name" value="{{$result->product_name}}">  
					@error('product_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>Product Code</label>
					<input type="text" class="form-control" name="product_code" value="{{$result->product_code}}"> 
					@error('product_code')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>Product Quantity</label>
					<input type="number" class="form-control" name="quantity" value="{{$result->quantity}}">  
				</div> 
				<div class="form-group">
					<label>Product Price</label>
					<input type="text" class="form-control" name="price" value="{{$result->price}}"> 
					@error('price')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Product Special Price</label>
					<input type="text" class="form-control" name="special_price" value="{{$result->special_price}}">  
				</div>   
				<div class="form-group">
					<label>Extra Discount</label>
					<input type="number" class="form-control" name="extra_discount" value="{{$result->extra_discount}}">  
				</div>    
				<div class="form-group">
					<label>Key Features</label> 
					<textarea rows="4" cols="15" id="editor1"   class="form-control"  name="key_features">{{$result->key_features}}</textarea>  
				</div> 
				<div class="form-group">
					<label>Short Description</label> 
					<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="short_description">{{$result->short_description}}</textarea>  
				</div>   
				<div class="form-group">
					<label>Long Description</label> 
					<textarea rows="4" cols="15" id="editor2"   class="form-control"  name="long_description">{{$result->long_description}}</textarea>  
				</div> 

				<div class="form-group">
					<label>Featured Product</label>&nbsp;
					<input type="checkbox"  name="featured_product" value="featured_product" @if($result->featured_product == 'featured_product')checked @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  
                	<label>Top Selling Product</label>&nbsp;
					<input type="checkbox" value="top_selling_product" name="top_selling_product" @if($result->top_selling_product == 'top_selling_product')checked @endif>  
				</div>  
                <div class="form-group">
					<label>If You Want To Upload Prescription Mandantory Then Check It</label> &nbsp;&nbsp;	
					<input type="checkbox"  name="prescription" value="1" @if($result->prescription == 1)checked @endif> 
				</div> 
				<div class="form-group">
					<label>Brand</label>
					<select name="brand" class="form-control">
						<option value="">select</option>
						@foreach($test as $r) 
							<option value="{{$r->id}}" @if($r->id == $result->brand)selected @endif>{{$r->brand_name}}</option> 
						@endforeach
					</select>  
				</div> 
				<div class="form-group">
					<label>Tags</label>
					<input type="text" class="form-control" name="tags" value="{{$result->tags}}">  
				</div>    
				<div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="categories" required>
						<option value="disabled">select</option>
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}" @if($result->categories == $r->categories_id)Selected @endif>{{$r->category_name}}</option>
							@error('categories')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>    
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Category</label> 
					<select class="form-control" name="sub_categories" required>
						<option value="disabled">select</option>
						@foreach($sub_category as $r) 
							<option value="{{$r->categories_id}}" @if($result->sub_categories == $r->categories_id)Selected @endif>{{$r->sub_category_name}}</option>
							@error('sub_categories')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>    
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Sub Category</label> 
					<select class="form-control" name="sub_sub_categories">
						<option value="disabled">select</option>
						@foreach($sub_sub_category as $r1) 
							<option value="{{$r1->categories_id}}" @if($result->sub_sub_categories == $r->categories_id)Selected @endif>{{$r1->sub_category_name}}</option> 
						@endforeach
					</select> 
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Sub Sub Category</label> 
					<select class="form-control" name="sub_sub_sub_categories">
						<option value="disabled">select</option>
						@foreach($sub_sub_sub_category as $r2) 
							<option value="{{$r2->categories_id}}" @if($result->sub_sub_sub_categories == $r2->categories_id)Selected @endif>{{$r2->sub_category_name}}</option> 
						@endforeach
					</select> 
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Vendor Name</label> 
					<select class="form-control" name="vendor_id" required>
						<option value="disabled">select</option>
						@foreach($vendor as $r) 
							<option value="{{$r->vendors_id}}" @if($result->vendor_id == $r->vendors_id)Selected @endif>{{$r->vendor_name}}</option> 
							@error('vendor_id')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>  
				<div class="form-group">
					<input type="hidden" name="product_images_id" value="{{$image->product_images_id}}"><br>
					<label>Main Image</label><br>
					<img style="height: 150px; width: 130px;"  src="{{asset($image->product_image)}}"><br>
		            <input type="hidden" name="product_image_one" value="{{$image->product_image}}"><br>
		            <input type="file" class="form-control" name="product_image_one"> 
		            <!-- <p style="color:red;">*Please Upload only Image size is 606 * 236 px </p>  -->
				</div>  
				@foreach($image1 as $r)
					<div class="form-group">
						<input type="hidden" name="product_images_id1[]" value="{{$r->product_images_id}}"><br>
						<label>Sub Image</label><br>
						<img style="height: 150px; width: 130px;"  src="{{asset($r->product_image)}}"><br>
			            <input type="hidden" name="product_image_two[]" value="{{$r->product_image}}"><br>
			            <input type="file" class="form-control" name="product_image_two[]"> 
			            <!-- <p style="color:red;">*Please Upload only Image size is 606 * 236 px </p>  -->
					</div> 
				@endforeach
			</div>  
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
	</div> 
</div>  