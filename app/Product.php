<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=['product_name','product_code','price','special_price','quantity','extra_discount','key_features','short_description','long_description','brand','prescription','categories','sub_categories','sub_sub_categories','sub_sub_sub_categories','featured_product','top_selling_product','vendor_id','tags','rating'];
}
