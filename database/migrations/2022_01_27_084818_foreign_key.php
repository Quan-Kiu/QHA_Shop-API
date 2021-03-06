<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('user_type_id')->references('id')->on('user_types');
        });
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('product_type_id')->references('id')->on('product_types');
        });
        Schema::table('sizes', function (Blueprint $table) {
            $table->foreign('product_type_id')->references('id')->on('product_types');
        });
        Schema::table('carts', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->foreign('order_status_id')->references('id')->on('order_statuses');
        });
        Schema::table('order_details', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders');
        });
        Schema::table('shipping_infos', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('product_id')->references('id')->on('products');
        });
        Schema::table('notifies', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
        Schema::table('products', function (Blueprint $table) {
            //
        });
        Schema::table('images', function (Blueprint $table) {
            //
        });
        Schema::table('sizes', function (Blueprint $table) {
            //
        });
        Schema::table('colors', function (Blueprint $table) {
            //
        });
        Schema::table('users', function (Blueprint $table) {
            //
        });
        Schema::table('orders', function (Blueprint $table) {
            //
        });
        Schema::table('order_details', function (Blueprint $table) {
            //
        });
        Schema::table('shipping_infos', function (Blueprint $table) {
            //
        });
        Schema::table('comments', function (Blueprint $table) {
            //
        });
        Schema::table('notifies', function (Blueprint $table) {
            //
        });
    }
}
