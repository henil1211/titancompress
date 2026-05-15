@extends('layouts.web')

@section('title', 'Our Products | TitanCompress')

@section('content')
    <!-- Page Header -->
    <div class="bg-industrial-blue py-16 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight">Our Product Range</h1>
            <div class="w-16 h-1 bg-industrial-orange mx-auto mt-6"></div>
        </div>
    </div>

    <!-- Product Catalog Grid -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 space-y-12">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($products as $product)
                <!-- Product Card -->
                <div class="bg-white border border-slate-100 shadow-lg hover:shadow-2xl transition-shadow rounded-xl overflow-hidden flex flex-col group">
                    <div class="h-64 bg-slate-50 relative p-8 flex items-center justify-center border-b border-slate-100">
                        @if($product->slug == 'piston-air-compressor-tc-p20')
                            <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=600" class="object-contain h-full group-hover:scale-105 transition-transform duration-500 mix-blend-multiply" alt="{{ $product->name }}">
                        @elseif($product->slug == 'screw-air-compressor-tc-s50')
                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=600" class="object-contain h-full group-hover:scale-105 transition-transform duration-500 mix-blend-multiply" alt="{{ $product->name }}">
                        @else
                            <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&q=80&w=600" class="object-contain h-full group-hover:scale-105 transition-transform duration-500 mix-blend-multiply grayscale" alt="{{ $product->name }}">
                        @endif
                    </div>
                    <div class="p-8 flex-grow flex flex-col">
                        <div class="mb-2">
                            <span class="text-[10px] font-black text-industrial-orange uppercase tracking-widest">{{ $product->sku }}</span>
                        </div>
                        <h3 class="text-xl font-bold text-industrial-blue mb-4">{{ $product->name }}</h3>
                        <p class="text-sm text-slate-600 mb-6 flex-grow">
                            {{ $product->short_description ?? 'High-performance industrial air compressor designed for maximum efficiency and durability.' }}
                        </p>
                        
                        <div class="flex items-center justify-between border-t border-slate-100 pt-4 mt-auto">
                            <a href="{{ route('products.show', $product->slug) }}" class="text-industrial-orange font-bold uppercase tracking-widest text-xs hover:text-industrial-blue transition-colors">Details &rarr;</a>
                            
                            <button onclick="addCatalogProductToCompare('{{ $product->id }}')" class="flex items-center space-x-2 text-xs font-bold text-slate-500 uppercase tracking-widest hover:text-industrial-orange transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                <span>Compare</span>
                            </button>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
        </div>
    </section>

    <!-- Compare Script for Catalog Page -->
    <script>
        function addCatalogProductToCompare(productId) {
            if(!productId) return;
            
            fetch('{{ route('compare.add') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.success) {
                    window.dispatchEvent(new CustomEvent('product-added-to-compare', {
                        detail: { count: data.count }
                    }));
                } else {
                    alert(data.message || 'Error adding to compare.');
                }
            })
            .catch(err => {
                console.error(err);
                alert('Error connecting to comparison engine.');
            });
        }
    </script>
@endsection
