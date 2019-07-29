<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyAchievement extends Model
{
    use SoftDeletes;

    public function yearly_achievement() {
        return $this->belongsTo('App\Models\Admin\YearlyAchievement');
    }

    public function daily_achievements() {
        return $this->hasMany('App\Models\Admin\DailyAchievement');
    }
}
