<div class="block-header block-header--has-breadcrumb block-header--has-title">

	<div class="container">

		<div class="block-header__body">

			<nav class="breadcrumb block-header__breadcrumb" aria-label="breadcrumb">

				<ol class="breadcrumb__list">

					<li class="breadcrumb__spaceship-safe-area" role="presentation"></li>

					<li class="breadcrumb__item breadcrumb__item--parent breadcrumb__item--first"><a href="{{url('/')}}" class="breadcrumb__item-link">Home</a>

					</li>

					<li class="breadcrumb__item breadcrumb__item--parent"><a href="#" class="breadcrumb__item-link">Product</a>

					</li>

					<li class="breadcrumb__item breadcrumb__item--current breadcrumb__item--last" aria-current="page"><span class="breadcrumb__item-link">Product Listing</span>

					</li>

					<li class="breadcrumb__title-safe-area" role="presentation"></li>

				</ol>

			</nav>

		</div>

	</div>

</div> 

<form action="{{route('filtercategory.show',[$data['parameter'][0],$data['parameter'][1],$data['parameter'][2],$data['parameter'][3]] )}}" method="post">

@csrf 

<div class="block-split block-split--has-sidebar">

	<div class="container">

		<div class="block-split__row row no-gutters">

			<div class="block-split__item block-split__item-sidebar col-auto">

				<div class="sidebar sidebar--offcanvas--mobile">

					<div class="sidebar__backdrop"></div>

					<div class="sidebar__body"> 

						<div class="sidebar__content"> 

							

								<div class="widget widget-filters widget-filters--offcanvas--mobile" data-collapse data-collapse-opened-class="filter--opened"> 

									<div class="widget-filters__list">

										<div class="widget-filters__item">

											<div class="filter filter--opened" data-collapse-item>

												<button type="button" class="filter__title" data-collapse-trigger>{{ $data['r']->category_name}} <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

												</button>

												<div class="filter__body" data-collapse-content>

													<div class="filter__container">

														<div class="filter-categories">

														    <ul> 

																@php 

																	$sub_category = DB::table('categories')->where('parent_id',$data['r']->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->where('status',0)->get(); 

																@endphp

																@foreach($sub_category as $r1)

																	@php 

																		$sub_sub_category = DB::table('categories')->where('sub_parent_id',$r1->categories_id)->where('sub_sub_parent_id',null)->where('status',0)->get(); 

																	@endphp

																	<li class="">

																		<a href="{{url('filter-category/'.$data['r']->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
																		<span></span>
																		<ul>  

																			@foreach($sub_sub_category as $r2)

																				@php 

																					$sub_sub_sub_category = DB::table('categories')->where('sub_sub_parent_id',$r2->categories_id)->where('status',0)->get(); 

																				@endphp

																				<li class="">

																					<a href="{{url('filter-category/'.$data['r']->categories_id.'/'.$r1-> categories_id.'/'.$r2-> categories_id)}}">{{$r2->sub_category_name}}</a>
																					<span></span>

																					<ul> 

																						@foreach($sub_sub_sub_category as $r3) 

																						<li><a href="{{url('filter-category/'.$data['r']->categories_id.'/'.$r1-> categories_id.'/'.$r2-> categories_id.'/'.$r3->categories_id)}}">{{$r3->sub_category_name}}</a>

																						</li> 

																						@endforeach  

																					</ul>

																				</li>  

																			@endforeach 

																		</ul>

																	</li>  

																@endforeach  

															</ul>  

														</div>

													</div>

												</div>

											</div>

										</div>  

										<div class="widget-filters__item">

											<div class="filter filter--opened" data-collapse-item>

												<button type="button" class="filter__title" data-collapse-trigger>Price <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

												</button>

												<div class="filter__body" data-collapse-content>

													<div class="filter__container">

														<div class="filter-price" data-min="0" data-max="{{$data['maxValue']}}" data-from="{{$minpr}}" data-to="@if($maxpr != null) {{$maxpr}} @else {{$data['maxValue']}} @endif">

															<div class="filter-price__slider"></div>

															<div class="filter-price__title-button">

																<div class="filter-price__title"> <i class="fas fa-rupee-sign"></i><span class="filter-price__min-value"></span> – <i class="fas fa-rupee-sign"></i><span class="filter-price__max-value"></span>

																</div>

																<!-- <button type="button" class="btn btn-xs btn-secondary filter-price__button">Filter</button> -->

																<input type="hidden" name="minpr" id="minpr" />

																<input type="hidden" name="maxpr" id="maxpr" />



															</div>

														</div>

													</div>

												</div>

											</div>

										</div>

										@php

											$brand1 = DB::table('brands')->where('status',0)->get();

										@endphp

										<div class="widget-filters__item">

											<div class="filter filter--opened" data-collapse-item>

												<button type="button" class="filter__title" data-collapse-trigger>Brand <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

												</button>

												<div class="filter__body" data-collapse-content>

													<div class="filter__container">

														<div class="filter-list">

															<div class="filter-list__list"> 

																@foreach($brand1 as $r1) 

																	@php 

																	$total_brand = 	  DB::table('products')->where('brand',$r1->id)->get(); 

																	@endphp 

																	<label class="filter-list__item"><span class="input-check filter-list__input"><span class="input-check__body"><input class="input-check__input" type="checkbox" name="brand[]" value="{{$r1->id}}" {{in_array($r1->id,$brand)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																		</span><span class="filter-list__title">{{$r1->brand_name}} </span><!-- {{$total_brand->count() }}<span class="filter-list__counter"></span> -->

																	</label> 

																@endforeach 

															</div>

														</div>

													</div>

												</div>

											</div>

										</div>

										<div class="widget-filters__item">

											<div class="filter filter--opened" data-collapse-item>

												<button type="button" class="filter__title" data-collapse-trigger>Tags <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

												</button>

												<div class="filter__body" data-collapse-content>

													<div class="filter__container">

														<div class="filter-list">

															<div class="filter-list__list">  

																@foreach($data['mainTags'] as $p) 

																	<label class="filter-list__item"><span class="filter-list__input input-radio"><span class="input-radio__body"><input class="input-radio__input" name="tags" type="radio" value="{{$p}}" @if($p == $tags) checked @endif> <span class="input-radio__circle"></span> </span>

																		</span><span class="filter-list__title">{{ucfirst($p)}} </span><span class="filter-list__counter"></span>

																	</label> 

																@endforeach 

															</div>

														</div>

													</div>

												</div>

											</div>

										</div>

										<div class="widget-filters__item"> 

											<!-- @php $rating_five = DB::table('products')->where('rating',5)->get(); @endphp 

											@php $rating_four = DB::table('products')->where('rating',4)->get(); @endphp 

											@php $rating_three = DB::table('products')->where('rating',3)->get(); @endphp 

											@php $rating_two = DB::table('products')->where('rating',2)->get(); @endphp 

											@php $rating_one = DB::table('products')->where('rating',1)->get(); @endphp  -->

											<div class="filter filter--opened" data-collapse-item>

												<button type="button" class="filter__title" data-collapse-trigger>Rating <span class="filter__arrow"><i class="fas fa-angle-down"></i></span>

												</button>

												 

												<div class="filter__body" data-collapse-content>

													<div class="filter__container">

														<div class="filter-rating">

															<ul class="filter-rating__list">

																<li class="filter-rating__item">

																	<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" {{in_array(5,$rating)?'checked':''}} value="5"  name="rating[]"> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																		</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div></div></div></span><span class="filter-rating__item-title sr-only">5 stars </span><!-- <span class="filter-rating__item-counter">{{$rating_five->count()}}</span> -->

																	</label>

																</li>

																<li class="filter-rating__item">

																	<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="4"  name="rating[]" {{in_array(4,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																		</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">4 stars </span><!-- <span class="filter-rating__item-counter">{{$rating_four->count()}}</span> -->

																	</label>

																</li>

																<li class="filter-rating__item">

																	<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="3"  name="rating[]" {{in_array(3,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																		</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">3 stars </span><!-- <span class="filter-rating__item-counter">{{$rating_three->count()}}</span> -->

																	</label>

																</li>

																<li class="filter-rating__item">

																	<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="2"  name="rating[]" {{in_array(2,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																		</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star rating__star--active"></div><div class="rating__star"></div><div class="rating__star"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">2 stars </span><!-- <span class="filter-rating__item-counter">{{$rating_two->count()}}</span> -->

																	</label>

																</li>

																<li class="filter-rating__item">

																	<label class="filter-rating__item-label"><span class="input-check filter-rating__item-input"><span class="input-check__body"><input class="input-check__input" type="checkbox" value="1"  name="rating[]" {{in_array(1,$rating)?'checked':''}}> <span class="input-check__box"></span>  <span class="input-check__icon"><svg width="9px" height="7px"><path d="M9,1.395L3.46,7L0,3.5L1.383,2.095L3.46,4.2L7.617,0L9,1.395Z"/></svg> </span></span>

																		</span><span class="filter-rating__item-stars"><div class="rating"><div class="rating__body"><div class="rating__star rating__star--active"></div><div class="rating__star"></div><div class="rating__star"></div><div class="rating__star"></div><div class="rating__star"></div></div></div></span><span class="filter-rating__item-title sr-only">1 star </span><!-- <span class="filter-rating__item-counter">{{$rating_one->count()}}</span> -->

																	</label>

																</li>

															</ul>

														</div>

													</div>

												</div>

											</div>

										</div> 

									</div>

									<div class="widget-filters__actions d-flex">

										<button type="submit" class="btn btn-primary btn-sm">Filter</button>

										<button class="btn btn-secondary btn-sm">Reset</button>

									</div>

								</div> 

						</div>

					</div>

				</div>

			</div>

			<div class="block-split__item block-split__item-content col-auto">

				<div class="block">

					<div class="products-view">

						<div class="products-view__options view-options view-options--offcanvas--mobile">

							<div class="view-options__body">

								<button type="button" class="view-options__filters-button filters-button"><span class="filters-button__icon"><i class="fas fa-sort-amount-down"></i></span><span class="filters-button__title">Filters</span>  <span class="filters-button__counter">3</span>

								</button>



								@php

                                	$count = DB::table('products')->count();

                            	@endphp

								<div class="view-options__legend">Showing {{ $data['product']->count() }} of {{$count}} products</div>

								<div class="view-options__spring"></div>

								<div class="view-options__select"> 

									<label for="view-option-sort">Sort:</label> 

										<select id="view-option-sort" class="form-control form-control-sm price_sorting" name="price_sort">

											<option value="">Select</option>

											<option value="0" {{$sortP == 'asc'? 'selected':''}}>Low Price</option>

											<option value="1" {{$sortP == 'desc'? 'selected':''}}>High Price</option>

										</select>

									    

								</div>

								<!-- <div class="view-options__select">

									<label for="view-option-limit">Show:</label>

									<select id="view-option-limit" class="form-control form-control-sm" name="">

										<option value="">16</option>

									</select>

								</div> -->

							</div>

							<!-- <div class="view-options__body view-options__body--filters">

								<div class="view-options__label">Active Filters</div>

								<div class="applied-filters">

									<ul class="applied-filters__list">

										<li class="applied-filters__item"><a href="#" class="applied-filters__button applied-filters__button--filter">Sales: Top Sellers <i class="fas fa-times"></i></a>

										</li>

										<li class="applied-filters__item"><a href="#" class="applied-filters__button applied-filters__button--filter">Brand: True Red <i class="fas fa-times"></i></a>

										</li>

										<li class="applied-filters__item">

											<button type="button" class="applied-filters__button applied-filters__button--clear">Clear All</button>

										</li>

									</ul>

								</div>

							</div> -->

						</div>

						<div class="products-view__list products-list products-list--grid--4" data-layout="grid" data-with-features="false"> 

							<div class="products-list__content">

								@foreach($data['product'] as $r)

						          @php 

						            $category = DB::table('product_images')->where('type',2)->where('products_id' , $r->products_id)->pluck('product_image')->first();  

						            $percent = (($r->price - $r->special_price)*100) /$r->price ;

						          @endphp 

								<div class="products-list__item"> 

									<div class="product-card">



										<div class="product-card__image">

											<span class="custom-badge">

						                  		@if($r->extra_discount == null) 

						                  		@else

							                    <span class="custom-label custom-label-large custom-label-success arrowed-in">  

								                    {{ $r->extra_discount}}% off 

							                    </span>

							                    @endif

						                  	</span>

											<a href="{{url('/product-detail/'.$r->products_id)}}">

												<img src="{{asset($category)}}" alt="">

											</a>



										</div>

										<div class="product-card__info">

											<div class="product-card__meta"><span class="product-card__meta-title">SKU:</span> {{$r->product_code}}</div>

											<div class="product-card__name">

												<div>

													<div class="product-card__badges">

								                        <div class="tag-badge tag-badge--sale">new</div>

								                        @if($r->featured_product != null)

								                        <div class="tag-badge tag-badge--new">hot</div>

								                        @elseif($r->top_selling_product != null)

								                        <div class="tag-badge tag-badge--hot">sale</div>

								                        @endif

								                    </div>

								                    <a href="{{url('/product-detail/'.$r->products_id)}}">{{$r->product_name}}</a>

												</div>

											</div>

											<div class="product-card__rating">

												<div class="rating product-card__rating-stars">

													<div class="rating__body">

														{!! str_repeat('<i class="fa fa-star" aria-hidden="true" style="color:#ea8330;"></i>', $r->rating) !!}

                										{!! str_repeat('<i class="fa fa-star-o" aria-hidden="true" style="color:red;"></i>', 5 - $r->rating) !!} 

													</div>

												</div>

												<div class="product-card__rating-label">4 on 3 reviews</div>

											</div>



										</div>

										<div class="product-card__footer">

											<div class="product-card__prices">

												@if($r->special_price == null)

													<div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> {{$r->price}}.00</div>

												@else

													<div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> 

														{{$r->special_price}}.00 

													</div>

												@endif

												@if($r->special_price != null)

                  								<div class="product-card__price product-card__price--old"><i class="fas fa-rupee-sign"></i> {{$r->price}}.00</div>

                  								@endif

											</div>

											@php 

							                    $session = Session::getId(); 

							                    $data1=DB::table('temp_carts')->where('product_id',$r->products_id)->where('session_id',$session)->first();

							                @endphp

							                @guest 

							                    @if($data1==null)

							                      <a href="{{url('cart-details/'.$r->products_id)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">

							                        <span class="icon-cart-plus"></span>

							                      </button></a>  

							                    @else

							                      <button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">

							                        <span class="icon-cart-plus" style="color:red;"></span>

							                      </button>  

							                    @endif 

							                @else 

							                      <a href="{{url('cart-details/'.$r->products_id)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">

							                        <span class="icon-cart-plus"></span>

							                      </button></a>   

							                @endguest

										</div>

									</div> 

								</div> 

								@endforeach

							</div> 

						</div> 

						<div class="products-view__pagination">

							<nav aria-label="Page navigation example">

								<ul class="pagination"> 

									 {{ $data['product']->appends($data['page'])->links() }}

								</ul>

							</nav>

							<div class="products-view__pagination-legend">Showing {{ $data['product']->count() }} of {{$count}} products</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="block-space block-space--layout--before-footer"></div>

	</div>

</div>

</form> 