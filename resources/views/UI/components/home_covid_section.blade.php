<div class="block block-sale " data-layout="grid-5">
  <div class="block-sale__content">
    <div class="block-sale__header">
      <?php 
        $title = DB::table('categories')->where('type',3)->first();  
        $covid1 = DB::table('categories')->where('categories_id',32)->first();
        $covid = DB::table('categories')->where('parent_id', $covid1->categories_id)->get();  
        //dd($title);
        // $covid = DB::table('products')->where('status',0)->where('categories',$title->categories_id)->orderBy(DB::raw('RAND()'))->take(30)->get();
        //dd($covid);
      ?>
      <div class="block-sale__title">{{$covid1->title}}!!!</div>
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
            @foreach($covid as $r)
            <div class="block-sale__item">
              <div class="product-card product-cat">  
                <div class="product-card__image">
                  <a href="{{url('filter-category/'.$covid1->categories_id.'/'.$r->categories_id)}}"><img src="{{asset($r->image)}}" alt=""></a>
                </div>
                <div class="product-card__info">
                  <div class="product-card__name">
                    <a href="{{url('filter-category/'.$covid1->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                  </div>
                  <div class="product-card__meta text-center text-success">{{$r->title}}</div>
                </div>
                
              </div>
            </div> 
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>
</div>