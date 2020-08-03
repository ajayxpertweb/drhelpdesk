$(function () {
    //code for loading gif on form submiting
    
//    $('form').submit(function () {
//        if ($(this).valid()) {
//            $(':submit').attr('disabled', 'disabled');
//            $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
//           
//        }
//    });
    
    ////code for loading gif on form submiting on ajax
     $('.preload').click(function () {
            $('body').append('<div style="" id="loadingDiv"><div class="loader">Loading...</div></div>');
    });
    
    
    
    //code for form validating
   
  $("form[name='contactForm']").validate({
    // Specify validation rules
    rules: {
      name: "required",
      email: {
        required: true,
        email: true
      },
      phone_number:{
          required:true,
         
           minlength: 10,
             maxlength: 11,
           number:true
        },
      message:{
          required:true
      }
      
    }
   
  });
  
   $("form[name='news-latter']").validate({
    // Specify validation rules
    rules: {
     
      email: {
        required: true,
        email: true
      },
     
    }
   
  });
  

 $("form[name='login_form']").validate({
    // Specify validation rules
    rules: {
      phn_or_email: "required",
      password: "required",
      user_type: "required",
       
    }
   
  });


});
