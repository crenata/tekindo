<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MonthlyInbound extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'monthly_achievement_id'
    ];

    public function yearly_achievement() {
        return $this->belongsTo('App\Models\Admin\YearlyAchievement');
    }

    public function monthly_achievement() {
        return $this->belongsTo('App\Models\Admin\MonthlyAchievement');
    }

    public function daily_inbound() {
        return $this->belongsTo('App\Models\Admin\DailyInbound');
    }
}
