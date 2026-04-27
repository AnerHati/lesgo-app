<template>
  <Head :title="pageTitle" />

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
        <button @click="isMobileMenuOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600 focus:outline-none rounded-lg p-1 focus:ring-2 focus:ring-blue-100">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      </div>

      <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
        <button
          v-for="item in sideNav"
          :key="item.id"
          type="button"
          class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left transition-all duration-200 focus:ring-2 focus:ring-blue-100 outline-none"
          :class="activeSection === item.id
            ? 'bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold shadow-md shadow-blue-500/20'
            : 'text-gray-500 hover:bg-gray-50 font-medium hover:translate-x-1'"
          @click="goNav(item.id); isMobileMenuOpen = false"
        >
          <span class="text-lg leading-none w-6 text-center shrink-0" v-html="item.icon"></span>
          <span>{{ item.name }}</span>
        </button>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col overflow-hidden w-full relative">

      <!-- Header -->
      <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md px-4 lg:px-8 py-4 flex items-center justify-between border-b border-gray-100/50">
        <div class="flex items-center gap-4 flex-1">
          <button @click="isMobileMenuOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-lg p-1 shrink-0">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>
          
          <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-xl px-4 py-2 shadow-sm cursor-pointer hover:bg-gray-50 transition">
             <div class="w-6 h-6 bg-orange-200 rounded-full flex items-center justify-center text-xs overflow-hidden">
                👦🏽
             </div>
             <span class="text-sm font-bold text-gray-800">Kenzo <span class="text-gray-500 font-medium">(SD)</span></span>
             <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
          </div>
        </div>

        <div class="flex items-center gap-3 ml-4 lg:ml-6 shrink-0">
          <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-900">Sarah Ambarawati</p>
            <p class="text-[10px] text-gray-500 font-medium tracking-wider">Orang Tua</p>
          </div>
          <div class="w-10 h-10 bg-green-100 rounded-full ring-4 ring-white shadow-sm overflow-hidden flex items-center justify-center shrink-0">
             <img src="https://ui-avatars.com/api/?name=Sarah+Ambarawati&background=dcfce7&color=166534&size=80" alt="Sarah Ambarawati" class="w-full h-full object-cover">
          </div>
        </div>
      </header>

      <!-- Content Area -->
      <div class="flex-1 overflow-y-auto p-4 lg:p-8 space-y-6">

        <ParentBeranda v-if="activeSection === 'beranda'" @navigate="goNav" />
        <ParentCariTutor v-else-if="activeSection === 'cari_tutor'" @navigate="goNav" />
        <ParentTutorSaya v-else-if="activeSection === 'tutor_saya'" @navigate="goNav" />
        <ParentProgresAnak v-else-if="activeSection === 'progres_anak'" @navigate="goNav" />
        <ParentKelasAnak v-else-if="activeSection === 'kelas_anak'" @navigate="goNav" />
        <template v-else>
           <div class="flex-1 flex items-center justify-center text-gray-400 font-medium h-[60vh]">
              Menu {{ activeSection }} sedang dalam pengembangan.
           </div>
        </template>
      </div>
    </main>
  </div>
</template>




<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';
import ParentBeranda from './parent/ParentBeranda.vue';
import ParentCariTutor from './parent/ParentCariTutor.vue';
import ParentTutorSaya from './parent/ParentTutorSaya.vue';
import ParentProgresAnak from './parent/ParentProgresAnak.vue';
import ParentKelasAnak from './parent/ParentKelasAnak.vue';

defineProps({
  pageTitle: {
    type: String,
    default: 'Dashboard Orang Tua - LesGo',
  },
});

const isMobileMenuOpen = ref(false);
const activeSection = ref('beranda');
const goNav = (id) => {
  activeSection.value = id;
};

// Sidebar Navigation
const sideNav = ref([
  { id: 'beranda', name: 'Beranda', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>' },
  { id: 'cari_tutor', name: 'Cari Tutor', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>' },
  { id: 'tutor_saya', name: 'Tutor Saya', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' },
  { id: 'progres_anak', name: 'Progres Anak', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>' },
  { id: 'kelas_anak', name: 'Kelas Anak', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>' },
  { id: 'jadwal', name: 'Jadwal', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>' },
  { id: 'pembayaran', name: 'Pembayaran', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>' },
  { id: 'pesan', name: 'Pesan', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>' },
  { id: 'pengaturan', name: 'Pengaturan', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>' }
]);
</script>

<style scoped>
/* Keyframes for subtle animations, similar to Student/Tutor view */
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(10px); }
  to { opacity: 1; transform: translateY(0); }
}

.animate-fade-in {
  animation: fadeIn 0.6s ease-out forwards;
}

@keyframes float {
  0%, 100% { transform: translateY(0); }
  50% { transform: translateY(-10px); }
}
.animate-float {
  animation: float 4s ease-in-out infinite;
}

/* Custom scrollbar */
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
