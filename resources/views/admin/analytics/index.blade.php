<x-admin-layout>
    <div class="space-y-8" x-data="{ range: '30d' }">
        <!-- Header -->
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tighter uppercase">INTELLIGENCE <span class="text-industrial-orange text-outline-thin">DASHBOARD</span></h1>
                <p class="text-slate-500 text-sm mt-1">Real-time enterprise metrics and conversion analytics.</p>
            </div>
            <div class="flex bg-white p-1 rounded-xl shadow-sm border border-slate-200">
                <button @click="range = '7d'" :class="range === '7d' ? 'bg-industrial-blue text-white' : 'text-slate-500'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">7D</button>
                <button @click="range = '30d'" :class="range === '30d' ? 'bg-industrial-blue text-white' : 'text-slate-500'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">30D</button>
                <button @click="range = '90d'" :class="range === '90d' ? 'bg-industrial-blue text-white' : 'text-slate-500'" class="px-4 py-1.5 rounded-lg text-xs font-bold transition-all">90D</button>
            </div>
        </div>

        <!-- High-Level Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach([
                ['Traffic', $stats['total_views'], 'Total Page Views', 'blue'],
                ['Leads', $stats['total_rfqs'], 'RFQ Submissions', 'orange'],
                ['Conversion', $stats['conversions'] . '%', 'Visitor to RFQ Rate', 'green'],
                ['AI Chats', $stats['ai_chats'], 'Automated Inquiries', 'purple']
            ] as $stat)
            <div class="glass-panel p-6 rounded-2xl border-l-4 border-{{ $stat[3] }}-500 shadow-lg bg-white">
                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $stat[2] }}</p>
                <h3 class="text-3xl font-black mt-2 text-slate-800">{{ $stat[1] }}</h3>
                <div class="mt-4 flex items-center text-[10px] font-bold text-{{ $stat[3] }}-600 uppercase">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    <span>Industrial Growth Active</span>
                </div>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Traffic Chart -->
            <div class="lg:col-span-2 glass-panel p-8 rounded-3xl bg-white border border-slate-100 shadow-sm">
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mb-8">Visitor Traffic Trend</h4>
                <div class="h-64 flex items-end space-x-2">
                    @foreach($trafficData as $data)
                        <div class="flex-1 bg-industrial-blue/10 hover:bg-industrial-orange/40 transition-all rounded-t-lg relative group" style="height: {{ ($data->views / max($trafficData->pluck('views')->toArray() ?: [1])) * 100 }}%">
                            <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-[8px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                {{ $data->views }}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="flex justify-between mt-4 text-[8px] font-bold text-slate-400 uppercase tracking-widest">
                    <span>30 Days Ago</span>
                    <span>Present Day</span>
                </div>
            </div>

            <!-- Lead Sources -->
            <div class="glass-panel p-8 rounded-3xl bg-white border border-slate-100 shadow-sm">
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em] mb-8">Lead Attribution</h4>
                <div class="space-y-6">
                    @foreach($leadSources as $source)
                    <div class="space-y-2">
                        <div class="flex justify-between text-[10px] font-bold uppercase tracking-widest">
                            <span class="text-slate-600">{{ $source->lead_source }}</span>
                            <span class="text-industrial-orange">{{ $source->total }}</span>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-industrial-orange h-full rounded-full" style="width: {{ ($source->total / max($leadSources->pluck('total')->toArray() ?: [1])) * 100 }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Popular Products -->
        <div class="glass-panel rounded-3xl overflow-hidden border border-slate-100 shadow-sm bg-white">
            <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50">
                <h4 class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">Product Engagement Benchmarks</h4>
            </div>
            <table class="w-full text-left">
                <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                    <tr>
                        <th class="px-8 py-4">Industrial System</th>
                        <th class="px-6 py-4">Total Views</th>
                        <th class="px-6 py-4">Conversion Potential</th>
                        <th class="px-8 py-4 text-right">Trend</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($popularProducts as $item)
                        @php $product = \App\Domains\Product\Models\Product::find($item->product_id); @endphp
                        @if($product)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-8 py-4">
                                <span class="text-sm font-bold text-slate-800">{{ $product->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-xs font-mono font-bold text-industrial-blue">{{ $item->views }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <div class="w-12 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                                        <div class="bg-green-500 h-full" style="width: 75%"></div>
                                    </div>
                                    <span class="text-[10px] font-bold text-green-600 uppercase">High</span>
                                </div>
                            </td>
                            <td class="px-8 py-4 text-right text-green-500">
                                <svg class="w-4 h-4 ml-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
