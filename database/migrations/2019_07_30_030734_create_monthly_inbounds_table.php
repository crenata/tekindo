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
            $table->bigInteger('yearly_achievement_id')->unsigned();
            $table->bigInteger('monthly_achievement_id')->unsigned();
            $table->bigInteger('daily_inbound_id')->unsigned();
            $table->string('name');
            $table->double('total', null, 2)->nullable();
            $table->enum('status', ['Tercapai', 'Belum Tercapai'])->default('Belum Tercapai');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('monthly_inbounds', function ($table) {
            $table->foreign('yearly_achievement_id')->references('id')->on('yearly_achievements')->onDelete('cascade');
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
