@props(['label', 'value', 'trend', 'icon', 'color' => 'orange'])

@php
    $colors = [
        'orange' => 'text-industrial-orange bg-orange-50 border-orange-100',
        'blue' => 'text-blue-600 bg-blue-50 border-blue-100',
        'slate' => 'text-slate-600 bg-slate-50 border-slate-100',
    ];
@endphp

<div class="glass-panel p-6 rounded-3xl relative overflow-hidden group hover:shadow-2xl transition-all duration-500">
    <div class="flex justify-between items-start">
        <div>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">{{ $label }}</p>
            <h3 class="text-3xl font-extrabold mt-2 tracking-tighter">{{ $value }}</h3>
            <div class="flex items-center mt-2 space-x-1">
                <span class="text-xs font-bold {{ str_contains($trend, '+') ? 'text-green-600' : 'text-red-600' }}">{{ $trend }}</span>
                <span class="text-[10px] text-slate-400 font-medium">vs last month</span>
            </div>
        </div>
        <div class="p-3 rounded-2xl {{ $colors[$color] }} border group-hover:scale-110 transition-transform duration-500">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
            </svg>
        </div>
    </div>
</div>
