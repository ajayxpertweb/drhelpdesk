<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Location</h3>
			<a href="{{url('view-location')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Location</a> 
		</div> 
		<?php
            $cities = DB::table('cities')->orderBy('city_name')->get();
        ?>
		<form action="{{url('location-submit')}}" method="post" enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="locations_id" value="{{$result->locations_id}}"> 

			<div class="box-body"> 
				<div class="form-group">
					<label for="exampleInputEmail1">Location Name</label>
					<select id="deliveryLocaion"  name="location_name" class="form-control form-control-select2">
					<option>Select a Location...</option>
						@foreach($cities as $r) 
							<option value="{{str_replace('"','',$r->city_name)}}" {{strtolower(Session::get('set_location_name'))==strtolower(str_replace('"','',$r->city_name)) ?"selected":"" }}>{{str_replace('"','',$r->city_name)}}</option>  
						@endforeach 
					</select>
					<!-- <input type="text" class="form-control" name="location_name">  -->
					@error('location_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div> 
				<div class="form-group">
					<label for="exampleInputEmail1">Location Code</label>
					<input type="text" class="form-control" name="location_code" value="{{$result->location_code}}"> 
					@error('location_code')
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