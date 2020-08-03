<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->bigIncrements('vendors_id');
            $table->string('vendor_name',200); 
            $table->string('logo')->nullable(); 
            $table->longText('address');
            $table->string('city');
            $table->string('pin_code',10);
            $table->string('state'); 
            $table->string('email',100);
            $table->bigInteger('mobile');
            $table->bigInteger('landline')->nullable();
            $table->string('website_url',100)->nullable();  
            $table->text('description')->nullable();  
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
        Schema::dropIfExists('vendors');
    }
}
