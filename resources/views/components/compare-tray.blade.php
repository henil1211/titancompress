<div x-data="compareTray()" 
     x-show="count > 0" 
     x-cloak
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="translate-y-full opacity-0"
     x-transition:enter-end="translate-y-0 opacity-100"
     class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100] w-full max-w-2xl px-4">
    
    <div class="glass-panel p-4 rounded-3xl border border-slate-200 shadow-2xl bg-slate-900/90 text-white flex items-center justify-between">
        <div class="flex items-center space-x-6">
            <div class="flex -space-x-3">
                <template x-for="i in count">
                    <div class="w-10 h-10 rounded-xl bg-industrial-orange border-2 border-slate-900 flex items-center justify-center font-black text-xs">T</div>
                </template>
            </div>
            <div>
                <p class="text-xs font-black uppercase tracking-widest"><span x-text="count"></span> SYSTEMS SELECTED</p>
                <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em]">Ready for Benchmark</p>
            </div>
        </div>

        <div class="flex items-center space-x-3">
            <button @click="clearAll()" class="text-[8px] font-bold uppercase tracking-widest text-slate-400 hover:text-white transition-colors">Clear</button>
            <a href="{{ route('compare.index') }}" class="bg-white text-slate-900 px-8 py-3 rounded-xl font-black text-[10px] tracking-widest hover:bg-industrial-orange hover:text-white transition-all">
                LAUNCH COMPARISON
            </a>
        </div>
    </div>
</div>

<script>
function compareTray() {
    return {
        count: 0,
        init() {
            // Check session or local storage for count if needed
            window.addEventListener('product-added-to-compare', (e) => {
                if (e.detail && e.detail.count !== undefined) {
                    this.count = e.detail.count;
                }
            });
        },
        async clearAll() {
            // Implementation for clearing
            this.count = 0;
        }
    }
}
</script>
