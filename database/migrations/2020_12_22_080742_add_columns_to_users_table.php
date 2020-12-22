<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable();
            $table->string('category')->nullable();
            $table->string('coupon')->nullable();
            $table->string('image')->nullable()->default('storage/noimage.jpeg')->change();
            $table->string('product')->nullable();
            $table->string('blog')->nullable();
            $table->string('order')->nullable();
            $table->string('other')->nullable();
            $table->string('report')->nullable();
            $table->string('role')->nullable();
            $table->string('return')->nullable();
            $table->string('contact')->nullable();
            $table->string('comment')->nullable();
            $table->string('setting')->nullable();
            $table->string('stock')->nullable();
            $table->integer('type')->nullable();

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
            Schema::dropColumns(['phone','category','coupon','image','product','blog','order','other','report','role','return','contact','comment','setting','stock','type']);

        });
    }
}
