<div class="col-md-6"> 
	<div class="box box-primary">
		<div class="box-header with-border">
			<h3 class="box-title">Edit Coupon</h3>
			<a href="{{url('view-coupon')}}" class="btn btn-sm btn-success" style="float:right; color:white;">View Coupon</a> 
		</div> 
		<form action="{{url('coupon-submit')}}" method="post"  enctype="multipart/form-data">
			{{ csrf_field() }}  
			<input type="hidden" class="form-control" name="coupons_id" value="{{$result->coupons_id}}" required>
			<div class="box-body"> 
				<div class="form-group">
					<label>Coupon Name</label>
					<input type="text" class="form-control" name="copoun_name" value="{{$result->copoun_name}}">  
					@error('copoun_name')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Coupon Code</label>
					<input type="text" class="form-control" name="copoun_code" value="{{$result->copoun_code}}">  
					@error('copoun_code')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Amount</label>
					<input type="number" class="form-control" name="amount" value="{{$result->amount}}">  
					@error('amount')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<div class="form-group">
					<label>Type</label><br>
					<input type="radio" name="type" value="fixed" @if($result->type == 'fixed')selected @endif> Fixed Price  
					<input type="radio" name="type" value="percentage" @if($result->type == 'percentage')selected @endif> Percentage Basis
					@error('type')
                     	<p>* {{ $message }}</p>
                	@enderror
				</div>  
				<p style="color:red;">* If You Want to do limit of a coupon choose from or to below</p>
				<div class="form-group">
					<label>From</label>
					<input type="date" class="form-control" name="from" value="{{$result->from}}">  
				</div>  
				<div class="form-group">
					<label>TO</label>
					<input type="date" class="form-control" name="to" value="{{$result->to}}">  
				</div>   
				<div class="form-group">
					<label>No Of Uses</label>
					<input type="number" class="form-control" name="no_of_uses" value="{{$result->no_of_uses}}">  
					@error('no_of_uses')
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