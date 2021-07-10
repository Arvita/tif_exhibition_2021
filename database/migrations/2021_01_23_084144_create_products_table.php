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
            $table->bigIncrements('id');
            $table->text('group_name');
            $table->string('group_leader', 25);
            $table->string('group_leader_nim', 10)->nullable();
            $table->text('group_member')->nullable();
            $table->text('group_email')->nullable();
            $table->string('group_phone', 15)->nullable();
            $table->integer('semester')->unsigned()->nullable();
            $table->string('group_class', 10)->nullable();
            $table->text('title');
            $table->text('description');
            $table->text('platform')->nullable();
            $table->text('link_video')->nullable();
            $table->text('link_web')->nullable();
            $table->text('link_mobile')->nullable();
            $table->text('link_desktop')->nullable();
            $table->text('link_ig_poster')->nullable();
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
}
