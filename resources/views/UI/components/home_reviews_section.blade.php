<div class="block block-reviews">
  <div class="container">
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Our customers feedback</h2>
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
    
    <div class="block-reviews__list">
      <div class="owl-carousel">
        @foreach($testimonial as $r)
        <div class="block-reviews__item">
          <div class="block-reviews__item-avatar">
            <img src="{{asset($r->image)}}" alt="">
          </div>
          <div class="block-reviews__item-content">
            <div class="block-reviews__item-text"> {!!$r->description!!}</div>
            <div class="block-reviews__item-meta">
              <div class="block-reviews__item-rating">
                <div class="rating">
                  <div class="rating__body">
                    <!-- <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star"></div> -->
                    {!! str_repeat('<i class="fa fa-star" aria-hidden="true" style="color:#ea8330;"></i>', $r->rating) !!}
                    {!! str_repeat('<i class="fa fa-star-o" aria-hidden="true" style="color:red;"></i>', 5 - $r->rating) !!} 
                  </div>
                </div>
              </div>
              <div class="block-reviews__item-author">{{$r->name}},{{$r->position}}</div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- <div class="block-reviews__item">
          <div class="block-reviews__item-avatar">
            <img src="{{asset('UI/images/testimonials/testimonial-2-190x190.jpg')}}" alt="">
          </div>
          <div class="block-reviews__item-content">
            <div class="block-reviews__item-text">Philosophical questions can be grouped into categories. These groupings allow philosophers. The groupings also make philosophy easier for students to approach.</div>
            <div class="block-reviews__item-meta">
              <div class="block-reviews__item-rating">
                <div class="rating">
                  <div class="rating__body">
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                  </div>
                </div>
              </div>
              <div class="block-reviews__item-author">Pete Bridges, Truck driver</div>
            </div>
          </div>
        </div>
        <div class="block-reviews__item">
          <div class="block-reviews__item-avatar">
            <img src="{{asset('UI/images/testimonials/testimonial-3-190x190.jpg')}}" alt="">
          </div>
          <div class="block-reviews__item-content">
            <div class="block-reviews__item-text">The ideas conceived by a society have profound repercussions on what actions the society performs. Philosophy yields applications such as those in ethics – applied ethics in particular – and political philosophy.</div>
            <div class="block-reviews__item-meta">
              <div class="block-reviews__item-rating">
                <div class="rating">
                  <div class="rating__body">
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star rating__star--active"></div>
                    <div class="rating__star"></div>
                  </div>
                </div>
              </div>
              <div class="block-reviews__item-author">Jeff Kowalski, CEO Stroyka</div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>

<div class="block-space block-space--layout--divider-sm"></div>