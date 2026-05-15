<?php

namespace App\Domains\Comparison\Services;

use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\SpecificationGroup;
use Illuminate\Support\Collection;

class ComparisonService
{
    public function getComparisonMatrix(Collection $products): array
    {
        $matrix = [];
        $groups = SpecificationGroup::with('attributes')->orderBy('sort_order')->get();

        foreach ($groups as $group) {
            $groupData = [
                'name' => $group->name,
                'attributes' => []
            ];

            foreach ($group->attributes as $attr) {
                $attrData = [
                    'name' => $attr->name,
                    'unit' => $attr->unit,
                    'values' => []
                ];

                $values = [];
                foreach ($products as $product) {
                    $spec = $product->specifications->where('attribute_id', $attr->id)->first();
                    $val = $spec ? $spec->value : null;
                    $attrData['values'][$product->id] = $val;
                    if ($val !== null) $values[] = $val;
                }

                // Smart Highlighting Logic
                $attrData['highlight'] = $this->determineHighlights($attr->name, $values);

                $groupData['attributes'][] = $attrData;
            }

            $matrix[] = $groupData;
        }

        return $matrix;
    }

    private function determineHighlights(string $attrName, array $values): array
    {
        if (empty($values)) return [];

        // Logic for highlighting "Better" values
        // Industrial Logic:
        // - High Air Flow is better
        // - Low Power/Voltage is better
        // - High Efficiency/Pressure is better

        $numericValues = array_filter($values, fn($v) => is_numeric($v));
        if (empty($numericValues)) return [];

        $isLowerBetter = $this->isLowerBetter($attrName);
        $bestValue = $isLowerBetter ? min($numericValues) : max($numericValues);

        $highlights = [];
        foreach ($values as $val) {
            if (is_numeric($val) && (float)$val == (float)$bestValue) {
                $highlights[] = $val;
            }
        }

        return $highlights;
    }

    private function isLowerBetter(string $name): bool
    {
        $lowerBetterKeywords = ['power', 'consumption', 'noise', 'decibel', 'db', 'weight', 'maintenance cost'];
        foreach ($lowerBetterKeywords as $kw) {
            if (stripos($name, $kw) !== false) return true;
        }
        return false;
    }
}
