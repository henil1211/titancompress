<x-admin-layout>
    <div class="space-y-8">
        <!-- Header -->
        <div class="flex justify-between items-end">
            <div>
                <h1 class="text-3xl font-extrabold tracking-tighter uppercase">AI <span class="text-industrial-orange text-outline-thin">KNOWLEDGE BASE</span></h1>
                <p class="text-slate-500 text-sm mt-1">Train the enterprise AI with technical manuals, brochures, and datasheets.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left: Upload Form -->
            <div class="glass-panel p-8 rounded-3xl h-fit border border-slate-100 shadow-sm">
                <h3 class="text-lg font-black tracking-tighter uppercase mb-6">INGEST <span class="text-industrial-blue">DOCUMENT</span></h3>
                
                <form action="{{ route('admin.knowledge.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Document Title</label>
                        <input type="text" name="title" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="e.g. Titan-X 500 Maintenance Manual">
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Document Type</label>
                        <select name="type" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                            <option value="manual">Technical Manual</option>
                            <option value="brochure">Sales Brochure</option>
                            <option value="datasheet">Engineering Datasheet</option>
                        </select>
                    </div>

                    <div class="space-y-2 pt-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Upload File (PDF/DOCX)</label>
                        <input type="file" name="file" required class="w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-bold file:bg-industrial-blue file:text-white hover:file:bg-slate-800 transition-all cursor-pointer">
                    </div>

                    <div class="pt-6">
                        <button type="submit" class="w-full btn-industrial py-3 text-xs tracking-widest shadow-lg shadow-orange-500/20">UPLOAD & QUEUE</button>
                    </div>
                </form>
            </div>

            <!-- Right: Document Library -->
            <div class="lg:col-span-2 glass-panel rounded-3xl overflow-hidden border border-slate-100 shadow-sm">
                <div class="px-8 py-6 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <h4 class="text-xs font-bold text-slate-500 uppercase tracking-[0.2em]">Indexed Library</h4>
                    <span class="text-xs font-bold bg-industrial-blue/10 text-industrial-blue px-3 py-1 rounded-full">{{ $documents->count() }} Files</span>
                </div>
                
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                        <tr>
                            <th class="px-8 py-4">Title & Type</th>
                            <th class="px-6 py-4 text-center">Status</th>
                            <th class="px-8 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($documents as $doc)
                        <tr class="hover:bg-slate-50 transition-colors group">
                            <td class="px-8 py-5">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400 group-hover:text-industrial-orange transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $doc->title }}</p>
                                        <p class="text-[10px] uppercase tracking-widest text-industrial-blue font-bold mt-1">{{ $doc->type }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($doc->is_indexed)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-tighter bg-green-100 text-green-700">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        Active
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[10px] font-black uppercase tracking-tighter bg-amber-100 text-amber-700">
                                        <svg class="w-3 h-3 mr-1 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                        Pending Index
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right">
                                @if(!$doc->is_indexed)
                                <form action="{{ route('admin.knowledge.index_doc', $doc->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-[10px] font-bold uppercase tracking-widest text-industrial-orange hover:text-industrial-blue transition-colors">
                                        RUN INDEXER
                                    </button>
                                </form>
                                @else
                                    <span class="text-[10px] font-bold uppercase tracking-widest text-slate-300">Ready</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="px-8 py-12 text-center text-slate-400 font-medium italic">
                                No technical documents have been ingested yet.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>
