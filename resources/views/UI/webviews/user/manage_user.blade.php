@extends('main_master') 
	@section('main_content')    
	@if($flag == 1)
  		@include('UI.components/user/user_registration')  
  	@elseif($flag == 2) 
  		@include('UI.components/user/user_my_cart')  
  	@elseif($flag == 3) 
  		@include('UI.components/user/user_checkout')  
  	@elseif($flag == 4) 
  		@include('UI.components/user/order_thanku_page') 
    @elseif($flag == 6) 
      @include('UI.components/user/user_login') 
    @elseif($flag == 8) 
  		@include('UI.components/user/order_fail_page') 
  	@endif 
@stop 
