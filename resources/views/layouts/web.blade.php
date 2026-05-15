<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TitanCompress | World Class Air Compressors')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white text-slate-800 antialiased font-sans flex flex-col min-h-screen">

    <!-- Top Bar -->
    <div class="bg-industrial-blue text-white py-2 px-6 lg:px-12 text-xs flex justify-between items-center">
        <div class="flex space-x-6">
            <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-industrial-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg> +91 98765 43210</span>
            <span class="flex items-center"><svg class="w-4 h-4 mr-2 text-industrial-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg> sales@titancompress.com</span>
        </div>
        <div class="flex space-x-4">
            <a href="#" class="hover:text-industrial-orange transition-colors">LinkedIn</a>
            <a href="#" class="hover:text-industrial-orange transition-colors">Facebook</a>
        </div>
    </div>

    <!-- Main Navigation -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-industrial-orange rounded-lg flex items-center justify-center font-black text-2xl text-white shadow-md">T</div>
                <div class="flex flex-col">
                    <span class="text-2xl font-black tracking-tight text-industrial-blue leading-none">TITAN</span>
                    <span class="text-sm font-bold tracking-[0.2em] text-industrial-orange leading-none">COMPRESS</span>
                </div>
            </a>
            
            <nav class="hidden lg:flex items-center space-x-8">
                <a href="/" class="text-sm font-bold uppercase tracking-widest transition-colors {{ request()->is('/') ? 'text-industrial-orange border-b-2 border-industrial-orange pb-1' : 'text-slate-600 hover:text-industrial-orange' }}">Home</a>
                <a href="{{ route('about') }}" class="text-sm font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('about') ? 'text-industrial-orange border-b-2 border-industrial-orange pb-1' : 'text-slate-600 hover:text-industrial-orange' }}">About Us</a>
                
                <div class="relative group" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                    <a href="{{ route('products.index') }}" class="text-sm font-bold uppercase tracking-widest flex items-center transition-colors {{ request()->routeIs('products.*') ? 'text-industrial-orange border-b-2 border-industrial-orange pb-1' : 'text-slate-600 hover:text-industrial-orange' }}">
                        Products
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                    </a>
                    <!-- Dropdown -->
                    <div x-show="open" x-transition class="absolute top-full left-0 mt-2 w-64 bg-white shadow-xl border border-slate-100 rounded-lg py-2 z-50">
                        @php
                            $navProducts = \App\Domains\Product\Models\Product::take(4)->get();
                        @endphp
                        @foreach($navProducts as $navProduct)
                            <a href="{{ route('products.show', $navProduct->slug) }}" class="block px-4 py-2 text-sm text-slate-600 hover:bg-slate-50 hover:text-industrial-orange font-medium">
                                {{ $navProduct->name }}
                            </a>
                        @endforeach
                        <div class="border-t border-slate-100 mt-2 pt-2">
                            <a href="{{ route('products.index') }}" class="block px-4 py-2 text-sm text-industrial-blue font-bold hover:bg-slate-50 hover:text-industrial-orange transition-colors">
                                View All Products &rarr;
                            </a>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('compare.index') }}" class="text-sm font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('compare.index') ? 'text-industrial-orange border-b-2 border-industrial-orange pb-1' : 'text-slate-600 hover:text-industrial-orange' }}">Compare</a>
                <a href="{{ route('contact') }}" class="text-sm font-bold uppercase tracking-widest transition-colors {{ request()->routeIs('contact') ? 'text-industrial-orange border-b-2 border-industrial-orange pb-1' : 'text-slate-600 hover:text-industrial-orange' }}">Contact</a>
            </nav>

            <div class="hidden lg:flex">
                <a href="{{ route('rfq.show') }}" class="btn-industrial bg-industrial-blue hover:bg-slate-800 shadow-lg">REQUEST A QUOTE</a>
            </div>
            
            <button class="lg:hidden text-industrial-blue">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-industrial-blue pt-20 pb-10 mt-auto border-t-[10px] border-industrial-orange">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 text-slate-300">
            
            <div class="space-y-6">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-industrial-orange rounded flex items-center justify-center font-black text-white text-xl">T</div>
                    <span class="text-xl font-black tracking-tighter uppercase text-white">Titan<span class="text-industrial-orange">Compress</span></span>
                </div>
                <p class="text-sm leading-relaxed">
                    World Class Air Compressors.<br>
                    ISO 9001:2015 Certified Company.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center hover:bg-industrial-orange transition-colors"><span class="text-xs font-bold">FB</span></a>
                    <a href="#" class="w-8 h-8 rounded bg-slate-800 flex items-center justify-center hover:bg-industrial-orange transition-colors"><span class="text-xs font-bold">IN</span></a>
                </div>
            </div>

            <div class="space-y-6">
                <h4 class="text-white font-bold uppercase tracking-widest text-sm">Quick Links</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="/" class="hover:text-industrial-orange transition-colors">Homepage</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-industrial-orange transition-colors">About Us</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Products</a></li>
                    <li><a href="#" class="hover:text-industrial-orange transition-colors">Dealers</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-industrial-orange transition-colors">Contact Us</a></li>
                </ul>
            </div>

            <div class="space-y-6">
                <h4 class="text-white font-bold uppercase tracking-widest text-sm">Products</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Screw Air Compressor</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Piston Air Compressor</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Air Booster for PET</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Oil Free Compressors</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-industrial-orange transition-colors">Air Accessories</a></li>
                </ul>
            </div>

            <div class="space-y-6">
                <h4 class="text-white font-bold uppercase tracking-widest text-sm">Contact Us</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start">
                        <svg class="w-5 h-5 mr-3 text-industrial-orange shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        <span>Industrial Zone, Phase 2, <br>Ahmedabad, Gujarat, India</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-industrial-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        <span>+91 98765 43210</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-3 text-industrial-orange shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <span>sales@titancompress.com</span>
                    </li>
                </ul>
                <a href="{{ route('rfq.show') }}" class="btn-industrial text-center w-full py-2 shadow-md">Inquire About Products</a>
            </div>

        </div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 mt-12 pt-8 border-t border-slate-800 text-center text-xs text-slate-500">
            © {{ date('Y') }} TitanCompress Equipments Ltd. All Rights Reserved.
        </div>
    </footer>

    <x-chatbot />
    <x-compare-tray />

</body>
</html>
