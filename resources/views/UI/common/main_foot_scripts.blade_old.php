<!-- scripts -->

	<script src="{{asset('UI/vendor/jquery/jquery.min.js')}}"></script>

	<script src="{{asset('UI/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

	<script src="{{asset('UI/vendor/owl-carousel/owl.carousel.min.js')}}"></script>

	<script src="{{asset('UI/vendor/nouislider/nouislider.min.js')}}"></script>

	<script src="{{asset('UI/vendor/photoswipe/photoswipe.min.js')}}"></script>

	<script src="{{asset('UI/vendor/photoswipe/photoswipe-ui-default.min.js')}}"></script>

	<script src="{{asset('UI/vendor/select2/js/select2.min.js')}}"></script>

	<script src="{{asset('UI/js/number.js')}}"></script>

	<script src="{{asset('UI/js/main.js')}}"></script>

	<!-- geoplugin link---->

	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript">

		

	</script> 

	<!-- access location popup----> 


<script>
var x = document.getElementById("demo");

	$(document).ready(function() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }


function showPosition(position) {
 

  var locAPI = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude +","+position.coords.longitude+"&key=AIzaSyCjf4v2Iaap5p7mNaROJ4RvU_knhiIG9do";
 
  $.get({
   url:locAPI,
   success:function(data){
   	x.innerHTML = data.results[0].address_components[4].long_name;
        $.ajax({
            type: "post",
            url: "http://lsne.in/dhd/public/checkaddress",
            dataType: "json",
            data: {name:x.innerHTML},
            success : function(data){
                //alert(data)
              if(data == 0){
              	$("#rs_phoneno1").html("Your Order Will Be Deleiver in 24 to 48 hours..!").show()
              }else{
              	$("#rs_phoneno1").html("Your Order Will Be Deleiver in 2 to 3 hours..!").show()
              }
            }
        });

   }
  });


}

})
</script>
<script>

    $(document).on('change','.food_sorting',function(){

        $(this).closest('form').submit();

    });

</script>

<script>

    $(document).on('change','.price_sorting',function(){

        $(this).closest('form').submit();

    });

</script>

<script type="text/javascript">

	$(document).ready(function () {

        $("#addNewaddress").click(function(){

            $(".new-address").show();           

        });	     

    });

</script>

<script type="text/javascript">

		$(document).ready(function() {

		$(".filter-categories span").click(function() {

				var link = $(this);

				var closest_ul = link.closest("ul");

				var parallel_active_links = closest_ul.find(".active")

				var closest_li = link.closest("li");

				var link_status = closest_li.hasClass("active");

				var count = 0;



				closest_ul.find("ul").slideUp(function() {

						if (++count == closest_ul.find("ul").length)

								parallel_active_links.removeClass("active");

				});



				if (!link_status) {

						closest_li.children("ul").slideDown();

						closest_li.addClass("active");

				}

		})

})

	</script>