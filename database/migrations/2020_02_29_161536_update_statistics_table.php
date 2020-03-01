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

            $table->string('browser',255)->after('city_name');
            $table->string('engine',255)->after('city_name');
            $table->string('os',255)->after('city_name');
            $table->string('device',255)->after('city_name');
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
            $table->dropColumn('user_agent');
        });
    }
}
