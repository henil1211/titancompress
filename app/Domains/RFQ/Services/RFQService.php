<?php

namespace App\Domains\RFQ\Services;

use App\Domains\RFQ\Models\RFQ;
use App\Domains\RFQ\Models\RFQStatus;
use Illuminate\Support\Facades\DB;

class RFQService
{
    public function createRFQ(array $data)
    {
        return DB::transaction(function () use ($data) {
            $defaultStatus = RFQStatus::where('name', 'New')->first();

            $rfq = RFQ::create([
                'status_id' => $defaultStatus->id,
                'customer_name' => $data['customer_name'],
                'company_name' => $data['company_name'],
                'email' => $data['email'],
                'phone' => $data['phone'] ?? null,
                'country' => $data['country'] ?? null,
                'industry' => $data['industry'] ?? null,
                'technical_requirements' => $data['technical_requirements'] ?? [],
                'additional_notes' => $data['additional_notes'] ?? null,
                'lead_source' => $data['lead_source'] ?? 'website',
                'priority' => $data['priority'] ?? 'medium',
            ]);

            // Add items
            if (isset($data['items'])) {
                foreach ($data['items'] as $item) {
                    $rfq->items()->create([
                        'product_id' => $item['product_id'] ?? null,
                        'product_name' => $item['product_name'],
                        'quantity' => $item['quantity'] ?? 1,
                    ]);
                }
            }

            // Log Initial Activity
            $rfq->activityLogs()->create([
                'action' => 'created',
                'description' => "RFQ generated via {$rfq->lead_source}"
            ]);

            return $rfq;
        });
    }
}
