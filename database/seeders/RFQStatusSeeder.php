<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RFQStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['name' => 'New', 'color_hex' => '#3b82f6', 'sort_order' => 1],
            ['name' => 'Under Review', 'color_hex' => '#f59e0b', 'sort_order' => 2],
            ['name' => 'Quoted', 'color_hex' => '#8b5cf6', 'sort_order' => 3],
            ['name' => 'Negotiation', 'color_hex' => '#ec4899', 'sort_order' => 4],
            ['name' => 'Closed Won', 'color_hex' => '#10b981', 'sort_order' => 5],
            ['name' => 'Closed Lost', 'color_hex' => '#ef4444', 'sort_order' => 6],
        ];

        foreach ($statuses as $status) {
            \App\Domains\RFQ\Models\RFQStatus::create($status);
        }
    }
}
