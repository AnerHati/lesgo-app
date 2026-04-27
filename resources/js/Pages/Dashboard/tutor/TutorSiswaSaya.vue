<template>
<div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
  <div>
    <h2 class="text-3xl font-black text-gray-900 mb-2">Siswa Saya</h2>
    <p class="text-gray-500 font-medium text-sm">Lihat siswa yang sudah mengkonfirmasi dan chat siswa.</p>
  </div>

  <!-- Tabs -->
  <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 w-fit">
    <button v-for="tab in siswaSayaTabs" :key="tab.id" type="button"
      class="px-6 py-2.5 rounded-lg text-sm font-bold transition"
      :class="siswaSayaFilter === tab.id ? 'bg-[#2563EB] text-white shadow-sm' : 'text-gray-600 hover:text-gray-800'"
      @click="siswaSayaFilter = tab.id"
    >{{ tab.label }}</button>
  </div>

  <!-- Cards Grid -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <article v-for="s in filteredSiswaSaya" :key="s.id" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 hover:shadow-md hover:-translate-y-1 transition-all duration-300">
      <div class="flex items-start gap-4 mb-4">
        <div class="w-14 h-14 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 shadow-inner">
          <img :src="`https://ui-avatars.com/api/?name=${s.name.replace(' ','+')}&background=eff6ff&color=2563eb&size=128`" class="w-full h-full object-cover">
        </div>
        <div class="flex-1 min-w-0">
          <h3 class="text-base font-black text-[#2563EB] leading-tight">{{ s.name }}</h3>
          <p class="text-xs font-bold text-gray-500 mt-0.5">{{ s.mapel }}</p>
          <div class="flex flex-wrap gap-x-4 gap-y-1 mt-1.5 text-[10px] text-gray-400 font-semibold">
            <span>🎓 {{ s.jenjang }}</span>
            <span>📍 {{ s.lokasi }}</span>
            <span>📅 {{ s.jadwal }}</span>
          </div>
        </div>
      </div>

      <!-- Confirmed: progress + Chat/Detail -->
      <template v-if="s.status === 'confirmed'">
        <div class="mb-4">
          <div class="flex justify-between text-[11px] font-bold mb-1.5">
            <span class="text-gray-500">Progress</span>
            <span class="text-gray-600">{{ s.progress }}/4</span>
          </div>
          <div class="h-2 rounded-full bg-gray-100 overflow-hidden">
            <div class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] progress-shine transition-all" :style="{ width: `${(s.progress / 4) * 100}%` }"></div>
          </div>
        </div>
        <div class="flex gap-3">
          <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition text-center">Chat</button>
          <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 transition shadow-sm text-center">Detail</button>
        </div>
      </template>

      <!-- Pending: expiry warning + Terima/Tolak -->
      <template v-else>
        <div class="flex items-center gap-2 mb-4 px-3 py-2 bg-red-50 border border-red-100 rounded-xl">
          <span class="text-red-500 text-base">⚠️</span>
          <p class="text-[11px] text-red-600 font-bold">Permintaan : konfirmasikan sebelum {{ s.expiry || '24 menit' }}</p>
        </div>
        <div class="flex gap-3">
          <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold bg-[#10B981] text-white hover:bg-emerald-600 transition shadow-sm text-center">Terima</button>
          <button type="button" class="flex-1 py-2.5 rounded-xl text-sm font-bold bg-red-500 text-white hover:bg-red-600 transition shadow-sm text-center">Tolak</button>
        </div>
      </template>
    </article>
  </div>
</div>
</template>

<script setup>
import { computed, ref } from 'vue'
const siswaSayaFilter = ref('terkonfirmasi')
const siswaSayaTabs = [{ id: 'terkonfirmasi', label: 'Terkonfirmasi' }, { id: 'menunggu', label: 'Menunggu' }]
const siswaSayaItems = [
  { id: 1, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 2, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 7:00-8:00', progress: 2, status: 'confirmed' },
  { id: 3, name: 'Natasha', mapel: 'Fisika', jenjang: 'SMA', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 4, name: 'Ananta Aldora', mapel: 'Bahasa Inggris', jenjang: 'SMA', lokasi: 'Tukad Badung, no 12', jadwal: 'Senin, 17:00-18:00', progress: 2, status: 'confirmed' },
  { id: 9, name: 'Kenzo Aliza', mapel: 'Matematika', jenjang: 'SD', lokasi: 'Tukad Badung, no 0', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
  { id: 10, name: 'Eka Savitry', mapel: 'Informatika', jenjang: 'SMP', lokasi: 'Online', jadwal: 'Senin, 17:00-18:00', progress: 0, status: 'pending', expiry: '24 menit' },
]
const filteredSiswaSaya = computed(() => {
  if (siswaSayaFilter.value === 'menunggu') return siswaSayaItems.filter(s => s.status === 'pending')
  return siswaSayaItems.filter(s => s.status === 'confirmed')
})
</script>
