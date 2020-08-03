<div class="block-banners block">
    <div class="container"> 
      <?php  
        $banner = DB::table('banners')->where('page_name','homepage')->where('location','top middle section')->where('status',0)->get(); //dd($banner);
      ?> 
      <div class="block-banners__list">
       @foreach($banner as $banners) 
       <a href="{{$banners->banner_link}}" class="block-banners__item ">
        <span class="block-banners__item-image">
          <img src="{{asset($banners->image)}}" alt=""></span>
          <span class="block-banners__item-image block-banners__item-image--blur"><img src="{{asset($banners->image)}}" alt=""></span> 
        </a>
        @endforeach
      </div> 
    </div>
  </div>
  <div class="block-space block-space--layout--divider-sm"></div>