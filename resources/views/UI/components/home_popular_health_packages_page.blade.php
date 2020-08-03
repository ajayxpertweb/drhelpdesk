<div class="block block-products-carousel" data-layout="grid-4">
  <div class="container">
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Popular Health Packages</h2>
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
      <div class="owl-carousel health-package">
        @foreach($packages as $r)
        <div class="block-products-carousel__column">
          <div class="block-products-carousel__cell">
            <div class="product-card product-card--layout--grid">
              <div class="product-card__info">
                <span class="custom-badge">
                  <span class="custom-label custom-label-large custom-label-success arrowed-in">{{$r->offer_discount}}% off</span>
                </span>
                <div class="product-card__meta">Available at 10 certified labs</div>
                <div class="product-card__name">
                  <div>
                    <a href="#">{{$r->package_name}}</a>
                  </div>
                </div>
                                </div>
              <div class="product-card__footer">
                <div class="product-card__prices">
                  @php
                    $session = Session::getId();  
                    $data1=DB::table('temp_carts')->where('product_id',$r->id)->where('session_id',$session)->where('type',3)->first();  
                    $temp_carts=DB::table('temp_carts')->where('session_id',$session)->where('type',3)->get();  
                    $discount = ($r->offer_discount * $r->package_cost) / 100;
                    $discount1 = $r->package_cost - $discount;
                  @endphp

                  @if($r->offer_discount == null)
                    <div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> {{$r->package_cost}}</div>
                  @else
                    <div class="product-card__price product-card__price--new"><i class="fas fa-rupee-sign"></i> {{$discount1}}</div>
                    <div class="product-card__price product-card__price--old"><i class="fas fa-rupee-sign"></i> {{$r->package_cost}}</div>
                  @endif 
                </div>
                @guest  
                  @if($data1 == null)
                    @if(Session::get('location_name')!='notfound')
                    <a href="{{url('package-add-cart/'.$r->id)}}" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a> 
                    @else
			 		    <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="product-card__addtocart-icon" type="button" aria-label="Add to cart"><span class="icon-cart-plus"></span></a>
			 		@endif
                  @else
                    <a  style="color:red;" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a>
                  @endif
                @else 
                  @php
                    $cart=DB::table('carts')->where('product_id',$r->id)->where('user_id',Auth::user()->id)->where('type',3)->first();  
                    $check_cart=DB::table('carts')->where('user_id',Auth::user()->id)->where('type',3)->get();   
                  @endphp
                  @if($cart==null)
                    @if(Session::get('location_name')!='notfound')
                    <a href="{{url('package-add-cart/'.$r->id)}}" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a>
                    @else
			 		    <a href="javascript:void(0);" onclick="alert('Service is not available for selected location.')" class="product-card__addtocart-icon" type="button" aria-label="Add to cart"><span class="icon-cart-plus"></span></a>
			 		@endif
                  @else
                    <a style="color:red;" class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                      <span class="icon-cart-plus"></span>
                    </a>
                  @endif  
                @endif
                 
              </div>
            </div>
          </div>
        </div>
        @endforeach 
      </div>
    </div>
  </div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>
 