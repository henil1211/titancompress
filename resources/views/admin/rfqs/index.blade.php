<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tighter">LEAD <span class="text-industrial-orange">PIPELINE</span></h1>
                <p class="text-slate-500 text-sm mt-1">Manage technical requests and sales inquiries (RFQ).</p>
            </div>
            <div class="flex space-x-3">
                <button class="bg-white border border-slate-200 px-4 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-slate-50 transition-all flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>Export Leads</span>
                </button>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($statuses->take(4) as $status)
            <div class="glass-panel p-6 rounded-2xl border-b-4" style="border-color: {{ $status->color_hex ?? '#ccc' }}">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $status->name }}</p>
                <h3 class="text-2xl font-black mt-1">{{ \App\Domains\RFQ\Models\RFQ::where('status_id', $status->id)->count() }}</h3>
            </div>
            @endforeach
        </div>

        <!-- Filters Bar -->
        <div class="glass-panel p-6 rounded-2xl flex flex-wrap gap-4 items-center justify-between bg-white/50 backdrop-blur">
            <form action="{{ route('admin.rfqs.index') }}" method="GET" class="flex flex-1 gap-4">
                <div class="relative flex-1 max-w-sm">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search customer, company, or email..." 
                           class="w-full bg-slate-100 border-none rounded-xl pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                </div>
                
                <select name="status" class="bg-slate-100 border-none rounded-xl px-4 py-2 text-sm focus:ring-2 focus:ring-industrial-orange min-w-[180px]">
                    <option value="">All Statuses</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->id }}" {{ request('status') == $status->id ? 'selected' : '' }}>{{ $status->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-industrial-blue text-white px-6 py-2 rounded-xl font-bold text-sm hover:bg-slate-800 transition-all">
                    Filter Pipeline
                </button>
            </form>
        </div>

        <!-- Lead Table -->
        <div class="glass-panel rounded-3xl overflow-hidden shadow-xl border border-slate-200">
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] border-b border-slate-100">
                        <tr>
                            <th class="px-8 py-4">Customer Details</th>
                            <th class="px-6 py-4">Items</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Assigned To</th>
                            <th class="px-6 py-4">Source</th>
                            <th class="px-8 py-4 text-right">Operations</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($rfqs as $rfq)
                        <tr class="hover:bg-slate-50/80 transition-all group">
                            <td class="px-8 py-5">
                                <div>
                                    <p class="text-sm font-bold text-slate-800 leading-none">{{ $rfq->customer_name }}</p>
                                    <p class="text-[10px] font-bold text-industrial-orange mt-1 uppercase tracking-tighter">{{ $rfq->company_name }}</p>
                                    <p class="text-[10px] text-slate-400 mt-0.5">{{ $rfq->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-xs font-bold text-slate-600 bg-slate-100 px-2 py-1 rounded">
                                    {{ $rfq->items->count() }} Systems
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-extrabold uppercase tracking-tighter" 
                                      style="background-color: {{ ($rfq->status->color_hex ?? '#f1f5f9') . '20' }}; color: {{ $rfq->status->color_hex ?? '#64748b' }};">
                                    {{ $rfq->status->name }}
                                </span>
                            </td>
                            <td class="px-6 py-5">
                                @if($rfq->assignedTo)
                                    <div class="flex items-center space-x-2">
                                        <div class="w-6 h-6 rounded-full bg-slate-200 flex items-center justify-center text-[10px] font-bold uppercase">
                                            {{ substr($rfq->assignedTo->name, 0, 1) }}
                                        </div>
                                        <span class="text-xs font-medium text-slate-600">{{ $rfq->assignedTo->name }}</span>
                                    </div>
                                @else
                                    <span class="text-[10px] font-bold text-slate-300 uppercase tracking-widest italic">Unassigned</span>
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $rfq->lead_source }}</span>
                            </td>
                            <td class="px-8 py-5 text-right">
                                <a href="{{ route('admin.rfqs.show', $rfq->id) }}" class="btn-industrial py-1.5 px-4 text-[10px] tracking-widest">
                                    PROCESS RFQ
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-8 py-12 text-center text-slate-400 font-medium italic">No pending requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($rfqs->hasPages())
            <div class="px-8 py-4 bg-slate-50 border-t border-slate-100">
                {{ $rfqs->links() }}
            </div>
            @endif
        </div>
    </div>
</x-admin-layout>
