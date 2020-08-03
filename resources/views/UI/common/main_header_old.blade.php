 

<header class="site__mobile-header">

  <div class="mobile-header">

    <div class="container">

      <div class="mobile-header__body">

        <button class="mobile-header__menu-button" type="button">

          <svg width="18px" height="14px">

            <path d="M-0,8L-0,6L18,6L18,8L-0,8ZM-0,-0L18,-0L18,2L-0,2L-0,-0ZM14,14L-0,14L-0,12L14,12L14,14Z" />

          </svg>

        </button>

        <a class="mobile-header__logo" href="{{url('/')}}">

          <!-- mobile-logo -->

            <img src="{{asset('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk"  class="img-fluid">

          <!-- mobile-logo / end -->

        </a>

        <div class="mobile-header__search mobile-search">

          <form class="mobile-search__body">

            <input type="text" class="mobile-search__input" placeholder="Search Doctor, medicine, testing labs...."> 

            <button type="submit" class="mobile-search__button mobile-search__button--search">

              <i class="fa fa-search"></i>

            </button>

            <button type="button" class="mobile-search__button mobile-search__button--close">

              <i class="fas fa-times"></i>

            </button>

            <div class="mobile-search__field"></div>

          </form>

        </div>

        <div class="mobile-header__indicators">

          <div class="mobile-indicator mobile-indicator--search d-md-none">

            <button type="button" class="mobile-indicator__button"><span class="mobile-indicator__icon"><i class="fa fa-search"></i></span>

            </button>

          </div>

          <div class="mobile-indicator d-none d-md-block"><a href="#" class="mobile-indicator__button"><span class="mobile-indicator__icon"><i class="icon-user-lock"></i></span></a>

          </div>

          

          <div class="mobile-indicator"><a href="#" class="mobile-indicator__button"><span class="mobile-indicator__icon"><i class="icon-cart-full"></i><span class="mobile-indicator__counter">3</span></span></a>

          </div>

        </div>

      </div>

    </div>

  </div>

</header>

<!-- site__mobile-header / end -->

