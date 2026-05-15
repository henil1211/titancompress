<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatalogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Create Categories
        $rotary = \App\Domains\Product\Models\Category::create([
            'name' => 'Rotary Screw Compressors',
            'slug' => 'rotary-screw-compressors',
            'description' => 'Continuous duty industrial air compressors.'
        ]);

        $piston = \App\Domains\Product\Models\Category::create([
            'name' => 'Piston Compressors',
            'slug' => 'piston-compressors',
            'description' => 'Reliable reciprocating technology.'
        ]);

        // 2. Create Specification Groups & Attributes
        $perfGroup = \App\Domains\Product\Models\SpecificationGroup::create(['name' => 'Performance', 'sort_order' => 1]);
        $elecGroup = \App\Domains\Product\Models\SpecificationGroup::create(['name' => 'Electrical', 'sort_order' => 2]);

        $attrs = [
            $perfGroup->id => [
                ['name' => 'Air Flow', 'unit' => 'm3/min'],
                ['name' => 'Working Pressure', 'unit' => 'bar'],
                ['name' => 'RPM', 'unit' => null],
            ],
            $elecGroup->id => [
                ['name' => 'Motor Power', 'unit' => 'kW'],
                ['name' => 'Voltage', 'unit' => 'V'],
                ['name' => 'Frequency', 'unit' => 'Hz'],
            ]
        ];

        foreach ($attrs as $groupId => $items) {
            foreach ($items as $item) {
                \App\Domains\Product\Models\SpecificationAttribute::create($item + ['group_id' => $groupId]);
            }
        }

        // 3. Create a Featured Product
        $product = \App\Domains\Product\Models\Product::create([
            'category_id' => $rotary->id,
            'name' => 'Titan-X 500 Industrial',
            'slug' => 'titan-x-500-industrial',
            'sku' => 'TX-500-PRO',
            'short_description' => 'Heavy-duty rotary screw compressor for 24/7 operations.',
            'status' => 'active',
            'featured' => true,
        ]);

        // Assign Specs
        $flowAttr = \App\Domains\Product\Models\SpecificationAttribute::where('name', 'Air Flow')->first();
        $powerAttr = \App\Domains\Product\Models\SpecificationAttribute::where('name', 'Motor Power')->first();

        $product->specifications()->createMany([
            ['attribute_id' => $flowAttr->id, 'value' => '6.5'],
            ['attribute_id' => $powerAttr->id, 'value' => '37'],
        ]);
    }
}
