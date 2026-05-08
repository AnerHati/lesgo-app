<script setup>
import { ref, computed } from 'vue'
import { Head, router, usePage } from '@inertiajs/vue3'

const page = usePage()
const user = computed(() => page.props.auth.user)

const props = defineProps({
    title: String,
    sidebarMenu: { type: Array, required: true },
    activeSection: { type: String, required: true }
})

const emit = defineEmits(['navigate'])

const isMobileMenuOpen = ref(false)

function handleNavigate(id) {
    emit('navigate', id)
    isMobileMenuOpen.value = false
}

function handleLogout() {
    router.post(route('logout'))
}
</script>

<template>
    <Head :title="title" />

    <div class="flex h-screen bg-slate-50 font-sans overflow-hidden relative">
        
        <!-- Mobile Sidebar Overlay -->
        <div 
            v-if="isMobileMenuOpen" 
            class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden" 
            @click="isMobileMenuOpen = false"
        ></div>

        <!-- Sidebar -->
        <aside 
            :class="[
                'fixed inset-y-0 left-0 z-50 w-64 bg-white flex flex-col border-r border-gray-100 shrink-0 transition-transform duration-300 lg:relative lg:translate-x-0',
                isMobileMenuOpen ? 'translate-x-0' : '-translate-x-full'
            ]"
        >
            <div class="p-6 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="text-green-500 text-3xl">🌱</div>
                    <div>
                        <h1 class="text-xl font-extrabold text-[#10B981] leading-none">LesGo</h1>
                        <p class="text-[9px] text-gray-400 font-medium">Digital Tutoring Ecosystem</p>
                    </div>
                </div>
                <button @click="isMobileMenuOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600 focus:outline-none rounded-lg p-1">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                <button
                    v-for="item in sidebarMenu"
                    :key="item.id"
                    type="button"
                    class="w-full flex items-center gap-3 px-4 py-3 rounded-[14px] text-left transition-all duration-200 outline-none"
                    :class="activeSection === item.id
                        ? 'bg-[#3B82F6] text-white font-bold shadow-md shadow-blue-500/20'
                        : 'text-gray-500 hover:bg-gray-50 font-medium hover:translate-x-1'"
                    @click="handleNavigate(item.id)"
                >
                    <span class="text-lg leading-none w-6 text-center shrink-0" v-html="item.icon"></span>
                    <span class="flex-1 text-left">{{ item.name }}</span>
                    <span v-if="item.id === 'pesan' && $page.props.unreadSendersCount > 0" class="bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full shrink-0">
                        {{ $page.props.unreadSendersCount }}
                    </span>
                </button>
            </nav>

            <!-- Bottom Logout (Optional but pro) -->
            <div class="p-4 border-t border-gray-50">
                <button @click="handleLogout" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left text-red-500 hover:bg-red-50 transition-all duration-200 font-medium">
                    <span class="text-lg w-6 text-center shrink-0">🚪</span>
                    <span>Keluar</span>
                </button>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden w-full relative">
            
            <!-- Header -->
            <header class="sticky top-0 z-40 bg-white px-4 lg:px-8 py-4 flex items-center justify-between border-b border-gray-100 shadow-sm">
                <div class="flex items-center gap-6 flex-1">
                    <button @click="isMobileMenuOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-lg p-1 shrink-0">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    
                    <div class="flex-1 relative hidden sm:block">
                        <slot name="header-left" />
                    </div>
                </div>

                <div class="flex items-center gap-4 ml-4 lg:ml-6 shrink-0">
                    <div class="text-right hidden sm:block leading-tight">
                        <p class="text-[14px] font-bold text-gray-800">{{ user?.name ?? 'User' }}</p>
                        <p class="text-[12px] text-gray-400 font-medium capitalize">{{ user?.active_role ?? 'Siswa' }}</p>
                    </div>
                    <div class="w-12 h-12 rounded-full border-2 border-white shadow-sm overflow-hidden flex items-center justify-center bg-gradient-to-br from-blue-400 to-emerald-400 shrink-0">
                        <img v-if="user?.profile_photo_path" :src="user.profile_photo_path" class="w-full h-full object-cover" />
                        <span v-else class="text-white font-bold text-lg">{{ user?.name?.charAt(0)?.toUpperCase() ?? 'U' }}</span>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-4 lg:p-8">
                <slot />
            </div>

        </main>
    </div>
</template>

<style scoped>
/* Scrollbar Styling */
::-webkit-scrollbar {
    width: 6px;
    height: 6px;
}
::-webkit-scrollbar-track {
    background: transparent;
}
::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}
::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}
</style>
