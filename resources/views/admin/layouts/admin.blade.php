<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TitanAdmin | Industrial Dashboard</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] { display: none !important; }
        .sidebar-item-active {
            @apply bg-industrial-orange text-white shadow-lg shadow-orange-500/20;
        }
    </style>
</head>
<body class="bg-[#f8fafc] font-sans antialiased text-slate-900" x-data="{ sidebarOpen: true }">
    
    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside 
            class="fixed inset-y-0 left-0 z-50 w-72 bg-industrial-blue text-white transition-transform duration-300 transform lg:static lg:inset-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:hidden'"
        >
            <div class="flex flex-col h-full">
                <!-- Sidebar Header -->
                <div class="p-6 flex items-center justify-between border-b border-white/10">
                    <span class="text-xl font-extrabold tracking-tighter">TITAN<span class="text-industrial-orange">ADMIN</span></span>
                    <button @click="sidebarOpen = false" class="lg:hidden text-slate-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
                    <x-admin.sidebar-item icon="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" label="Dashboard" route="admin.dashboard" />
                    <x-admin.sidebar-item icon="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" label="Products" route="admin.products.index" />
                    <x-admin.sidebar-item icon="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" label="RFQs" route="admin.rfqs.index" />
                    <x-admin.sidebar-item icon="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" label="AI Assistant" route="admin.knowledge.index" />
                    
                    <div class="pt-8 pb-2">
                        <p class="px-4 text-[10px] font-bold text-slate-500 uppercase tracking-[0.2em]">System</p>
                    </div>
                    <x-admin.sidebar-item icon="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" label="Analytics" route="admin.analytics.index" />
                </nav>

                <!-- Sidebar Footer -->
                <div class="p-6 bg-slate-900/50">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 rounded-full bg-industrial-orange flex items-center justify-center font-bold">
                            {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold truncate">{{ Auth::user()->name ?? 'Admin' }}</p>
                            <p class="text-xs text-slate-500 truncate">Super Admin</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 relative overflow-y-auto focus:outline-none bg-slate-50">
            <!-- Top Navbar -->
            <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 sticky top-0 z-40">
                <div class="px-6 py-4 flex items-center justify-between">
                    <button @click="sidebarOpen = true" class="lg:hidden p-2 text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    
                    <div class="flex-1 px-4">
                        <div class="relative w-full max-w-md">
                            <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </span>
                            <input type="text" placeholder="Global search..." class="w-full bg-slate-100 border-none rounded-lg pl-10 pr-4 py-2 text-sm focus:ring-2 focus:ring-industrial-orange transition-all">
                        </div>
                    </div>

                    <div class="flex items-center space-x-4">
                        <button class="p-2 text-slate-500 hover:text-industrial-orange transition-colors relative">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                            <span class="absolute top-2 right-2 w-2 h-2 bg-red-500 rounded-full border-2 border-white"></span>
                        </button>
                        
                        <div class="relative" x-data="{ userMenuOpen: false }">
                            <button @click="userMenuOpen = !userMenuOpen" class="flex items-center space-x-2 p-1 rounded-lg hover:bg-slate-100 transition-colors">
                                <div class="w-8 h-8 rounded bg-slate-200 flex items-center justify-center">
                                     <svg class="w-5 h-5 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                </div>
                            </button>
                            <div x-show="userMenuOpen" @click.away="userMenuOpen = false" x-cloak class="absolute right-0 mt-2 w-48 glass-panel rounded-xl py-2 z-50">
                                <a href="#" class="block px-4 py-2 text-sm hover:bg-slate-50">Profile Settings</a>
                                <div class="border-t border-slate-100 my-1"></div>
                                <form action="{{ route('admin.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">Sign Out</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <div class="p-8">
                {{ $slot }}
            </div>
        </main>
    </div>

    <!-- Toast Container -->
    <div x-data="{ toasts: [] }" 
         @toast.window="toasts.push($event.detail); setTimeout(() => toasts.shift(), 3000)"
         class="fixed bottom-8 right-8 z-[100] space-y-2">
        <template x-for="toast in toasts" :key="toast.id">
            <div class="glass-panel p-4 rounded-xl flex items-center space-x-3 border-l-4 border-industrial-orange animate-reveal">
                <div class="flex-1 text-sm font-bold" x-text="toast.message"></div>
            </div>
        </template>
    </div>

</body>
</html>
