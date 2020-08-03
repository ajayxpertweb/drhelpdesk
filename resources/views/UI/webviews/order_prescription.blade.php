@extends('main_master') 
	@section('main_content')    
	@if($flag == 1)
  		@include('UI.components/order_prescription')   
  	@endif 
@stop 
