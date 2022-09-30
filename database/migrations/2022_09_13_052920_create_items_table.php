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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->integer('relax');
            $table->integer('inflammation');
            $table->integer('paschoactive');
            $table->integer('vitality');
            $table->integer('headache');
            $table->integer('insomnia');
            $table->integer('quantity')->default(0);
            $table->integer('cart_flg')->default(false);
            $table->boolean('order_flg')->default(false);
            $table->integer('price')->default(0);
            $table->integer('star')->default(false);
            $table->integer('created_order_flg')->default(false);
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
        Schema::dropIfExists('items');
    }
};
