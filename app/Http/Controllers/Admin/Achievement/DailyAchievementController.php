<?php

namespace App\Http\Controllers\Admin\Achievement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Helper;

use App\Models\Admin\YearlyAchievement;
use App\Models\Admin\MonthlyAchievement;
use App\Models\Admin\DailyAchievement;

use Session;
use Validator;

class DailyAchievementController extends Controller
{
    protected $rules = [
        'yearly_achievement_id' => 'required|numeric',
        'monthly_achievement_id' => 'required|numeric',
        'name' => 'required'
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearlys = YearlyAchievement::all();
        $monthlys = MonthlyAchievement::all();
        $dailys = DailyAchievement::all();
        return view('admin.pages.achievement.daily.index')->withYearlys($yearlys)->withMonthlys($monthlys)->withDailys($dailys);
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
            $daily = new DailyAchievement;

            $daily->yearly_achievement_id = $request->yearly_achievement_id;
            $daily->monthly_achievement_id = $request->monthly_achievement_id;
            $daily->name = $request->name;
            $daily->slug = str_slug($request->name, '-');
            $daily->target = $request->target;

            $daily->save();

            return response()->json($daily->load('yearly_achievement')->load('monthly_achievement'));
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
            $daily = DailyAchievement::findOrFail($id);

            $daily->yearly_achievement_id = $request->yearly_achievement_id;
            $daily->monthly_achievement_id = $request->monthly_achievement_id;
            $daily->name = $request->name;
            $daily->slug = str_slug($request->name, '-');
            $daily->target = $request->target;

            $daily->save();

            return response()->json($daily->load('yearly_achievement')->load('monthly_achievement'));
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
        $daily = DailyAchievement::findOrFail($id);
        $daily->delete();
        return response()->json($daily);
    }

    public function monthlyByYearly($id) {
        $monthly = MonthlyAchievement::where('yearly_achievement_id', $id)->get();
        return response()->json($monthly->load('yearly_achievement'));
    }

    public function dailyByMonthly($id) {
        $daily = DailyAchievement::where('monthly_achievement_id', $id)->get();
        return response()->json($daily->load('yearly_achievement')->load('monthly_achievement'));
    }

    public function dailySaveGenerateTarget(Request $request) {
        $monthly = MonthlyAchievement::where('id', $request->monthly_id)->firstOrFail();
        DailyAchievement::where('monthly_achievement_id', $monthly->id)->update(['target' => $request->target]);
        $daily = DailyAchievement::where('monthly_achievement_id', $monthly->id)->get();
        return response()->json($daily->load('yearly_achievement')->load('monthly_achievement'));
    }
}
