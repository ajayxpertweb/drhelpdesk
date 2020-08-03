<!-- scripts -->

	<script src="{{asset('UI/vendor/jquery/jquery.min.js')}}"></script>
	
	<script src="{{asset('UI/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

	<script src="{{asset('UI/vendor/owl-carousel/owl.carousel.min.js')}}"></script>

	<script src="{{asset('UI/vendor/nouislider/nouislider.min.js')}}"></script>

	<script src="{{asset('UI/vendor/photoswipe/photoswipe.min.js')}}"></script>

	<script src="{{asset('UI/vendor/photoswipe/photoswipe-ui-default.min.js')}}"></script>

	<script src="{{asset('UI/vendor/select2/js/select2.min.js')}}"></script>
        <script src="{{asset('UI/vendor/jquery/jquery.validate.min.js')}}"></script>


	<script src="{{asset('UI/js/number.js')}}"></script>

	<script src="{{asset('UI/js/main.js')}}"></script>
	<script src="{{asset('UI/js/loading.js')}}"></script>
        
        
	
	<!-- geoplugin link---->

	<script language="JavaScript" src="http://www.geoplugin.net/javascript.gp" type="text/javascript">

		

	</script> 

	<!-- access location popup----> 


<script>
    $(document).on('change', '#deliveryLocaion', function(){
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
  var locAPI = "https://maps.googleapis.com/maps/api/geocode/json?latlng="+position.coords.latitude +","+position.coords.longitude+"&key=AIzaSyAuLQFXPC_i3ZMhtpEplk3Owv8XGHyPOVM";
 
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

$(document).on('change', '#prescription_image', function(e){
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
                alert('You are unable call, Please contact with admin.');
                $('#calling').hide();
                $('#voice_call').show();
              } else {
                $('#calling').hide();
                $('#voice_call').show();
                location.reload(true);
              }
            }
        });
    });
</script>
<script>
 var foo = [];
 var reating = [];
    $(document).on('click','.CheckCls',function(){
        var check = $(this).is(":checked");
        var catId = $(this).val();
        var containName = catId.includes("rating");
            
        if(check){
            if(containName){
                rate = catId.split('-');
                reating.push(rate['1']);
            }else{
               foo.push(catId); 
            }
             
        }else{
            if(containName){
                rate = catId.split('-');
                reating.splice( $.inArray(rate['1'], reating), 1 );
            }else{
            foo.splice( $.inArray(catId, foo), 1 );    
            }
            
        }
        //for rating
        
        var tokens = $("#_token").val();
        $.ajax({
            type: "post",
            url: "{{url('/doctor-list-ajax')}}",
            data:  {"catId":foo,"reating":reating,"_token":tokens},
            success : function(res){
                 $("#loadingDiv").remove();
            $('.filterData').html(res);
//           
             
            }
        });
        

    });

</script>
<script>
     $(document).ready(function(){
        var check = $('.CheckCls').is(":checked");
        var catId = $('.CheckCls:checked').val();
        if(check){
             foo.push(catId);
        }else{
            foo.splice( $.inArray(catId, foo), 1 );
        }
        console.log(foo);
        var tokens = $("#_token").val();
        $('.gg>.preload').click();
        $.ajax({
            type: "post",
            url: "{{url('/doctor-list-ajax')}}",
            data:  {"catId":foo,"_token":tokens},
            success : function(res){
                 $("#loadingDiv").remove();
            $('.filterData').html(res);
            }
        });
        

    });

</script>  
<script>
$(document).ready(function(){
    $('.ttype').change(function(){
        var iid = $(this).val();
        if(iid == '3'){
            $(".speciality").css("display","block");
            $(".speciality").prop('required',true);
        }else{
            $(".speciality").prop('required',false);
             $(".speciality").css("display","none");
        }
    })
})
</script>
<script>
$(document).ready(function(){
$(document).on('click','.recbutton',function(){
        var likVal = $(this).val();
        var id = $(this).attr('name');
        var tokens = $("#_token").val();
        $.ajax({
            type: "post",
            url: "{{url('/submit-review-ajax')}}",
            data:  {"likeVal":likVal,"id":id,"_token":tokens},
            success : function(res){
                 $("#loadingDiv").remove();
          location.reload(true);
            }
        });
        

    });
})
$(document).ready(function(){
        $(document).on('click', '#consult_now_credit', function(){
          var consult_ids = $(this).attr('data-consult_ids');
          
           $.ajax({
                type: "post",
                url: "{{route('cunsult_now')}}",
                dataType: "json",
                data: {"consult_ids":consult_ids, "_token": "{{ csrf_token() }}"},
                success : function(res){
                  location.reload(true);
                }
            });
        });
});
</script>
<script>
$(document).ready(function(){
$(document).on('click','#SubID',function(){
        var subMail = $("#newslatter_email").val();
         var tokens = $("#_token").val();
         var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(subMail == ""){
           alert("Please Enter Email Id");
           return false;
        }
       if(subMail.match(mailformat))
        {
              $(".preload").click();
              $.ajax({
                type: "post",
                url: "{{url('/save-newslatter')}}",
                data:  {"newslatter_email":subMail,"_token":tokens},
                success : function(res){
                $("#loadingDiv").remove();
                $("#newslatter_email").val("");
                $(".divmsg").css("display","block");
            }
        });
        }else{
            alert('Please Enter Valid EmailId');
            return flase;
        }
        
        
        
       });
})
</script>

