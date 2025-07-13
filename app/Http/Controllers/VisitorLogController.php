<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class VisitorLogController extends Controller
{
    public function index()
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        // Daily and Monthly Hit Counts
        $dailyHitCount = DB::table('visitor_logs')
            ->whereDate('visited_at', $today)
            ->count();

        $monthlyHitCount = DB::table('visitor_logs')
            ->whereDate('visited_at', '>=', $startOfMonth)
            ->count();

        // Unique Visitors
        $dailyUniqueVisitors = DB::table('visitor_logs')
            ->whereDate('visited_at', $today)
            ->distinct('ip')
            ->count('ip');

        $monthlyUniqueVisitors = DB::table('visitor_logs')
            ->whereDate('visited_at', '>=', $startOfMonth)
            ->distinct('ip')
            ->count('ip');


        $logs = DB::table('visitor_logs')->latest()->orderBy('id','desc')->paginate(20);
        $topLinks = DB::table('visitor_logs')
            ->select('url', DB::raw('COUNT(*) as hit_count'))
            ->groupBy('url')
            ->orderByDesc('hit_count')
            ->limit(100)
            ->paginate(25);
        return view('report.visitor_logs', compact('logs','topLinks','dailyHitCount', 'monthlyHitCount','dailyUniqueVisitors','monthlyUniqueVisitors'));
    }


    public function loginHistory()
    {
        $histories = DB::table('login_histories')
            ->join('users', 'login_histories.user_id', '=', 'users.id')
            ->select(
                'users.company_name',
                'users.company_email',
                DB::raw('DATE(login_histories.login_at) as login_date'),
                DB::raw('COUNT(*) as total_logins'),
                DB::raw('MAX(login_histories.login_at) as last_login_time'),
                DB::raw('MAX(login_histories.ip_address) as last_ip')
            )
            ->groupBy('login_histories.user_id', DB::raw('DATE(login_histories.login_at)'), 'users.company_name', 'users.company_email')
            ->orderBy('login_date', 'desc')
            ->paginate(20);

        return view('report.login_history', compact('histories'));
    }


}
