<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YearlyAchievement extends Model
{
    use SoftDeletes;

    public function monthly_achievements() {
        return $this->hasMany('App\Models\Admin\MonthlyAchievement');
    }

    public function daily_achievements() {
        return $this->hasMany('App\Models\Admin\DailyAchievement');
    }
}
