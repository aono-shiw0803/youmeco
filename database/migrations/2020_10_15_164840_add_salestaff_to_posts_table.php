<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalestaffToPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->string('salestaff')->nullable();
            $table->string('windowstaff')->nullable();
            $table->string('type')->nullable();
            $table->string('delivery_number')->nullable();
            $table->date('delivery_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('salestaff');
            $table->dropColumn('windowstaff');
            $table->dropColumn('type');
            $table->dropColumn('delivery_number');
            $table->dropColumn('delivery_date');
        });
    }
}
