<template>
  <div class="max-w-6xl mx-auto w-full space-y-6">
    <!-- Header Banner -->
    <section class="bg-[#e0f2fe] rounded-xl border border-blue-100 p-8">
      <h2 class="text-4xl font-black text-gray-900">Progres Saya</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium">Pantau kemajuan belajarmu dan lihat hasil evaluasi untuk mengetahui perkembanganmu, Kenzo!</p>
      <p class="text-sm text-gray-700 font-medium">Selesaikan progresmu, ya!</p>
    </section>

    <!-- Filter -->
    <div class="flex justify-end mb-4">
      <div class="inline-flex items-center bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
        <button class="px-4 py-2 text-sm font-bold text-gray-700 hover:bg-gray-50 transition border-r border-gray-200">Semua Mata Pelajaran</button>
        <button class="px-3 py-2 text-gray-500 hover:bg-gray-50 transition">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
        </button>
      </div>
    </div>

    <!-- Grid Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <div v-for="p in progres" :key="p.id" class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm flex flex-col justify-between hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 hover:border-blue-100 transition-all duration-300">
        <div class="flex items-start gap-4 mb-6">
          <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-50 to-indigo-50 flex items-center justify-center text-3xl shrink-0 shadow-inner">{{ p.icon }}</div>
          <div>
            <h3 class="text-xl font-black text-[#2563EB] mb-1">{{ p.subject }}</h3>
            <p class="text-sm font-bold text-gray-600">{{ p.topic }}</p>
            <p class="text-xs font-medium text-gray-500 mt-1 flex items-center gap-1">
              <span class="text-gray-400">👤</span> Tutor {{ p.tutor }}
            </p>
          </div>
        </div>
        
        <div>
          <p class="text-xs font-bold text-gray-700 mb-2">Rata-Rata Evaluasi: <span class="text-[#2563EB]">{{ p.eval }}</span></p>
          <div class="flex items-center gap-3">
            <div class="flex-1 h-2 rounded-full bg-gray-100 overflow-hidden">
              <div class="h-full rounded-full bg-[#2563EB]" :style="{ width: `${p.percent}%` }"></div>
            </div>
            <span class="text-[10px] font-bold text-[#2563EB] w-6 text-right">{{ p.percent }}%</span>
</div>
</div>
</div>
</div>
</div>
</template>

<script setup>
const progres = [
  { id: 1, subject: 'Matematika', topic: 'Transformasi Geometri', tutor: 'Isyana Randini', schedule: 'Senin, 15:00', percent: 15, eval: 84, icon: '📐' },
  { id: 2, subject: 'Bahasa Jepang', topic: 'Huruf Hiragana', tutor: 'Renata', schedule: 'Rabu, 10:00', percent: 65, eval: 84, icon: '🇯🇵' },
  { id: 3, subject: 'Bahasa Inggris', topic: 'Simple Present Tense', tutor: 'Jhon Doe', schedule: 'Jumat, 16:00', percent: 40, eval: 84, icon: '🇬🇧' },
  { id: 4, subject: 'Bahasa Indonesia', topic: 'Paragraf Deduktif', tutor: 'Jonathan', schedule: 'Kamis, 14:00', percent: 95, eval: 84, icon: '🇮🇩' },
  { id: 5, subject: 'Matematika', topic: 'Transformasi Geometri', tutor: 'Isyana Randini', schedule: 'Senin, 15:00', percent: 15, eval: 84, icon: '📐' },
  { id: 6, subject: 'Bahasa Jepang', topic: 'Huruf Hiragana', tutor: 'Renata', schedule: 'Rabu, 10:00', percent: 65, eval: 84, icon: '🇯🇵' },
  { id: 7, subject: 'Bahasa Inggris', topic: 'Simple Present Tense', tutor: 'Jhon Doe', schedule: 'Jumat, 16:00', percent: 40, eval: 84, icon: '🇬🇧' },
  { id: 8, subject: 'Bahasa Indonesia', topic: 'Paragraf Deduktif', tutor: 'Jonathan', schedule: 'Kamis, 14:00', percent: 95, eval: 84, icon: '🇮🇩' },
]
</script>
