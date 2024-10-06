<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tbl_category_products', function (Blueprint $table) {
            $table->bigIncrements('cate_pro_id');
            $table->string('cate_pro_name');
            $table->boolean('cate_pro_show');
            $table->string('cate_pro_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_category_products');
    }
};
