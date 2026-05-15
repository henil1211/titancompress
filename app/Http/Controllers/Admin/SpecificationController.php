<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Domains\Product\Models\SpecificationGroup;
use App\Domains\Product\Models\SpecificationAttribute;
use Illuminate\Http\Request;

class SpecificationController extends Controller
{
    public function index()
    {
        $groups = SpecificationGroup::with('attributes')->orderBy('sort_order')->get();
        return view('admin.specifications.index', compact('groups'));
    }

    public function storeGroup(Request $request)
    {
        $request->validate(['name' => 'required|string']);
        SpecificationGroup::create($request->only('name'));
        return back()->with('success', 'Group created');
    }

    public function storeAttribute(Request $request)
    {
        $request->validate([
            'group_id' => 'required|exists:specification_groups,id',
            'name' => 'required|string',
            'unit' => 'nullable|string',
        ]);
        SpecificationAttribute::create($request->all());
        return back()->with('success', 'Attribute added');
    }
}
