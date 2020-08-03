<div class="block block-teammates">
  <div class="container">
    <div class="section-header">
      <div class="section-header__body">
        <h2 class="section-header__title">Consult Top Doctors</h2>
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
    <div class="block-teammates__list">
      <div class="owl-carousel"> 
        @foreach($doctor as $r) 
        <?php
          $speciality = DB::table('categories')->where('status',0)->where('categories_id',$r->speciality)->first(); 

        $date1 = strtotime($r->experience_from);  
        $date2 = strtotime($r->experience_to);   
        $diff = abs($date2 - $date1);   
        $years = floor($diff / (365*60*60*24));   
        $months = floor(($diff - $years * 365*60*60*24) 
        / (30*60*60*24));   
        $days = floor(($diff - $years * 365*60*60*24 -  
        $months*30*60*60*24)/ (60*60*24));  
        $hours = floor(($diff - $years * 365*60*60*24  
        - $months*30*60*60*24 - $days*60*60*24) 
        / (60*60));   
        $minutes = floor(($diff - $years * 365*60*60*24  
        - $months*30*60*60*24 - $days*60*60*24  
        - $hours*60*60)/ 60);   
        $seconds = floor(($diff - $years * 365*60*60*24  
        - $months*30*60*60*24 - $days*60*60*24 
        - $hours*60*60 - $minutes*60));  
        // printf("%d years, %d months", $years, $months);  
        ?> 
        <div class="block-teammates__item teammate">
          <div class="teammate__avatar">
            <a href="{{url('/doctor-details/'.$r->user_details_id)}}"><img src="{{asset($r->image)}}" alt=""></a>
          </div>
          <a href="{{url('/doctor-details/'.$r->user_details_id)}}"><div class="teammate__info">
            <div class="teammate__name">{{$r->user_name}}</div>
            <div class="teammate__position">{{$speciality->sub_category_name}}</div>
            <div class="teammate__experience"><?php printf("%d yrs, %d months", $years, $months); ?> experience</div>
            <div class="teammate__btn">Consult Now</div>
          </div></a>
        </div>
        @endforeach 
      </div>
    </div>
  </div>
</div>

<div class="block-space block-space--layout--divider-sm d-xl-block d-none"></div>