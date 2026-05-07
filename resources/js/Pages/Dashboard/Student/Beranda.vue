<template>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
          <div class="lg:col-span-8 bg-gradient-to-r from-[#0EA5E9] to-[#3B82F6] rounded-[32px] p-10 flex justify-between items-center text-white relative overflow-hidden animate-fade-in">
            <!-- Decorative Orbs -->
            <div class="hero-orb-1"></div>
            <div class="hero-orb-2"></div>
            <div class="z-10 max-w-md">
              <h2 class="text-4xl font-black mb-3">Halo, {{ user?.name || 'siswa' }}! <br> Siap belajar hari ini?</h2>
              <p class="text-blue-50 font-medium mb-8 text-sm opacity-90">Pilih pelajaranmu atau tutor terbaik untuk mulai belajar.</p>
              <button type="button" class="group bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 px-8 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 transition-all duration-300 hover:shadow-lg hover:shadow-blue-500/30 active:scale-95 focus:ring-2 focus:ring-blue-100 outline-none">
                Lihat Materi
                <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform">→</span>
              </button>
            </div>
            <div class="absolute right-10 bottom-0 w-48 h-48 opacity-90 hidden sm:block animate-float">
               <span class="text-[120px]">👧🏽</span>
            </div>
          </div>

          <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-in-delay-1">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">🔔 Notifikasi</h3>
              <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition focus:outline-none focus:underline">Lihat Semua</a>
            </div>
            <div class="space-y-6">
              <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-50 to-indigo-50 shadow-inner text-blue-600 rounded-xl flex items-center justify-center text-lg shrink-0">📁</div>
                <div>
                  <p class="text-[13px] font-bold text-gray-800 leading-tight">Tugas Baru</p>
                  <p class="text-[11px] text-gray-500 mt-1">Tutor Rian menambahkan tugas baru untuk kamu</p>
                  <p class="text-[10px] text-blue-500 font-bold mt-1">2 menit lalu</p>
                </div>
              </div>
              <div class="flex gap-4 items-start">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-50 to-indigo-50 shadow-inner text-blue-600 rounded-xl flex items-center justify-center text-lg shrink-0">📖</div>
                <div>
                  <p class="text-[13px] font-bold text-gray-800 leading-tight">Pengumpulan Tugas</p>
                  <p class="text-[11px] text-gray-500 mt-1">Kumpulkan tugas Bahasa Indonesia hari ini!</p>
                  <p class="text-[10px] text-blue-500 font-bold mt-1">2 jam lalu</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
          <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📖 Jadwal Hari Ini</h3>
              <a href="#" class="text-xs text-gray-400 font-bold focus:outline-none focus:underline">Lihat Semua</a>
            </div>
            <div v-if="jadwal.length > 0" class="space-y-4">
              <div v-for="j in jadwal" :key="j.id" class="flex items-center gap-4 p-3 bg-white rounded-2xl hover:bg-gray-50 border border-gray-50 transition">
                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center text-lg shrink-0">{{ j.study_class.subject.icon }}</div>
                <div>
                  <h4 class="text-[13px] font-bold text-[#3B82F6] leading-none mb-1">{{ j.study_class.subject.name }}</h4>
                  <p class="text-[11px] text-gray-500 font-medium">Tutor {{ j.study_class.tutor.name }}</p>
                  <p class="text-[10px] text-gray-400 mt-0.5">{{ formatWaktu(j.start_time) }}</p>
                </div>
              </div>
            </div>
            <div v-else class="flex-1 flex flex-col items-center justify-center py-6 text-center">
              <span class="text-4xl mb-3 opacity-80">😴</span>
              <p class="text-sm font-bold text-gray-700">Belum ada jadwal</p>
              <p class="text-[11px] text-gray-500 mt-1">Kamu bisa bersantai hari ini!</p>
            </div>
          </div>

          <div class="lg:col-span-3 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up-delay-1">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📓 Tugas</h3>
              <a href="#" class="text-xs text-gray-400 font-bold focus:outline-none focus:underline">Lihat Semua</a>
            </div>
            <div v-if="tugas.length > 0" class="space-y-5">
              <div v-for="t in tugas" :key="t.id" class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-lg shrink-0">{{ t.study_class.subject.icon }}</div>
                <div>
                  <h4 class="text-[13px] font-bold text-gray-800 leading-none mb-1">{{ t.study_class.subject.name }}</h4>
                  <p class="text-[10px] text-gray-500 font-medium">{{ t.title }}</p>
                  <p class="text-[10px] text-gray-400 mt-1 font-bold italic">Tenggat: {{ waktuSingkat(t.deadline) }}</p>
                </div>
              </div>
            </div>
            <div v-else class="flex-1 flex flex-col items-center justify-center py-6 text-center">
              <span class="text-4xl mb-3 opacity-80">🎉</span>
              <p class="text-sm font-bold text-gray-700">Bebas tugas!</p>
              <p class="text-[11px] text-gray-500 mt-1">Tidak ada tugas yang menunggu.</p>
            </div>
          </div>

          <div class="lg:col-span-5 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-slide-up-delay-2">
             <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">📅 Februari 2026</h3>
                <div class="flex gap-2">
                   <button class="w-6 h-6 border rounded-md text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-100">‹</button>
                   <button class="w-6 h-6 border rounded-md text-gray-400 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-100">›</button>
                </div>
             </div>
             <div class="grid grid-cols-7 text-center text-[10px] text-gray-400 font-bold mb-4 uppercase">
                <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
             </div>
             <div class="grid grid-cols-7 text-center gap-y-2">
                <div v-for="day in 28" :key="day" :class="day === 15 ? 'bg-blue-500 text-white rounded-full' : 'text-gray-500 hover:bg-gray-50 rounded-full'" class="py-2 text-[11px] font-bold cursor-pointer">
                   {{ day }}
                </div>
             </div>
          </div>
        </div>

        <section class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 animate-fade-in-delay-3">
          <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-gray-900 flex items-center gap-2">📊 Progres</h3>
            <a href="#" @click.prevent="goNav('progres')" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
          </div>
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div
              v-for="p in progres"
              :key="p.id"
              class="rounded-2xl border border-gray-100 bg-[#FAFBFC] p-5 hover:shadow-lg hover:shadow-blue-500/5 hover:-translate-y-1 transition-all duration-300 cursor-pointer"
            >
              <h4 class="text-sm font-bold text-[#3B82F6] leading-tight">{{ p.subject.name }}</h4>
              <p class="text-[11px] text-gray-500 mt-1">Tutor {{ p.tutor.name }}</p>
              <div class="mt-4">
                <div class="flex justify-between items-center text-[11px] font-bold text-gray-600 mb-1.5">
                  <span>Progres</span>
                  <span>{{ p.progress_percentage }}%</span>
                </div>
                <div class="h-2 rounded-full bg-gray-200 overflow-hidden">
                  <div
                    class="h-full rounded-full bg-gradient-to-r from-[#3B82F6] to-[#0EA5E9] transition-all progress-shine"
                    :style="{ width: `${p.progress_percentage}%` }"
                  />
                </div>
              </div>
            </div>
          </div>
        </section>

</template>

<script setup>
const props = defineProps({
  jadwal: Array,
  tugas: Array,
  progres: Array,
  user: Object
})

defineEmits(['navigate'])

// Helper format tanggal
const formatWaktu = (dateString) => {
    if(!dateString) return '';
    return new Date(dateString).toLocaleDateString('id-ID', { weekday: 'long', hour: '2-digit', minute: '2-digit' }).replace(' pukul', ',');
}

// Helper format tanggal singkat untuk tugas
const waktuSingkat = (dateString) => {
    if(!dateString) return '';
    return new Date(dateString).toLocaleDateString('id-ID', {day: 'numeric', month: 'short'});
}
</script>
