<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <div>
                <nav class="flex text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                    <a href="{{ route('admin.rfqs.index') }}" class="hover:text-industrial-orange transition-colors">Pipeline</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-800">RFQ Details</span>
                </nav>
                <h1 class="text-2xl font-extrabold tracking-tighter uppercase">PROCESS <span class="text-industrial-orange">REQUEST</span> #{{ substr($rfq->id, 0, 8) }}</h1>
            </div>
            <div class="flex space-x-3" x-data="{ openStatus: false }">
                <div class="relative">
                    <button @click="openStatus = !openStatus" class="bg-white border border-slate-200 px-6 py-2 rounded-xl text-sm font-bold shadow-sm hover:bg-slate-50 transition-all flex items-center space-x-2">
                        <span class="w-2 h-2 rounded-full" style="background-color: {{ $rfq->status->color_hex }}"></span>
                        <span>Status: {{ $rfq->status->name }}</span>
                    </button>
                    <div x-show="openStatus" @click.away="openStatus = false" class="absolute right-0 mt-2 w-48 glass-panel rounded-xl py-2 z-50">
                        @foreach($statuses as $status)
                        <form action="{{ route('admin.rfqs.status', $rfq->id) }}" method="POST">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status_id" value="{{ $status->id }}">
                            <button type="submit" class="block w-full text-left px-4 py-2 text-xs font-bold hover:bg-slate-50 {{ $rfq->status_id == $status->id ? 'text-industrial-orange' : 'text-slate-600' }}">
                                {{ $status->name }}
                            </button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: RFQ Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Customer & Technical Profile -->
                <div class="glass-panel p-8 rounded-3xl space-y-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Customer Profile</h3>
                            <div class="space-y-3">
                                <div><p class="text-[10px] uppercase font-bold text-slate-400">Contact</p><p class="text-sm font-bold">{{ $rfq->customer_name }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-slate-400">Company</p><p class="text-sm font-bold text-industrial-orange">{{ $rfq->company_name }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-slate-400">Industry</p><p class="text-sm font-bold">{{ $rfq->industry ?? 'N/A' }}</p></div>
                                <div><p class="text-[10px] uppercase font-bold text-slate-400">Contact Detail</p><p class="text-sm font-bold">{{ $rfq->email }} / {{ $rfq->phone ?? 'No Phone' }}</p></div>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Technical Specification Requirements</h3>
                            <div class="grid grid-cols-2 gap-4">
                                @if($rfq->technical_requirements)
                                    @foreach($rfq->technical_requirements as $key => $val)
                                    <div class="bg-slate-50 p-3 rounded-xl border border-slate-100">
                                        <p class="text-[8px] uppercase font-bold text-slate-400">{{ str_replace('_', ' ', $key) }}</p>
                                        <p class="text-xs font-bold text-slate-800">{{ $val }}</p>
                                    </div>
                                    @endforeach
                                @else
                                    <p class="text-xs text-slate-400 italic">No specific technical data provided.</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-slate-100">
                        <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Additional Context</h3>
                        <p class="text-sm text-slate-600 bg-slate-50 p-4 rounded-2xl italic">
                            {{ $rfq->additional_notes ?? 'No additional comments provided by the customer.' }}
                        </p>
                    </div>
                </div>

                <!-- Product Request Table -->
                <div class="glass-panel rounded-3xl overflow-hidden shadow-sm border border-slate-100">
                    <div class="px-8 py-4 bg-slate-50/50 border-b border-slate-100">
                        <h3 class="font-bold uppercase text-[10px] tracking-[0.2em] text-slate-500">Requested Systems Inventory</h3>
                    </div>
                    <table class="w-full text-left">
                        <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest border-b border-slate-100">
                            <tr>
                                <th class="px-8 py-3">Industrial System</th>
                                <th class="px-6 py-3">Category</th>
                                <th class="px-6 py-3 text-right">Qty</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 bg-white">
                            @foreach($rfq->items as $item)
                            <tr>
                                <td class="px-8 py-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-8 h-8 rounded bg-slate-100 flex items-center justify-center text-slate-400 font-bold text-xs">
                                            {{ substr($item->product_name ?? 'P', 0, 1) }}
                                        </div>
                                        <span class="text-sm font-bold text-slate-800">{{ $item->product_name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-[10px] font-bold text-slate-500 uppercase">{{ $item->product->category->name ?? 'N/A' }}</span>
                                </td>
                                <td class="px-6 py-4 text-right font-mono font-bold">{{ $item->quantity }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Activity Timeline -->
                <div class="space-y-4">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest px-4">Sales Activity Timeline</h3>
                    <div class="space-y-0">
                        @foreach($rfq->activityLogs as $log)
                        <div class="flex items-start space-x-4 p-4 hover:bg-white rounded-2xl transition-all border-l-2 border-slate-200 ml-4 relative">
                            <div class="absolute -left-[9px] top-5 w-4 h-4 rounded-full bg-slate-200 border-4 border-slate-50"></div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-1">
                                    <p class="text-[10px] font-bold uppercase tracking-tighter text-industrial-blue">{{ $log->action }}</p>
                                    <p class="text-[10px] text-slate-400">{{ $log->created_at->format('M d, H:i') }}</p>
                                </div>
                                <p class="text-xs text-slate-600">{{ $log->description }}</p>
                                @if($log->user)
                                    <p class="text-[8px] uppercase font-bold text-slate-400 mt-1">By: {{ $log->user->name }}</p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right: Sales Assignment & Notes -->
            <div class="space-y-8">
                <!-- Assignment -->
                <div class="glass-panel p-8 rounded-3xl space-y-6">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Ownership Assignment</h3>
                    <form action="{{ route('admin.rfqs.assign', $rfq->id) }}" method="POST" class="space-y-4">
                        @csrf @method('PATCH')
                        <select name="user_id" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                            <option value="">Unassigned</option>
                            @foreach($salesManagers as $manager)
                                <option value="{{ $manager->id }}" {{ $rfq->assigned_to == $manager->id ? 'selected' : '' }}>{{ $manager->name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="w-full btn-industrial py-3 text-[10px] tracking-widest">TRANSFER OWNERSHIP</button>
                    </form>
                </div>

                <!-- Internal Notes -->
                <div class="glass-panel p-8 rounded-3xl space-y-6">
                    <h3 class="text-xs font-bold text-slate-500 uppercase tracking-widest">Internal Collaboration</h3>
                    <div class="space-y-4 max-h-[300px] overflow-y-auto">
                        @forelse($rfq->notes as $note)
                        <div class="bg-slate-50 p-4 rounded-2xl border border-slate-100">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-[10px] font-bold text-slate-800 uppercase">{{ $note->user->name }}</span>
                                <span class="text-[8px] text-slate-400 font-bold">{{ $note->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-xs text-slate-600">{{ $note->content }}</p>
                        </div>
                        @empty
                        <p class="text-xs text-slate-400 italic text-center py-4">No internal notes for this lead.</p>
                        @endforelse
                    </div>
                    <form action="{{ route('admin.rfqs.note', $rfq->id) }}" method="POST" class="space-y-4 pt-4 border-t border-slate-100">
                        @csrf
                        <textarea name="content" required rows="3" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-xs focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="Write internal note..."></textarea>
                        <button type="submit" class="w-full bg-industrial-blue text-white py-3 rounded-xl font-bold text-[10px] uppercase tracking-widest hover:bg-slate-800 transition-all">ADD INTERNAL NOTE</button>
                    </form>
                </div>

                <!-- Lead Actions -->
                <div class="grid grid-cols-2 gap-4">
                    <button class="bg-white border border-slate-200 p-4 rounded-2xl flex flex-col items-center justify-center hover:bg-slate-50 transition-all group">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-industrial-orange mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span class="text-[8px] font-bold uppercase text-slate-500">Email Customer</span>
                    </button>
                    <button class="bg-white border border-slate-200 p-4 rounded-2xl flex flex-col items-center justify-center hover:bg-slate-50 transition-all group">
                        <svg class="w-6 h-6 text-slate-400 group-hover:text-blue-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        <span class="text-[8px] font-bold uppercase text-slate-500">Generate PDF</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
