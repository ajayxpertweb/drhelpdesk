<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  @include('UI.common/main_head_scripts')   
</head> 
<body>
  <!-- site -->
  <div class="site"> 
    <!-- site__header -->
      @include('UI.common/main_header') 
    <!-- site__header / end --> 
    
    <!-- site__body -->
    <div class="site__body"> 
      @yield('main_content')
    </div>
    <!-- site__body / end -->
    
    <!-- site__footer -->
      @include('UI.common/main_footer') 
    <!-- site__footer / end -->
  </div>
  <!-- site / end -->
  <!-- mobile-menu --> 

  <!-- mobile-menu / end --> 
  <!-- scripts -->
    @include('UI.common/header_mobile_menu')  

    @include('UI.common/main_foot_scripts')  
  <!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5f226e9a1a544e2a7275a251/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>