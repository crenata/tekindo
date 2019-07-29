<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Helper;

use App\Models\Admin\YearlyAchievement;
use App\Models\Admin\MonthlyAchievement;
use App\Models\Admin\DailyAchievement;

use Session;
use Validator;

class MonthlyAchievementController extends Controller
{
    protected $rules = [
        'yearly_achievement_id' => 'required|numeric',
        'name' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearlys = YearlyAchievement::orderBy('name', 'asc')->get();
        $monthlys = MonthlyAchievement::all();
        return view('admin.pages.achievement.monthly.index')->withYearlys($yearlys)->withMonthlys($monthlys);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $monthly = new MonthlyAchievement;

            $monthly->yearly_achievement_id = $request->yearly_achievement_id;
            $monthly->name = $request->name;
            $monthly->slug = str_slug($request->name, '-');
            $monthly->target = $request->target;

            $monthly->save();

            $days = cal_days_in_month(CAL_GREGORIAN, $monthly->id, $request->yearly_achievement_id);

            for ($i = 1; $i <= $days; $i++) {
                $daily = new DailyAchievement;

                $daily->yearly_achievement_id = $request->yearly_achievement_id;
                $daily->monthly_achievement_id = $monthly->id;
                $daily->name = $i;
                $daily->slug = str_slug($i, '-');

                $daily->save();
            }

            return response()->json($monthly->load('yearly_achievement'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $monthly = MonthlyAchievement::findOrFail($id);

            $monthly->yearly_achievement_id = $request->yearly_achievement_id;
            $monthly->name = $request->name;
            $monthly->slug = str_slug($request->name, '-');
            $monthly->target = $request->target;

            $monthly->save();

            return response()->json($monthly->load('yearly_achievement'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $monthly = MonthlyAchievement::findOrFail($id);
        $monthly->daily_achievements->each->delete();
        $monthly->delete();
        return response()->json($monthly);
    }

    public function generateByYearly($id) {
        $yearly = YearlyAchievement::where('id', $id)->firstOrFail();
        $target = ceil(($yearly->target / $yearly->monthly_achievements->count()));
        return response()->json($target);
    }

    public function generateByMonthly($id) {
        $monthly = MonthlyAchievement::where('id', $id)->firstOrFail();

        if ($monthly->target != null || $monthly->target != 0) {
            $target = ceil(($monthly->target / $monthly->daily_achievements->count()));
            return response()->json($target);
        } else {
            $yearly = YearlyAchievement::where('id', $monthly->yearly_achievement_id)->firstOrFail();
            $monthly_target = ceil(($yearly->target / $yearly->monthly_achievements->count()));
            MonthlyAchievement::where('yearly_achievement_id', $yearly->id)->update(['target' => $monthly_target]);
            $target = ceil(($monthly_target / $monthly->daily_achievements->count()));
            return response()->json($target);
        }
    }

    public function monthlySaveGenerateTarget(Request $request) {
        $yearly = YearlyAchievement::where('id', $request->yearly_id)->firstOrFail();
        MonthlyAchievement::where('yearly_achievement_id', $yearly->id)->update(['target' => $request->target]);
        $monthly = MonthlyAchievement::where('yearly_achievement_id', $yearly->id)->get();
        return response()->json($monthly->load('yearly_achievement'));
    }
}
