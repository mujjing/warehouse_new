<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWarehouseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('warehouse', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Serial_number')->nullable()->comment('시리얼 넘버');
            $table->string('Address')->nullable()->comment('주소');
            $table->string('Kendall')->nullable()->comment('켄달');
            $table->string('Building')->nullable()->comment('건물명');
            $table->integer('GFA_Py')->unsigned()->nullable()->comment('면적');
            $table->integer('const_permission')->unsigned()->nullable()->comment('허가');
            $table->integer('build_start_date')->unsigned()->nullable()->comment('준공일');
            $table->integer('completion_date')->unsigned()->nullable()->comment('완공일');
            $table->string('Investor_landlord')->nullable();
            $table->string('AMC')->nullable();
            $table->string('PM_LM')->nullable();
            $table->string('DRY_COLD')->nullable();
            $table->double('Latitude')->unsigned()->nullable()->comment('위도');
            $table->double('Longitude')->unsigned()->nullable()->comment('경도');
            $table->string('Land_code')->nullable();
            $table->string('district_code')->nullable();
            $table->string('zone_code')->nullable();
            $table->string('area_code')->nullable();
            $table->double('land_area_sqm')->unsigned()->nullable();
            $table->double('floor_area')->unsigned()->nullable();
            $table->double('building_closing_rates')->unsigned()->nullable();
            $table->double('GFA_sqm')->unsigned()->nullable();
            $table->double('Floor_area_calculation_GFA')->unsigned()->nullable();
            $table->double('floor_area_ratio')->unsigned()->nullable();
            $table->integer('number_of_buildings')->unsigned()->nullable();
            $table->integer('number_of_affiliate_buildings')->unsigned()->nullable();
            $table->integer('park_lot')->unsigned()->nullable();
            $table->integer('construction_expected_date')->unsigned()->nullable();
            $table->integer('construction_delay_date')->unsigned()->nullable();
            $table->integer('creating_date')->unsigned()->nullable();
            $table->string('note')->nullable()->comment('노트');
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
        Schema::dropIfExists('warehouse');
    }
}
