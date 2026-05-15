<?php

namespace App\Http\Middleware;

use App\Domains\Analytics\Services\AnalyticsService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    protected $analytics;

    public function __construct(AnalyticsService $analytics)
    {
        $this->analytics = $analytics;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only track successful GET requests for non-ajax/api routes
        if ($request->isMethod('GET') && ! $request->ajax() && ! $request->is('admin*') && $response->getStatusCode() === 200) {
            $this->analytics->logEvent('page_view', [], $request);
        }

        return $response;
    }
}
