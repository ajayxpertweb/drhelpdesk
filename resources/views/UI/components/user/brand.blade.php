<div class="block-space block-space--layout--divider-sm"></div>
<div class="container">
   <div class="row">
	   <div class="col-md-12">
	   	<div class="block block-products-carousel" data-layout="grid-5">
				<div class="container">
					<div class="section-header">
						<div class="section-header__body">
							<h2 class="section-header__title">Our Top Brand</h2>
							<div class="section-header__spring"></div>
							
							<div class="section-header__arrows">
								<div class="arrow section-header__arrow section-header__arrow--prev arrow--prev">
									<button class="arrow__button" type="button">
										<i class="fas fa-angle-left"></i>
									</button>
								</div>
								<div class="arrow section-header__arrow section-header__arrow--next arrow--next">
									<button class="arrow__button" type="button">
										<i class="fas fa-angle-right"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
					<div class="block-products-carousel__carousel">
						<div class="block-products-carousel__carousel-loader"></div>
						<div class="owl-carousel">
							<?php
			                 	$brands = DB::table('brands')->where('status',0)->get();
			                ?>
							@foreach($brands as $r) 
							<div class="block-products-carousel__column">
								<div class="block-products-carousel__cell">
									<div class="product-card product-card--layout--grid"> 
										<div class="product-card__image"> 
											@if(file_exists(asset($r->image)))
								                <img src="{{asset($r->image)}}" style="height: 180px;"> 
								            @elseif($r->image == null)
								                <img src="{{asset('UI/images/Gallery.png')}}" style="height: 180px;">
								            @else 
								                <img src="{{asset('UI/images/Gallery.png')}}" style="height: 180px;">
								            @endif   
										</div>
										
									</div>
								</div><br>
								<div class="alltest-heading" style="text-align:center;">{{$r->brand_name}}</a></div>
							</div>
							@endforeach  
						</div>
					</div>
				</div>
			</div>
	   </div>
   </div>
    
</div>
<div class="block-space block-space--layout--divider-sm"></div> 