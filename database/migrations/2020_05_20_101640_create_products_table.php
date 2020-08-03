<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('products_id');
            $table->string('product_name',200); 
            $table->Integer('price'); 
            $table->Integer('special_price');
            $table->string('short_description',200); 
            $table->text('long_description');  
            $table->string('categories');  
            $table->string('sub_categories');  
            $table->string('featured_product',50);  
            $table->string('top_selling_product',50);  
            $table->Integer('vendor_id')->nullable();  
            $table->tinyInteger('status')->default(0)->comment('0-activate,1-de-activate');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