<!-- site__header -->

  <header class="site__header">

    <div class="header">

      <div class="header__megamenu-area megamenu-area"></div>

      <div class="header__topbar-classic-bg"></div>

      <div class="header__topbar-classic">

        <div class="topbar topbar--classic">

          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/about-us')}}">About Us</a>

          </div>

          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/contact-us')}}">Contact Us</a>

          </div>

          

          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/')}}">Track Order</a>

          </div>

          <div class="topbar__item-text"><a class="topbar__link" href="{{url('/blog')}}">Blog</a>

          </div>

          <div class="topbar__item-spring"></div> 

          @if(Auth::check())
            @php
              $wallet = DB::table('de_wallets')->where('user_id',Auth::id())->first();
            @endphp
          <div class="topbar__menu">
            <button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button"><span class="topbar__button-label">D-Wallet:</span>  <span class="topbar__button-title"><!-- <i class="fas fa-rupee-sign"></i>   -->{{$wallet->coin}}.00 Coin</span> 
            </button> 
          </div>
          @else
          <div class="topbar__menu">
            <button class="topbar__button topbar__button--has-arrow topbar__menu-button" type="button"><span class="topbar__button-label">D-Wallet:</span>  <span class="topbar__button-title"><!-- <i class="fas fa-rupee-sign"></i>  -->0.00 Coin</span> 
            </button> 
          </div>
          @endif

        </div>

      </div> 
      <div class="header__navbar">
            <div class="header__navbar-departments">
              <div class="departments">
                <button class="departments__button" type="button"><span class="departments__button-icon"><i class="fas fa-sort-amount-down"></i> </span><span class="departments__button-title">Save More!! Care More!!</span>  <span class="departments__button-arrow"><i class="fas fa-angle-down"></i></span>
                </button>
                <div class="departments__menu">
                  <div class="departments__arrow"></div>
                  <div class="departments__body">
                    <?php
                      $save_more_category = DB::table('categories')->where('category_name','!=' , null)->where('type',2)->where('status',0)->orderBy('categories_id','asc')->get(); 
                    ?>
                    <ul class="departments__list">
                      <li class="departments__list-padding" role="presentation"></li>
                      @foreach($save_more_category as $r)
                      <li class="departments__item">
                        <a href="{{url('filter-category/'.$r->categories_id)}}" class="departments__item-link d-flex">
                          <img src="{{asset($r->image)}}" alt="">
                          <span class="d-block">{{$r->category_name}}
                            <span class="d-md-block small text-success">{{$r->title}}</span>
                          </span>                       
                        </a>
                      </li>
                      @endforeach 
                      <li class="departments__list-padding" role="presentation"></li>
                    </ul>
                    <div class="departments__menu-container"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="header__navbar-menu">
              <div class="main-menu">
                <ul class="main-menu__list">
                  <?php 
                    $medicine = DB::table('categories')->where('categories_id',14)->first();
                    $lab = DB::table('categories')->where('categories_id',15)->first();
                    $doctor = DB::table('categories')->where('categories_id',16)->first();
                    $sexual = DB::table('categories')->where('categories_id',285)->first();
                    $cosmetic = DB::table('categories')->where('categories_id',1)->first();
                    $ayurveda = DB::table('categories')->where('categories_id',18)->first(); 
                    //dd($cosmetic);
                  ?> 
                  <?php
                    $sub_cosmetic = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                    $sub_medicine = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                    $sub_lab = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                    $sub_doctor = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                    $sub_sexual = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
                    $sub_ayurveda = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->first(); 
    
                    $sub_cosmetic1 = DB::table('categories')->where('parent_id',$cosmetic->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                    $sub_medicine1 = DB::table('categories')->where('parent_id',$medicine->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                    $sub_lab1 = DB::table('categories')->where('parent_id',$lab->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                    $sub_doctor1 = DB::table('categories')->where('parent_id',$doctor->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                    $sub_sexual1 = DB::table('categories')->where('parent_id',$sexual->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get(); 
                    $sub_ayurveda1 = DB::table('categories')->where('parent_id',$ayurveda->categories_id)->where('sub_parent_id',null)->where('sub_sub_parent_id',null)->get();  
                  ?> 
                  
                  @if($sub_medicine != null)
                    <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$medicine->categories_id)}}" class="main-menu__link">{{$medicine->category_name}} <i class="fas fa-angle-down"></i></a>
                      <div class="main-menu__submenu">
                        <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                          <div class="megamenu">
                            <div class="row">
                              @foreach($sub_medicine1 as $r)
                                <?php  
                                  $sub1_medicine = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                ?>
                              <div class="col-2">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$medicine->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                    <ul class="megamenu-links">
                                      @foreach($sub1_medicine as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$medicine->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                        </li> 
                                      @endforeach 
                                    </ul>
                                  </li> 
                                </ul>
                              </div> 
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> 
                  @else
                    <li class="main-menu__item"><a href="{{url('filter-category/'.$medicine->categories_id)}}" class="main-menu__link">{{$medicine->category_name}} </a>
                      
                    </li>
                  @endif 
    
                  @if($sub_lab != null)
                    <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$lab->categories_id)}}" class="main-menu__link">{{$lab->category_name}} <i class="fas fa-angle-down"></i></a>
                      <div class="main-menu__submenu">
                        <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                          <div class="megamenu">
                            <div class="row">
                              @foreach($sub_lab1 as $r)
                                <?php  
                                  $sub1_lab = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                ?>
                              <div class="col-2">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$lab->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                    <ul class="megamenu-links">
                                      @foreach($sub1_lab as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$lab->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                        </li> 
                                      @endforeach 
                                    </ul>
                                  </li> 
                                </ul>
                              </div> 
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> 
                  @else
                    <li class="main-menu__item"><a href="{{url('filter-category/'.$lab->categories_id)}}" class="main-menu__link">{{$lab->category_name}} </a>
                      
                    </li>
                  @endif 
    
                 @if($sub_doctor != null)
                    <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu">
                      <a href="{{url('doctor-list/'.$doctor->categories_id)}}" class="main-menu__link">{{$doctor->category_name}} 
                        <i class="fas fa-angle-down"></i>
                      </a>
                      <div class="main-menu__submenu">
                        <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                          <div class="megamenu">
                            <div class="row">
                              @foreach($sub_doctor1 as $r)
                                <?php  
                                  $sub1_doctor = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                ?>
                              <div class="col-2">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('doctor-list/'.$doctor->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                   <!--  <ul class="megamenu-links">
                                      @foreach($sub1_doctor as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('doctor-list/'.$doctor->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                        </li> 
                                      @endforeach 
                                    </ul> -->
                                  </li> 
                                </ul>
                              </div> 
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> 
                  @else
                    <li class="main-menu__item">
                      <a href="{{url('doctor-listing')}}" class="main-menu__link">{{$doctor->category_name}}</a> 
                    </li>
                  @endif 
    
                  @if($sub_sexual != null)
                    <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$sexual->categories_id)}}" class="main-menu__link">{{$sexual->category_name}} <i class="fas fa-angle-down"></i></a>
                      <div class="main-menu__submenu">
                        <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                          <div class="megamenu">
                            <div class="row">
                              @foreach($sub_sexual1 as $r)
                                <?php  
                                  $sub1_sexual = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                ?>
                              <div class="col-2">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$sexual->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                    <ul class="megamenu-links">
                                      @foreach($sub1_sexual as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$sexual->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                        </li> 
                                      @endforeach 
                                    </ul>
                                  </li> 
                                </ul>
                              </div> 
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> 
                  @else
                    <li class="main-menu__item"><a href="{{url('filter-category/'.$sexual->categories_id)}}" class="main-menu__link">{{$sexual->category_name}} </a>
                      
                    </li>
                  @endif  
    
                  @if($sub_cosmetic != null)
                    <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$cosmetic->categories_id)}}" class="main-menu__link">{{$cosmetic->category_name}} <i class="fas fa-angle-down"></i></a>
                      <div class="main-menu__submenu">
                        <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                          <div class="megamenu">
                            <div class="row">
                              @foreach($sub_cosmetic1 as $r)
                                <?php  
                                  $sub1_cosmetic = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                ?>
                              <div class="col-2">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$cosmetic->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                    <ul class="megamenu-links">
                                      @foreach($sub1_cosmetic as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$cosmetic->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                        </li> 
                                      @endforeach 
                                    </ul>
                                  </li>
                                  
                                </ul>
                              </div> 
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> 
                  @else
                    <li class="main-menu__item"><a href="{{url('filter-category/'.$cosmetic->categories_id)}}" class="main-menu__link">{{$cosmetic->category_name}} </a>
                      
                    </li>
                  @endif 
    
    
                  @if($sub_ayurveda != null)
                    <li class="main-menu__item main-menu__item--submenu--megamenu main-menu__item--has-submenu"><a href="{{url('filter-category/'.$ayurveda->categories_id)}}" class="main-menu__link">{{$ayurveda->category_name}} <i class="fas fa-angle-down"></i></a>
                      <div class="main-menu__submenu">
                        <div class="main-menu__megamenu main-menu__megamenu--size--xxl">
                          <div class="megamenu">
                            <div class="row">
                              @foreach($sub_ayurveda1 as $r)
                                <?php  
                                  $sub1_ayurveda = DB::table('categories')->where('sub_parent_id',$r->categories_id)->where('sub_parent_id','!=' , null)->where('parent_id','!=' , null)->where('sub_sub_parent_id',  null)->get();  
                                ?>
                              <div class="col-2">
                                <ul class="megamenu__links megamenu-links megamenu-links--root">
                                  <li class="megamenu-links__item megamenu-links__item--has-submenu"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$ayurveda->categories_id.'/'.$r->categories_id)}}">{{$r->sub_category_name}}</a>
                                    <ul class="megamenu-links">
                                      @foreach($sub1_ayurveda as $r1) 
                                        <li class="megamenu-links__item"><a class="megamenu-links__item-link" href="{{url('filter-category/'.$ayurveda->categories_id.'/'.$r->categories_id.'/'.$r1-> categories_id)}}">{{$r1->sub_category_name}}</a>
                                        </li> 
                                      @endforeach 
                                    </ul>
                                  </li> 
                                </ul>
                              </div> 
                              @endforeach
                            </div>
                          </div>
                        </div>
                      </div>
                    </li> 
                  @else
                    <li class="main-menu__item"><a href="{{url('filter-category/'.$ayurveda->categories_id)}}" class="main-menu__link">{{$ayurveda->category_name}} </a>
                      
                    </li>
                  @endif  
                </ul>
              </div>
            </div>
            <div class="header__navbar-phone phone">
              <a href="#" class="phone__body">
                <div class="phone__title"><i class="icon-phone-wave"></i></div>
                <div class="phone__number">1800 060 0730</div>
              </a>
            </div>
        </div>
      <div class="header__logo">
        <a href="{{url('/')}}" class="logo">
          <div class="logo__image">
            <!-- logo -->
            <img src="{{asset('UI/images/DHD-Logo.png')}}" alt="Dr. Helpdesk" class="img-fluid">
            <!-- logo / end -->
          </div>
        </a>
      </div>

      <div class="header__search">
     <span style="color:red" id="rs_phoneno1"></span>
        <div class="search">

          <form action="#" class="search__body">

            <div class="search__shadow"></div>

            <input class="search__input" type="text" placeholder="Search Doctor, medicine, testing labs....">

            <button class="search__button search__button--start" type="button"><span class="search__button-icon"><span class="icon-map-marker"></span></span><span id="demo" class="search__button-title"></span>

            </button>

            <button class="search__button search__button--end" type="submit"><span class="search__button-icon"><span class="fa fa-search"></span></span>

            </button>

            <div class="search__box"></div>

            <div class="search__decor">

              <div class="search__decor-start"></div>

              <div class="search__decor-end"></div>

            </div>

           

            <div class="search__dropdown search__dropdown--vehicle-picker vehicle-picker">

              <div class="search__dropdown-arrow"></div>

              <div class="vehicle-picker__panel vehicle-picker__panel--list vehicle-picker__panel--active" data-panel="list">

                <div class="vehicle-picker__panel-body">

                  <div class="vehicle-picker__text">Select a location to find out our services</div>
                    <?php
                        $cities = DB::table('cities')->orderBy('city_id','asc')->get();
                    ?>
                  <div class="location-list">
                    @foreach($cities as $r)
                        <label class="location-list__item"> 
                            <span class="location-list__item-radio input-radio"> 
                                <span class="input-radio__body"> 
                                    <input class="input-radio__input" name="location" type="radio" value="{{$r->city_name}}">  
                                    <span class="input-radio__circle"></span>  
                                </span> 
                            </span> 
                            <span class="location-list__item-info"> 
                                <span   class="location-list__item-name">{{$r->city_name}}</span> 
                            </span>  
                        </label>
                     @endforeach 

                  </div>

                  <div class="vehicle-picker__actions">

                    <button type="button" onclick="getLocation()"  class="btn btn-primary btn-sm" data-to-panel="form">Current Location</button>

                  </div>

                </div>

              </div>

              

            </div>

          </form>

        </div>

      </div>

      <div class="header__indicators"> 

        @if(Auth::check())
            <?php 
                $image1 = DB::table('user_details')->where('user_id',Auth::user()->id)->pluck('image')->first(); 
            ?>
          <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><img src="{{asset($image1)}}" alt="" style="height: 42px; width: 42px; border-radius: 20px;"></span> </span><span class="indicator__title">Hello, {{Auth::user()->name}}</span> <span class="indicator__value">My Account</span></a> 
        @else
          <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><span class="icon-user-lock"></span> </span><span class="indicator__title">Hello, Log In</span> <span class="indicator__value">My Account</span></a> 
        @endif 
          <div class="indicator__content">

            <div class="account-menu"> 

              @if(session('message') != null)

                <div class="alert alert-success alert-dismissable" style="margin-top: 20px;">

                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                  {{session('message')}}

                </div>

              @endif

              @if(Auth::check() == null)

                <form method="POST" action="{{ url('user-login') }}" role="form"  class="account-menu__form" enctype="multipart/form-data">

                  @csrf

                  <div class="account-menu__form-title">Log In to Your Account</div>

                  <div class="form-group">

                    <label for="header-signin-email" class="sr-only">Email address</label>

                    <input id="header-signin-email" type="email" class="form-control @error('email') is-invalid @enderror form-control-sm" placeholder="Email address" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus> 

                    @error('email')

                        <span class="invalid-feedback" role="alert">

                            <strong>{{ $message }}</strong>

                        </span>

                    @enderror

                  </div>

                  <div class="form-group">

                    <label for="header-signin-password" class="sr-only">Password</label>

                    <div class="account-menu__form-forgot">

                      <input id="header-signin-password" type="password" class="form-control @error('password') is-invalid @enderror form-control-sm" placeholder="Password" name="password" required autocomplete="current-password"> <a href="{{url('/forget-password')}}" class="account-menu__form-forgot-link">Forgot?</a>

                      @error('password')

                          <span class="invalid-feedback" role="alert">

                              <strong>{{ $message }}</strong>

                          </span>

                      @enderror

                    </div>
                  </div>
                    <div class="form-group">
                      <div class="radio radio-inline mr-3">                      
                        <input type="radio" name="user_type" id="user" value="2" required>
                        <label for="user">User</label>
                      </div>
                      <div class="radio radio-inline">
                        <input type="radio" name="user_type" value="3" id="doctor" required>
                        <label for="doctor">Doctor</label>
                      </div>
                  </div> 

                  <div class="form-group account-menu__form-button">

                    <button type="submit" class="btn btn-primary btn-sm">Login</button>

                  </div>

                  <div class="account-menu__form-link"><a href="{{url('/registration')}}">Create An Account</a>

                  </div>

                </form> 

              @elseif(Auth::check())

                <?php

                  $image = DB::table('user_details')->where('user_id',Auth::user()->id)->pluck('image')->first();

                ?>

                <div class="account-menu__divider"></div>

                <a href="{{url('/')}}" class="account-menu__user">

                  <div class="account-menu__user-avatar">

                    <img src="{{asset($image)}}" alt="">

                  </div>

                  <div class="account-menu__user-info">

                    <div class="account-menu__user-name">{{Auth::user()->name}}</div>

                    <div class="account-menu__user-email">{{Auth::user()->email}}</div>

                  </div>

                </a>

                <div class="account-menu__divider"></div>

               @if(Auth::user()->user_type == 2)
                <ul class="account-menu__links">

                  <li><a href="{{url('/user-dashboard')}}">Dashboard</a>

                  </li>

                  <li><a href="{{url('/user-profile')}}">My Profile</a>

                  </li>

                  <li><a href="{{url('/user-booking')}}">My Booking</a>

                  </li>

                  <li><a href="{{url('/user-order-history')}}">Order History</a>

                  </li>

                  <li><a href="{{url('/user-address')}}">My Address</a>

                  </li>

                  <!-- <li><a href="{{url('/')}}">My Packages</a>

                  </li> -->

                </ul>
                @elseif(Auth::user()->user_type == 3)
                @endif

                <div class="account-menu__divider"></div>

                <ul class="account-menu__links">

                  <li> 

                    <a href="{{ route('logout') }}" onclick="event.preventDefault();

                      document.getElementById('logout-form').submit();">

                       Logout 

                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">

                      {{ csrf_field() }}

                    </form>

                  </li>

                </ul> 

              @endif

            </div>

          </div>

        </div>
        <?php
          $session = Session::getId(); 
          $r = DB::table('temp_carts')->where('session_id',$session)->pluck('product_id');
          $cart = DB::table('carts')->where('user_id',Auth::id())->pluck('product_id');
          $cart1 = DB::table('carts')->where('user_id',Auth::id())->count();
          $count = DB::table('temp_carts')->where('session_id',$session)->count(); 
          foreach ($r as $key => $r1) {
            $data1[]=DB::table('products')
            ->join('temp_carts', 'products.products_id', '=', 'temp_carts.product_id')
            ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price','temp_carts.quantity','temp_carts.temp_carts_id')->where('products.products_id',$r1)
            ->first();
          }
          foreach ($cart as $key => $r2) {
            $data1[]=DB::table('products')
            ->join('carts', 'products.products_id', '=', 'carts.product_id')
            ->select('products.products_id','products.product_name' ,'products.price', 'products.special_price','carts.quantity','carts.id')->where('products.products_id',$r2)
            ->first();
          }
          if (DB::table('temp_carts')->where('session_id',$session)->count()>0) {
            $result = $data1;   
          }elseif (DB::table('carts')->where('user_id',Auth::id())->count()>0) {
            $result = $data1;   
          }else{
            $result='Please Choose To Continue Shopping'; 
          } 
        ?>
        @php 
          $total_amount=0;
        @endphp  
        @if(Auth::check()) <!---this run only after login---> 
          @if(is_array($result)) <!---this run only after login cart not empty --->
            @foreach($result as $products)
              @if($products->special_price == null)
                <?php $total_amount+= $products->price * $products->quantity;?>
              @else
                <?php $total_amount+= $products->special_price * $products->quantity;?>
              @endif 
             
            @endforeach
            <div class="indicator indicator--trigger--click"><a href="javascript:void(0);" class="indicator__button"><span class="indicator__icon"><span class="icon-cart-full"></span><span class="indicator__counter">{{$cart1}}</span> </span><span class="indicator__title">Shopping Cart</span> <span class="indicator__value">
                <!--<i class="fas fa-rupee-sign"></i>-->
            <!--{{$total_amount}}.00-->
            </span></a>
              <div class="indicator__content">
                <div class="dropcart">
                  <ul class="dropcart__list">
                    @php 
                      $total_amount1=0;
                      $total_amount2 =0;
                    @endphp 
                    @foreach($result as $products) 
                      <?php 
                        $category = DB::table('product_images')->where('type',2)->where('products_id' , $products->products_id)->pluck('product_image')->first(); 
                      ?>
                      <li class="dropcart__item">
                        <div class="dropcart__item-image">
                          <a href="{{url('/product-detail/'.$products->products_id)}}">
                            <img src="{{asset($category)}}" alt="" class="img-fluid">
                          </a>
                        </div>
                        <div class="dropcart__item-info">
                          <div class="dropcart__item-name"><a href="{{url('/product-detail/'.$products->products_id)}}">{{$products->product_name}}</a>
                          </div>
                          <ul class="dropcart__item-features">
                            <!--<li>Color: Yellow</li>-->
                          </ul>
                          <div class="dropcart__item-meta">
                            <div class="dropcart__item-quantity">{{$products->quantity}}</div>
                            <div class="dropcart__item-price"><i class="fas fa-rupee-sign"></i> 
                              @if($products->special_price == null)
                                {{$products->quantity}} * {{ $products->price }} 
                              @else
                                {{$products->quantity}} * {{ $products->special_price }} 
                              @endif 
                            </div>
                          </div>
                        </div>
                        <button type="button" class="dropcart__item-remove"> 
                          <a href="{{url('/')}}" class="text-danger" onclick="removeProduct({{$products->id}})"><i class="fas fa-times"></i></a>
                        </button>
                      </li> 
                      @if($products->special_price != null) 
                        <?php $total_amount1+=  
                        $products->special_price  * $products->quantity;   
                        ?>
                      @else
                        <?php $total_amount1+=  
                        $products->price  * $products->quantity;   
                        ?>
                      @endif
                    @endforeach 
                  </ul>
                  <div class="dropcart__totals">
                    <table>
                      <tr>
                        <th>Subtotal</th>
                        <td><i class="fas fa-rupee-sign"></i> {{$total_amount1}}</td>
                      </tr>
                       
                    </table>
                  </div>
                  <div class="dropcart__actions"><a href="{{url('/my-cart')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/checkout/'.Auth::user()->id)}}" class="btn btn-primary">Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          @else <!---this run only after login when cart empty --->
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><span class="icon-cart-full"></span><span class="indicator__counter">0</span> </span><span class="indicator__title">Shopping Cart</span> <span class="indicator__value">
                <!--<i class="fas fa-rupee-sign"></i>00.00</span>-->
                </a>
              <div class="indicator__content">
                <div class="dropcart"> 
                  <div class="dropcart__totals">
                    <table>
                      <a href="{{url('/')}}" style="color:#1d99b6; font-size:18px;">{{$result}}</a>
                    </table>
                  </div>
                  <!--<div class="dropcart__actions"><a href="{{url('/')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/')}}" class="btn btn-primary">Checkout</a>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
          @endif  
        @else <!---this run only without login time---> 
          @if(is_array($result)) <!---this run only without login temp cart not empty --->
            @foreach($result as $products)
              @if($products->special_price == null)
                <?php $total_amount+= $products->price * $products->quantity;?>
              @else
                <?php $total_amount+= $products->special_price * $products->quantity;?>
              @endif 
            @endforeach
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><span class="icon-cart-full"></span><span class="indicator__counter">{{$count}}</span> </span><span class="indicator__title">Shopping Cart</span> <span class="indicator__value">
                <!--<i class="fas fa-rupee-sign"></i>{{$total_amount}}.00-->
                </span></a>
              <div class="indicator__content">
                <div class="dropcart">
                  <ul class="dropcart__list">
                    @php 
                      $total_amount1=0;
                      $total_amount2=0;
                    @endphp 
                    @foreach($result as $products) 
                      <?php 
                        $category = DB::table('product_images')->where('type',2)->where('products_id' , $products->products_id)->pluck('product_image')->first(); 
                      ?>
                      <li class="dropcart__item">
                        <div class="dropcart__item-image">
                          <a href="{{url('/product-detail/'.$products->products_id)}}">
                            <img src="{{asset($category)}}" alt="" class="img-fluid">
                          </a>
                        </div>
                        <div class="dropcart__item-info">
                          <div class="dropcart__item-name"><a href="{{url('/product-detail/'.$products->products_id)}}">{{$products->product_name}}</a>
                          </div>
                          <ul class="dropcart__item-features">
                            <!--<li>Color: Yellow</li>-->
                          </ul>
                          <div class="dropcart__item-meta">
                            <div class="dropcart__item-quantity">{{$products->quantity}}</div>
                            <div class="dropcart__item-price"><i class="fas fa-rupee-sign"></i> 
                              @if($products->special_price == null)
                                {{$products->quantity}} * {{ $products->price }} 
                              @else
                                {{$products->quantity}} * {{ $products->special_price }} 
                              @endif 
                            </div>
                          </div>
                        </div>
                        <button type="button" class="dropcart__item-remove"> 
                          <a  href="{{url('/')}}" class="text-danger" onclick="removeProduct({{$products->temp_carts_id}})"><i class="fas fa-times"></i></a>
                        </button>
                      </li>  
                      @if($products->special_price != null) 
                        <?php $total_amount1+=  
                        $products->special_price  * $products->quantity;   
                        ?>
                      @else
                        <?php $total_amount1+=  
                        $products->price  * $products->quantity;   
                        ?>
                      @endif
                    @endforeach 
                  </ul>
                  <div class="dropcart__totals">
                    <table>
                      <tr>
                        <th>Subtotal</th>
                        <td><i class="fas fa-rupee-sign"></i> {{$total_amount1}}</td>
                      </tr>
                        
                    </table>
                  </div>
                  <div class="dropcart__actions"><a href="{{url('/my-cart')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/login-user')}}" class="btn btn-primary">Checkout</a>
                  </div>
                </div>
              </div>
            </div>
          @else <!---this run only without login temp cart empty --->
            <div class="indicator indicator--trigger--click"><a href="{{url('/')}}" class="indicator__button"><span class="indicator__icon"><span class="icon-cart-full"></span><span class="indicator__counter">0</span> </span><span class="indicator__title">Shopping Cart</span> <span class="indicator__value">
                <!--<i class="fas fa-rupee-sign"></i>00.00-->
                </span></a>
              <div class="indicator__content">
                <div class="dropcart"> 
                  <div class="dropcart__totals">
                    <table>
                      <a href="{{url('/')}}" style="color:#1d99b6; font-size:18px;">{{$result}}</a>
                    </table>
                  </div>
                  <!--<div class="dropcart__actions"><a href="{{url('/')}}" class="btn btn-secondary">View Cart</a>  <a href="{{url('/')}}" class="btn btn-primary">Checkout</a>-->
                  <!--</div>-->
                </div>
              </div>
            </div>
          @endif 
        @endif <!---endif to check login or without login--->

  </header>
  
  <script type="text/javascript"> 

    Notification.requestPermission(function(result) {
  if (result === 'denied') {
    console.log('Permission wasn\'t granted. Allow a retry.');
    return;
  } else if (result === 'default') {
    console.log('The permission request was dismissed.');
    return;
  }
  console.log('Permission was granted for notifications');
});
  function removeProduct(id) {
    //console.log(id);
  $.ajax({
    url: "remove-product",
    data:"cart_id="+id,
    type: 'get',
    success: function(response){
      alert('product successfully deleted from cart');
    }
  });
  document.getElementById('record-'+id).style.display="none";
  //for total cart amount calculation
  document.getElementById('total').innerHTML= parseInt(document.getElementById('total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
  document.getElementById('grand-total').innerHTML= parseInt(document.getElementById('grand-total').innerHTML) - parseInt(document.getElementById('price-'+id).innerHTML);
  }
</script> 

<!-- site__header / end