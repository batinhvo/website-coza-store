<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_products', function (Blueprint $table) {
            $table->Increments('pro_id');
            $table->integer('cate_id');
            $table->string('pro_name');
            $table->string('pro_price');
            $table->string('pro_size');
            $table->string('pro_color');
            $table->string('pro_img');
            $table->text('pro_desc');
            $table->integer('pro_status');
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
        Schema::dropIfExists('tbl_products');
    }
}
