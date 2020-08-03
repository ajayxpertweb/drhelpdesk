<style>
	p {
		color:red;
		font-size:14px;
		font-family:verdana;
	}
</style>
<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Products</h3>
			<a href="{{url('view-product')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Products</a> 
		</div> 
		<form action="{{url('products-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<div class="box-body"> 
				<div class="form-group">
					<label>Product Name</label>
					<input type="text" class="form-control" name="product_name" value="{{ old('product_name') }}"> 
					@error('product_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>Product Code</label>
					<input type="text" class="form-control" name="product_code" value="{{ old('product_code') }}"> 
					@error('product_code')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label>Product Quantity</label>
					<input type="number" class="form-control" name="quantity" value="{{ old('quantity') }}">  
				</div> 
				<div class="form-group">
					<label>Product Price</label>
					<input type="text" class="form-control" name="price" value="{{ old('price') }}"> 
					@error('price')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>   
				<div class="form-group">
					<label>Product Special Price</label>
					<input type="text" class="form-control" name="special_price" value="{{ old('special_price') }}"> 
				</div>   
				<div class="form-group">
					<label>Extra Discount</label>
					<input type="number" class="form-control" name="extra_discount" value="{{ old('extra_discount') }}">  
				</div>  
				<div class="form-group">
					<label>Key Features</label> 
					<textarea rows="4" cols="15" id="editor1" class="form-control"  name="key_features" value="{{ old('key_features') }}"></textarea>  
				</div> 
				<div class="form-group">
					<label>Short Description</label> 
					<textarea rows="4" cols="15" style="resize: vertical;"  class="form-control"  name="short_description" value="{{ old('short_description') }}"></textarea>  
				</div>   
				<div class="form-group">
					<label>Long Description</label> 
					<textarea rows="4" cols="15" id="editor2"   class="form-control"  name="long_description" value="{{ old('long_description') }}"></textarea>  
				</div> 

				<div class="form-group">
					<label>Featured Product</label>&nbsp;
					<input type="checkbox"  name="featured_product" value="featured_product" value="{{ old('featured_product') }}">&nbsp;&nbsp;&nbsp; 
                	<label>Top Selling Product</label>&nbsp;
					<input type="checkbox"  name="top_selling_product" value="top_selling_product" value="{{ old('top_selling_product') }}">  
				</div> 
				<div class="form-group">
					<label>If You Want To Upload Prescription Mandantory Then Check It</label> &nbsp;&nbsp;	
					<input type="checkbox"  name="prescription" value="1" value="{{ old('prescription') }}"> 
				</div> 
				<div class="form-group">
					<label>Brand</label>
					<select name="brand" class="form-control">
						<option value="">select</option>
						@foreach($test as $r) 
							<option value="{{$r->id}}">{{$r->brand_name}}</option> 
						@endforeach
					</select>  
				</div> 
				<div class="form-group">
					<label>Tags</label>
					<input type="text" class="form-control" name="tags" value="{{ old('tags') }}">  
				</div>    

				<div class="form-group">
					<label for="exampleInputEmail1">Category</label> 
					<select class="form-control" name="categories" required>
						<option value="">select</option>
						@foreach($category as $r) 
							<option value="{{$r->categories_id}}">{{$r->category_name}}</option>
							@error('categories')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>    
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Category</label> 
					<select class="form-control" name="sub_categories">
						<option value="">select</option>
						@foreach($sub_category as $r) 
							<option value="{{$r->categories_id}}">{{$r->sub_category_name}}</option>
							@error('sub_categories')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>    
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Sub Category</label> 
					<select class="form-control" name="sub_sub_categories">
						<option value="">select</option>
						@foreach($sub_sub_category as $r1) 
							<option value="{{$r1->categories_id}}">{{$r1->sub_category_name}}</option> 
						@endforeach
					</select> 
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Sub Sub Sub Category</label> 
					<select class="form-control" name="sub_sub_sub_categories">
						<option value="">select</option>
						@foreach($sub_sub_sub_category as $r2) 
							<option value="{{$r2->categories_id}}">{{$r2->sub_category_name}}</option> 
						@endforeach
					</select> 
				</div>
				<div class="form-group">
					<label for="exampleInputEmail1">Vendor Name</label> 
					<select class="form-control" name="vendor_id" required>
						<option value="">Select</option>
						@foreach($vendor as $r) 
							<option value="{{$r->vendors_id}}">{{$r->vendor_name}}</option>
							@error('vendor_id')
		                     	<p>* {{ $message }}</p>
		                	@enderror
						@endforeach
					</select> 
				</div>  

				<div class="form-group">
					<label>Main Image</label>
					<input type="file" class="form-control" name="product_image_one" value="{{ old('product_image_one') }}"> 
					@error('product_image_one')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  

				<div class="form-group">
					<label>Sub Images</label>
					<input type="file" class="form-control" name="product_image_two" value="{{ old('product_image_two') }}"> 
					@error('product_image_two')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  

				<div class="form-group">
					<label>Sub Images</label>
					<input type="file" class="form-control" name="product_image_three" value="{{ old('product_image_three') }}"> 
					@error('product_image_three')
                     	<p>* {{ $message }}</p>
                	@enderror 
				</div>  

				<div class="form-group">
					<label>Sub Images</label>
					<input type="file" class="form-control" name="product_image_four" value="{{ old('product_image_four') }}"> 
					@error('product_image_four')
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
<div class="col-md-6">
    <div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Add Products By Excel</h3> 
		</div> 
        <form action="{{ url('import') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <input type="file" name="file" class="form-control" required>
          <br>
          <button class="btn btn-success">Import File</button>
        </form><br> 
    </div>
</div>
<script type="text/javascript">
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('editor1');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
