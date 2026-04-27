<template>
  <Head :title="pageTitle" />

  <div class="flex h-screen bg-slate-50 font-sans overflow-hidden relative">

    <!-- Mobile Sidebar Overlay -->
    <div 
      v-if="isMobileMenuOpen" 
      class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden" 
      @click="isMobileMenuOpen = false"
    ></div>

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
          <span class="text-lg leading-none w-6 text-center shrink-0">{{ item.icon }}</span>
          <span>{{ item.name }}</span>
        </button>
      </nav>
    </aside>

    <main class="flex-1 flex flex-col overflow-hidden w-full relative">

      <header class="sticky top-0 z-40 bg-white/80 backdrop-blur-md px-4 lg:px-8 py-4 flex items-center justify-between border-b border-gray-100/50">
        <div class="flex items-center gap-4 flex-1">
          <button @click="isMobileMenuOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-100 rounded-lg p-1 shrink-0">
             <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>
          
          <div class="flex-1 max-w-2xl relative hidden sm:block">
            <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">🔍</span>
            <input type="text" placeholder="Cari tutor / mata pelajaran" class="w-full bg-[#F3F4F6] border-none rounded-xl py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-100 outline-none">
          </div>
        </div>

        <div class="flex items-center gap-3 ml-4 lg:ml-6 shrink-0">
          <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-900">Kenzo Aliza</p>
            <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">Siswa</p>
          </div>
          <div class="w-10 h-10 bg-orange-200 rounded-full ring-4 ring-white shadow-sm overflow-hidden flex items-center justify-center shrink-0">
            👦🏽
          </div>
        </div>
      </header>

      <div class="flex-1 overflow-y-auto p-4 lg:p-8 space-y-6">

        <StudentBeranda v-if="activeSection === 'beranda'" @navigate="goNav" />
        <StudentKelas v-else-if="activeSection === 'kelas'" :japanese-class-data="japaneseClassData" />
        <StudentTugas v-else-if="activeSection === 'tugas'" />
        <StudentTutor v-else-if="activeSection === 'tutor'" @navigate="goNav" />
        <StudentCariTutor v-else-if="activeSection === 'cari'" @navigate="goNav" />
        <StudentPesan v-else-if="activeSection === 'pesan'" @navigate="goNav" />
        <StudentProgres v-else-if="activeSection === 'progres'" />
        <StudentPengaturan v-else-if="activeSection === 'pengaturan'" />

      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import StudentBeranda from './student/StudentBeranda.vue'
import StudentKelas from './student/StudentKelas.vue'
import StudentTugas from './student/StudentTugas.vue'
import StudentTutor from './student/StudentTutor.vue'
import StudentCariTutor from './student/StudentCariTutor.vue'
import StudentPesan from './student/StudentPesan.vue'
import StudentProgres from './student/StudentProgres.vue'
import StudentPengaturan from './student/StudentPengaturan.vue'

const props = defineProps({
  japaneseClassData: { type: Object, default: null },
})

const activeSection = ref('beranda')
const isMobileMenuOpen = ref(false)

const sideNav = [
  { id: 'beranda', name: 'Beranda', icon: '▦' },
  { id: 'kelas', name: 'Kelas Saya', icon: '🎓' },
  { id: 'tugas', name: 'Tugas Saya', icon: '📝' },
  { id: 'tutor', name: 'Tutor Saya', icon: '👤' },
  { id: 'cari', name: 'Cari Tutor', icon: '🔍' },
  { id: 'progres', name: 'Progres', icon: '📊' },
  { id: 'pesan', name: 'Pesan', icon: '✉️' },
  { id: 'pengaturan', name: 'Pengaturan', icon: '⚙️' },
]

function goNav(id) {
  activeSection.value = id
}

const pageTitle = computed(() => {
  const titles = {
    kelas: 'Kelas Saya', tugas: 'Tugas Saya', tutor: 'Tutor Saya',
    cari: 'Cari Tutor', pesan: 'Pesan', progres: 'Progres Saya', pengaturan: 'Pengaturan',
  }
  return titles[activeSection.value] || 'Beranda Siswa'
})
</script>
