
<div class="block block-products-carousel" data-layout="grid-5">
  <div class="container">
    @if(session('message1') != null)
      <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        {{session('message1')}}
      </div>
    @endif
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Top Selling</h2>
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
        @foreach($top_selling_product as $r)
          <?php 
            $category = DB::table('product_images')->where('type',2)->where('products_id' , $r->products_id)->pluck('product_image')->first();  
            $percent = (($r->price - $r->special_price)*100) /$r->price ;
          ?>
          <div class="block-products-carousel__column">
            <div class="block-products-carousel__cell">
              <div class="product-card product-card--layout--grid"> 
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
                    @if(file_exists(asset($category)))
                      <img src="{{asset($category)}}" alt="">
                    @else
                      <img src="{{asset('UI/images/product_default1.png')}}" alt="">
                    @endif
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
                        {!! str_repeat(' <i class="fa fa-star" aria-hidden="true" style="color:#ea8330;"></i>', $r->rating ) !!}
                        {!! str_repeat(' <i class="fa fa-star" aria-hidden="true" style="color:#ebebeb;"></i>', 5 - $r->rating ) !!} 
                      </div>
                    </div>
                    <!--<div class="product-card__rating-label">4 on 3 reviews</div>-->
                  </div>
                </div>
                <div class="product-card__footer">
                  <div class="product-card__prices">
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
                  </div>
                  <?php 
                    $session = Session::getId(); 
                    $data1=DB::table('temp_carts')->where('product_id',$r->products_id)->where('session_id',$session)->first();
                  ?>
                  @guest 
                    @if($data1==null)
                      <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                        <span class="icon-cart-plus"></span>
                      </button></a>  
                    @else
                      <button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                        <span class="icon-cart-plus" style="color:red;"></span>
                      </button>  
                    @endif 
                  @else 
                      <a href="{{url('cart-details/'.$r->products_id.'/'.$r->categories)}}"><button class="product-card__addtocart-icon" type="button" aria-label="Add to cart">
                        <span class="icon-cart-plus"></span>
                      </button></a>   
                  @endguest
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

<script>
  function buy_now(){
    document.getElementById("buy-now").style.display="block";
  }   
  var closebtns = document.getElementsByClassName("close");
  var i; 
  for (i = 0; i < closebtns.length; i++) {
    closebtns[i].addEventListener("click", function() {
      this.parentElement.style.display = 'none';
    });
  }
</script>