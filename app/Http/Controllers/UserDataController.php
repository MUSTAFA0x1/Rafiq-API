<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UserDataController extends Controller
{
    public function fetchAllUserData(Request $request)
    {
        $user = auth()->user()->load([
            'waterTracking',
            'stepPlans',
            'tasks',
            'prayers'
        ]);



        return response()->json([
            'user' => [
                'id' => $user->user_id,
                'name' => $user->first_name . ' ' . $user->last_name,
                'email' => $user->email,
                'magic_points' => $user->magic_points,
                'created_at' => $user->created_at,
            ],
            'waterTracking' => $user->waterTracking,
            'stepPlans' => $user->stepPlans,
            'tasks' => $user->tasks,
            'prayers' => $user->prayers,
        ]);
    }


    // Fetch Magic Points
    public function fetchMagicPoints(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('user_management.mv_weekly_magic_points')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }

    // Fetch Magic Ranking
    public function fetchMagicRanking(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('user_management.mv_weekly_magic_ranking')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }

    // Fetch Weekly Step Progress
    public function fetchWeeklyStep(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('fitness_management.mv_weekly_step_progress')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }


    // Fetch Weekly Water Progress
    public function fetchWeeklyWater(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('fitness_management.mv_weekly_water_progress')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }


    // Fetch Weekly Tasks Summary
    public function fetchTasksSummary(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('task_management.mv_weekly_task_summary')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }


    // Fetch Weekly Fard Prayers
    public function fetchFardPrayers(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('religious_management.mv_weekly_fard_prayers')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }


    // Fetch Weekly Prayers PCT
    public function fetchPrayerPct(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('religious_management.mv_weekly_prayer_pct')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }


    // Fetch Nawafil Prayers Streak
    public function fetchNawafilStreak(Request $request){

        $data = DB::connection('pgsqldwh')
            ->table('religious_management.mv_nawafil_prayer_streaks')
            ->where('user_id',auth()->id())
            ->get();

        return response()->json($data);
    }
}
