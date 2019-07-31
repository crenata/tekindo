<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateYearlyInboundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('yearly_inbounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('yearly_achievement_id')->unsigned();
            $table->bigInteger('monthly_inbound_id')->unsigned();
            $table->string('name');
            $table->bigInteger('total');
            $table->enum('status', ['Tercapai', 'Belum Tercapai']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('yearly_inbounds', function ($table) {
            $table->foreign('yearly_achievement_id')->references('id')->on('yearly_achievements')->onDelete('cascade');
            $table->foreign('monthly_inbound_id')->references('id')->on('monthly_inbounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('yearly_inbounds');
    }
}
