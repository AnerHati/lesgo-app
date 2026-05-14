<template>
  <div class="animate-fade-in space-y-8 pb-12">
    <!-- Hero Section with Points & Progress -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
      <div class="lg:col-span-8 bg-gradient-to-br from-[#10B981] via-[#3B82F6] to-[#6366F1] rounded-[40px] p-10 flex justify-between items-center text-white relative overflow-hidden shadow-2xl shadow-blue-500/20">
        <!-- Decorative Elements -->
        <div class="absolute -right-20 -top-20 w-80 h-80 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-20 -bottom-20 w-60 h-60 bg-emerald-400/20 rounded-full blur-2xl"></div>

        <div class="z-10 w-full md:max-w-md">
          <h2 class="text-4xl font-black mb-2 leading-tight">Halo, {{ user?.name?.split(' ')[0] || 'Siswa' }}! 🔥</h2>
          <p class="text-blue-50 font-medium mb-8 text-sm opacity-90">Terus belajar dan raih lencana prestasimu hari ini.</p>
          
          <!-- Points & Next Badge Progress -->
          <div class="bg-white/15 backdrop-blur-xl rounded-[32px] p-6 border border-white/20 shadow-inner mb-6">
            <div class="flex justify-between items-end mb-4">
              <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-yellow-400 rounded-2xl flex items-center justify-center text-2xl shadow-lg shadow-yellow-500/30 animate-bounce-slow">
                  💎
                </div>
                <div>
                  <p class="text-[10px] font-black uppercase tracking-widest text-blue-100">Learning Points</p>
                  <p class="text-3xl font-black leading-none">{{ totalPoints || 0 }}</p>
                </div>
              </div>
              <div v-if="nextBadge" class="text-right">
                <p class="text-[10px] font-black uppercase tracking-widest text-blue-100 mb-1">Lencana Berikutnya</p>
                <div class="flex items-center gap-2 justify-end">
                   <span class="text-xs font-bold">{{ nextBadge.name }}</span>
                   <span class="text-lg">{{ nextBadge.icon_path }}</span>
                </div>
              </div>
            </div>

            <!-- Progress Bar to Next Badge -->
            <div v-if="nextBadge" class="space-y-2">
              <div class="flex justify-between text-[10px] font-black uppercase tracking-wider text-blue-50/70">
                <span>{{ progressToNextBadge }}% Menuju Target</span>
                <span>{{ totalPoints }} / {{ nextBadge.required_points }} XP</span>
              </div>
              <div class="h-3 rounded-full bg-black/20 overflow-hidden border border-white/10 p-[2px]">
                <div 
                  class="h-full rounded-full bg-gradient-to-r from-yellow-300 via-emerald-300 to-white transition-all duration-1000 ease-out relative"
                  :style="{ width: `${progressToNextBadge}%` }"
                >
                  <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                </div>
              </div>
            </div>
            <div v-else class="text-xs font-bold text-center py-2 text-yellow-300">
               ⭐ Kamu telah meraih semua lencana! Luar biasa!
            </div>
          </div>

          <button @click="$emit('navigate', 'kelas')" class="bg-white text-blue-600 px-8 py-3.5 rounded-2xl font-black text-sm shadow-xl hover:bg-blue-50 transition-all transform hover:scale-105 active:scale-95 flex items-center gap-2">
            Mulai Belajar
            <span class="text-lg">🚀</span>
          </button>
        </div>

        <div class="absolute right-12 bottom-0 w-64 h-64 opacity-20 lg:opacity-100 pointer-events-none transition-all duration-700 hidden sm:block">
           <img src="https://cdni.iconscout.com/illustration/premium/thumb/student-getting-award-illustration-download-in-svg-png-gif-formats--graduation-trophy-winner-educational-pack-school-education-illustrations-5386053.png" class="w-full h-full object-contain filter drop-shadow-2xl" />
        </div>
      </div>

      <!-- Lencana Saya Section (Duolingo Style) -->
      <div class="lg:col-span-4 bg-white rounded-[40px] p-8 border border-gray-100 shadow-xl shadow-blue-500/5 flex flex-col">
        <div class="flex justify-between items-center mb-8">
          <h3 class="font-black text-gray-900 text-lg flex items-center gap-2">
            <span class="text-2xl">🏆</span> Lencana Saya
          </h3>
          <span class="text-[10px] font-black bg-emerald-50 text-emerald-600 px-3 py-1 rounded-full uppercase">{{ badges?.length || 0 }} Diraih</span>
        </div>

        <div class="flex-1 overflow-y-auto pr-2 custom-scrollbar">
          <div v-if="badges && badges.length > 0" class="grid grid-cols-2 gap-6">
            <div v-for="badge in badges" :key="badge.id" class="flex flex-col items-center group">
              <div class="relative">
                <div class="w-20 h-20 rounded-[24px] bg-gradient-to-b from-gray-50 to-gray-100 border-b-4 border-gray-200 flex items-center justify-center text-4xl shadow-inner group-hover:from-yellow-50 group-hover:to-yellow-100 group-hover:border-yellow-200 transition-all duration-300 transform group-hover:-translate-y-1">
                  {{ badge.icon_path }}
                </div>
                <!-- Sparkle effect on hover -->
                <div class="absolute -top-1 -right-1 w-6 h-6 bg-yellow-400 rounded-full flex items-center justify-center text-[10px] opacity-0 group-hover:opacity-100 transition-opacity animate-pulse shadow-lg">✨</div>
              </div>
              <p class="text-[10px] font-black text-gray-800 mt-3 text-center leading-tight uppercase tracking-tighter">{{ badge.name }}</p>
            </div>
          </div>
          
          <div v-else class="h-full flex flex-col items-center justify-center text-center py-10 opacity-30">
            <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center text-5xl mb-4 grayscale">🔒</div>
            <p class="text-sm font-black text-gray-900">Belum Ada Lencana</p>
            <p class="text-[10px] text-gray-500 mt-1 font-medium">Selesaikan kuis untuk mendapatkan lencana pertamamu!</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Rest of the dashboard (Jadwal, Tugas, etc.) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
       <!-- Jadwal Section -->
       <div class="lg:col-span-6 bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm">
          <div class="flex justify-between items-center mb-6">
             <h3 class="font-black text-gray-800 flex items-center gap-2">📅 Jadwal Mendatang</h3>
             <button class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</button>
          </div>
          <div v-if="jadwal?.length" class="space-y-4">
             <div v-for="j in jadwal" :key="j.id" class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50/50 border border-transparent hover:border-blue-100 hover:bg-white transition-all group">
                <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">{{ j.study_class?.subject?.icon || '📚' }}</div>
                <div class="flex-1">
                   <h4 class="text-sm font-black text-gray-900">{{ j.study_class?.subject?.name }}</h4>
                   <p class="text-[11px] text-gray-500 font-bold uppercase tracking-wider">{{ formatWaktu(j.start_time) }}</p>
                </div>
                <button class="bg-blue-600 text-white p-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity">
                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
             </div>
          </div>
          <div v-else class="py-8 text-center text-gray-400">
             <p class="text-sm font-medium italic">Tidak ada jadwal terdekat.</p>
          </div>
       </div>

       <!-- Tugas Section -->
       <div class="lg:col-span-6 bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm">
          <div class="flex justify-between items-center mb-6">
             <h3 class="font-black text-gray-800 flex items-center gap-2">📝 Tugas Pending</h3>
             <button class="text-xs font-bold text-blue-600 hover:underline">Lihat Semua</button>
          </div>
          <div v-if="tugas?.length" class="space-y-4">
             <div v-for="t in tugas" :key="t.id" class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50/50 border border-transparent hover:border-orange-100 hover:bg-white transition-all group">
                <div class="w-12 h-12 rounded-xl bg-white shadow-sm flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">📄</div>
                <div class="flex-1">
                   <h4 class="text-sm font-black text-gray-900">{{ t.title }}</h4>
                   <p class="text-[11px] text-orange-500 font-bold uppercase tracking-wider">Tenggat: {{ waktuSingkat(t.deadline) }}</p>
                </div>
                <div class="text-[10px] font-black text-gray-400 uppercase tracking-widest">{{ t.study_class?.subject?.name }}</div>
             </div>
          </div>
          <div v-else class="py-8 text-center text-gray-400">
             <p class="text-sm font-medium italic">Semua tugas telah selesai! 🎉</p>
          </div>
       </div>
    </div>
  </div>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  jadwal: { type: Array, default: () => [] },
  tugas: { type: Array, default: () => [] },
  progres: { type: Array, default: () => [] },
  user: { type: Object, default: () => ({}) },
  totalPoints: { type: Number, default: 0 },
  badges: { type: Array, default: () => [] },
  nextBadge: { type: Object, default: null }
})

