<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name')->unique();
            $table->foreignId('substance_id');
            $table->foreignId('maker_id');
            $table->unsignedInteger('price');
            $table->timestamps();

            $table->index('substance_id', 'product_substance_idx');
            $table->index('maker_id', 'product_maker_idx');
            $table->foreign('substance_id', 'product_substance_fk')->on('substances')->references('id');
            $table->foreign('maker_id', 'product_substance_fk')->on('makers')->references('id');
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
