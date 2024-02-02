<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("name")->default(null)->nullable();
            $table->string("title")->default(null)->nullable();
            $table->string("articul",50)->default(null)->nullable();
            $table->double("weight",20,3)->default(null)->nullable();
            $table->double("price",20,2)->default(null)->nullable();
            $table->double("count",20,3)->default(null)->nullable();
            $table->integer("currency")->default(1)->nullable();
            $table->boolean("is_active")->default(1)->nullable();
            $table->foreignId('catalog_id')->nullable()->constrained('catalogs')->onDelete('set null');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->longText("gallery")->default(null)->nullable();
            $table->longText("description")->default(null)->nullable();
            $table->longText("information")->default(null)->nullable();
            $table->string("seo_title")->default(null)->nullable();
            $table->string("seo_description")->default(null)->nullable();
            $table->string("seo_keywords")->default(null)->nullable();
            $table->string("telegram")->default(null)->nullable();
            $table->string("instagram")->default(null)->nullable();
            $table->string("facebook")->default(null)->nullable();
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
};
