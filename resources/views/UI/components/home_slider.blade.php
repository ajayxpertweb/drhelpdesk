<div class="block block-slideshow mt-2">
  <div class="container-fluid">
    <div class="block-slideshow__carousel">
      <?php  
        $banner = DB::table('banners')->where('page_name','homepage')->where('location','slider')->where('status',0)->get();
        //dd($banner); 
      ?> 
      <div class="owl-carousel">
        @foreach($banner as $banners) 
          <a class="block-slideshow__item" href="{{$banners->banner_link}}" target="_blank">
            <span class="block-slideshow__item-image block-slideshow__item-image--desktop" style="background-image: url({{asset($banners->image)}})"></span> 
            <span class="block-slideshow__item-image block-slideshow__item-image--mobile" style="background-image: url({{asset($banners->image)}})"></span>  
          </a>
        @endforeach

        <!-- <a class="block-slideshow__item" href="#">
          <span class="block-slideshow__item-image block-slideshow__item-image--desktop" style="background-image: url({{asset('UI/images/slides/slide-2.jpg')}})"></span> 
          <span class="block-slideshow__item-image block-slideshow__item-image--mobile" style="background-image: url({{asset('UI/images/slides/slide-2.jpg')}})"></span> 
        </a>
        <a class="block-slideshow__item" href="#">
          <span class="block-slideshow__item-image block-slideshow__item-image--desktop" style="background-image: url({{asset('UI/images/slides/slide-1.jpg')}})"></span> 
          <span class="block-slideshow__item-image block-slideshow__item-image--mobile" style="background-image: url({{asset('UI/images/slides/slide-1.jpg')}})"></span> 
        </a> -->
      </div>
    </div>
  </div>
</div>
<div class="block-space block-space--layout--divider-xs"></div>