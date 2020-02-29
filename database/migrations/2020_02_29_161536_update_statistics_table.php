<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateStatisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('statistics', function (Blueprint $table) {

            $table->dropColumn('user_agent');
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });

        Schema::table('statistics', function (Blueprint $table) {

            $table->string('browser',255);
            $table->string('engine',255);
            $table->string('os',255);
            $table->string('device',255);
            $table->timestamps();
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('statistics', function (Blueprint $table) {

        });
    }
}
