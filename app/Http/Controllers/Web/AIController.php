<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Domains\RFQ\Services\RFQService;
use Illuminate\Http\Request;
use OpenAI\Laravel\Facades\OpenAI;

class AIController extends Controller
{
    protected $rfqService;

    public function __construct(RFQService $rfqService)
    {
        $this->rfqService = $rfqService;
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        // Simple Lead Capture Detection
        if ($this->isLeadIntent($request->message)) {
            return response()->json([
                'answer' => "I can certainly help you with a technical quote! Please provide your Company Name and Email address so our engineering team can prepare a formal proposal for you.",
                'intent' => 'lead_capture'
            ]);
        }

        // Handle direct lead submission from chat
        if ($request->has('lead_data')) {
            $rfq = $this->rfqService->createRFQ($request->lead_data + ['lead_source' => 'ai_chatbot']);
            return response()->json([
                'answer' => "Excellent. I have registered your request (Ref: " . substr($rfq->id, 0, 8) . "). Our regional manager will contact you shortly.",
                'intent' => 'lead_success'
            ]);
        }

        $prompt = "You are an expert industrial compressor assistant for TitanCompress. 
        Answer concisely. If the user wants a price or quote, tell them you can start the RFQ process right here.";

        if (config('openai.api_key')) {
            try {
                $result = OpenAI::chat()->create([
                    'model' => 'gpt-4-turbo',
                    'messages' => [
                        ['role' => 'system', 'content' => $prompt],
                        ['role' => 'user', 'content' => $request->message],
                    ],
                ]);

                return response()->json([
                    'answer' => $result->choices[0]->message->content
                ]);
            } catch (\Exception $e) {
                // fallback to simulation
            }
        }

        return response()->json([
            'answer' => $this->simulateAIResponse($request->message)
        ]);
    }

    private function simulateAIResponse($message)
    {
        $message = strtolower($message);
        
        if (str_contains($message, 'titan-x') || str_contains($message, 'titan x')) {
            return "The Titan-X 500 Industrial is our flagship heavy-duty rotary screw compressor. It features a 500 CFM output and is designed for 24/7 continuous operations. Would you like to compare it with other models or get a price quote?";
        }
        
        if (str_contains($message, 'piston')) {
            return "Our Piston Air Compressors are known for their rugged, cast-iron construction. They are incredibly reliable for heavy-duty applications. Do you have a specific CFM or pressure requirement in mind?";
        }

        if (str_contains($message, 'oil-free') || str_contains($message, 'oil free')) {
            return "TitanCompress Oil-Free compressors guarantee 100% oil-free air, making them perfect for food & beverage or pharmaceutical applications. Should I direct you to the full catalog?";
        }
        
        if (str_contains($message, 'compare')) {
            return "I recommend using our System Benchmark tool! You can compare our Piston, Screw, and Oil-Free models side-by-side. Just click on 'Compare' in the main menu.";
        }

        if (str_contains($message, 'hi') || str_contains($message, 'hello') || str_contains($message, 'hey')) {
            return "Hello! I am the TitanCompress AI Assistant. How can I help you find the right industrial air system today?";
        }

        return "That's an excellent question. TitanCompress equipments are engineered for maximum efficiency. To give you the most accurate technical details, could you provide more specifics, or would you like to request a formal quote from our engineering team?";
    }

    private function isLeadIntent($message)
    {
        $keywords = ['quote', 'price', 'cost', 'buy', 'purchase', 'inquiry', 'rfq'];
        foreach ($keywords as $word) {
            if (stripos($message, $word) !== false) return true;
        }
        return false;
    }
}
