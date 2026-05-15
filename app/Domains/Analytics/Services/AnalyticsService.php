<?php

namespace App\Domains\Analytics\Services;

use App\Domains\Analytics\Models\AnalyticsEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AnalyticsService
{
    public function logEvent(string $type, array $meta = [], Request $request = null)
    {
        $request = $request ?? request();

        return AnalyticsEvent::create([
            'event_type' => $type,
            'url' => $request->fullUrl(),
            'referrer' => $request->header('referer'),
            'session_id' => Session::getId(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'meta' => $meta,
        ]);
    }

    public function getStats()
    {
        return [
            'total_views' => AnalyticsEvent::where('event_type', 'page_view')->count(),
            'total_rfqs' => AnalyticsEvent::where('event_type', 'rfq_submitted')->count(),
            'product_views' => AnalyticsEvent::where('event_type', 'product_view')->count(),
            'ai_chats' => AnalyticsEvent::where('event_type', 'ai_chat')->count(),
            'conversions' => $this->getConversionRate(),
        ];
    }

    private function getConversionRate()
    {
        $views = AnalyticsEvent::where('event_type', 'page_view')->distinct('session_id')->count();
        $rfqs = AnalyticsEvent::where('event_type', 'rfq_submitted')->distinct('session_id')->count();
        
        return $views > 0 ? round(($rfqs / $views) * 100, 2) : 0;
    }
}
