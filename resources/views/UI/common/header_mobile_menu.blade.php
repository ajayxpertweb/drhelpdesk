<!-- mobile-menu -->
<div class="mobile-menu">
	<div class="mobile-menu__backdrop"></div>
	<div class="mobile-menu__body">
		<button class="mobile-menu__close" type="button">
			<i class="fa fa-times"></i>
		</button>
		<div class="mobile-menu__panel">
			<div class="mobile-menu__panel-header">
				<div class="mobile-menu__panel-title">Menu</div>
			</div>
			<div class="mobile-menu__panel-body">
				<div class="mobile-menu__settings-list">
					<div class="mobile-menu__setting" data-mobile-menu-item>
						<button class="mobile-menu__setting-button" title="Language" data-mobile-menu-trigger><span class="mobile-menu__setting-icon"><img src="{{asset('UI/images/languages/language-1.png')}}" alt=""> </span><span class="mobile-menu__setting-title">English</span>  <span class="mobile-menu__setting-arrow"><i class="fas fa-angle-right"></i></span>
						</button>
						<div class="mobile-menu__setting-panel" data-mobile-menu-panel>
							<div class="mobile-menu__panel mobile-menu__panel--hidden">
								<div class="mobile-menu__panel-header">
									<button class="mobile-menu__panel-back" type="button">
										<i class="fas fa-angle-left"></i>
									</button>
									<div class="mobile-menu__panel-title">Language</div>
								</div>
								<div class="mobile-menu__panel-body">
									<ul class="mobile-menu__links">
										<li data-mobile-menu-item>
											<button type="button" class="" data-mobile-menu-trigger>
												<div class="mobile-menu__links-image">
													<img src="{{asset('UI/images/languages/language-1.png')}}" alt="">
												</div>English</button>
										</li>
										
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="mobile-menu__setting" data-mobile-menu-item>
						<button class="mobile-menu__setting-button" title="Currency" data-mobile-menu-trigger><span class="mobile-menu__setting-icon mobile-menu__setting-icon--currency"><i class="fas fa-rupee-sign"></i> </span><span class="mobile-menu__setting-title">INR</span>  <span class="mobile-menu__setting-arrow"><i class="fas fa-angle-right"></i></span>
						</button>
						
					</div>
				</div>
				<div class="mobile-menu__divider"></div>
				<div class="mobile-menu__indicators">
					<a class="mobile-menu__indicator" href="{{url('/')}}">
						<span class="mobile-menu__indicator-icon"><i class="icon-home"></i></span><span class="mobile-menu__indicator-title">Home</span> 
					</a>
					@if(Auth::check())
					@else
					<a class="mobile-menu__indicator" href="{{url('/login-user')}}">
						<span class="mobile-menu__indicator-icon"><i class="icon-user-lock"></i> </span><span class="mobile-menu__indicator-title">Account</span> 
					</a>
					@endif
					@if(Auth::check())
					<a class="mobile-menu__indicator" href="{{url('/my-cart')}}">
						<span class="mobile-menu__indicator-icon"><i class="icon-cart-full"></i><span class="mobile-menu__indicator-counter">3</span> </span><span class="mobile-menu__indicator-title">Cart</span> 
					</a>
					@else
					<a class="mobile-menu__indicator" href="{{url('/login-user')}}">
						<span class="mobile-menu__indicator-icon"><i class="icon-cart-full"></i><span class="mobile-menu__indicator-counter"></span> </span><span class="mobile-menu__indicator-title">Cart</span> 
					</a>
					@endif
					@if(Auth::check())
					<a class="mobile-menu__indicator" href="">
						<span class="mobile-menu__indicator-icon"><i class="icon-wallet"></i> </span><span class="mobile-menu__indicator-title">Wallet</span>
					</a>
					@else
					<a class="mobile-menu__indicator" href="{{url('/login-user')}}">
						<span class="mobile-menu__indicator-icon"><i class="icon-wallet"></i> </span><span class="mobile-menu__indicator-title">Wallet</span>
					</a>
					@endif

					
				</div>
				<div class="mobile-menu__divider"></div>
				<?php
                  $save_more_category = DB::table('categories')->where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 
                ?>
				<ul class="mobile-menu__links">
					@foreach($save_more_category as $r)
					<li data-mobile-menu-item><a href="{{url('filter-category/'.$r->categories_id)}}" class="" data-mobile-menu-trigger>{{$r->category_name}}</a>
					</li>
					@endforeach 
				</ul>
				<div class="mobile-menu__spring"></div>
				<div class="mobile-menu__divider"></div>
				<a class="mobile-menu__contacts" href="#">
					<div class="mobile-menu__contacts-subtitle">Free call 24/7</div>
					<div class="mobile-menu__contacts-title">1800 060 0730</div>
				</a>
			</div>
		</div>
	</div>
</div>
<!-- mobile-menu / end -->