<?php

namespace App\Http\Controllers\Admin\Inbound;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Helpers\Helper;

use App\Models\Admin\YearlyAchievement;
use App\Models\Admin\MonthlyAchievement;
use App\Models\Admin\DailyAchievement;

use App\Models\Admin\DailyInbound;
use App\Models\Admin\MonthlyInbound;
use App\Models\Admin\YearlyInbound;

use Session;
use Validator;

class DailyInboundController extends Controller
{
    protected $rules = [
        'daily_achievement_id' => 'required|numeric'
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
        $dailys = DailyInbound::all();
        return view('admin.pages.inbound.daily.index')->withYearlys($yearlys)->withMonthlys($monthlys)->withDailys($dailys);
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
            $daily_achievement = DailyAchievement::where('id', $request->daily_achievement_id)->firstOrFail();

            $daily = new DailyInbound;

            $daily->daily_achievement_id = $request->daily_achievement_id;
            $daily->total = $request->total;
            $daily->status = (($request->total >= $daily_achievement->target) ? 'Tercapai' : 'Belum Tercapai');
            $daily->note = $request->note;

            $daily->save();

            return response()->json($daily->load('daily_achievement'));
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
            $daily_achievement = DailyAchievement::where('id', $request->daily_achievement_id)->firstOrFail();

            $daily = DailyInbound::findOrFail($id);

            $daily->daily_achievement_id = $request->daily_achievement_id;
            $daily->total = $request->total;
            $daily->status = (($request->total >= $daily_achievement->target) ? 'Tercapai' : 'Belum Tercapai');
            $daily->note = $request->note;

            $daily->save();

            return response()->json($daily->load('daily_achievement'));
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
        $daily = DailyInbound::findOrFail($id);
        $daily->delete();
        return response()->json($daily);
    }
}
