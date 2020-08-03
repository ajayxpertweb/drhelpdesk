<div class="block-space block-space--layout--divider-xs"></div>
<div class="block block-brands block-brands--layout--columns-6-full">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="float-left">
						<h3>Our Brands</h3>
						</div>
						
					</div>
				</div>
                            <?php
                             $brands = DB::table('brands')->where('status',0)->get();
                            ?>
				@foreach($brands as $r) 
					 
					<div class="alltest-box">
						<!--  -->
						<div>
							@if($r->image == null)
                            <img class="alltest-img" src="{{asset('UI/images/lab.png')}}" alt="brands" width="150px">
							@else
							<img  src="{{asset($r->image)}}" alt="Brands" width="150px">
							@endif
							<div class="alltest-content">
                                                            <div class="alltest-heading">{{$r->brand_name}}</a></div>
							</div>
						</div> 
						
					</div>
				
				@endforeach 
				
			</div>
			
	</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>