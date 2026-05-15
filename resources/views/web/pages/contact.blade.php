@extends('layouts.web')

@section('title', 'Contact Us | TitanCompress')

@section('content')
    <!-- Page Header -->
    <div class="bg-industrial-blue py-16 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl md:text-5xl font-black text-white uppercase tracking-tight">Contact Us</h1>
            <div class="w-16 h-1 bg-industrial-orange mx-auto mt-6"></div>
        </div>
    </div>

    <!-- Main Content -->
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Contact Info -->
            <div class="space-y-10">
                <div>
                    <h2 class="text-3xl font-black text-industrial-blue uppercase mb-4">Get In Touch</h2>
                    <p class="text-slate-600">
                        Have a question about our products or need technical support? Our team of experts is ready to assist you.
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-industrial-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-industrial-blue uppercase">Corporate Office & Works</h4>
                            <p class="text-slate-600 mt-1">TitanCompress Equipments Ltd.<br>Plot No. 45, Industrial Zone Phase 2,<br>Ahmedabad, Gujarat, India - 380015</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-industrial-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-industrial-blue uppercase">Phone</h4>
                            <p class="text-slate-600 mt-1">+91 98765 43210 <br> +91 79 2233 4455</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center shrink-0 mr-4">
                            <svg class="w-6 h-6 text-industrial-orange" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-industrial-blue uppercase">Email</h4>
                            <p class="text-slate-600 mt-1">sales@titancompress.com <br> support@titancompress.com</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-slate-50 p-8 border border-slate-100 rounded-xl shadow-sm">
                <h3 class="text-2xl font-black text-industrial-blue uppercase mb-6">Send a Message</h3>
                
                @if(session('success'))
                    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center">
                        <svg class="w-5 h-5 mr-3 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-bold text-sm">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Full Name</label>
                        <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-industrial-orange focus:border-industrial-orange outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Email Address</label>
                        <input type="email" class="w-full px-4 py-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-industrial-orange focus:border-industrial-orange outline-none" required>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Phone Number</label>
                        <input type="text" class="w-full px-4 py-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-industrial-orange focus:border-industrial-orange outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-1">Message</label>
                        <textarea rows="4" class="w-full px-4 py-2 border border-slate-300 rounded-md focus:ring-2 focus:ring-industrial-orange focus:border-industrial-orange outline-none" required></textarea>
                    </div>
                    <div class="pt-2">
                        <button type="submit" class="btn-industrial w-full text-center">SEND MESSAGE</button>
                    </div>
                </form>
            </div>

        </div>
    </section>
@endsection
