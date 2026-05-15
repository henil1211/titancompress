<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domains\RFQ\Services\RFQService;
use App\Domains\Product\Models\Product;
use Illuminate\Http\Request;

class RFQController extends Controller
{
    protected $rfqService;

    public function __construct(RFQService $rfqService)
    {
        $this->rfqService = $rfqService;
    }

    public function show(Request $request)
    {
        $selectedProduct = null;
        if ($request->product) {
            $selectedProduct = Product::where('id', $request->product)->first();
        }
        return view('web.rfq.submit', compact('selectedProduct'));
    }

    public function submit(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string',
            'technical_requirements' => 'nullable|array',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'nullable|exists:products,id',
            'items.*.product_name' => 'required|string',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $rfq = $this->rfqService->createRFQ($validated + ['lead_source' => 'website']);

        return response()->json([
            'success' => true,
            'message' => 'Your request has been received. Our engineering team will contact you within 24 hours.',
            'rfq_id' => $rfq->id
        ]);
    }
}
