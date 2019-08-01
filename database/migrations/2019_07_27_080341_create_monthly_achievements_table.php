<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMonthlyAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_achievements', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('yearly_achievement_id')->unsigned();
            $table->bigInteger('year_name');
            $table->enum('name', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12]);
            $table->string('slug');
            $table->double('target', null, 2)->nullable()->default(0);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('monthly_achievements', function ($table) {
            $table->foreign('yearly_achievement_id')->references('id')->on('yearly_achievements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('monthly_achievements');
    }
}
