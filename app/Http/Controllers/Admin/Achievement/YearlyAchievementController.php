<?php

namespace App\Http\Controllers\Admin\Achievement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;

use App\Helpers\Helper;

use App\Models\Admin\YearlyAchievement;
use App\Models\Admin\MonthlyAchievement;
use App\Models\Admin\DailyAchievement;

use Session;
use Validator;

class YearlyAchievementController extends Controller
{
    protected $rules = [
        'start' => 'required|date',
        'end' => 'required|date',
        'target' => 'required|numeric'
    ];
    private $request, $yearly_id;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $yearlys = YearlyAchievement::orderBy('name', 'asc')->get();
        return view('admin.pages.achievement.yearly.index')->withYearlys($yearlys);
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
        $this->request = $request;

        $validator = Validator::make($request->all(), $this->rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            try {
                DB::transaction(function () {
                    $now = Carbon::now();
                    $yearly_id = DB::table('yearly_achievements')->insertGetId([
                        'start' => $this->request->start,
                        'end' => $this->request->end,
                        'name' => (date('Y', strtotime($this->request->start)) . ' - ' . date('Y', strtotime($this->request->end))),
                        'slug' => str_slug((date('Y', strtotime($this->request->start)) . ' - ' . date('Y', strtotime($this->request->end))), '-'),
                        'target' => $this->request->target,
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);

                    $this->yearly_id = $yearly_id;

                    for ($i = date('m', strtotime($this->request->start)); $i <= 12; $i++) {
                        $monthly_id = DB::table('monthly_achievements')->insertGetId([
                            'yearly_achievement_id' => $yearly_id,
                            'year_name' => date('Y', strtotime($this->request->start)),
                            'name' => $i,
                            'slug' => str_slug($i, '-'),
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);

                        $days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($this->request->start)), date('Y', strtotime($this->request->start)));

                        for ($j = 1; $j <= $days; $j++) {
                            DB::table('daily_achievements')->insert([
                                'yearly_achievement_id' => $yearly_id,
                                'monthly_achievement_id' => $monthly_id,
                                'name' => date('Y-m-d', strtotime(date('Y', strtotime($this->request->start)) . '-' . str_pad($i, 2, 0, STR_PAD_LEFT) . '-' . str_pad($j, 2, 0, STR_PAD_LEFT))),
                                'slug' => str_slug($j, '-'),
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);
                        }
                    }

                    for ($k = 1; $k < date('m', strtotime($this->request->start)); $k++) {
                        $monthly_id_end = DB::table('monthly_achievements')->insertGetId([
                            'yearly_achievement_id' => $yearly_id,
                            'year_name' => date('Y', strtotime($this->request->end)),
                            'name' => $k,
                            'slug' => str_slug($k, '-'),
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);

                        $days = cal_days_in_month(CAL_GREGORIAN, date('m', strtotime($this->request->end)), date('Y', strtotime($this->request->end)));

                        for ($l = 1; $l <= $days; $l++) {
                            DB::table('daily_achievements')->insert([
                                'yearly_achievement_id' => $yearly_id,
                                'monthly_achievement_id' => $monthly_id_end,
                                'name' => date('Y-m-d', strtotime(date('Y', strtotime($this->request->end)) . '-' . str_pad($k, 2, 0, STR_PAD_LEFT) . '-' . str_pad($l, 2, 0, STR_PAD_LEFT))),
                                'slug' => str_slug($l, '-'),
                                'created_at' => $now,
                                'updated_at' => $now
                            ]);
                        }
                    }
                });

                $yearly = YearlyAchievement::where('id', $this->yearly_id)->firstOrFail();

                return response()->json($yearly);
            } catch (Exception $e) {
                return response()->json(array('errors' => $e->getMessage()));
            }
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
        $yearly = YearlyAchievement::where('id', $id)->firstOrFail();
        return response()->json($yearly->load('monthly_achievements'));
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
            try {
                $yearly = YearlyAchievement::findOrFail($id);

                $yearly->start = $request->start;
                $yearly->end = $request->end;
                $yearly->name = (date('Y', strtotime($request->start)) . ' - ' . date('Y', strtotime($request->end)));
                $yearly->slug = str_slug((date('Y', strtotime($request->start)) . ' - ' . date('Y', strtotime($request->end))), '-');
                $yearly->target = $request->target;

                $yearly->save();

                return response()->json($yearly);
            } catch (QueryException $e) {
                $error_code = $e->errorInfo[1];
                return response()->json(array('errors' => 'This year already added!'));
            }
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
        $yearly = YearlyAchievement::findOrFail($id);

        foreach ($yearly->monthly_achievements as $monthly) {
            $monthly->daily_achievements->each->delete();
        }

        $yearly->monthly_achievements->each->delete();
        $yearly->delete();
        return response()->json($yearly);
    }
}
