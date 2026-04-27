<template>
  <Head :title="pageTitle" />

  <div class="flex h-screen bg-slate-50 font-sans overflow-hidden relative">

    <div v-if="isMobileMenuOpen" class="fixed inset-0 bg-gray-900/50 z-40 lg:hidden" @click="isMobileMenuOpen = false"></div>

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
        <button @click="isMobileMenuOpen = false" class="lg:hidden text-gray-400 hover:text-gray-600 rounded-lg p-1">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
      </div>

      <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
        <button
          v-for="item in sideNav" :key="item.id" type="button"
          class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-left transition-all duration-200 outline-none"
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
          <button @click="isMobileMenuOpen = true" class="lg:hidden text-gray-500 hover:text-gray-700 rounded-lg p-1 shrink-0">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
          </button>
          <div class="flex-1 max-w-2xl relative hidden sm:block">
            <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">🔍</span>
            <input type="text" placeholder="Cari siswa" class="w-full bg-[#F3F4F6] border-none rounded-xl py-3 pl-12 pr-4 text-sm focus:ring-2 focus:ring-blue-100 outline-none">
          </div>
        </div>
        <div class="flex items-center gap-3 ml-4 lg:ml-6 shrink-0">
          <div class="text-right hidden sm:block">
            <p class="text-sm font-bold text-gray-900">Isyana Randini</p>
            <p class="text-[10px] text-gray-500 font-medium uppercase tracking-wider">Tutor</p>
          </div>
          <div class="w-10 h-10 bg-blue-100 rounded-full ring-4 ring-white shadow-sm overflow-hidden flex items-center justify-center shrink-0">
            <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=dbeafe&color=2563eb" alt="Avatar" class="w-full h-full object-cover">
          </div>
        </div>
      </header>

      <div class="flex-1 overflow-y-auto p-4 lg:p-8 space-y-6">

        <TutorBeranda v-if="activeSection === 'beranda'" @navigate="goNav" />
        <TutorCariSiswa v-else-if="activeSection === 'cari_siswa'" />
        <TutorSiswaSaya v-else-if="activeSection === 'siswa_saya'" />
        <TutorKelasSaya v-else-if="activeSection === 'kelas_saya'" />
        <TutorJadwal v-else-if="activeSection === 'jadwal'" />
        <TutorKeuangan v-else-if="activeSection === 'keuangan'" />
        <TutorPesan v-else-if="activeSection === 'pesan'" />
        <TutorUlasan v-else-if="activeSection === 'ulasan'" />
        <TutorPengaturan v-else-if="activeSection === 'pengaturan'" />

        <!-- Placeholder -->
        <template v-else>
          <div class="max-w-6xl mx-auto w-full animate-fade-in">
            <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-8">
              <h2 class="text-4xl font-black text-gray-900">{{ pageTitle }}</h2>
              <p class="text-sm text-gray-600 mt-2">Halaman ini sedang dalam pengembangan.</p>
            </section>
          </div>
        </template>

      </div>
    </main>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue'
import { Head } from '@inertiajs/vue3'
import TutorBeranda from './tutor/TutorBeranda.vue'
import TutorCariSiswa from './tutor/TutorCariSiswa.vue'
import TutorSiswaSaya from './tutor/TutorSiswaSaya.vue'
import TutorKelasSaya from './tutor/TutorKelasSaya.vue'
import TutorJadwal from './tutor/TutorJadwal.vue'
import TutorKeuangan from './tutor/TutorKeuangan.vue'
import TutorPesan from './tutor/TutorPesan.vue'
import TutorUlasan from './tutor/TutorUlasan.vue'
import TutorPengaturan from './tutor/TutorPengaturan.vue'

const activeSection = ref('beranda')
const isMobileMenuOpen = ref(false)

const sideNav = [
  { id: 'beranda', name: 'Beranda', icon: '▦' },
  { id: 'cari_siswa', name: 'Cari Siswa', icon: '🔍' },
  { id: 'siswa_saya', name: 'Siswa Saya', icon: '👥' },
  { id: 'kelas_saya', name: 'Kelas Saya', icon: '🎓' },
  { id: 'jadwal', name: 'Jadwal', icon: '📅' },
  { id: 'keuangan', name: 'Keuangan', icon: '💰' },
  { id: 'pesan', name: 'Pesan', icon: '✉️' },
  { id: 'ulasan', name: 'Ulasan', icon: '⭐' },
  { id: 'pengaturan', name: 'Pengaturan', icon: '⚙️' },
]

const sectionTitles = {
  beranda: 'Beranda Tutor', cari_siswa: 'Cari Siswa', siswa_saya: 'Siswa Saya',
  kelas_saya: 'Kelas Saya', jadwal: 'Jadwal', keuangan: 'Keuangan',
  pesan: 'Pesan', ulasan: 'Ulasan', pengaturan: 'Pengaturan',
}

const pageTitle = computed(() => sectionTitles[activeSection.value] || 'Beranda Tutor')

function goNav(id) {
  activeSection.value = id
}
</script>
