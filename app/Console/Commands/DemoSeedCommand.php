<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\Category;
use Illuminate\Support\Str;

class DemoSeedCommand extends Command
{
    protected $signature = 'demo:seed';
    protected $description = 'Seed demo products for comparison';

    public function handle()
    {
        $cat = Category::firstOrCreate(
            ['slug' => 'air-compressors'],
            ['id' => Str::uuid(), 'name' => 'Air Compressors']
        );
        
        $products = [
            ['name' => 'Piston Air Compressor TC-P20', 'slug' => 'piston-air-compressor-tc-p20', 'sku' => 'TC-P20'],
            ['name' => 'Screw Air Compressor TC-S50', 'slug' => 'screw-air-compressor-tc-s50', 'sku' => 'TC-S50'],
            ['name' => 'Oil-Free Compressor TC-OF100', 'slug' => 'oil-free-compressor-tc-of100', 'sku' => 'TC-OF100']
        ];

        $attributes = \App\Domains\Product\Models\SpecificationAttribute::all();

        foreach($products as $index => $p) {
            $product = Product::firstOrCreate(
                ['slug' => $p['slug']],
                [
                    'id' => Str::uuid(),
                    'category_id' => $cat->id,
                    'name' => $p['name'],
                    'sku' => $p['sku'],
                    'short_description' => 'Industrial compressor detail.',
                    'description' => 'Full specification and details.',
                    'status' => 'active',
                    'featured' => true
                ]
            );

            // Give them slightly different specs based on their index
            foreach($attributes as $attr) {
                $val = 'N/A';
                if (stripos($attr->name, 'Air Flow') !== false) {
                    $val = 5.0 + ($index * 3.5);
                } elseif (stripos($attr->name, 'Pressure') !== false) {
                    $val = 8 + ($index * 2);
                } elseif (stripos($attr->name, 'Power') !== false) {
                    $val = 15 + ($index * 15);
                } elseif (stripos($attr->name, 'Voltage') !== false) {
                    $val = '400V / 3Ph';
                } elseif (stripos($attr->name, 'Frequency') !== false) {
                    $val = '50 Hz';
                } elseif (stripos($attr->name, 'RPM') !== false) {
                    $val = 1450 - ($index * 100);
                }

                \App\Domains\Product\Models\ProductSpecification::firstOrCreate(
                    [
                        'product_id' => $product->id,
                        'attribute_id' => $attr->id
                    ],
                    [
                        'id' => Str::uuid(),
                        'value' => (string) $val
                    ]
                );
            }
        }
        $this->info('Seeded with specs');
    }
}
