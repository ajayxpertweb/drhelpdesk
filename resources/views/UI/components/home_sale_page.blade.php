<div class="block block-sale " data-layout="grid-5">
  <div class="block-sale__content">
    <div class="block-sale__header">
      <div class="block-sale__title">Save More!!! Care More!!!</div>
      <div class="block-sale__controls">
        <div class="arrow block-sale__arrow block-sale__arrow--prev arrow--prev"><button class="arrow__button" type="button">
          <i class="fas fa-angle-left"></i>
        </button>
      </div>
      <div class="arrow block-sale__arrow block-sale__arrow--next arrow--next"><button class="arrow__button" type="button">
        <i class="fas fa-angle-right"></i>
      </button>
    </div>
  </div>
</div>
<div class="block-sale__body">            
  <div class="container">
    <div class="block-sale__carousel">
      <div class="owl-carousel">
        @foreach($save_more_category as $r)
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="{{url('filter-category/'.$r->categories_id)}}"><img src="{{asset($r->image)}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="{{url('filter-category/'.$r->categories_id)}}">{{$r->category_name}}</a>
              </div>
              <div class="product-card__meta text-center text-success">{{$r->title}}</div>
            </div>
            
          </div>
        </div>
        @endforeach

       <!--  <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/BabyCare.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Mom & Baby Care</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 25%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/MensHygiene.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Men's Hygiene</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 35%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/WomensHygiene.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Women's Hygiene</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 35%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/Healthcare.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Health Care Products</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 25%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/MedicalDevices.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Medical Devices</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 45%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/DibetesCare.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Diabetes Care</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 50%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/SeasonEssential.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Season Essentials</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 30%</div>
            </div>
            
          </div>
        </div>
        <div class="block-sale__item">
          <div class="product-card product-cat">  
            <div class="product-card__image">
              <a href="#"><img src="{{asset('UI/images/products/ImmunityBooster.png')}}" alt=""></a>
            </div>
            <div class="product-card__info">
              <div class="product-card__name">
                <a href="#">Immunity Booster</a>
              </div>
              <div class="product-card__meta text-center text-success">Save upto 35%</div>
            </div>
            
          </div>
        </div> --> 
      </div>
    </div>
  </div>
</div>
</div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>