<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group([ 'middleware' => 'check'], function()
{	
	
	Route::post('registration-otp','api\UserController@registrationOTP'); 
	Route::post('register','api\UserController@register'); 
	Route::post('login','api\UserController@login'); 
	Route::post('social-login','api\UserController@socialLogin'); 
	Route::post('/write-review', 'api\UserController@writeReview'); 
	Route::post('/show-review', 'api\UserController@showReview'); 
	Route::get('/apply-coupen', 'api\UserController@applyCoupen'); 
	Route::post('/edit-user-profile', 'api\UserController@editProfile'); 
	Route::post('change-password','api\UserController@changePassword'); 
	Route::post('forgot-password', 'api\UserController@forgotPassword');
	Route::post('otp', 'api\UserController@otp');
	Route::post('/refer-code', 'api\UserController@applyReferCode');
    Route::get('/doctor-list', 'api\UserController@consultDoctorList');
	Route::get('/user-uses-doctor', 'api\UserController@userUsesDoctor');
	Route::get('/user-wallet-history', 'api\UserController@userWalletHistory');
	Route::post('/user-add-wallet', 'api\UserController@userAddWallet');
	Route::post('/user-consult-doctor', 'api\UserController@consultDoctor');
	Route::post('/add-credit', 'api\UserController@addCredit');
	Route::get('/doctor-call', 'api\UserController@doctorCall');
    
    Route::post('/write-doctor-review', 'api\UserController@writeDoctorReview'); 
	Route::post('/write-doctor-recommandation', 'api\UserController@writeDoctorRecommendation'); 
	
	
	
	Route::get('/categories', 'api\AdminController@category'); 
	Route::get('/sub-categories', 'api\AdminController@subCategory'); 
	Route::get('/product', 'api\AdminController@productBySubCategory'); 
	Route::get('/product-detail', 'api\AdminController@productDetails'); 
	Route::get('/doctor-listing', 'api\AdminController@doctorListing'); 
    Route::get('/location-list', 'api\AdminController@locationListing'); 
	Route::get('/home-page', 'api\AdminController@homePage'); 
	Route::post('/add-to-cart', 'api\AdminController@addToCart');  
	Route::post('/my-cart', 'api\AdminController@myCart'); 
	Route::post('/brand', 'api\AdminController@fetchBrand'); 
	Route::post('/doctor-detail', 'api\AdminController@doctorDetails'); 
	Route::get('/lab-test', 'api\AdminController@allLabTest'); 
	Route::get('/vendor-order', 'api\AdminController@vendorsOrder'); 
	Route::get('/shipping-charge', 'api\AdminController@shippingCharge'); 
    Route::get('/user-wallet', 'api\AdminController@deWalletCoin'); 
	Route::get('/delivery-boy', 'api\AdminController@deliveryBoyListing'); 
	Route::post('/add-to-wishlist', 'api\AdminController@addToWishlist'); 
	Route::post('/my-wishlist', 'api\AdminController@myWishlist'); 
	Route::get('/product-filter', 'api\AdminController@productFilter'); 
	Route::get('/product-filter-sort', 'api\AdminController@productFilterSortBy'); 
	Route::get('/all-city', 'api\AdminController@allCities');
	Route::get('/search-data', 'api\AdminController@searchData');
	Route::get('/search', 'api\AdminController@search');

	Route::post('/add-address', 'api\BookingController@addAddress');
	Route::post('/user-address', 'api\BookingController@userAddresses');
	Route::post('/place-order', 'api\BookingController@placeOrderSingle');
	Route::post('/place-cart-order', 'api\BookingController@placeOrderCart');
	Route::get('/cart-update', 'api\BookingController@cartUpdate');
	Route::get('/remove-product', 'api\BookingController@removeProduct');
	Route::post('/my-order', 'api\BookingController@myOrder');
	Route::post('/my-booking', 'api\BookingController@myBooking');
    Route::post('/order-details', 'api\BookingController@orderDetails');
    Route::post('/sub-order-listing', 'api\BookingController@subOrderDetails');
    Route::post('/sub-booking-listing', 'api\BookingController@subBookingDetails');
    
	Route::post('/cancle-order', 'api\BookingController@cancleOrder');
	Route::post('/doctor-appointment', 'api\BookingController@doctorAppointment');
	Route::post('/upload-prescription', 'api\BookingController@uploadPrescription');
	Route::get('/delete-prescription', 'api\BookingController@userPrescriptionDelete');
	Route::post('/prescription-list', 'api\BookingController@userPrescription');
	Route::post('/vendor-list', 'api\BookingController@vendorList');
	Route::post('/health-package', 'api\BookingController@HealthPackage');
	Route::post('/all-health-package', 'api\BookingController@allHealthPackage');
	Route::get('cart-count', 'api\BookingController@myCartCount');
	Route::get('/vendors-order-list', 'api\BookingController@vendorOrderList');
	Route::get('/delivery-boy-order-list', 'api\BookingController@DeliveryBoyOrderList');
	Route::post('/vendors-order-accept', 'api\BookingController@vendorOrderAccept');
	Route::post('/change-order-status', 'api\BookingController@orderStatusUpdate');
	Route::post('/user-cancle-order', 'api\BookingController@userCancelOrder');
	Route::get('/remove-wishlist-product', 'api\BookingController@removeProductFromWishlist');
	Route::get('user-address-delete','api\BookingController@userAddressDelete'); 
	Route::post('/edit-address', 'api\BookingController@editAddress');
	Route::get('/package-detail', 'api\BookingController@packageDetailById');
    Route::get('/sexsual', 'api\AdminController@sexualWelnessDetail');
    Route::post('/update-delivery-boy-location', 'api\BookingController@updateDeliveryBoyLocation');
    Route::get('/track-order-route', 'api\BookingController@trackOrderRoute');
	//user Route
	
	//doctor route
	Route::get('/doctor-time-slot', 'api\DoctorController@doctorTimeSlot');
	Route::get('/doctor-dashboard', 'api\DoctorController@doctorDashboard');
	Route::post('/clinic-details-submit', 'api\DoctorController@clinicDetailsSubmit');
	//lab test
// 	Route::get('/lab-test1', 'api\LabTestController@labTest');
 
});
