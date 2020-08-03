<div class="block block-posts-carousel block-posts-carousel--layout--list" data-layout="list">
  <div class="container">
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Stay Healthy</h2>
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
    <div class="block-posts-carousel__carousel">
      <div class="owl-carousel">
        @foreach($blog as $r)
        <div class="block-posts-carousel__item">
          <div class="post-card">
            <div class="post-card__image">
              <a href="#">
                <img src="{{asset($r->blog_image)}}" alt="">
              </a>
            </div>
            <div class="post-card__content">
              <!-- <div class="post-card__category"><a href="#">Special Offers</a>
              </div> -->
              <div class="post-card__title">
                <h2><a href="#">{{$r->blog_title}}</a></h2>
              </div>
              <!-- <div class="post-card__date">By <a href="#">Jessica Moore</a> on October 19, 2019</div> -->
              <div class="post-card__excerpt">
                <div class="typography">{!!$r->blog_description!!}</div>
              </div>
              <div class="post-card__more"><a href="#" class="btn btn-secondary btn-sm">Read more</a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
        <!-- <div class="block-posts-carousel__item">
          <div class="post-card">
            <div class="post-card__image">
              <a href="#">
                <img src="{{asset('UI/images/posts/post-2-730x485.jpg')}}" alt="">
              </a>
            </div>
            <div class="post-card__content">
              <div class="post-card__category"><a href="#">Latest News</a>
              </div>
              <div class="post-card__title">
                <h2><a href="#">Red, Green And Orange Zones – What’s It All...</a></h2>
              </div>
              <div class="post-card__date">By <a href="#">Jessica Moore</a> on September 5, 2019</div>
              <div class="post-card__excerpt">
                <div class="typography">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis neque ut purus fermentum, ac pretium nibh facilisis. Vivamus venenatis viverra iaculis. Suspendisse tempor orci non sapien ullamcorper dapibus. Suspendisse at velit diam. Donec pharetra nec enim blandit vulputate.</div>
              </div>
              <div class="post-card__more"><a href="#" class="btn btn-secondary btn-sm">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="block-posts-carousel__item">
          <div class="post-card">
            <div class="post-card__image">
              <a href="#">
                <img src="{{asset('UI/images/posts/post-3-730x485.jpg')}}" alt="">
              </a>
            </div>
            <div class="post-card__content">
              <div class="post-card__category"><a href="#">New Arrivals</a>
              </div>
              <div class="post-card__title">
                <h2><a href="#">The Importance Of Micronutrients For Good Health</a></h2>
              </div>
              <div class="post-card__date">By <a href="#">Jessica Moore</a> on August 12, 2019</div>
              <div class="post-card__excerpt">
                <div class="typography">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis neque ut purus fermentum, ac pretium nibh facilisis. Vivamus venenatis viverra iaculis. Suspendisse tempor orci non sapien ullamcorper dapibus. Suspendisse at velit diam. Donec pharetra nec enim blandit vulputate.</div>
              </div>
              <div class="post-card__more"><a href="#" class="btn btn-secondary btn-sm">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="block-posts-carousel__item">
          <div class="post-card">
            <div class="post-card__image">
              <a href="#">
                <img src="{{asset('UI/images/posts/post-4-730x485.jpg')}}" alt="">
              </a>
            </div>
            <div class="post-card__content">
              <div class="post-card__category"><a href="#">Special Offers</a>
              </div>
              <div class="post-card__title">
                <h2><a href="#">Want Beat Diabetes? Things You Must Know!</a></h2>
              </div>
              <div class="post-card__date">By <a href="#">Jessica Moore</a> on Jule 30, 2019</div>
              <div class="post-card__excerpt">
                <div class="typography">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis neque ut purus fermentum, ac pretium nibh facilisis. Vivamus venenatis viverra iaculis. Suspendisse tempor orci non sapien ullamcorper dapibus. Suspendisse at velit diam. Donec pharetra nec enim blandit vulputate.</div>
              </div>
              <div class="post-card__more"><a href="#" class="btn btn-secondary btn-sm">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="block-posts-carousel__item">
          <div class="post-card">
            <div class="post-card__image">
              <a href="#">
                <img src="{{asset('UI/images/posts/post-5-730x485.jpg')}}" alt="">
              </a>
            </div>
            <div class="post-card__content">
              <div class="post-card__category"><a href="#">New Arrivals</a>
              </div>
              <div class="post-card__title">
                <h2><a href="#">The Connection Between Stress and Thyroid</a></h2>
              </div>
              <div class="post-card__date">By <a href="#">Jessica Moore</a> on June 12, 2019</div>
              <div class="post-card__excerpt">
                <div class="typography">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis neque ut purus fermentum, ac pretium nibh facilisis. Vivamus venenatis viverra iaculis. Suspendisse tempor orci non sapien ullamcorper dapibus. Suspendisse at velit diam. Donec pharetra nec enim blandit vulputate.</div>
              </div>
              <div class="post-card__more"><a href="#" class="btn btn-secondary btn-sm">Read more</a>
              </div>
            </div>
          </div>
        </div>
        <div class="block-posts-carousel__item">
          <div class="post-card">
            <div class="post-card__image">
              <a href="#">
                <img src="{{asset('UI/images/posts/post-6-730x485.jpg')}}" alt="">
              </a>
            </div>
            <div class="post-card__content">
              <div class="post-card__category"><a href="#">Special Offers</a>
              </div>
              <div class="post-card__title">
                <h2><a href="#">How Can Vaping Increase The Risk Of Asthma And COPD?</a></h2>
              </div>
              <div class="post-card__date">By <a href="#">Jessica Moore</a> on May 21, 2019</div>
              <div class="post-card__excerpt">
                <div class="typography">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec facilisis neque ut purus fermentum, ac pretium nibh facilisis. Vivamus venenatis viverra iaculis. Suspendisse tempor orci non sapien ullamcorper dapibus. Suspendisse at velit diam. Donec pharetra nec enim blandit vulputate.</div>
              </div>
              <div class="post-card__more"><a href="#" class="btn btn-secondary btn-sm">Read more</a>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>

<div class="block-space block-space--layout--divider-xl"></div>