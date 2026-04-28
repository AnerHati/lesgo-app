<template>
  <LesGoLayout
    :title="pageTitle"
    :sidebar-menu="sideNav"
    :active-section="activeSection"
    @navigate="goNav"
  >
    <div class="space-y-6">
      <Beranda v-if="activeSection === 'beranda'" @navigate="goNav" />
      <Kelas v-else-if="activeSection === 'kelas'" :japanese-class-data="japaneseClassData" />
      <Tugas v-else-if="activeSection === 'tugas'" />
      <Tutor v-else-if="activeSection === 'tutor'" @navigate="goNav" />
      <CariTutor v-else-if="activeSection === 'cari'" @navigate="goNav" />
      <Pesan v-else-if="activeSection === 'pesan'" @navigate="goNav" />
      <Progres v-else-if="activeSection === 'progres'" />
      <Pengaturan v-else-if="activeSection === 'pengaturan'" />
    </div>
  </LesGoLayout>
</template>

<script setup>
import { computed, ref } from 'vue'
import LesGoLayout from '@/Layouts/LesGoLayout.vue'
import Beranda from './Beranda.vue'
import Kelas from './Kelas.vue'
import Tugas from './Tugas.vue'
import Tutor from './Tutor.vue'
import CariTutor from './CariTutor.vue'
import Pesan from './Pesan.vue'
import Progres from './Progres.vue'
import Pengaturan from './Pengaturan.vue'

const props = defineProps({
  japaneseClassData: { type: Object, default: null },
})

const activeSection = ref('beranda')

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
