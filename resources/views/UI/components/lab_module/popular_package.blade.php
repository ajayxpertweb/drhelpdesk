<style>
	#sidebarpop{
		display: none;
		position: fixed;
	    top: 0;
	    right: 0;
	    z-index: 999;
	    background: #1d99b6;
        padding: 20px;
        width: 30%;
        height: 100vh;
	}
	#sidebarpop1{
		display: none;
		position: fixed;
	    top: 0;
	    right: 0;
	    z-index: 999;
	    background: white;
        padding: 20px;
        width: 30%;
        height: 100vh;
	}
	.sideform{
		-webkit-box-pack: start;
	    -ms-flex-pack: start;
	    justify-content: flex-start;
	    padding: 15px;
	    background-color: #fff;
	    border: 1px solid #dfe3e6;
	    border-radius: 10px;
	    font-size: 14px;
	    font-weight: 700;
	}
	.iconimg {
	    height: 20px;
	    position: absolute;
	    right: 5px;
	    top: 40px;
   	} 
   	input {
   		width:100%;
   	}
   	.iconimg {
   		height: 20px;
   		position: absolute;
   		right: 5px;
   		top: 5px;
   	}
   	.presentationform .form-group{
   		position: relative;
   	}
   	.inputtext{
   		position: absolute;
   		top: 5px;
   		left: 10px;
   	}
   	.presentationform h3{
   		color: white;
   		font-size: 20px;
   		margin-bottom: 10px;
   	}
   	#sidebarpop .close {
   		position: absolute;
   		padding: 15px;
   		top: 30px;
   		left: -43px;
   		z-index: 2;
   		display: -webkit-box;
   		display: -ms-flexbox;
   		display: flex;
   		cursor: pointer;
   		background: #1d99b6;
   		color: #8897a2;
   		opacity: inherit;
   		right: auto;
   	}
   	#sidebarpop1 .close {
   		position: absolute;
   		padding: 15px;
   		top: 30px;
   		left: -43px;
   		z-index: 2;
   		display: -webkit-box;
   		display: -ms-flexbox;
   		display: flex;
   		cursor: pointer;
   		background: #1d99b6;
   		color: #8897a2;
   		opacity: inherit;
   		right: auto;
   	}
   	#sidebarpop ._2RlN7{
   		color: white;
   	}
   	.testlab-list{
   		background-color: white;
   		width: 100%;
   		border: 1px solid #1d99b624;
   		padding: 20px;
   	}
   	.testlab-list img{
   		width: 30px;
   		height: 30px;
   	}
   	.testlab-list h2{
   		font-size: 16px;
   		margin-top: 10px;
   	}
   	.testlab-list p{
   		font-size: 12px;
   	}
</style>
@include('UI.components/home_slider')   
<!-- <div class="block-space block-space--layout--divider-xs"></div> -->
<div class="block block-brands block-brands--layout--columns-6-full">
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<ul class="myul">
					<li><a class="SSZRE diagnosticsHoverEffect" href="{{url('lab-test')}}"><img class="L2VjC" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/6b3d644c.svg" alt="All Tests">All Tests</a></li>
				</ul>
			</div>
			<div class="col-md-3">
				<ul class="myul">
					<li><a class="SSZRE diagnosticsHoverEffect" href="{{url('all-package')}}"><img class="L2VjC" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/dea295a0.svg" alt="Health Packages">Health Packages</a></li>
				</ul>
			</div>
			@guest
			    <div class="col-md-3">
				<ul class="myul">
					<li><a class="SSZRE diagnosticsHoverEffect" href="{{url('/')}}"><img class="L2VjC" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/d4d62fbf.svg" alt="Upload Prescription">Upload Prescription</a></li>
				</ul>
			    </div>
			@else
			    <div class="col-md-3">
				<ul class="myul">
					<li><a class="SSZRE diagnosticsHoverEffect" href="{{url('/upload-prescription')}}"><img class="L2VjC" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/d4d62fbf.svg" alt="Upload Prescription">Upload Prescription</a></li>
				</ul>
			    </div>
			@endguest
			
			<div class="col-md-3">
				<div tabindex="0" role="button" class="_2tdEn SSZRE diagnosticsHoverEffect" to="" onclick="sidePop()"><img class="L2VjC" src="https://d2y2l77dht9e8d.cloudfront.net/web-assets/dist/4ed59722.svg" alt="Book on Call">
                                    <a href="//api.whatsapp.com/send?phone=917393869990&text=booking Order">
                                    Book on WhatsApp
                                    </a>
                                </div>
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div> 
@include('UI.components/home_popular_health_packages_page')   
<div class="block block-products-carousel" data-layout="grid-5">
	<div class="container">
		<div class="section-header">
			<div class="section-header__body">
				<h2 class="section-header__title">Top Logo</h2>
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
				@foreach($vendor as $vendors)
					@if($vendors->logo == null)
					<div class="block-products-carousel__column">
						<div class="block-products-carousel__cell">
							<div class="product-card product-card--layout--grid"> 
								<div class="product-card__image">
									<img src="images/logo2.png" style="height: 180px;"> 
								</div>
							</div>
						</div>
					</div>
					@else
					<div class="block-products-carousel__column">
						<div class="block-products-carousel__cell">
							<div class="product-card product-card--layout--grid"> 
								<div class="product-card__image">
									<img src="{{asset($vendors->logo)}}" style="height: 180px;"> 
								</div>
							</div>
						</div>
					</div>
					@endif
				@endforeach 
			</div>
		</div>
	</div>
</div>
<div class="block-space block-space--layout--divider-xl"></div>
@include('UI.components/home_reviews_section')  
@include('UI.components/home_features_section')  