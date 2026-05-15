<div x-data="chatbot()" class="fixed bottom-8 right-8 z-[100]">
    <!-- Toggle Button -->
    <button @click="open = !open" class="w-16 h-16 bg-industrial-orange text-white rounded-full shadow-2xl flex items-center justify-center hover:scale-110 transition-transform relative z-10">
        <svg x-show="!open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
        </svg>
        <svg x-show="open" class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Chat Window -->
    <div x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-10 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         class="fixed bottom-28 left-4 right-4 sm:absolute sm:bottom-20 sm:left-auto sm:right-0 sm:w-[400px] glass-panel rounded-2xl overflow-hidden flex flex-col shadow-2xl h-[550px] max-h-[80vh] z-50">
        
        <!-- Header -->
        <div class="bg-industrial-blue p-4 text-white shrink-0">
            <h4 class="font-bold tracking-tighter">TITAN AI ASSISTANT</h4>
            <p class="text-[10px] text-slate-300 uppercase tracking-widest font-semibold">Industrial Intelligence Platform</p>
        </div>

        <!-- Messages & Options -->
        <div class="flex-1 p-4 overflow-y-auto bg-white flex flex-col gap-4 custom-scrollbar" id="chat-messages">
            <template x-for="msg in messages" :key="msg.id">
                <div class="w-full flex" :class="msg.role === 'user' ? 'justify-end' : 'justify-start items-end'">
                    <!-- Bot Avatar -->
                    <template x-if="msg.role === 'assistant'">
                        <div class="w-6 h-6 rounded-full bg-industrial-blue shrink-0 flex items-center justify-center mr-2 mb-1 shadow-sm">
                            <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                    </template>
                    
                    <div :class="msg.role === 'user' ? 'bg-slate-800 text-white rounded-2xl rounded-br-sm' : 'bg-slate-50 text-slate-800 border border-slate-100 rounded-2xl rounded-bl-sm'" 
                         class="inline-block p-3.5 text-[13px] shadow-sm max-w-[85%] leading-relaxed">
                        <span x-text="msg.content"></span>
                    </div>
                </div>
            </template>
            
            <div x-show="loading" class="w-full flex justify-start items-end">
                <div class="w-6 h-6 rounded-full bg-industrial-blue shrink-0 flex items-center justify-center mr-2 mb-1 shadow-sm">
                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                <div class="bg-slate-50 border border-slate-100 p-3 rounded-2xl rounded-bl-sm shadow-sm inline-block">
                    <div class="flex space-x-1">
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce"></div>
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></div>
                        <div class="w-1.5 h-1.5 bg-slate-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></div>
                    </div>
                </div>
            </div>

            <!-- Quick Options -->
            <div class="flex flex-col gap-2 mt-2 pt-2 border-t border-slate-50">
                <template x-for="(question, index) in predefinedQuestions" :key="index">
                    <button @click="sendPredefined(question)" :disabled="loading"
                            class="w-full p-3 bg-white hover:bg-slate-50 border border-slate-200 shadow-sm text-slate-700 text-xs font-bold rounded-xl transition-all disabled:opacity-50 text-left flex items-center justify-between group">
                        <span x-text="question" class="flex-1"></span>
                        <svg class="w-4 h-4 text-slate-400 group-hover:text-industrial-orange transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                    </button>
                </template>
            </div>
        </div>
    </div>
</div>

<style>
.custom-scrollbar::-webkit-scrollbar {
    width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
    background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
    background: #e2e8f0;
    border-radius: 4px;
}
.custom-scrollbar:hover::-webkit-scrollbar-thumb {
    background: #cbd5e1;
}
</style>

<script>
function chatbot() {
    return {
        open: false,
        loading: false,
        predefinedQuestions: [
            "Tell me about the Titan-X 500",
            "Piston vs Screw Compressors?",
            "Do you have Oil-Free models?",
            "How can I compare systems?",
            "Request a formal price quote"
        ],
        messages: [
            { id: 1, role: 'assistant', content: 'Welcome to TitanCompress. How can I assist you with our industrial solutions today? Please select an option below.' }
        ],
        async sendPredefined(query) {
            if (this.loading) return;
            
            const userMsg = { id: Date.now(), role: 'user', content: query };
            this.messages.push(userMsg);
            this.loading = true;

            try {
                const response = await fetch('{{ route('ai.chat') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ message: query })
                });
                
                const data = await response.json();
                this.messages.push({ id: Date.now() + 1, role: 'assistant', content: data.answer });
            } catch (error) {
                this.messages.push({ id: Date.now() + 1, role: 'assistant', content: 'Error connecting to AI engine.' });
            } finally {
                this.loading = false;
                this.$nextTick(() => {
                    const el = document.getElementById('chat-messages');
                    el.scrollTop = el.scrollHeight;
                });
            }
        }
    }
}
</script>
