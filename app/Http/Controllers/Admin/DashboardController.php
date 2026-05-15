<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'recent_products' => Product::latest()->take(5)->get(),
            'rfq_count' => 0, // Placeholder until RFQ domain is fully integrated
            'ai_interactions' => 0, // Placeholder
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
