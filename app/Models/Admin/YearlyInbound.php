<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class YearlyInbound extends Model
{
    use SoftDeletes;

    public function yearly_achievement() {
        return $this->belongsTo('App\Models\Admin\YearlyAchievement');
    }

    public function monthly_inbound() {
        return $this->belongsTo('App\Models\Admin\MonthlyInbound');
    }
}
