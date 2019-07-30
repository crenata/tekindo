<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyInbound extends Model
{
    use SoftDeletes;

    public function daily_achievement() {
        return $this->belongsTo('App\Models\Admin\DailyAchievement');
    }
}
