<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyInboundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_inbounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('monthly_achievement_id')->unsigned();
            $table->bigInteger('daily_inbound_id')->unsigned();
            $table->string('name');
            $table->bigInteger('total');
            $table->enum('status', ['Tercapai', 'Tidak Tercapai']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('monthly_inbounds', function ($table) {
            $table->foreign('monthly_achievement_id')->references('id')->on('monthly_achievements')->onDelete('cascade');
            $table->foreign('daily_inbound_id')->references('id')->on('daily_inbounds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_inbounds');
    }
}
