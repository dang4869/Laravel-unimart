<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColorToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            //
            $table->string('color',255);
            $table->string('thumbnail',255);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders_detail', function (Blueprint $table) {
            //
            $table->dropColumn('color');
            $table->dropColumn('thumbnail');
        });
    }
}
