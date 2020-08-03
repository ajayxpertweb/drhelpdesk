<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return redirect('admin');
});
Route::post('/checkaddress', 'UI\MainController@checkaddress');

	// Main Controller ROUTES
	Route::get('/', 'UI\MainController@homePage');
	Route::get('/product-detail/{products_id}', 'UI\MainController@productDetail');
	// Route::get('/product-list', 'UI\MainController@productListing');
	// Route::get('filter-categories/{categories_id}','UI\MainController@productFilter');  
	// Route::get('filter-subcategories/{categories_id}/{subcategories}','UI\MainController@productFilter1');  
	// Route::get('filter-subsubcategories/{categories_id}/{subcategories}/{subsubcategories}','UI\MainController@productFilter2');  
	Route::get('filter-category/{categories_id}/{subcategories?}/{subsubcategories?}/{subsubsubcategories?}','UI\MainController@productFilter3')->name('filtersubcategory.show'); 
	Route::post('filter-category/{categories_id}/{subcategories?}/{subsubcategories?}/{subsubsubcategories?}','UI\MainController@productFilter3')->name('filtercategory.show'); 
	Route::get('about-us','UI\MainController@aboutUs');
	Route::get('contact-us','UI\MainController@contactUs');
	Route::get('blog','UI\MainController@blog');
	Route::get('privacy-policy','UI\MainController@privacyPolicy');
	
	//User Controller Routes
	Route::get('/registration', 'UI\UserController@userRegistration');
	Route::get('/login-user', 'UI\UserController@userLogin');
	Route::post('user-registration','UI\UserController@userRegistrationSubmit'); 
	Route::post('user-login','UI\UserController@userLoginSubmit'); 
	Route::get('dashboard','UI\UserController@dashboard'); 
	Route::get('cart-details/{products_id}','UI\UserController@addtoCart');
	Route::get('cart','UI\UserController@addtoCart1');

	Route::get('my-cart','UI\UserController@userMyCart');
	Route::get('cart-update','UI\UserController@cartUpdate');
	Route::get('remove-product','UI\UserController@removeProduct'); 
	Route::get('checkout/{id}','UI\UserController@userCheckout');
	Route::get('checkout1/{id}/{prescription_id?}','UI\UserController@userCheckout1');
	Route::post('user-address-submit','UI\UserController@userAddressSubmit');
	Route::get('user-address-delete/{id}','UI\UserController@userAddressDelete'); 
	Route::get('user-address-edit/{id}','UI\UserController@userAddressEdit'); 
	Route::post('checkout-submit','UI\UserController@checkoutSubmit');
	Route::get('order-suceess/{order_id}','UI\UserController@orderSuccessPage');
	Route::get('ip','UI\MainController@get_ip_detail');
	Route::get('upload-prescription','UI\MainController@uploadPrescription');
	Route::post('prescription-submit','UI\UserController@prescription');
	


	Route::post('product-review-submit','UI\UserController@addReviewComment'); 

	// User Dashboard routes
	   Route::get('user-dashboard','UI\UserController@userDashboard'); 
	   Route::get('user-order-detail/{id}','UI\UserController@userOrderDetail');
	   Route::get('user-profile','UI\UserController@userProfile'); 
	   Route::get('user-order-history','UI\UserController@userOrderHistory');
	   Route::get('user-booking','UI\UserController@userMyBooking');
	   Route::get('user-address','UI\UserController@userAddress');
	   Route::get('user-password','UI\UserController@userPassword');
	   Route::post('user-profile-submit','UI\UserController@userProfileSubmit'); 
	   Route::post('order-status-update','UI\UserController@orderCancelOrder');
	   Route::post('shippingorder-status-update','UI\UserController@shippingorderCancelOrder');

	     Route::post('trackorder','UI\UserController@trackorder');
	// Doctor Controller 
	   	//Doctor Dashboard routes
	   	Route::post('doctor-education-submit','UI\DoctorController@doctoreducation');
	    Route::post('doctor-experiance-submit','UI\DoctorController@doctorexperiance');
         Route::post('doctor-award-submit','UI\DoctorController@doctoraward');
          Route::post('doctor-ragistration-submit','UI\DoctorController@doctorragistration');
          
           Route::get('/delete-experiance-detail/{id}', 'UI\DoctorController@deleteexperiance');
            Route::get('/delete-award-detail/{id}', 'UI\DoctorController@deleteaward');
             Route::get('/delete-registration-detail/{id}', 'UI\DoctorController@deleteragistration');
              Route::get('/delete-education-detail/{id}', 'UI\DoctorController@deleteeducation');
             
	   	
	   Route::get('doctor-appointment','UI\DoctorController@doctorAppointment');
	   Route::get('doctor-change-password','UI\DoctorController@doctorChangePassword');
	   Route::get('doctor-chat','UI\DoctorController@doctorChatDoctor');
	   Route::get('doctor-dashboard','UI\DoctorController@doctorDashboard');
	   Route::get('doctor-invoices','UI\DoctorController@doctorInvoices');
	   Route::get('doctor-profile-setting','UI\DoctorController@doctorProfileSettings');
	   Route::get('doctor-clinic-setting','UI\DoctorController@doctorClinicSettings');
	   Route::get('doctor-review','UI\DoctorController@doctorReviews');
	   Route::get('doctor-schedule-timing','UI\DoctorController@doctorScheduleTimings'); 
	   Route::get('doctor-list/{categories_id}/{subcategories?}','UI\DoctorController@doctorListing')->name('doctorlist.show');
	   Route::post('doctor-list/{categories_id}/{subcategories?}','UI\DoctorController@doctorListing')->name('doctorlist.view'); 
	   Route::get('doctor-details/{id}','UI\DoctorController@doctorDetails');
	   Route::get('doctor-dashboard','UI\DoctorController@doctorDashboard');
	   Route::post('appointment','UI\DoctorController@doctorAppointmentSubmit');
	   Route::post('feedback','UI\DoctorController@doctorFeedback'); 
	   Route::post('doctor-detail-submit','UI\DoctorController@doctorDetailsSubmit'); 
	   Route::post('clinic-detail-submit','UI\DoctorController@clinicDetailsSubmit'); 
	   Route::get('/delete-patient-detail/{id}', 'UI\DoctorController@deletePatientData');
	   Route::get('/delete-profile-detail/{id}', 'UI\DoctorController@deleteProfileData');
	   Route::get('toggle-patient-status/{status}/{id}', 'UI\DoctorController@togglePatientActiveStatus');
	   Route::post('change-password','UI\DoctorController@changePassword');   
	 
	   //forget Password website
        Route::get('forget-password','UI\UserController@forgetPasswordView');
        Route::post('forget-password-submit','UI\UserController@forgotPasswordSubmit');
        //password reset
        Route::get('passwordreset/{id}','UI\UserController@forgetPassword');
        Route::post('submit','UI\UserController@submit');
        Route::get('thanku','UI\UserController@thanku');


