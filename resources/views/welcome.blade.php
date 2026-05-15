@extends('layouts.web')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[600px] flex items-center justify-start bg-slate-100 overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=2070" class="w-full h-full object-cover object-center opacity-90" alt="Industrial Facility">
            <div class="absolute inset-0 bg-gradient-to-r from-industrial-blue/90 via-industrial-blue/70 to-transparent"></div>
        </div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-6 lg:px-12 w-full">
            <div class="max-w-2xl space-y-6">
                <span class="px-4 py-1.5 bg-industrial-orange text-white text-[10px] font-black uppercase tracking-[0.2em] rounded-sm">Leading Manufacturer in India</span>
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-black text-white leading-tight uppercase">
                    World Class <br>
                    <span class="text-industrial-orange">Air Compressors</span>
                </h1>
                <p class="text-lg text-slate-200 font-medium">
                    Delivering energy-efficient, highly reliable compressed air solutions for diverse industrial applications worldwide since 1985.
                </p>
                <div class="pt-4 flex space-x-4">
                    <a href="{{ route('products.index') }}" class="btn-industrial py-4 text-sm tracking-widest shadow-lg shadow-orange-500/30">EXPLORE PRODUCTS</a>
                    <a href="{{ route('about') }}" class="px-6 py-4 bg-white/10 hover:bg-white/20 text-white font-bold rounded-none backdrop-blur-sm border border-white/20 transition-all text-sm tracking-widest uppercase">KNOW MORE</a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section Overview -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="space-y-6">
                <h2 class="text-3xl md:text-4xl font-black text-industrial-blue uppercase">TITANCOMPRESS EQUIPMENTS LTD.</h2>
                <div class="w-20 h-1 bg-industrial-orange"></div>
                <p class="text-slate-600 leading-relaxed text-lg">
                    TitanCompress Equipments Limited, established in 1985 is an ISO 9001:2015 Company, which designs and manufactures the most reliable energy efficient wide range of Air Compressors with a vision to provide Compressed Air Solutions to Everyone, Everywhere.
                </p>
                <a href="{{ route('about') }}" class="inline-block text-industrial-orange font-bold uppercase tracking-widest hover:text-industrial-blue transition-colors mt-4">Read Full Story &rarr;</a>
            </div>
            <div class="relative">
                <div class="absolute -inset-4 bg-slate-100 rounded-3xl transform rotate-3"></div>
                <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=1000" class="relative rounded-2xl shadow-2xl z-10" alt="Manufacturing Facility">
            </div>
        </div>
    </section>
    <!-- Global Footprint Counter Section -->
    <section class="py-24 bg-white border-t border-slate-100 text-center" 
        x-data="{
            started: false,
            count1: 0,
            count2: 0,
            count3: 0,
            target1: 52,
            target2: 40,
            target3: 400,
            startAnimation() {
                if (this.started) return;
                this.started = true;
                this.animateValue('count1', this.target1, 2000);
                this.animateValue('count2', this.target2, 2000);
                this.animateValue('count3', this.target3, 2000);
            },
            animateValue(prop, end, duration) {
                let startTimestamp = null;
                const step = (timestamp) => {
                    if (!startTimestamp) startTimestamp = timestamp;
                    const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                    this[prop] = Math.floor(progress * end);
                    if (progress < 1) {
                        window.requestAnimationFrame(step);
                    }
                };
                window.requestAnimationFrame(step);
            }
        }"
        x-init="
            const observer = new IntersectionObserver(entries => {
                if (entries[0].isIntersecting) {
                    startAnimation();
                }
            }, { threshold: 0.5 });
            observer.observe($el);
        "
    >
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <p class="text-sm font-bold uppercase tracking-[0.2em] text-slate-500 mb-2">Follow Our</p>
            <h2 class="text-4xl md:text-5xl font-black text-industrial-blue uppercase mb-24">Global Footprint</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16">
                <div class="flex flex-col items-center">
                    <div style="font-size: 110px; line-height: 1;" class="font-black text-industrial-blue tracking-tighter mb-6"><span x-text="count1">0</span>+</div>
                    <p class="text-xl text-slate-800 font-bold">Years of Excellence</p>
                    <div class="w-16 h-1 bg-industrial-orange mt-8"></div>
                </div>
                <div class="flex flex-col items-center">
                    <div style="font-size: 110px; line-height: 1;" class="font-black text-industrial-blue tracking-tighter mb-6"><span x-text="count2">0</span>+</div>
                    <p class="text-xl text-slate-800 font-bold">No. of Countries we serve</p>
                    <div class="w-16 h-1 bg-industrial-orange mt-8"></div>
                </div>
                <div class="flex flex-col items-center">
                    <div style="font-size: 110px; line-height: 1;" class="font-black text-industrial-blue tracking-tighter mb-6"><span x-text="count3">0</span>K+</div>
                    <p class="text-xl text-slate-800 font-bold">Products Delivered</p>
                    <div class="w-16 h-1 bg-industrial-orange mt-8"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Range Banner -->
    <section class="bg-slate-100 py-16 border-y border-slate-200 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-2xl md:text-3xl font-black text-industrial-blue uppercase tracking-tight">A RANGE OF OVER 250+ PRODUCTS, PROVIDES COMPRESSED AIR FOR ALL NEEDS</h2>
        </div>
    </section>

    <!-- Products Grid Overview -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 space-y-16">
            <div class="text-center space-y-4">
                <h2 class="text-4xl font-black text-industrial-blue uppercase">OUR FEATURED PRODUCTS</h2>
                <div class="w-24 h-1 bg-industrial-orange mx-auto"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <!-- Product Card 1 -->
                <div class="bg-white border border-slate-100 shadow-lg hover:shadow-2xl transition-shadow rounded-xl overflow-hidden group flex flex-col">
                    <div class="h-64 bg-slate-50 relative p-8 flex items-center justify-center border-b border-slate-100">
                        <img src="https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?auto=format&fit=crop&q=80&w=600" class="object-contain h-full group-hover:scale-105 transition-transform duration-500 mix-blend-multiply" alt="Screw Compressor">
                    </div>
                    <div class="p-8 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-industrial-blue mb-4">2 Stage Screw Air Compressor</h3>
                        <p class="text-sm text-slate-600 mb-6 flex-grow">Super Premium Efficiency system with advanced VFD.</p>
                        <a href="{{ route('products.index') }}" class="text-industrial-orange font-bold uppercase tracking-widest text-sm hover:text-industrial-blue transition-colors">View Range &rarr;</a>
                    </div>
                </div>

                <!-- Product Card 2 -->
                <div class="bg-white border border-slate-100 shadow-lg hover:shadow-2xl transition-shadow rounded-xl overflow-hidden group flex flex-col">
                    <div class="h-64 bg-slate-50 relative p-8 flex items-center justify-center border-b border-slate-100">
                        <img src="https://images.unsplash.com/photo-1504328345606-18bbc8c9d7d1?auto=format&fit=crop&q=80&w=600" class="object-contain h-full group-hover:scale-105 transition-transform duration-500 mix-blend-multiply grayscale" alt="Oil Free Compressor">
                    </div>
                    <div class="p-8 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-industrial-blue mb-4">High Pressure Oil-Free Compressor</h3>
                        <p class="text-sm text-slate-600 mb-6 flex-grow">Get Oil Free air with the best and efficient Balanced Opposed technology.</p>
                        <a href="{{ route('products.index') }}" class="text-industrial-orange font-bold uppercase tracking-widest text-sm hover:text-industrial-blue transition-colors">View Range &rarr;</a>
                    </div>
                </div>

                <!-- Product Card 3 -->
                <div class="bg-white border border-slate-100 shadow-lg hover:shadow-2xl transition-shadow rounded-xl overflow-hidden group flex flex-col">
                    <div class="h-64 bg-slate-50 relative p-8 flex items-center justify-center border-b border-slate-100">
                        <img src="https://images.unsplash.com/photo-1621905252507-b35492cc74b4?auto=format&fit=crop&q=80&w=600" class="object-contain h-full group-hover:scale-105 transition-transform duration-500 mix-blend-multiply" alt="Piston Compressor">
                    </div>
                    <div class="p-8 flex-grow flex flex-col">
                        <h3 class="text-xl font-bold text-industrial-blue mb-4">Piston Air Compressor</h3>
                        <p class="text-sm text-slate-600 mb-6 flex-grow">Rugged, cast-iron construction for heavy-duty applications.</p>
                        <a href="{{ route('products.index') }}" class="text-industrial-orange font-bold uppercase tracking-widest text-sm hover:text-industrial-blue transition-colors">View Range &rarr;</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center pt-8">
                 <a href="{{ route('products.index') }}" class="btn-industrial bg-industrial-blue hover:bg-slate-800">VIEW ALL PRODUCTS</a>
            </div>
        </div>
    </section>
@endsection
