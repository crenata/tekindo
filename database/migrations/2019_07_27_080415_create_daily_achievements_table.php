<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('yearly_achievement_id')->unsigned();
            $table->bigInteger('monthly_achievement_id')->unsigned();
            $table->date('name');
            $table->string('slug');
            $table->double('target', null, 2)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('daily_achievements', function ($table) {
            $table->foreign('yearly_achievement_id')->references('id')->on('yearly_achievements')->onDelete('cascade');
            $table->foreign('monthly_achievement_id')->references('id')->on('monthly_achievements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_achievements');
    }
}
