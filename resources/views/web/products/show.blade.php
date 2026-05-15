@extends('layouts.web')

@section('title', $product->name . ' | TitanCompress')

@section('content')
    <!-- Product Breadcrumb & Header -->
    <div class="bg-slate-100 py-6 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="flex items-center text-sm font-bold text-slate-500 tracking-wider uppercase">
                <a href="/" class="hover:text-industrial-orange transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Products</a>
                <span class="mx-2">/</span>
                <span class="text-industrial-blue">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <!-- Product Main Info -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
            
            <!-- Product Image Gallery -->
            <div class="space-y-4 static lg:sticky lg:top-24">
                <div class="bg-white border border-slate-200 p-8 rounded-xl shadow-lg flex items-center justify-center h-[350px] lg:h-[500px]">
                    @if(str_contains($product->slug, 'piston'))
                        <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=800" class="max-w-full max-h-full object-contain mix-blend-multiply" alt="{{ $product->name }}">
                    @elseif(str_contains($product->slug, 'screw'))
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=800" class="max-w-full max-h-full object-contain mix-blend-multiply" alt="{{ $product->name }}">
                    @else
                        <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&q=80&w=800" class="max-w-full max-h-full object-contain mix-blend-multiply grayscale" alt="{{ $product->name }}">
                    @endif
                </div>
                <!-- Thumbnail placeholders filled with images -->
                <div class="grid grid-cols-4 gap-4">
                    <div class="bg-slate-50 border border-slate-200 h-24 rounded-lg cursor-pointer hover:border-industrial-orange transition-colors overflow-hidden flex justify-center items-center p-2"><img src="https://images.unsplash.com/photo-1563720223185-11003d516935?auto=format&fit=crop&w=150&q=80" class="mix-blend-multiply max-h-full"></div>
                    <div class="bg-slate-50 border border-slate-200 h-24 rounded-lg cursor-pointer hover:border-industrial-orange transition-colors overflow-hidden flex justify-center items-center p-2"><img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&w=150&q=80" class="mix-blend-multiply max-h-full"></div>
                    <div class="bg-slate-50 border border-slate-200 h-24 rounded-lg cursor-pointer hover:border-industrial-orange transition-colors overflow-hidden flex justify-center items-center p-2"><img src="https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=150&q=80" class="mix-blend-multiply max-h-full"></div>
                    <div class="bg-slate-50 border border-slate-200 h-24 rounded-lg cursor-pointer hover:border-industrial-orange transition-colors overflow-hidden flex justify-center items-center p-2"><img src="https://images.unsplash.com/photo-1504917595217-d4bffc269b5a?auto=format&fit=crop&w=150&q=80" class="mix-blend-multiply max-h-full"></div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-8">
                <div>
                    <h1 class="text-4xl lg:text-5xl font-black text-industrial-blue uppercase mb-4">{{ $product->name }}</h1>
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="px-3 py-1 bg-industrial-orange/10 text-industrial-orange text-xs font-bold uppercase tracking-widest rounded">{{ $product->category->name ?? 'Industrial' }}</span>
                        <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-widest rounded">SKU: {{ $product->sku }}</span>
                    </div>
                    <p class="text-lg text-slate-600 leading-relaxed">
                        {{ $product->description ?? 'Engineered for heavy-duty industrial applications, delivering high pressure and robust performance.' }}
                    </p>
                </div>

                <!-- Key Features List -->
                <ul class="space-y-4 text-slate-700">
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-industrial-orange mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="font-medium"><strong class="text-industrial-blue">Cast Iron Cylinders:</strong> High wear resistance and excellent heat dissipation.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-industrial-orange mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="font-medium"><strong class="text-industrial-blue">Energy Efficient Motor:</strong> IE3/IE4 premium efficiency motors for reduced power costs.</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-6 h-6 text-industrial-orange mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <span class="font-medium"><strong class="text-industrial-blue">Deep Finned Coolers:</strong> Ensures discharge temperatures remain extremely low.</span>
                    </li>
                </ul>

                <!-- Action Buttons -->
                <div class="pt-6 flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                    <a href="{{ route('rfq.show') }}" class="btn-industrial bg-industrial-orange flex-1 text-center py-4 text-sm">REQUEST QUOTE</a>
                    <button class="px-6 py-4 bg-industrial-blue text-white font-bold text-sm tracking-widest uppercase hover:bg-slate-800 transition-colors flex items-center justify-center space-x-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        <span>Brochure</span>
                    </button>
                    <button onclick="addToCompare('{{ $product->id }}')" class="px-6 py-4 border-2 border-industrial-blue text-industrial-blue font-bold text-sm tracking-widest uppercase hover:bg-slate-50 transition-colors flex items-center justify-center" title="Add to Compare">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- Compare Script -->
    <script>
        function addToCompare(productId) {
            if(!productId) {
                alert('No product available to compare in this demo.');
                return;
            }
            
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

    <!-- Technical Data & Working Principle (Tabs) -->
    <section class="py-16 bg-slate-50 border-t border-slate-200" x-data="{ activeTab: 'specs' }">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            
            <!-- Tab Navigation -->
            <div class="flex space-x-8 border-b border-slate-300 mb-8 overflow-x-auto">
                <button @click="activeTab = 'specs'" :class="{'border-industrial-orange text-industrial-orange': activeTab === 'specs', 'border-transparent text-slate-500 hover:text-industrial-blue': activeTab !== 'specs'}" class="pb-4 font-bold uppercase tracking-widest text-sm border-b-2 whitespace-nowrap transition-colors">Technical Specifications</button>
                <button @click="activeTab = 'working'" :class="{'border-industrial-orange text-industrial-orange': activeTab === 'working', 'border-transparent text-slate-500 hover:text-industrial-blue': activeTab !== 'working'}" class="pb-4 font-bold uppercase tracking-widest text-sm border-b-2 whitespace-nowrap transition-colors">Working Principle</button>
                <button @click="activeTab = 'applications'" :class="{'border-industrial-orange text-industrial-orange': activeTab === 'applications', 'border-transparent text-slate-500 hover:text-industrial-blue': activeTab !== 'applications'}" class="pb-4 font-bold uppercase tracking-widest text-sm border-b-2 whitespace-nowrap transition-colors">Applications</button>
            </div>

            <!-- Tab Content: Specs -->
            <div x-show="activeTab === 'specs'" x-transition.opacity class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
                <h3 class="text-2xl font-black text-industrial-blue uppercase mb-6">Performance Data</h3>
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-slate-600 border-collapse">
                        <thead>
                            <tr class="bg-slate-100 text-industrial-blue">
                                <th class="p-4 font-bold uppercase text-xs tracking-widest border border-slate-200 w-1/3">Parameter</th>
                                <th class="p-4 font-bold uppercase text-xs tracking-widest border border-slate-200">Specification Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($product->specifications && $product->specifications->count() > 0)
                                @foreach($product->specifications as $spec)
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border border-slate-200 font-bold uppercase">{{ $spec->attribute->name }}</td>
                                    <td class="p-4 border border-slate-200">{{ $spec->value }} {{ $spec->attribute->unit }}</td>
                                </tr>
                                @endforeach
                            @else
                                <tr class="hover:bg-slate-50">
                                    <td class="p-4 border border-slate-200 font-bold" colspan="2">No specifications available for this model.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Tab Content: Working Principle -->
            <div x-show="activeTab === 'working'" x-transition.opacity style="display: none;" class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6 text-slate-600 leading-relaxed text-justify">
                        <h3 class="text-2xl font-black text-industrial-blue uppercase">How It Works</h3>
                        <p>
                            A piston (or reciprocating) air compressor operates on the principle of positive displacement. The electric motor drives a crankshaft, which moves pistons up and down inside cylinders. 
                        </p>
                        <p>
                            During the downward stroke, the intake valve opens, drawing atmospheric air into the cylinder. On the upward stroke, the intake valve closes, and the air is compressed in the decreasing volume of the cylinder. 
                        </p>
                        <p>
                            Once the pressure reaches the set limit, the discharge valve opens, forcing the highly compressed air into the storage receiver tank. For multi-stage models, air is pushed from the first cylinder into an intercooler before entering a smaller second cylinder for even higher compression.
                        </p>
                    </div>
                    <div class="bg-slate-100 rounded-lg p-6 flex justify-center items-center h-full min-h-[300px]">
                        <div class="text-center text-slate-400">
                            <svg class="w-16 h-16 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <span class="uppercase tracking-widest text-xs font-bold">[Diagram / Animation Placeholder]</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tab Content: Applications -->
            <div x-show="activeTab === 'applications'" x-transition.opacity style="display: none;" class="bg-white p-8 rounded-xl shadow-sm border border-slate-100">
                <h3 class="text-2xl font-black text-industrial-blue uppercase mb-6">Ideal Industries</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg text-center hover:border-industrial-orange transition-colors">
                        <h4 class="font-bold text-industrial-blue uppercase">Automotive</h4>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg text-center hover:border-industrial-orange transition-colors">
                        <h4 class="font-bold text-industrial-blue uppercase">Manufacturing</h4>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg text-center hover:border-industrial-orange transition-colors">
                        <h4 class="font-bold text-industrial-blue uppercase">PET Blowing</h4>
                    </div>
                    <div class="p-6 bg-slate-50 border border-slate-200 rounded-lg text-center hover:border-industrial-orange transition-colors">
                        <h4 class="font-bold text-industrial-blue uppercase">Construction</h4>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-industrial-blue py-16 text-center text-white border-b-4 border-industrial-orange">
        <div class="max-w-3xl mx-auto px-6">
            <h2 class="text-3xl font-black uppercase mb-4">Ready to upgrade your air system?</h2>
            <p class="text-slate-300 mb-8">Our engineers can help you size the exact piston compressor needed for your facility.</p>
            <a href="{{ route('rfq.show') }}" class="btn-industrial bg-industrial-orange inline-block">Consult an Engineer Today</a>
        </div>
    </section>
@endsection
