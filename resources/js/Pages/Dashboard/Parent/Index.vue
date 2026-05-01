<template>
  <LesGoLayout
    :title="pageTitle"
    :sidebar-menu="sideNav"
    :active-section="activeSection"
    @navigate="goNav"
  >
    <!-- Child Selection Bar (Specific to Parent) -->
    <div class="mb-6 flex items-center gap-3 bg-white border border-gray-200 rounded-xl px-4 py-2 shadow-sm cursor-pointer hover:bg-gray-50 transition w-fit">
        <div class="w-6 h-6 bg-orange-200 rounded-full flex items-center justify-center text-xs overflow-hidden">
            👦🏽
        </div>
        <span class="text-sm font-bold text-gray-800">Kenzo <span class="text-gray-500 font-medium">(SD)</span></span>
        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
    </div>

    <div class="space-y-6">
      <Beranda v-if="activeSection === 'beranda'" @navigate="goNav" />
      <CariTutor v-else-if="activeSection === 'cari_tutor'" @navigate="goNav" />
      <TutorAnak v-else-if="activeSection === 'tutor_saya'" @navigate="goNav" />
      <ProgresAnak v-else-if="activeSection === 'progres_anak'" @navigate="goNav" />
      <KelasAnak v-else-if="activeSection === 'kelas_anak'" @navigate="goNav" />
      <ParentDetailKelasAnak v-else-if="activeSection === 'detail_kelas_anak'" @navigate="goNav" />
      <ParentKelasSaya v-else-if="activeSection === 'jadwal'" @navigate="goNav" />
      <Pesan v-else-if="activeSection === 'pesan'" @navigate="goNav" />
      <Pengaturan v-else-if="activeSection === 'pengaturan'" @navigate="goNav" />
      <template v-else>
          <div class="flex-1 flex items-center justify-center text-gray-400 font-medium h-[40vh]">
            Menu {{ activeSection }} sedang dalam pengembangan.
          </div>
      </template>
    </div>
  </LesGoLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import LesGoLayout from '@/Layouts/LesGoLayout.vue'
import Beranda from './Beranda.vue';
import CariTutor from './CariTutor.vue';
import TutorAnak from './TutorAnak.vue';
import ProgresAnak from './ProgresAnak.vue';
import KelasAnak from './KelasAnak.vue';
import ParentDetailKelasAnak from './ParentDetailKelasAnak.vue';
import ParentKelasSaya from './ParentKelasSaya.vue';
import Pesan from './Pesan.vue';
import Pengaturan from './Pengaturan.vue';

const props = defineProps({
  pageTitle: {
    type: String,
    default: 'Dashboard Orang Tua - LesGo',
  },
});

const activeSection = ref('beranda');

const goNav = (id) => {
  activeSection.value = id;
};

// Sidebar Navigation
const sideNav = [
  { id: 'beranda', name: 'Beranda', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>' },
  { id: 'cari_tutor', name: 'Cari Tutor', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>' },
  { id: 'tutor_saya', name: 'Tutor Saya', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' },
  { id: 'progres_anak', name: 'Progres Anak', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>' },
  { id: 'kelas_anak', name: 'Kelas Anak', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>' },
  { id: 'jadwal', name: 'Jadwal', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>' },
  { id: 'pembayaran', name: 'Pembayaran', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>' },
  { id: 'pesan', name: 'Pesan', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>' },
  { id: 'pengaturan', name: 'Pengaturan', icon: '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>' }
];

const pageTitle = computed(() => {
    return 'Dashboard Orang Tua - LesGo'
});
</script>
