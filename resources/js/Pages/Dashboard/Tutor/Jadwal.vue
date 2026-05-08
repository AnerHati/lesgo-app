<template>
<div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">Jadwal Saya</h2>
              <p class="text-gray-500 font-medium text-sm">Kelola semua sesi mengajarmu dengan mudah.</p>
            </div>

            <!-- Tabs -->
            <div class="flex items-center gap-2">
              <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1">
                <button v-for="tab in jadwalTabs" :key="tab.id" type="button"
                  class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
                  :class="jadwalFilter === tab.id ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                  @click="jadwalFilter = tab.id"
                >{{ tab.label }}</button>
              </div>
              <button type="button" class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
              </button>
            </div>

            <!-- Schedule Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <article v-for="j in filteredJadwal" :key="j.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
                <div class="flex items-start gap-4 mb-4">
                  <div class="w-14 h-14 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 shadow-inner">
                    <img :src="`https://ui-avatars.com/api/?name=${j.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
                  </div>
                  <div class="flex-1 min-w-0">
                    <h3 class="text-base font-black text-[#2563EB] leading-tight">{{ j.name }}</h3>
                    <p class="text-xs font-bold text-gray-500 mt-0.5">{{ j.mapel }}</p>
                    <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1.5 text-[10px] text-gray-400 font-semibold">
                      <span>🎓 {{ j.jenjang }}</span>
                      <span>📍 {{ j.lokasi }}</span>
                      <span>📅 {{ j.jadwal }}</span>
                    </div>
                  </div>
                </div>
                <div class="mb-4">
                  <div class="flex justify-between text-[11px] font-bold mb-1.5">
                    <span class="text-gray-500">Progress</span>
                    <span class="text-gray-600">{{ j.progress }}/4</span>
                  </div>
                  <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
                    <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine transition-all" :style="{ width: `${(j.progress / 4) * 100}%` }"></div>
                  </div>
                </div>
                <div class="flex justify-end">
                  <button type="button" class="px-8 py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm">Detail</button>
                </div>
              </article>
            </div>

            <div v-if="filteredJadwal.length === 0" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-12 text-center">
              <span class="text-5xl mb-3 block">📅</span>
              <p class="text-lg font-bold text-gray-700">Tidak ada jadwal</p>
              <p class="text-sm text-gray-500 mt-1">Belum ada jadwal mengajar untuk periode ini.</p>
</div>
</div>
</template>

<script setup>
import { computed, ref } from 'vue'

const props = defineProps({
  semuaJadwal: { type: Array, default: () => [] },
  kelasAktif: { type: Array, default: () => [] }
})

const jadwalFilter = ref('hari_ini')
const jadwalTabs = [
  { id: 'hari_ini', label: 'Hari Ini' }, 
  { id: 'besok', label: 'Besok' }, 
  { id: 'mendatang', label: 'Mendatang' }
]

// Memformat data asli dari database agar sesuai persis dengan desain HTML
const formattedJadwal = computed(() => {
  return props.semuaJadwal.map(jadwal => {
    const classData = jadwal.study_class;
    const student = classData?.student;
    const profile = student?.student_profile;
    
    // Tentukan kategori tab (Hari Ini / Besok / Mendatang)
    const start = new Date(jadwal.start_time);
    const today = new Date();
    const tomorrow = new Date();
    tomorrow.setDate(today.getDate() + 1);
    
    let dayCategory = 'mendatang';
    if (start.toDateString() === today.toDateString()) {
      dayCategory = 'hari_ini';
    } else if (start.toDateString() === tomorrow.toDateString()) {
      dayCategory = 'besok';
    }
    
    // Format Hari & Jam (Misal: "Senin, 15:00-16:30")
    const hari = start.toLocaleDateString('id-ID', { weekday: 'long' });
    const jamMulai = start.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    const jamSelesai = new Date(jadwal.end_time).toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
    
    return {
      id: jadwal.id,
      name: student ? student.name : 'Siswa',
      mapel: classData?.subject?.name || 'Mata Pelajaran',
      jenjang: profile?.grade_level || 'SD/SMP/SMA',
      lokasi: classData?.learning_method === 'offline' ? (student?.address || 'Alamat Siswa') : 'Online',
      jadwal: `${hari}, ${jamMulai}-${jamSelesai}`,
      progress: 1, // Progress simulasi
      day: dayCategory
    };
  });
});

const filteredJadwal = computed(() => formattedJadwal.value.filter(j => j.day === jadwalFilter.value))
</script>

