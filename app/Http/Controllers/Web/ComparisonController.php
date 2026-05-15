<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domains\Comparison\Models\ComparisonSession;
use App\Domains\Comparison\Models\ComparisonItem;
use App\Domains\Comparison\Services\ComparisonService;
use App\Domains\Comparison\Services\AIComparisonService;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ComparisonController extends Controller
{
    protected $comparisonService;
    protected $aiService;

    public function __construct(ComparisonService $comparisonService, AIComparisonService $aiService)
    {
        $this->comparisonService = $comparisonService;
        $this->aiService = $aiService;
    }

    public function index(Request $request)
    {
        $session = $this->getOrCreateSession();
        $products = $session->products()->with(['category', 'specifications.attribute'])->get();
        
        $matrix = $this->comparisonService->getComparisonMatrix($products);

        return view('web.comparison.index', compact('products', 'matrix'));
    }

    public function add(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        $session = $this->getOrCreateSession();
        
        // Max 4 products for comparison
        if ($session->products()->count() >= 4) {
            return response()->json(['success' => false, 'message' => 'Comparison limit reached (Max 4).'], 422);
        }

        ComparisonItem::firstOrCreate([
            'session_id' => $session->id,
            'product_id' => $request->product_id
        ]);

        return response()->json([
            'success' => true, 
            'count' => $session->products()->count(),
            'message' => 'System added to comparison matrix.'
        ]);
    }

    public function remove(Request $request)
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        
        $session = $this->getOrCreateSession();
        ComparisonItem::where('session_id', $session->id)->where('product_id', $request->product_id)->delete();

        return response()->json(['success' => true, 'count' => $session->products()->count()]);
    }

    public function analyze(Request $request)
    {
        $session = $this->getOrCreateSession();
        $products = $session->products()->with(['specifications.attribute'])->get();
        
        if ($products->isEmpty()) {
            return response()->json(['analysis' => 'Please add systems to compare.']);
        }

        $matrix = $this->comparisonService->getComparisonMatrix($products);
        $analysis = $this->aiService->analyzeComparison($products, $matrix);

        return response()->json(['analysis' => $analysis]);
    }

    private function getOrCreateSession()
    {
        $token = session()->get('comparison_token', Str::random(40));
        session()->put('comparison_token', $token);

        return ComparisonSession::firstOrCreate(
            ['session_token' => $token],
            ['id' => Str::uuid()]
        );
    }
}
