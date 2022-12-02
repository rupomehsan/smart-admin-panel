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
        Schema::create('smart_form_validations', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->string('image_sec')->nullable();
            $table->string('color')->nullable();
            $table->string('switch')->nullable();
            $table->string('category_id')->nullable();
            $table->text('description')->nullable();
            $table->text('description2')->nullable();

            $table->string('date_time')->nullable();
            $table->string('date')->nullable();
            $table->string('status')->nullable();
            $table->dateTime('start_time')->nullable();

            $table->json('chips')->nullable();
            $table->json('multi_chips_select')->nullable();
            $table->json('days')->nullable();
            $table->json('single_item')->nullable();
            $table->json('multi_item')->nullable();
            $table->json('multi_category_selector')->nullable();
            $table->softDeletes();
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
        Schema::drop("smart_form_validations");
    }
};