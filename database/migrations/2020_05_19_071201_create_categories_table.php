<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('categories_id');
            $table->string('category_name',100)->nullable();
            $table->string('title',100)->nullable();
            $table->string('image')->nullable();
            $table->string('sub_category_name',150)->nullable();
            $table->integer('parent_id')->nullable();
            $table->tinyInteger('type')->default(0)->comment('0-inactive,1-user');
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
        Schema::dropIfExists('categories');
    }
}
