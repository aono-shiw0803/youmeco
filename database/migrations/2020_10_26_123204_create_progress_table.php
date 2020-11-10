<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProgressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('progress', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('measures')->nullable();
            $table->string('month')->nullable();
            $table->string('completion')->nullable();
            $table->string('company')->nullable();
            $table->integer('no')->nullable();
            $table->string('title')->nullable();
            $table->string('matter_content')->nullable();
            $table->string('original_staff')->nullable();
            $table->string('original_done')->nullable();
            $table->string('original_content')->nullable();
            $table->string('check_staff')->nullable();
            $table->string('check_done')->nullable();
            $table->string('check_content')->nullable();
            $table->string('update_staff')->nullable();
            $table->string('update_done')->nullable();
            $table->string('update_content')->nullable();
            $table->string('file_staff')->nullable();
            $table->string('file_done')->nullable();
            $table->string('file_content')->nullable();
            $table->string('sale_staff')->nullable();
            $table->string('sale_done')->nullable();
            $table->string('sale_content')->nullable();
            $table->string('final_staff')->nullable();
            $table->string('final_done')->nullable();
            $table->string('final_content')->nullable();
            $table->string('delivery')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('progress');
    }
}
