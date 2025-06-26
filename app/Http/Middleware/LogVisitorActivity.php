<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class LogVisitorActivity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Paths that should be excluded from visitor logging
        $excludedPaths = [
            'visitor-logs',
        ];

        foreach ($excludedPaths as $path) {
            if ($request->is($path)) {
                return $next($request); // Skip logging for excluded paths
            }
        }

        // Get user's IP address
        $ip = $_SERVER['REMOTE_ADDR'];

        // Fetch location data from ip-api
        $geoData = @file_get_contents("http://ip-api.com/json/{$ip}");
        $data = json_decode($geoData, true);

        // Initialize city and country if available
        if ($data && $data['status'] === 'success') {
            $city = $data['city'] ?? null;
            $country = $data['country'] ?? null;
        } else {
            $city = null;
            $country = null;
        }

        // Set current time in Asia/Dhaka timezone
        $bdTime = now()->setTimezone('Asia/Dhaka');

        // Insert visitor log into the database
        DB::table('visitor_logs')->insert([
            'ip' => $request->ip(),
            'country' => $country,
            'city' => $city,
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'referrer' => $request->header('referer') ?? 'Direct',
            'user_agent' => $request->userAgent(),
            'visited_at' => $bdTime,
            'created_at' => $bdTime,
            'updated_at' => $bdTime,
        ]);

        return $next($request);
    }


}
