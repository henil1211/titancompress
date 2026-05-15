<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tighter">OPERATIONAL <span class="text-industrial-orange">OVERVIEW</span></h1>
                <p class="text-slate-500 text-sm mt-1">Real-time status of the industrial compressor ecosystem.</p>
            </div>
            <div class="flex space-x-3">
                <button class="bg-white border border-slate-200 px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-slate-50 transition-all flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Export Report</span>
                </button>
                <a href="{{ route('admin.products.create') }}" class="btn-industrial py-2 px-4 text-xs inline-block">
                    New Product
                </a>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <x-admin.stat-card label="Total Products" value="{{ $stats['total_products'] }}" trend="+12%" icon="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" color="orange" />
            <x-admin.stat-card label="Active RFQs" value="{{ $stats['rfq_count'] }}" trend="+5%" icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" color="blue" />
            <x-admin.stat-card label="AI Interactions" value="{{ $stats['ai_interactions'] }}" trend="+42%" icon="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" color="slate" />
            <x-admin.stat-card label="Conversion Rate" value="3.2%" trend="-1.5%" icon="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" color="orange" />
        </div>

        <!-- Main Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Recent Activity -->
            <div class="lg:col-span-2 space-y-6">
                <div class="glass-panel rounded-3xl overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                        <h3 class="font-bold uppercase text-[10px] tracking-[0.2em] text-slate-500">Recent Inventory Updates</h3>
                        <a href="#" class="text-[10px] font-bold text-industrial-orange hover:underline uppercase tracking-tighter">View All</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                                <tr>
                                    <th class="px-6 py-3">Product Name</th>
                                    <th class="px-6 py-3">SKU</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($stats['recent_products'] as $product)
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 rounded bg-slate-100 flex items-center justify-center">
                                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <span class="text-sm font-bold text-slate-800">{{ $product->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-xs font-mono text-slate-500">{{ $product->sku }}</td>
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-green-100 text-green-800">
                                            Active
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button class="text-slate-400 hover:text-industrial-blue transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Side Cards -->
            <div class="space-y-6">
                <!-- System Health -->
                <div class="glass-panel rounded-3xl p-6 bg-industrial-blue text-white overflow-hidden relative">
                    <div class="absolute top-0 right-0 p-2 opacity-10">
                        <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                    </div>
                    <h3 class="font-bold text-xs uppercase tracking-[0.2em] mb-6">System Health</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-[10px] font-bold uppercase mb-1">
                                <span>API Server</span>
                                <span class="text-green-400">99.9%</span>
                            </div>
                            <div class="w-full bg-white/10 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-green-400 h-full w-[99%]"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-[10px] font-bold uppercase mb-1">
                                <span>AI Response Time</span>
                                <span class="text-industrial-orange">1.2s</span>
                            </div>
                            <div class="w-full bg-white/10 h-1.5 rounded-full overflow-hidden">
                                <div class="bg-industrial-orange h-full w-[85%]"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-panel rounded-3xl p-6">
                    <h3 class="font-bold text-xs uppercase tracking-[0.2em] mb-4 text-slate-500">Quick Actions</h3>
                    <div class="grid grid-cols-2 gap-3">
                        <a href="{{ route('admin.products.create') }}" class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-all border border-slate-100 group">
                            <svg class="w-6 h-6 text-industrial-orange mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-tighter text-slate-800">Add Product</span>
                        </a>
                        <a href="{{ route('admin.categories.index') }}" class="flex flex-col items-center justify-center p-4 bg-slate-50 rounded-2xl hover:bg-slate-100 transition-all border border-slate-100 group">
                            <svg class="w-6 h-6 text-blue-600 mb-2 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                            <span class="text-[10px] font-bold uppercase tracking-tighter text-slate-800">Edit CMS</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
