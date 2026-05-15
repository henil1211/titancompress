<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login | TitanCompress</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-industrial-blue min-h-screen flex items-center justify-center p-6 overflow-hidden relative">
    
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-industrial-orange/10 blur-[120px] rounded-full -translate-y-1/2 translate-x-1/2"></div>
    <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-blue-600/10 blur-[120px] rounded-full translate-y-1/2 -translate-x-1/2"></div>

    <div class="w-full max-w-md relative z-10">
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-white tracking-tighter">TITAN<span class="text-industrial-orange">ADMIN</span></h1>
            <p class="text-slate-400 mt-2 uppercase text-[10px] tracking-[0.3em]">Authorized Access Only</p>
        </div>

        <div class="glass-panel p-10 rounded-3xl border-white/10 shadow-2xl">
            <form action="{{ route('admin.login') }}" method="POST" class="space-y-6">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Email Address</label>
                    <input type="email" name="email" required value="{{ old('email') }}"
                           class="w-full bg-slate-800/50 border-white/5 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-industrial-orange transition-all placeholder-slate-600"
                           placeholder="admin@titancompress.com">
                    @error('email')
                        <p class="text-red-500 text-xs mt-2 font-bold">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-widest">Password</label>
                        <a href="#" class="text-[10px] text-industrial-orange hover:underline uppercase tracking-tighter">Forgot?</a>
                    </div>
                    <input type="password" name="password" required
                           class="w-full bg-slate-800/50 border-white/5 rounded-xl px-4 py-3 text-white focus:ring-2 focus:ring-industrial-orange transition-all"
                           placeholder="••••••••">
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="remember" id="remember" class="w-4 h-4 rounded bg-slate-800 border-white/10 text-industrial-orange focus:ring-industrial-orange">
                    <label for="remember" class="ml-2 text-xs text-slate-400 font-medium">Keep me signed in for 30 days</label>
                </div>

                <button type="submit" class="w-full btn-industrial py-4 text-sm tracking-widest">
                    SECURE SIGN IN
                </button>
            </form>
        </div>
        
        <p class="text-center mt-8 text-slate-500 text-[10px] uppercase tracking-widest">
            &copy; 2026 Titan Engineering Group
        </p>
    </div>

</body>
</html>
