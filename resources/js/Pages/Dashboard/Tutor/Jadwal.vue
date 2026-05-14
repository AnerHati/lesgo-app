<template>
<div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">Jadwal Saya</h2>
              <p class="text-gray-500 font-medium text-sm">Kelola semua sesi mengajarmu dengan mudah.</p>
            </div>

            <!-- Tabs & Date Filter -->
            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
              <div class="flex items-center gap-2 overflow-x-auto pb-2 sm:pb-0">
                <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 shrink-0">
                  <button v-for="tab in jadwalTabs" :key="tab.id" type="button"
                    class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
                    :class="(jadwalFilter === tab.id && !selectedDate) ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
                    @click="jadwalFilter = tab.id; selectedDate = ''"
                  >{{ tab.label }}</button>
                </div>
              </div>

              <div class="flex items-center gap-2 shrink-0">
                <input 
                  type="date" 
                  v-model="selectedDate" 
                  class="px-4 py-2.5 rounded-xl border border-gray-200 bg-white text-sm font-bold text-gray-700 outline-none focus:border-[#2563EB] focus:ring-2 focus:ring-blue-100 transition shadow-sm"
                >
                <button 
                  v-if="selectedDate" 
                  @click="selectedDate = ''" 
                  type="button" 
                  class="w-11 h-11 shrink-0 rounded-xl border border-red-100 bg-red-50 text-red-500 hover:bg-red-100 flex items-center justify-center shadow-sm transition" 
                  title="Reset Filter Tanggal"
                >
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
              </div>
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
const selectedDate = ref('')
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
    
    // Format rawDate YYYY-MM-DD untuk filter kalender
    const year = start.getFullYear();
    const month = String(start.getMonth() + 1).padStart(2, '0');
    const day = String(start.getDate()).padStart(2, '0');
    const rawDate = `${year}-${month}-${day}`;
    
    return {
      id: jadwal.id,
      name: student ? student.name : 'Siswa',
      mapel: classData?.subject?.name || 'Mata Pelajaran',
      jenjang: profile?.grade_level || 'SD/SMP/SMA',
      lokasi: classData?.learning_method === 'offline' ? (student?.address || 'Alamat Siswa') : 'Online',
      jadwal: `${hari}, ${jamMulai}-${jamSelesai}`,
      progress: 1, // Progress simulasi
      day: dayCategory,
      rawDate: rawDate
    };
  });
});

const filteredJadwal = computed(() => {
  if (selectedDate.value) {
    return formattedJadwal.value.filter(j => j.rawDate === selectedDate.value);
  }
  return formattedJadwal.value.filter(j => j.day === jadwalFilter.value);
})
</script>

