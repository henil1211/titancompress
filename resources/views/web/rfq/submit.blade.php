<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Request for Quote | TitanCompress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-50 antialiased font-sans">
    
    <!-- Header -->
    <header class="bg-industrial-blue text-white py-12 text-center relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')]"></div>
        <div class="relative z-10">
            <h1 class="text-4xl font-extrabold tracking-tighter uppercase">REQUEST <span class="text-industrial-orange">TECHNICAL</span> QUOTE</h1>
            <p class="text-slate-400 mt-2 font-bold tracking-widest text-[10px] uppercase">Engineered Reliability for Global Industry</p>
        </div>
    </header>

    <main class="max-w-4xl mx-auto -mt-12 px-4 pb-24 relative z-20">
        <div class="glass-panel p-8 md:p-12 rounded-3xl shadow-2xl bg-white/90 backdrop-blur-xl" x-data="rfqForm()">
            
            <form @submit.prevent="submitForm" class="space-y-12">
                <!-- Step 1: Customer Details -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 border-b border-slate-100 pb-4">
                        <span class="w-8 h-8 rounded-full bg-industrial-orange text-white flex items-center justify-center font-bold">1</span>
                        <h2 class="text-xl font-extrabold tracking-tight uppercase">Corporate Identity</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Full Name</label>
                            <input type="text" x-model="form.customer_name" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Company / Organization</label>
                            <input type="text" x-model="form.company_name" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Business Email</label>
                            <input type="email" x-model="form.email" required class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Phone Number</label>
                            <input type="text" x-model="form.phone" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                        </div>
                    </div>
                </div>

                <!-- Step 2: Technical Requirements -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 border-b border-slate-100 pb-4">
                        <span class="w-8 h-8 rounded-full bg-industrial-blue text-white flex items-center justify-center font-bold">2</span>
                        <h2 class="text-xl font-extrabold tracking-tight uppercase">Technical Matrix</h2>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Required Flow (m3/min)</label>
                            <input type="text" x-model="form.technical_requirements.required_flow" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="e.g. 5.5">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Working Pressure (bar)</label>
                            <input type="text" x-model="form.technical_requirements.required_pressure" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all" placeholder="e.g. 8">
                        </div>
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">Operating Environment</label>
                            <select x-model="form.technical_requirements.environment" class="w-full bg-slate-50 border-slate-200 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                                <option value="standard">Standard Industrial</option>
                                <option value="high_temp">High Temperature</option>
                                <option value="explosive">Explosive (ATEX)</option>
                                <option value="clean_room">Clean Room / Food Grade</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Product Selection -->
                <div class="space-y-8">
                    <div class="flex items-center space-x-4 border-b border-slate-100 pb-4">
                        <span class="w-8 h-8 rounded-full bg-slate-800 text-white flex items-center justify-center font-bold">3</span>
                        <h2 class="text-xl font-extrabold tracking-tight uppercase">System Configuration</h2>
                    </div>

                    <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 space-y-4">
                        @if($selectedProduct)
                            <div class="flex items-center justify-between p-4 bg-white rounded-xl shadow-sm border border-orange-100">
                                <div class="flex items-center space-x-4">
                                    <div class="w-10 h-10 bg-industrial-orange/10 rounded flex items-center justify-center text-industrial-orange">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-slate-800">{{ $selectedProduct->name }}</p>
                                        <p class="text-[10px] text-slate-400 font-mono">{{ $selectedProduct->sku }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-[10px] font-bold text-slate-400 uppercase">Qty</span>
                                    <input type="number" x-model="form.items[0].quantity" class="w-16 bg-slate-50 border-slate-200 rounded-lg px-2 py-1 text-sm font-bold">
                                </div>
                            </div>
                        @else
                            <p class="text-sm text-slate-500 italic">No specific system selected. Our engineers will recommend the best fit based on your technical matrix.</p>
                        @endif
                    </div>
                </div>

                <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                    <p class="text-[10px] text-slate-400 uppercase tracking-widest max-w-sm">
                        By submitting this request, you agree to our industrial data processing terms. A technical specialist will review your matrix.
                    </p>
                    <button type="submit" 
                            :disabled="loading"
                            class="btn-industrial py-4 px-12 shadow-xl shadow-orange-500/30 flex items-center space-x-3 disabled:opacity-50">
                        <span x-show="!loading">INITIALIZE QUOTE REQUEST</span>
                        <span x-show="loading" class="flex items-center space-x-2">
                            <svg class="animate-spin h-5 w-5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span>PROCESSING MATRIX...</span>
                        </span>
                    </button>
                </div>
            </form>

            <!-- Success Overlay -->
            <div x-show="success" x-cloak class="absolute inset-0 bg-white/95 backdrop-blur rounded-3xl flex items-center justify-center text-center p-12 z-50">
                <div class="space-y-6">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h3 class="text-3xl font-extrabold tracking-tighter uppercase">TRANSMISSION <span class="text-green-600">SUCCESSFUL</span></h3>
                    <p class="text-slate-600 max-w-md mx-auto" x-text="message"></p>
                    <a href="/" class="inline-block text-industrial-blue font-bold border-b-2 border-industrial-orange mt-8 hover:text-industrial-orange transition-all">RETURN TO OPERATIONS</a>
                </div>
            </div>
        </div>
    </main>

    <script>
    function rfqForm() {
        return {
            loading: false,
            success: false,
            message: '',
            form: {
                customer_name: '',
                company_name: '',
                email: '',
                phone: '',
                technical_requirements: {
                    required_flow: '',
                    required_pressure: '',
                    environment: 'standard'
                },
                items: [
                    { 
                        product_id: '{{ $selectedProduct->id ?? '' }}', 
                        product_name: '{{ $selectedProduct->name ?? 'General Inquiry' }}',
                        quantity: 1 
                    }
                ]
            },
            async submitForm() {
                this.loading = true;
                try {
                    const response = await fetch('{{ route('rfq.submit') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(this.form)
                    });
                    const data = await response.json();
                    if (data.success) {
                        this.success = true;
                        this.message = data.message;
                    }
                } catch (e) {
                    alert('Communication error with HQ servers. Please try again.');
                } finally {
                    this.loading = false;
                }
            }
        }
    }
    </script>
</body>
</html>
