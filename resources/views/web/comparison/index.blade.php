@extends('layouts.web')

@section('title', 'Technical Comparison | TitanCompress')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<div x-data="comparisonUI()" class="bg-slate-50 min-h-screen pb-20">
    <main class="py-12 px-6 md:px-12">
        <div class="max-w-7xl mx-auto space-y-12">
            
            <!-- Comparison Table Header -->
            <div class="flex flex-col md:flex-row md:items-end justify-between gap-6">
                <div>
                    <h1 class="text-5xl font-black tracking-tighter uppercase leading-none">SYSTEM <span class="text-industrial-orange text-outline-thin">BENCHMARK</span></h1>
                    <p class="text-slate-500 mt-4 max-w-xl font-medium">Objective technical analysis across our high-performance compressor lineup. Compare specifications, efficiency, and engineering standards.</p>
                </div>
                <div class="flex space-x-4">
                    <button @click="askAI()" class="bg-slate-900 text-white px-6 py-3 rounded-2xl font-bold text-xs flex items-center space-x-3 hover:bg-industrial-blue transition-all group shadow-xl">
                        <svg class="w-5 h-5 text-industrial-orange group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        <span>AI ANALYZE DIFFERENCES</span>
                    </button>
                </div>
            </div>

            <!-- Desktop Comparison Matrix (Hidden on Mobile) -->
            <div class="hidden lg:block relative overflow-x-auto rounded-3xl border border-slate-200 shadow-2xl bg-white" id="comparison-table">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="p-8 w-64 border-r border-slate-100 sticky left-0 bg-slate-50 z-20">
                                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">Technical Spec</span>
                            </th>
                            @foreach($products as $product)
                            <th class="p-8 min-w-[280px] border-r border-slate-100 align-top relative group">
                                <button @click="removeItem('{{ $product->id }}')" class="absolute top-4 right-4 text-slate-300 hover:text-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                </button>
                                <div class="space-y-4">
                                    <div class="h-32 bg-slate-100 rounded-2xl flex items-center justify-center overflow-hidden p-4">
                                        @if(str_contains($product->slug, 'piston'))
                                            <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=400" class="max-h-full object-contain mix-blend-multiply" alt="{{ $product->name }}">
                                        @elseif(str_contains($product->slug, 'screw'))
                                            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=400" class="max-h-full object-contain mix-blend-multiply" alt="{{ $product->name }}">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&q=80&w=400" class="max-h-full object-contain mix-blend-multiply grayscale" alt="{{ $product->name }}">
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <p class="text-[10px] font-bold text-industrial-orange uppercase tracking-widest mb-1">{{ $product->category->name }}</p>
                                        <h3 class="text-lg font-extrabold tracking-tight leading-tight uppercase">{{ $product->name }}</h3>
                                        <p class="text-xs text-slate-400 font-mono mt-1">{{ $product->sku }}</p>
                                    </div>
                                    <a href="{{ route('rfq.show', ['product' => $product->id]) }}" class="block text-center bg-slate-900 text-white py-2 rounded-xl text-[10px] font-bold tracking-widest hover:bg-industrial-orange transition-all">INQUIRE NOW</a>
                                </div>
                            </th>
                            @endforeach
                            @for($i = count($products); $i < 4; $i++)
                            <th class="p-8 min-w-[280px] bg-slate-50/50 border-r border-slate-100 align-middle text-center">
                                <a href="{{ route('products.index') }}" class="inline-flex flex-col items-center group">
                                    <div class="w-12 h-12 rounded-full border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-300 group-hover:border-industrial-orange group-hover:text-industrial-orange transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <span class="mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-slate-800">Add System</span>
                                </a>
                            </th>
                            @endfor
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($matrix as $group)
                        <tr class="bg-industrial-blue/5">
                            <td colspan="5" class="px-8 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-industrial-blue border-y border-slate-100">
                                {{ $group['name'] }}
                            </td>
                        </tr>
                        @foreach($group['attributes'] as $attr)
                        <tr class="hover:bg-slate-50/50 transition-colors border-b border-slate-100">
                            <td class="px-8 py-5 border-r border-slate-100 sticky left-0 bg-white z-10">
                                <p class="text-xs font-bold text-slate-700 leading-tight">{{ $attr['name'] }}</p>
                                @if($attr['unit'])
                                <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-0.5">{{ $attr['unit'] }}</p>
                                @endif
                            </td>
                            @foreach($products as $product)
                            <td class="px-8 py-5 border-r border-slate-100 text-sm font-medium">
                                @php 
                                    $val = $attr['values'][$product->id] ?? 'N/A';
                                    $isHighlighted = in_array($val, $attr['highlight'] ?? []);
                                @endphp
                                <div class="flex items-center space-x-2">
                                    <span class="{{ $isHighlighted ? 'text-industrial-blue font-black' : 'text-slate-600' }}">
                                        {{ $val }}
                                    </span>
                                    @if($isHighlighted)
                                    <div class="w-1.5 h-1.5 rounded-full bg-industrial-orange animate-pulse"></div>
                                    @endif
                                </div>
                            </td>
                            @endforeach
                            @for($i = count($products); $i < 4; $i++)
                            <td class="px-8 py-5 border-r border-slate-100 bg-slate-50/20"></td>
                            @endfor
                        </tr>
                        @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Comparison View (Hidden on Desktop) -->
            <div class="lg:hidden space-y-8">
                @foreach($products as $product)
                <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden relative group">
                    <button @click="removeItem('{{ $product->id }}')" class="absolute top-4 right-4 z-10 w-8 h-8 bg-white/80 rounded-full flex items-center justify-center text-red-500 shadow hover:bg-red-500 hover:text-white transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    <div class="p-6 bg-slate-50 border-b border-slate-100 flex flex-col items-center text-center">
                        <div class="h-32 w-full bg-white rounded-xl mb-4 flex items-center justify-center p-2 shadow-sm border border-slate-100">
                            @if(str_contains($product->slug, 'piston'))
                                <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=400" class="max-h-full object-contain" alt="{{ $product->name }}">
                            @elseif(str_contains($product->slug, 'screw'))
                                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=400" class="max-h-full object-contain" alt="{{ $product->name }}">
                            @else
                                <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&q=80&w=400" class="max-h-full object-contain grayscale" alt="{{ $product->name }}">
                            @endif
                        </div>
                        <p class="text-[10px] font-bold text-industrial-orange uppercase tracking-widest">{{ $product->category->name }}</p>
                        <h3 class="text-xl font-black tracking-tight mt-1">{{ $product->name }}</h3>
                        <p class="text-xs text-slate-400 font-mono mt-1">{{ $product->sku }}</p>
                        <a href="{{ route('rfq.show', ['product' => $product->id]) }}" class="mt-4 w-full text-center bg-slate-900 text-white py-3 rounded-xl text-xs font-bold tracking-widest hover:bg-industrial-orange transition-colors">INQUIRE NOW</a>
                    </div>
                    <div class="p-0">
                        @foreach($matrix as $group)
                        <div class="bg-industrial-blue/5 px-6 py-2 text-[10px] font-black uppercase tracking-[0.3em] text-industrial-blue border-y border-slate-100">
                            {{ $group['name'] }}
                        </div>
                        <div class="divide-y divide-slate-50">
                            @foreach($group['attributes'] as $attr)
                            @php 
                                $val = $attr['values'][$product->id] ?? 'N/A';
                                $isHighlighted = in_array($val, $attr['highlight'] ?? []);
                            @endphp
                            <div class="flex justify-between items-center px-6 py-4 hover:bg-slate-50 transition-colors">
                                <div class="flex flex-col">
                                    <span class="text-xs font-bold text-slate-700">{{ $attr['name'] }}</span>
                                    @if($attr['unit'])
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $attr['unit'] }}</span>
                                    @endif
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-sm {{ $isHighlighted ? 'text-industrial-blue font-black' : 'text-slate-600 font-medium' }}">{{ $val }}</span>
                                    @if($isHighlighted)
                                    <div class="w-1.5 h-1.5 rounded-full bg-industrial-orange animate-pulse"></div>
                                    @endif
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            
                @if(count($products) < 4)
                <a href="{{ route('products.index') }}" class="block w-full border-2 border-dashed border-slate-300 rounded-3xl p-8 text-center hover:border-industrial-orange group transition-colors">
                    <div class="w-12 h-12 bg-slate-50 rounded-full mx-auto flex items-center justify-center text-slate-400 group-hover:text-industrial-orange transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    </div>
                    <h4 class="mt-4 text-xs font-bold text-slate-500 uppercase tracking-widest group-hover:text-industrial-orange">Add System to Compare</h4>
                </a>
                @endif
            </div>

            <!-- AI Insights Modal -->
            <div x-show="showAI" x-cloak class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-[100] flex items-center justify-center p-6">
                <div @click.away="showAI = false" class="bg-white rounded-3xl w-full max-w-2xl shadow-2xl overflow-hidden relative">
                    <div class="bg-industrial-blue p-8 text-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-2xl font-black tracking-tighter uppercase">AI <span class="text-industrial-orange">ANALYSIS</span></h3>
                            <button @click="showAI = false" class="text-white/50 hover:text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        <p class="text-slate-400 text-xs mt-2 font-bold tracking-widest uppercase">Engineered Logic & System Recommendations</p>
                    </div>
                    <div class="p-8 space-y-6">
                        <div x-show="aiLoading" class="flex flex-col items-center py-12 space-y-4">
                            <div class="w-12 h-12 border-4 border-industrial-orange border-t-transparent rounded-full animate-spin"></div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-[0.2em]">Processing Engineering Data...</p>
                        </div>
                        <div x-show="!aiLoading" class="prose prose-slate max-w-none">
                            <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100" x-html="aiContent"></div>
                        </div>
                        <div class="flex justify-end space-x-4">
                            <button @click="showAI = false" class="text-xs font-bold uppercase tracking-widest text-slate-400">Close</button>
                            <a href="{{ route('rfq.show') }}" class="bg-industrial-orange text-white px-8 py-3 rounded-xl font-bold text-[10px] tracking-widest hover:scale-105 transition-transform shadow-lg shadow-orange-500/30">CONVERT TO RFQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
