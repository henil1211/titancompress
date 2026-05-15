<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Analytics\Models\AnalyticsEvent;
use App\Domains\Analytics\Services\AnalyticsService;
use App\Domains\RFQ\Models\RFQ;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService)
    {
        $this->analyticsService = $analyticsService;
    }

    public function index()
    {
        $stats = $this->analyticsService->getStats();
        
        // Lead Source Breakdown
        $leadSources = RFQ::select('lead_source', DB::raw('count(*) as total'))
            ->groupBy('lead_source')
            ->get();

        // Product Popularity (Most Viewed)
        $popularProducts = AnalyticsEvent::where('event_type', 'product_view')
            ->select(DB::raw("JSON_EXTRACT(meta, '$.product_id') as product_id"), DB::raw('count(*) as views'))
            ->groupBy('product_id')
            ->orderBy('views', 'desc')
            ->take(5)
            ->get();

        // Daily Traffic (Last 30 days)
        $trafficData = AnalyticsEvent::where('event_type', 'page_view')
            ->where('created_at', '>=', now()->subDays(30))
            ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as views'))
            ->groupBy('date')
            ->get();

        return view('admin.analytics.index', compact('stats', 'leadSources', 'popularProducts', 'trafficData'));
    }
}
