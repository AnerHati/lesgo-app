<template>
  <LesGoLayout
    :title="pageTitle"
    :sidebar-menu="sideNav"
    :active-section="activeSection"
    @navigate="goNav"
  >
    <div class="space-y-6">
      <Beranda v-if="activeSection === 'beranda'" @navigate="goNav" />
      <CariSiswa v-else-if="activeSection === 'cari_siswa'" />
      <Siswa v-else-if="activeSection === 'siswa_saya'" />
      <Kelas v-else-if="activeSection === 'kelas_saya'" />
      <Jadwal v-else-if="activeSection === 'jadwal'" />
      <Keuangan v-else-if="activeSection === 'keuangan'" />
      <Pesan v-else-if="activeSection === 'pesan'" />
      <Ulasan v-else-if="activeSection === 'ulasan'" />
      <Pengaturan v-else-if="activeSection === 'pengaturan'" />

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
  </LesGoLayout>
</template>

<script setup>
import { computed, ref } from 'vue'
import LesGoLayout from '@/Layouts/LesGoLayout.vue'
import Beranda from './Beranda.vue'
import CariSiswa from './CariSiswa.vue'
import Siswa from './Siswa.vue'
import Kelas from './Kelas.vue'
import Jadwal from './Jadwal.vue'
import Keuangan from './Keuangan.vue'
import Pesan from './Pesan.vue'
import Ulasan from './Ulasan.vue'
import Pengaturan from './Pengaturan.vue'

const activeSection = ref('beranda')

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
