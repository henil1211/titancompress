<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompressorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $screw = \App\Domains\Product\Models\Category::create([
            'name' => 'Rotary Screw Compressors',
            'slug' => 'rotary-screw-compressors',
            'description' => 'Industrial grade continuous duty screw compressors.',
        ]);

        $piston = \App\Domains\Product\Models\Category::create([
            'name' => 'Piston Compressors',
            'slug' => 'piston-compressors',
            'description' => 'High-pressure reciprocating compressors.',
        ]);

        $prod1 = \App\Domains\Product\Models\Product::create([
            'category_id' => $screw->id,
            'name' => 'Titan-X 500 Industrial Screw',
            'slug' => 'titan-x-500',
            'sku' => 'TX-500-S',
            'summary' => 'High-efficiency rotary screw compressor for 24/7 operations.',
            'description' => 'The Titan-X 500 series represents the pinnacle of industrial air compression. Featuring an advanced air-end design and intelligent control systems.',
            'featured' => true,
        ]);

        $prod1->attributes()->createMany([
            ['label' => 'Motor Power', 'value' => '37', 'unit' => 'kW'],
            ['label' => 'Working Pressure', 'value' => '8', 'unit' => 'bar'],
            ['label' => 'Air Flow', 'value' => '6.5', 'unit' => 'm3/min'],
        ]);

        $prod2 = \App\Domains\Product\Models\Product::create([
            'category_id' => $piston->id,
            'name' => 'Hercules 150 High Pressure',
            'slug' => 'hercules-150',
            'sku' => 'HER-150-P',
            'summary' => 'Dual-stage reciprocating compressor for high-pressure applications.',
            'description' => 'Robust and reliable, the Hercules 150 is designed for demanding environments requiring up to 15 bar of pressure.',
            'featured' => false,
        ]);

        $prod2->attributes()->createMany([
            ['label' => 'Motor Power', 'value' => '11', 'unit' => 'kW'],
            ['label' => 'Working Pressure', 'value' => '15', 'unit' => 'bar'],
            ['label' => 'Tank Capacity', 'value' => '500', 'unit' => 'L'],
        ]);
    }
}