defineEmits(['navigate'])

// Kalkulasi Progres ke Lencana Berikutnya
const progressToNextBadge = computed(() => {
  if (!props.nextBadge || props.totalPoints === 0) return 0;
  
  // Mencari lencana sebelumnya (opsional, untuk start point)
  // Tapi untuk simpelnya kita hitung dari 0 ke required_points
  const percentage = (props.totalPoints / props.nextBadge.required_points) * 100;
  return Math.min(Math.round(percentage), 100);
})

// Helper format tanggal
const formatWaktu = (dateString) => {
    if(!dateString) return '';
    return new Date(dateString).toLocaleDateString('id-ID', { weekday: 'long', hour: '2-digit', minute: '2-digit' });
}

// Helper format tanggal singkat
const waktuSingkat = (dateString) => {
    if(!dateString) return '';
    return new Date(dateString).toLocaleDateString('id-ID', { day: 'numeric', month: 'short' });
}
</script>

<style scoped>
.animate-bounce-slow {
  animation: bounce 3s infinite;
}

@keyframes bounce {
  0%, 100% { transform: translateY(-5%); animation-timing-function: cubic-bezier(0.8, 0, 1, 1); }
  50% { transform: translateY(0); animation-timing-function: cubic-bezier(0, 0, 0.2, 1); }
}

.custom-scrollbar::-webkit-scrollbar {
  width: 4px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #E2E8F0;
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #CBD5E1;
}
</style>
