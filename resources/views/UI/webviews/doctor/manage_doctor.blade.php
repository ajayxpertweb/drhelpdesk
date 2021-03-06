@extends('main_master') 
	@section('main_content')    
	  @if($flag == 1)
  		@include('UI.components/doctor/doctor_appointments') 
  	@elseif($flag == 2)
  		@include('UI.components/doctor/doctor_change_password')
  	@elseif($flag == 3)
  		@include('UI.components/doctor/doctor_chat_doctor')
  	@elseif($flag == 4)
  		@include('UI.components/doctor/doctor_dashboard')
  	@elseif($flag == 5)
  		@include('UI.components/doctor/doctor_invoices')
  	@elseif($flag == 6)
  		@include('UI.components/doctor/doctor_profile_settings')
  	@elseif($flag == 7)
  		@include('UI.components/doctor/doctor_reviews')
  	@elseif($flag == 8)
  		@include('UI.components/doctor/doctor_schedule_timings') 
  	@elseif($flag == 10)
  		@include('UI.components/doctor/doctor_detail')
    @elseif($flag == 11)
      @include('UI.components/doctor/doctor_clinic_details')
    @elseif($flag == 12)
      @include('UI.components/doctor/doctor_view_consult_detail')
    @elseif($flag == 13)
      @include('UI.components/doctor/doctor_view_credit_detail')
  	@endif  
@stop 
