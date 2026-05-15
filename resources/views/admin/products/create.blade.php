<x-admin-layout>
    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8" x-data="{ activeTab: 'basic' }">
        @csrf
        
        <!-- Header -->
        <div class="flex justify-between items-center bg-white p-6 rounded-3xl shadow-sm border border-slate-100">
            <div>
                <nav class="flex text-[10px] font-bold text-slate-400 uppercase tracking-widest mb-2">
                    <a href="{{ route('admin.products.index') }}" class="hover:text-industrial-orange transition-colors">Products</a>
                    <span class="mx-2">/</span>
                    <span class="text-slate-800">New Product</span>
                </nav>
                <h1 class="text-2xl font-extrabold tracking-tighter uppercase">REGISTER <span class="text-industrial-orange">NEW SYSTEM</span></h1>
            </div>
            <div class="flex space-x-3">
                <a href="{{ route('admin.products.index') }}" class="px-6 py-2 border border-slate-200 rounded-xl text-sm font-bold hover:bg-slate-50 transition-all">Cancel</a>
                <button type="submit" class="btn-industrial py-2 px-8 shadow-lg shadow-orange-500/20">
                    Deploy Product
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Navigation -->
            <div class="space-y-2">
                <button type="button" @click="activeTab = 'basic'" :class="activeTab === 'basic' ? 'bg-industrial-blue text-white shadow-lg' : 'bg-white text-slate-500 hover:bg-slate-50'" class="w-full text-left px-6 py-4 rounded-2xl font-bold text-sm transition-all flex items-center space-x-3 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Basic Information</span>
                </button>
                <button type="button" @click="activeTab = 'specs'" :class="activeTab === 'specs' ? 'bg-industrial-blue text-white shadow-lg' : 'bg-white text-slate-500 hover:bg-slate-50'" class="w-full text-left px-6 py-4 rounded-2xl font-bold text-sm transition-all flex items-center space-x-3 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    <span>Technical Specs</span>
                </button>
                <button type="button" @click="activeTab = 'media'" :class="activeTab === 'media' ? 'bg-industrial-blue text-white shadow-lg' : 'bg-white text-slate-500 hover:bg-slate-50'" class="w-full text-left px-6 py-4 rounded-2xl font-bold text-sm transition-all flex items-center space-x-3 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Media Assets</span>
                </button>
                <button type="button" @click="activeTab = 'seo'" :class="activeTab === 'seo' ? 'bg-industrial-blue text-white shadow-lg' : 'bg-white text-slate-500 hover:bg-slate-50'" class="w-full text-left px-6 py-4 rounded-2xl font-bold text-sm transition-all flex items-center space-x-3 border border-slate-100">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <span>SEO & Metadata</span>
                </button>
            </div>

            <!-- Content Area -->
            <div class="lg:col-span-3 space-y-8">
                
                <!-- Basic Info Tab -->
                <div x-show="activeTab === 'basic'" class="glass-panel p-8 rounded-3xl space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Product Name</label>
                            <input type="text" name="name" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="e.g. Titan-X 500 Rotary Screw">
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">SKU / Model Number</label>
                            <input type="text" name="sku" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="e.g. TX-500-2026">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Category</label>
                            <select name="category_id" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="space-y-2">
                            <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">System Status</label>
                            <select name="status" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                                <option value="draft">Draft</option>
                                <option value="active" selected>Active / In Production</option>
                                <option value="archived">Archived</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Technical Summary (Short)</label>
                        <textarea name="short_description" rows="3" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="Quick overview for listing pages..."></textarea>
                    </div>

                    <div class="flex items-center space-x-6 pt-4 border-t border-slate-100">
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="featured" class="w-5 h-5 rounded border-slate-300 text-industrial-orange focus:ring-industrial-orange transition-all">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-industrial-orange transition-colors">Featured System</span>
                        </label>
                        <label class="flex items-center space-x-3 cursor-pointer group">
                            <input type="checkbox" name="trending" class="w-5 h-5 rounded border-slate-300 text-blue-600 focus:ring-blue-600 transition-all">
                            <span class="text-sm font-bold text-slate-700 group-hover:text-blue-600 transition-colors">Trending Now</span>
                        </label>
                    </div>
                </div>

                <!-- Technical Specs Tab -->
                <div x-show="activeTab === 'specs'" class="space-y-6">
                    @foreach($specGroups as $group)
                    <div class="glass-panel p-8 rounded-3xl border-l-4 border-industrial-orange">
                        <h3 class="text-lg font-extrabold tracking-tighter mb-6 uppercase">{{ $group->name }}</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            @foreach($group->attributes as $attr)
                            <div class="space-y-2">
                                <label class="text-[10px] font-extrabold text-slate-400 uppercase tracking-widest">{{ $attr->name }} {{ $attr->unit ? "($attr->unit)" : '' }}</label>
                                <input type="text" name="specs[{{ $attr->id }}]" 
                                       class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm font-mono focus:ring-2 focus:ring-industrial-orange transition-all" 
                                       placeholder="Enter value...">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Media Assets Tab -->
                <div x-show="activeTab === 'media'" class="glass-panel p-8 rounded-3xl space-y-8">
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold uppercase tracking-widest text-slate-800">Primary Product Image</h4>
                        <div class="border-2 border-dashed border-slate-200 rounded-3xl p-12 text-center hover:border-industrial-orange transition-colors group relative">
                            <input type="file" name="main_image" class="absolute inset-0 opacity-0 cursor-pointer">
                            <svg class="w-12 h-12 text-slate-300 mx-auto group-hover:text-industrial-orange transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <p class="mt-4 text-sm font-bold text-slate-500">Drop main image here or <span class="text-industrial-orange">browse files</span></p>
                            <p class="text-[10px] text-slate-400 mt-1 uppercase tracking-widest">Supports PNG, JPG, WEBP (Max 5MB)</p>
                        </div>
                    </div>

                    <div class="space-y-4 pt-8 border-t border-slate-100">
                        <h4 class="text-sm font-bold uppercase tracking-widest text-slate-800">Technical Documents & 3D Models</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach(['PDF Brochure', 'CAD File (DWG/STP)', 'Technical Datasheet', '3D Model (GLB)'] as $docType)
                            <div class="bg-slate-50 p-4 rounded-2xl flex items-center justify-between border border-slate-100">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-white rounded-lg flex items-center justify-center text-slate-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                    </div>
                                    <span class="text-xs font-bold uppercase tracking-tighter">{{ $docType }}</span>
                                </div>
                                <button type="button" class="text-industrial-orange font-bold text-[10px] uppercase hover:underline">Upload</button>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- SEO Tab -->
                <div x-show="activeTab === 'seo'" class="glass-panel p-8 rounded-3xl space-y-6">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Meta Title</label>
                        <input type="text" name="meta_title" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="Default: Product Name | TitanCompress">
                        <p class="text-[10px] text-slate-400">Recommended length: 60 characters.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Meta Description</label>
                        <textarea name="meta_description" rows="3" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="Enter SEO description..."></textarea>
                        <p class="text-[10px] text-slate-400">Recommended length: 160 characters.</p>
                    </div>
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-widest">Focus Keywords</label>
                        <input type="text" name="meta_keywords" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="e.g. industrial compressor, rotary screw, 500kW">
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
