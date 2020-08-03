<?php

namespace App\Http\Controllers\admin;
use App\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\UsersImport; 
use Illuminate\Support\Facades\Input; 

use Maatwebsite\Excel\Facades\Excel;

class ExcelController extends Controller
{  
  public function importproduct() { 
    $data = Excel::import(new UsersImport, request()->file('file'));
    //dd($data); die; 
    return back()->with('msg','Data Upload Successfully');
  } 
}
