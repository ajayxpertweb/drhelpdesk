<?php

namespace App\Imports;
use DB;
use App\Product;
use App\ProductImage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;
HeadingRowFormatter::default('none');

class UsersImport implements ToModel,WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {   
        // $category = DB::table('categories')->where('category_name',$row[11])->pluck('categories_id')->first(); 
        // $subcategory = DB::table('categories')->where('parent_id',$category)->where('sub_category_name',$row[12])->pluck('categories_id')->first(); 
        // $subsubcategory = DB::table('categories')->where('parent_id',$category)->where('sub_parent_id',$subcategory)->where('sub_category_name',$row[13])->pluck('categories_id')->first(); 
        // $subsubsubcategory = DB::table('categories')->where('parent_id',$category)->where('sub_parent_id',$subcategory)
        // ->where('sub_sub_parent_id',$subsubcategory)->where('sub_category_name',$row[14])->pluck('categories_id')->first();
        $category = DB::table('categories')->where('categories_id',$row[11])->pluck('categories_id')->first(); 
        $subcategory = DB::table('categories')->where('parent_id',$category)->where('categories_id',$row[12])->pluck('categories_id')->first(); 
        $subsubcategory = DB::table('categories')->where('parent_id',$category)->where('sub_parent_id',$subcategory)->where('categories_id',$row[13])->pluck('categories_id')->first(); 
        $subsubsubcategory = DB::table('categories')->where('parent_id',$category)->where('sub_parent_id',$subcategory)
        ->where('sub_sub_parent_id',$subsubcategory)->where('categories_id',$row[14])->pluck('categories_id')->first();
        $brand = DB::table('brands')->where('brand_name',$row[10])->pluck('id')->first();  
        if($row[15] == 1){
            $featured_product = 'featured_product';
        } 
        if($row[16] == 1){
            $top_selling_product = 'top_selling_product';
        } 
        //dd($row);
        $value =  new Product; 
        $value->product_name =  $row[0];
        $value->product_code =  $row[1];
        $value->price    =  $row[2];
        $value->special_price =  $row[3];
        $value->quantity =  $row[4];
        $value->extra_discount =  $row[5];
        $value->prescription =  $row[6];
        $value->key_features =  $row[7];  
        $value->short_description =  $row[8];  
        $value->long_description =  $row[9];
        $value->brand =  $brand;
        $value->categories =  $category;
        $value->sub_categories =  $subcategory;
        $value->sub_sub_categories =  $subsubcategory;
        $value->sub_sub_sub_categories =  $subsubsubcategory;
        $value->featured_product =  $featured_product;
        $value->top_selling_product =  $top_selling_product;
        $value->vendor_id =  $row[17];
        $value->tags =  $row[18]; 
        $value->save(); 
        //dd($value); 

        $image1 = new ProductImage();
        $image1->products_id = $value->id; 
        $image1->product_image  = 'upload/product/product_one'.$row[19]; 
        $image1->type  = 2; 
        $image1->save();

        $image2 =  new ProductImage();
        $image2->products_id = $value->id; 
        $image2->product_image  = 'upload/product/product_two'.$row[20]; 
        $image2->type  =1; 
        $image2->save(); 

        $image3 = new ProductImage();
        $image3->products_id = $value->id; 
        $image3->product_image  = 'upload/product/product_three'.$row[21]; 
        $image3->type  = 1; 
        $image3->save(); 

        $image4 = new ProductImage();
        $image4->products_id = $value->id; 
        $image4->product_image  = 'upload/product/product_four'.$row[22]; 
        $image4->type  = 1; 
        $image4->save();  
    }
    public function startRow(): int
    {
      return 2;
    }
}
