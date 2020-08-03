<header class="main-header"> 
  <a href="{{ url('admin') }}" class="logo"> 
    <span class="logo-mini"></span> 
    <span class="logo-lg" ><b>DHD</b></span><hr>
  </a> 
  <nav class="navbar navbar-static-top" role="navigation"  style="background-color:#ffffff;"> 
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" style="color:black;">
      <span class="sr-only">Toggle navigation</span>
    </a> 
    <div class="navbar-custom-menu">
      <!-- <ul class="nav navbar-nav">
        <li>
          <a href="{{ url('logout') }}" style="color:black;">Logout <i class="fas fa-sign-out-alt"></i></a>
        </li>
      </ul> -->
      <ul class="nav navbar-nav"> 
        <li>
          <!-- <a href="{{url('/')}}" style="color:black; float:left;">
            Visit Website
          </a> -->
        </li>
        <li class="dropdown user user-menu">
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" style="color:black;">
            <span class="hidden-xs" style="color:black;">Logout <i class="fas fa-sign-out-alt"></i></span>
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
          </form>
        </li> 
        
      </ul>
    </div>
  </nav>
</header>
