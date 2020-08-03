<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->bigIncrements('banners_id');
            $table->string('banner_name',100); 
            $table->string('image'); 
            $table->string('type',50); 
            $table->string('location',75); 
            $table->string('from',15)->nullable(); 
            $table->string('to',15)->nullable();  
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
        Schema::dropIfExists('banners');
    }
}
