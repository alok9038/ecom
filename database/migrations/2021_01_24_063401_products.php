<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Products extends Migration
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
            $table->string('title');
            $table->string('price');
            $table->string('discount_price');
            $table->string('model')->nullable();
            $table->string('brand')->nullable();
            $table->string('cover_image');
            $table->string('images')->nullable();
            $table->string('status')->default(1);
            $table->text('description');
            $table->text('slug');
            $table->foreignId('cat_id')->constrained('categories');
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
        //
    }
}
