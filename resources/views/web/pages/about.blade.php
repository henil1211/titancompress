@extends('layouts.web')

@section('title', 'About Us | TitanCompress')

@section('content')
    <!-- Page Header -->
    <div class="bg-industrial-blue py-16 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight">About Us</h1>
            <div class="w-16 h-1 bg-industrial-orange mx-auto mt-6"></div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6 lg:px-12 space-y-8 text-slate-600 text-lg leading-relaxed text-justify">
            <h2 class="text-3xl font-black text-industrial-blue uppercase text-center mb-12">TITANCOMPRESS EQUIPMENTS LTD.</h2>
            
            <p>
                TitanCompress Equipments Limited, established in 1985 is an ISO 9001:2015 Company, which designs and manufactures the most reliable energy efficient wide range of Air Compressors with a vision to provide Compressed Air Solutions to Everyone, Everywhere.
            </p>
            
            <p>
                We have expanded our state-of-the-art manufacturing facility to an area of 40,000 sq. meter at our Industrial Zone in Ahmedabad, Gujarat, India. Our facilities are equipped with the latest CNC machining centers and advanced testing laboratories to ensure that every unit meets strict global quality standards.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 my-12">
                <div class="bg-slate-50 p-8 border border-slate-100 rounded-lg">
                    <h3 class="text-xl font-bold text-industrial-blue uppercase mb-4 text-center">Our Vision</h3>
                    <p class="text-base text-center">
                        To be the global leader in providing innovative, energy-efficient, and sustainable compressed air solutions that empower industries to achieve peak performance.
                    </p>
                </div>
                <div class="bg-slate-50 p-8 border border-slate-100 rounded-lg">
                    <h3 class="text-xl font-bold text-industrial-blue uppercase mb-4 text-center">Our Mission</h3>
                    <p class="text-base text-center">
                        To engineer highly reliable air compressors utilizing advanced technologies, ensuring maximum uptime and reducing total cost of ownership for our customers.
                    </p>
                </div>
            </div>

            <p>
                With a product range of over 250+ variants, TitanCompress provides comprehensive air solutions for industries including PET Blowing, Textiles, Pharmaceuticals, Healthcare, Engineering, and Food Packaging. Our dedicated R&D team continuously innovates to meet the evolving demands of Industry 4.0.
            </p>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-16 bg-slate-100 border-t border-slate-200">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div class="space-y-2">
                <span class="block text-4xl font-black text-industrial-blue">40+</span>
                <span class="block text-sm font-bold text-slate-500 uppercase tracking-widest">Years of Experience</span>
            </div>
            <div class="space-y-2">
                <span class="block text-4xl font-black text-industrial-blue">250+</span>
                <span class="block text-sm font-bold text-slate-500 uppercase tracking-widest">Products</span>
            </div>
            <div class="space-y-2">
                <span class="block text-4xl font-black text-industrial-blue">15,000+</span>
                <span class="block text-sm font-bold text-slate-500 uppercase tracking-widest">Happy Clients</span>
            </div>
            <div class="space-y-2">
                <span class="block text-4xl font-black text-industrial-blue">25+</span>
                <span class="block text-sm font-bold text-slate-500 uppercase tracking-widest">Countries Exported</span>
            </div>
        </div>
    </section>
@endsection
