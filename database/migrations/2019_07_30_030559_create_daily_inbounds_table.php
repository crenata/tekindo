<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyInboundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_inbounds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('daily_achievement_id')->unsigned();
            $table->bigInteger('total')->default(0);
            $table->enum('status', ['Tercapai', 'Belum Tercapai'])->default('Belum Tercapai');
            $table->longText('note')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('daily_inbounds', function ($table) {
            $table->foreign('daily_achievement_id')->references('id')->on('daily_achievements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_inbounds');
    }
}
