<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Product\Models\Product;
use App\Domains\Product\Models\Category;
use App\Domains\Product\Models\SpecificationGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'mainImage']);

        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                  ->orWhere('sku', 'like', "%{$request->search}%");
        }

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::whereNull('parent_id')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        $specGroups = SpecificationGroup::with('attributes')->orderBy('sort_order')->get();
        return view('admin.products.create', compact('categories', 'specGroups'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:product_categories,id',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'status' => 'required|in:draft,active,archived',
        ]);

        return DB::transaction(function () use ($request, $validated) {
            $product = Product::create($validated + [
                'slug' => Str::slug($request->name),
                'featured' => $request->boolean('featured'),
                'trending' => $request->boolean('trending'),
            ]);

            // Handle Specifications
            if ($request->specs) {
                foreach ($request->specs as $attrId => $value) {
                    if ($value !== null) {
                        $product->specifications()->create([
                            'attribute_id' => $attrId,
                            'value' => $value
                        ]);
                    }
                }
            }

            // Handle Media (Simplified for now)
            if ($request->hasFile('main_image')) {
                $path = $request->file('main_image')->store('products/images', 'public');
                $product->media()->create([
                    'file_path' => $path,
                    'file_type' => 'image',
                    'is_main' => true
                ]);
            }

            return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
        });
    }

    public function edit(Product $product)
    {
        $product->load(['specifications', 'media']);
        $categories = Category::with('subcategories')->whereNull('parent_id')->get();
        $specGroups = SpecificationGroup::with('attributes')->orderBy('sort_order')->get();
        return view('admin.products.edit', compact('product', 'categories', 'specGroups'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:product_categories,id',
            'status' => 'required|in:draft,active,archived',
        ]);

        DB::transaction(function () use ($request, $product, $validated) {
            $product->update($validated + [
                'slug' => Str::slug($request->name),
                'featured' => $request->boolean('featured'),
                'trending' => $request->boolean('trending'),
            ]);

            // Sync Specifications
            $product->specifications()->delete();
            if ($request->specs) {
                foreach ($request->specs as $attrId => $value) {
                    if ($value !== null) {
                        $product->specifications()->create([
                            'attribute_id' => $attrId,
                            'value' => $value
                        ]);
                    }
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product moved to trash');
    }
}
