<!DOCTYPE html>
<html>
  <head> 
     @include('admin.common/admin_head_scripts')
  </head>
  <body class="skin-blue sidebar-mini">
    <div class="wrapper">   
      @include('admin.common/admin_header')
      @include('admin.common/admin_sidebar')
      <div class="content-wrapper"> 
        <section class="content-header">
          <h1>
             {{ $page_title }}
           <!--  <small>Control panel</small> -->
          </h1>
          <!-- <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol> -->
        </section> 
        <section class="content"> 
         @yield('main_content')
       </section>
      </div>  
      @include('admin.common/admin_footer')
      <div class="control-sidebar-bg"></div>
    </div> 
    @include('admin.common/admin_foot_scripts')
  </body>
</html>
