<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Auth;

class DashboardController extends Controller
{
    Public function admin(){
    	$data['page_title'] = 'Dashboard'; 
    	return view('admin/webviews/admin_dashboard',$data);
    } 
}
