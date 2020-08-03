<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {
            $table->bigIncrements('user_details_id');
            $table->string('user_name',200); 
            $table->string('image')->nullable(); 
            $table->longText('address');
            $table->string('city');
            $table->string('pin_code',10);
            $table->string('state');
            $table->string('country');
            $table->string('email',100)->nullable();
            $table->bigInteger('mobile')->nullable();
            $table->string('speciality',100)->nullable(); 
            $table->date('experience_from')->nullable(); 
            $table->date('experience_to')->nullable(); 
            $table->text('description')->nullable();  
            $table->tinyInteger('role_id')->nullable();  
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
        Schema::dropIfExists('user_details');
    }
}
