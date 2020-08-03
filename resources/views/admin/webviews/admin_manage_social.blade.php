@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row"> 
            @if($flag == 1)
            	@include('admin.components/admin_edit_social')
            @endif
        </div>
    </section>
@stop