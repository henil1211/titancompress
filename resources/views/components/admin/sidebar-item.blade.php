@props(['icon', 'label', 'route'])

@php
    $isActive = request()->routeIs($route);
@endphp

<a href="{{ route($route) }}" 
   class="flex items-center space-x-3 px-4 py-3 rounded-xl transition-all duration-300 group {{ $isActive ? 'sidebar-item-active' : 'hover:bg-white/5 text-slate-400 hover:text-white' }}">
    <svg class="w-5 h-5 {{ $isActive ? 'text-white' : 'text-slate-500 group-hover:text-industrial-orange' }} transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
    </svg>
    <span class="text-sm font-medium">{{ $label }}</span>
</a>
