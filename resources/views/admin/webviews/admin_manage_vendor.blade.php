@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_add_vendor')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_vendor')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_vendor')
            @endif
        </div>
    </section>
@stop