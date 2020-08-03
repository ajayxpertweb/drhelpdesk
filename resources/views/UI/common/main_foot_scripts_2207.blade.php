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
    $(document).on('click', '#deliveryLocaion', function(){
       var delid = $(this).val(); 
       $('#demo').html(delid);
       $('.search__dropdown').removeClass('search__dropdown--open');
       $.ajax({
            type: "post",
            //url: "http://lsne.in/dhd/public/checkaddress",
            url: "{{ url('/checkaddress') }}",
            dataType: "json",
            data: {name:delid},
            success : function(data){
                //alert(data)
              if(data == 0){
              	$("#rs_phoneno1").html("Your Order Will Be deliver in 24 to 48 hours..!").show()
              }else{
              	$("#rs_phoneno1").html("Your Order Will Be deliver in 60 Min to 90 Min..!").show()
              }
              //window.location.href = "http://lsne.in/dhd/public";
              window.location.reload(true);
            }
        });
    });
var x = document.getElementById("demo");
function getLocation(){
    if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
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
              	$("#rs_phoneno1").html("Your Order Will Be deliver in 24 to 48 hours..!").show()
              }else{
              	$("#rs_phoneno1").html("Your Order Will Be deliver in 60 Min to 90 Min..!").show()
              }
              window.location.href = "http://lsne.in/dhd/public/";
            }
        });

   }
  });


}
	$(document).ready(function() {
            
        @if(!Session::get('location_name'))
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
@endif
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
	 <script>
function sidePop() {
  document.getElementById("sidebarpop").style.display = "block";
}
function sidePop1()
{
  document.getElementById("sidebarpop1").style.display = "block";
}

 var closebtns = document.getElementsByClassName("close");
  var i;

  for (i = 0; i < closebtns.length; i++) {
 closebtns[i].addEventListener("click", function() {
 this.parentElement.style.display = 'none';
 });
 }
</script>
<script>
	$(function(){
var overlay = $('<div id="overlay"></div>');
overlay.show();
overlay.appendTo(document.body);
$('.popup-onload').show();
$('.close').click(function(){
$('.popup-onload').hide();
overlay.appendTo(document.body).remove();
return false;
});


 

$('.x').click(function(){
$('.popup').hide();
overlay.appendTo(document.body).remove();
return false;
});
});

$(document).on('change', '#prescription_image', function(){
      var formData = new FormData($('#presentationform')[0]);
       $.ajax({
            type: "post",
            url: "{{url('/prescription-submit')}}",
            data:  formData,
            contentType: false,
            cache: false,
            processData:false,
            success : function(res){
            if(res=='2') {
              alert('Something went wrong')
            
            } else {
              location.reload(true);
            }
             
            }
        });
    });
     $(document).on('click', '#consult_now_add', function(){

      var doc_id = $(this).attr('data-doc_id');
      $('#login_form').append('<input type="hidden" id="doc_id" name="doc_id" value="">');
      $('#doc_id').val(doc_id)
    });
    $(document).on('click', '#voice_call', function(){
      var consult_call = $(this).attr('data-consult_call');
      $('#calling').show();
      $(this).hide();
       $.ajax({
            type: "post",
            url: "{{route('calling')}}",
            dataType: "json",
            data: {"consult_call":consult_call, "_token": "{{ csrf_token() }}"},
            success : function(res){
              if(res=='2') {
                alert('Something went wrong');
                $('#calling').hide();
                $(this).show();
              } else {
                $('#calling').hide();
                $(this).show();
                location.reload(true);
              }
            }
        });
    });
</script>
<script>
 var foo = [];
    $(document).on('click','.CheckCls',function(){
        var check = $(this).is(":checked");
        var catId = $(this).val();
        if(check){
             foo.push(catId);
        }else{
            foo.splice( $.inArray(catId, foo), 1 );
        }
        var tokens = $("#_token").val();
        $.ajax({
            type: "post",
            url: "{{url('/doctor-list-ajax')}}",
            data:  {"catId":foo,"_token":tokens},
            success : function(res){
            $('.filterData').html(res);
             
            }
        });
        

    });

</script>