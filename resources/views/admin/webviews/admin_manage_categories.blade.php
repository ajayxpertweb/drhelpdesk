@extends('admin_master') 
	@section('main_content')   
    @include('admin/common.admin_message_box')
	<section class="content">
        <div class="row">
            @if($flag == 1)
            	@include('admin.components/admin_add_categories')
            @elseif($flag == 2)
            	@include('admin.components/admin_view_categories')
            @elseif($flag == 3)
            	@include('admin.components/admin_edit_categories')
            @elseif($flag == 4)
                @include('admin.components/admin_edit_save_more_categories')
            @elseif($flag == 5)
                @include('admin.components/admin_covid_categories') 
            @endif
        </div>
    </section>
@stop