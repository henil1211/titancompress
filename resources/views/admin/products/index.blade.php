<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tighter">PRODUCT <span class="text-industrial-orange">CATALOG</span></h1>
                <p class="text-slate-500 text-sm mt-1">Manage industrial compressor inventory and specifications.</p>
            </div>
            <div>
                <a href="{{ route('admin.products.create') }}" class="btn-industrial py-2 px-6">
                    <span class="flex items-center space-x-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        <span>Add New Product</span>
                    </span>
                </a>
            </div>
        </div>

        <!-- Filters Bar -->
        <div class="glass-panel p-6 rounded-2xl flex flex-wrap gap-4 items-center justify-between bg-white/50 backdrop-blur">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex flex-1 gap-4">
                <div class="relative flex-1 max-w-sm">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search by name or SKU..." 
                           class="w-full bg-slate-100 border-none rounded-xl pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                </div>
                
                <select name="category" class="bg-slate-100 border-none rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-industrial-orange min-w-[200px]">
                    <option value="">All Categories</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-industrial-blue text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all">
                    Filter
                </button>
                @if(request()->anyFilled(['search', 'category']))
                    <a href="{{ route('admin.products.index') }}" class="text-slate-400 hover:text-red-500 text-sm flex items-center px-2">Clear</a>
                @endif
            </form>
        </div>

        <!-- Table Container -->
        <div class="glass-panel rounded-3xl overflow-hidden shadow-xl border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-4">Product Info</th>
                            <th class="px-6 py-4">Category</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Attributes</th>
                            <th class="px-8 py-4 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($products as $product)
                        <tr class="hover:bg-slate-50/80 transition-all group">
                            <td class="px-8 py-5">
                                <div class="flex items-center space-x-4">
                                    <div class="w-12 h-12 rounded-xl bg-slate-100 border border-slate-200 flex items-center justify-center overflow-hidden">
                                        @if($product->mainImage)
                                            <img src="{{ Storage::url($product->mainImage->file_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <svg class="w-6 h-6 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800 leading-none group-hover:text-industrial-orange transition-colors">{{ $product->name }}</p>
                                        <p class="text-[10px] font-mono text-slate-400 mt-1 uppercase">{{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-xs font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded">{{ $product->category->name }}</span>
                            </td>
                            <td class="px-6 py-5">
                                @php
                                    $statusColors = [
                                        'active' => 'bg-green-100 text-green-700',
                                        'draft' => 'bg-slate-100 text-slate-600',
                                        'archived' => 'bg-red-100 text-red-700'
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-tighter {{ $statusColors[$product->status] ?? 'bg-slate-100' }}">
                                    {{ $product->status }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex -space-x-1">
                                    @if($product->featured) <span class="w-5 h-5 rounded-full bg-industrial-orange border-2 border-white flex items-center justify-center text-[8px] text-white font-bold" title="Featured">F</span> @endif
                                    @if($product->trending) <span class="w-5 h-5 rounded-full bg-blue-600 border-2 border-white flex items-center justify-center text-[8px] text-white font-bold" title="Trending">T</span> @endif
                                </div>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 text-slate-400 hover:text-industrial-blue hover:bg-blue-50 rounded-lg transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Archive this product?')">
                                        @csrf @method('DELETE')
                                        <button class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-12 text-center text-slate-400 font-medium">No products found in the inventory.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($products->hasPages())
            <div class="px-8 py-4 bg-slate-50 border-t border-slate-100">
                {{ $products->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
