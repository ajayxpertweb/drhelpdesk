<div class="block-banners block">
  <div class="container">
    <?php  
      $banner = DB::table('banners')->where('page_name','homepage')->where('location','middle section')->where('status',0)->get(); 
    ?> 
    <div class="block-banners__list2">
      @foreach($banner as $banners) 
        <a href="{{$banners->banner_link}}" target="_blank" class="block-banners__item2 ">
          <span class="block-banners__item-image">
            <img src="{{asset($banners->image)}}" alt="">
          </span>
        </a>
      @endforeach 
    </div>
  </div>
</div>
<div class="block-space block-space--layout--divider-sm"></div>