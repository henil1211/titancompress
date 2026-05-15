<x-admin-layout>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar: Add Category -->
        <div class="space-y-6">
            <div class="glass-panel p-8 rounded-3xl sticky top-24">
                <h2 class="text-xl font-extrabold tracking-tighter uppercase mb-6">NEW <span class="text-industrial-orange">CATEGORY</span></h2>
                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Category Name</label>
                        <input type="text" name="name" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Parent Category</label>
                        <select name="parent_id" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                            <option value="">None (Top Level)</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full btn-industrial py-3 text-sm">Create Category</button>
                </form>
            </div>
        </div>

        <!-- Main: Category List -->
        <div class="lg:col-span-2">
            <div class="glass-panel rounded-3xl overflow-hidden shadow-xl border border-slate-200">
                <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
                    <h3 class="font-extrabold uppercase text-xs tracking-[0.2em] text-slate-800">Operational Hierarchy</h3>
                </div>
                <div class="p-8">
                    <div class="space-y-4">
                        @foreach($categories as $cat)
                        <div class="p-4 bg-white border border-slate-100 rounded-2xl flex items-center justify-between hover:border-industrial-orange transition-all group shadow-sm">
                            <div class="flex items-center space-x-4">
                                <div class="w-10 h-10 rounded-lg bg-industrial-blue text-white flex items-center justify-center font-bold">
                                    {{ substr($cat->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800">{{ $cat->name }}</h4>
                                    <p class="text-[10px] text-slate-400 uppercase tracking-widest">{{ $cat->subcategories->count() }} Subcategories</p>
                                </div>
                            </div>
                            <div class="flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                <button class="p-2 text-slate-400 hover:text-industrial-blue">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </button>
                                <form action="{{ route('admin.categories.destroy', $cat->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button class="p-2 text-slate-400 hover:text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