Auth::routes(); 
Route::middleware(['auth'])->group(function() {
	Route::get('/admin', 'admin\DashboardController@admin'); 
	Route::get('/vendor', 'admin\DashboardController@vendor'); 

	Route::get('/add-categories', 'admin\AdminController@addCategories');
	Route::get('/view-categories', 'admin\AdminController@viewCategories');
	Route::get('/edit-categories/{id}', 'admin\AdminController@editCategories');
	Route::get('/edit-save-more-categories/{id}', 'admin\AdminController@editSaveMoreCategories');
	Route::get('/edit-covid-categories/{id}', 'admin\AdminController@editCovidCategories');

	Route::get('/delete-categories/{id}', 'admin\AdminController@deleteCategories');
	Route::post('/categories-submit', 'admin\AdminController@categoriesSubmit');
	Route::get('toggle-categories-status/{status}/{id}', 'admin\AdminController@toggleCategoriesActiveStatus');


	Route::get('/add-sub-categories', 'admin\AdminController@addSubCategories');
	Route::get('/view-sub-categories', 'admin\AdminController@viewSubCategories');
	Route::get('/edit-sub-categories/{id}', 'admin\AdminController@editSubCategories');
	Route::get('/delete-sub-categories/{id}', 'admin\AdminController@deleteSubCategories');
	Route::post('/sub-categories-submit', 'admin\AdminController@subCategoriesSubmit');
	Route::get('toggle-sub-categories-status/{status}/{id}', 'admin\AdminController@toggleSubCategoriesActiveStatus');


	Route::get('/add-user-categories', 'admin\AdminController@addUserCategories');
	Route::get('/view-user-categories', 'admin\AdminController@viewUserCategories');
	Route::get('/edit-user-categories/{id}', 'admin\AdminController@editUserCategories');
	Route::get('/delete-user-categories/{id}', 'admin\AdminController@deleteUserCategories');
	Route::post('/user-categories-submit', 'admin\AdminController@userCategoriesSubmit');
	Route::get('toggle-user-categories-status/{status}/{id}', 'admin\AdminController@toggleUserCategoriesActiveStatus');


	Route::get('/add-user-sub-categories', 'admin\AdminController@addUserSubCategories');
	Route::get('/view-user-sub-categories', 'admin\AdminController@viewUserSubCategories');
	Route::get('/edit-user-sub-categories/{id}', 'admin\AdminController@editUserSubCategories');
	Route::get('/delete-user-sub-categories/{id}', 'admin\AdminController@deleteUserSubCategories');
	Route::post('/user-sub-categories-submit', 'admin\AdminController@userSubCategoriesSubmit');
	Route::get('toggle-user-sub-categories-status/{status}/{id}', 'admin\AdminController@toggleUserSubCategoriesActiveStatus');

	Route::get('/add-banner', 'admin\AdminController@addBanner');
	Route::get('/view-banner', 'admin\AdminController@viewBanner');
	Route::get('/edit-banner/{id}', 'admin\AdminController@editBanner');
	Route::get('/delete-banner/{id}', 'admin\AdminController@deleteBanner');
	Route::post('/banner-submit', 'admin\AdminController@bannerSubmit');
	Route::get('toggle-banner-status/{status}/{id}', 'admin\AdminController@toggleBannerActiveStatus');

	Route::get('/add-coupon', 'admin\AdminController@addCoupon');
	Route::get('/view-coupon', 'admin\AdminController@viewCoupon');
	Route::get('/edit-coupon/{id}', 'admin\AdminController@editCoupon');
	Route::get('/delete-coupon/{id}', 'admin\AdminController@deleteCoupon');
	Route::post('/coupon-submit', 'admin\AdminController@couponSubmit');
	Route::get('toggle-coupon-status/{status}/{id}', 'admin\AdminController@toggleCouponActiveStatus');

	Route::get('/add-role', 'admin\AdminController@addRole');
	Route::get('/view-role', 'admin\AdminController@viewRole');
	Route::get('/edit-role/{id}', 'admin\AdminController@editRole');
	Route::get('/delete-role/{id}', 'admin\AdminController@deleteRole');
	Route::post('/role-submit', 'admin\AdminController@roleSubmit');
	Route::get('toggle-role-status/{status}/{id}', 'admin\AdminController@toggleRoleActiveStatus');

	Route::get('/add-language', 'admin\AdminController@addLanguage');
	Route::get('/view-language', 'admin\AdminController@viewLanguage');
	Route::get('/edit-language/{id}', 'admin\AdminController@editLanguage');
	Route::get('/delete-language/{id}', 'admin\AdminController@deleteLanguage');
	Route::post('/language-submit', 'admin\AdminController@languageSubmit');
	Route::get('toggle-language-status/{status}/{id}', 'admin\AdminController@toggleLanguageActiveStatus');

	Route::get('/add-user-details', 'admin\AdminController@addUserDetails');
	Route::get('/view-user-details', 'admin\AdminController@viewUserDetails');
	Route::get('/edit-user-details/{id}', 'admin\AdminController@editUserDetails');
	Route::get('/delete-user-details/{id}', 'admin\AdminController@deleteUserDetails');
	Route::post('/user-details-submit', 'admin\AdminController@userDetailsSubmit');
	Route::get('toggle-user-details-status/{status}/{id}', 'admin\AdminController@toggleUserDetailsActiveStatus');

	Route::get('/add-vendors', 'admin\VendorController@addVendors');
	Route::get('/view-vendors', 'admin\VendorController@viewVendors');
	Route::get('/edit-vendors/{id}', 'admin\VendorController@editVendors');
	Route::get('/delete-vendors/{id}', 'admin\VendorController@deleteVendors');
	Route::post('/vendors-submit', 'admin\VendorController@vendorsSubmit');
	Route::get('toggle-vendors-status/{status}/{id}', 'admin\VendorController@toggleVendorsActiveStatus');
	
	Route::get('/add-delivery-boy', 'admin\DeliveryBoyController@addDeliveryBoy');
	Route::get('/view-delivery-boy', 'admin\DeliveryBoyController@viewDeliveryBoy');
	Route::get('/edit-delivery-boy/{id}', 'admin\DeliveryBoyController@editDeliveryBoy');
	Route::get('/delete-delivery-boy/{id}', 'admin\DeliveryBoyController@deleteDeliveryBoy');
	Route::post('/delivery-boy-submit', 'admin\DeliveryBoyController@deliveryBoySubmit');
	Route::get('toggle-delivery-boy-status/{status}/{id}', 'admin\DeliveryBoyController@toggleDeliveryBoyActiveStatus');


	Route::get('/add-blogs', 'admin\VendorController@addBlogs');
	Route::get('/view-blogs', 'admin\VendorController@viewBlogs');
	Route::get('/edit-blogs/{id}', 'admin\VendorController@editBlogs');
	Route::get('/delete-blogs/{id}', 'admin\VendorController@deleteBlogs');
	Route::post('/blogs-submit', 'admin\VendorController@blogsSubmit');
	Route::get('toggle-blogs-status/{status}/{id}', 'admin\VendorController@toggleBlogsActiveStatus');

	Route::get('/add-product', 'admin\VendorController@addProduct');
	Route::get('/view-product', 'admin\VendorController@viewProduct');
	Route::get('/edit-product/{id}', 'admin\VendorController@editProduct');
	Route::get('/delete-product/{id}', 'admin\VendorController@deleteProduct');
	Route::post('/products-submit', 'admin\VendorController@productSubmit');
	Route::get('toggle-product-status/{status}/{id}', 'admin\VendorController@toggleProductActiveStatus');

	Route::get('/add-location', 'admin\VendorController@addLocation');
	Route::get('/view-location', 'admin\VendorController@viewLocation');
	Route::get('/edit-location/{id}', 'admin\VendorController@editLocation');
	Route::get('/delete-location/{id}', 'admin\VendorController@deleteLocation');
	Route::post('/location-submit', 'admin\VendorController@locationSubmit');
	Route::get('toggle-location-status/{status}/{id}', 'admin\VendorController@toggleLocationActiveStatus');

	Route::get('/add-testimonials', 'admin\VendorController@addTestimonial');
	Route::get('/view-testimonials', 'admin\VendorController@viewTestimonial');
	Route::get('/edit-testimonials/{id}', 'admin\VendorController@editTestimonial');
	Route::get('/delete-testimonials/{id}', 'admin\VendorController@deleteTestimonial');
	Route::post('/testimonials-submit', 'admin\VendorController@testimonialSubmit');
	Route::get('toggle-testimonials-status/{status}/{id}', 'admin\VendorController@toggleTestimonialActiveStatus');

	Route::get('/add-packages', 'admin\VendorController@addPackages');
	Route::get('/view-packages', 'admin\VendorController@viewPackages');
	Route::get('/edit-packages/{id}', 'admin\VendorController@editPackages');
	Route::get('/delete-packages/{id}', 'admin\VendorController@deletePackages');
	Route::post('/packages-submit', 'admin\VendorController@packagessubmit');
	Route::get('toggle-packages-status/{status}/{id}', 'admin\VendorController@togglePackagesActiveStatus');

	Route::get('/add-brand', 'admin\VendorController@addBrand');
	Route::get('/view-brand', 'admin\VendorController@viewBrand');
	Route::get('/edit-brand/{id}', 'admin\VendorController@editBrand');
	Route::get('/delete-brand/{id}', 'admin\VendorController@deleteBrand');
	Route::post('/brand-submit', 'admin\VendorController@brandSubmit');
	Route::get('toggle-brand-status/{status}/{id}', 'admin\VendorController@toggleBrandActiveStatus'); 
	
	// order related routes in admin
	Route::get('/view-order', 'admin\OrderController@viewOrder');
	Route::get('/view-order-details/{id}', 'admin\OrderController@viewOrderDetail');
	Route::post('/order-status-change', 'admin\OrderController@orderStatusUpdate');
	Route::post('/vendor-assign', 'admin\OrderController@vendorAssign');
	
	Route::post('import', 'admin\ExcelController@importproduct')->name('import');

});