function comparisonUI() {
    return {
        showAI: false,
        aiLoading: false,
        aiContent: '',
        async removeItem(id) {
            const response = await fetch('{{ route('compare.remove') }}', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                body: JSON.stringify({ product_id: id })
            });
            if (response.ok) window.location.reload();
        },
        async askAI() {
            this.showAI = true;
            this.aiLoading = true;
            this.aiContent = '';

            try {
                const response = await fetch('{{ route('compare.analyze') }}', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                });
                const data = await response.json();
                this.aiContent = data.analysis;
            } catch (e) {
                this.aiContent = '<p class="text-red-500 font-bold">Failed to connect to Engineering AI. Please try again later.</p>';
            } finally {
                this.aiLoading = false;
            }
        }
    }
}

// GSAP Animations
document.addEventListener('DOMContentLoaded', () => {
    gsap.from('tr', {
        opacity: 0,
        y: 20,
        stagger: 0.05,
        duration: 0.8,
        ease: "power2.out"
    });
});
</script>

<style>
.text-outline-thin {
    -webkit-text-stroke: 1px currentColor;
    color: transparent;
}
#comparison-table::-webkit-scrollbar {
    height: 8px;
}
#comparison-table::-webkit-scrollbar-track {
    background: #f1f5f9;
}
#comparison-table::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 4px;
}
</style>
@endsection
