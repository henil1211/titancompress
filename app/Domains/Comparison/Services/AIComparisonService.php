<?php

namespace App\Domains\Comparison\Services;

use App\Domains\Product\Models\Product;
use OpenAI\Laravel\Facades\OpenAI;
use Illuminate\Support\Collection;

class AIComparisonService
{
    public function analyzeComparison(Collection $products, array $matrix): string
    {
        if ($products->isEmpty()) return "Please select products to analyze.";

        $prompt = $this->buildPrompt($products, $matrix);

        try {
            $result = OpenAI::chat()->create([
                'model' => 'gpt-4-turbo',
                'messages' => [
                    ['role' => 'system', 'content' => "You are a senior industrial engineering consultant for TitanCompress. Analyze the following technical comparison data concisely and recommend the best fit for different industrial scenarios."],
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            return $result->choices[0]->message->content;
        } catch (\Exception $e) {
            return "Engineering AI is currently offline. Please review the technical specs manually.";
        }
    }

    private function buildPrompt(Collection $products, array $matrix): string
    {
        $text = "Analyze these " . $products->count() . " industrial compressor systems:\n\n";

        foreach ($products as $product) {
            $text .= "Product: {$product->name} (SKU: {$product->sku})\n";
        }

        $text .= "\nTechnical Comparison Matrix:\n";
        foreach ($matrix as $group) {
            $text .= "Group: {$group['name']}\n";
            foreach ($group['attributes'] as $attr) {
                $text .= "- {$attr['name']}: " . implode(' vs ', $attr['values']) . " {$attr['unit']}\n";
            }
        }

        $text .= "\nProvide:\n1. Top efficiency performer.\n2. Best value for standard industrial use.\n3. Unique engineering advantages of each.\n4. Final recommendation.";

        return $text;
    }
}
