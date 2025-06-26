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
}
