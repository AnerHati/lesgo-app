<template>
  <div class="max-w-6xl mx-auto w-full animate-fade-in space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-cyan-50 to-blue-100 rounded-[24px] p-8 border border-blue-100/50 shadow-sm relative overflow-hidden">
      <div class="relative z-10 max-w-2xl">
        <h2 class="text-3xl font-black text-gray-900 mb-2">Jadwal Saya</h2>
        <p class="text-sm font-medium text-gray-600">Kelola semua sesi belajar anak Anda dengan mudah.</p>
      </div>
      <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-white/40 to-transparent pointer-events-none"></div>
    </div>

    <!-- Controls -->
    <div class="flex justify-end items-center gap-4">
      <div class="flex items-center bg-white border border-gray-200 rounded-xl p-1 shadow-sm overflow-x-auto hide-scrollbar">
        <button 
          @click="activeTab = 'hari_ini'"
          :class="activeTab === 'hari_ini' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
          class="px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200 min-w-max">
          Hari ini
        </button>
        <button 
          @click="activeTab = 'besok'"
          :class="activeTab === 'besok' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
          class="px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200 min-w-max">
          Besok
        </button>
        <button 
          @click="activeTab = 'mendatang'"
          :class="activeTab === 'mendatang' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
          class="px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200 min-w-max">
          Mendatang
        </button>
      </div>
      <button class="bg-white border border-gray-200 text-gray-600 p-2 rounded-xl hover:bg-gray-50 transition shadow-sm shrink-0">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
      </button>
    </div>

    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-10">
      <article
        v-for="kelas in currentList"
        :key="kelas.id"
        class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm flex flex-col justify-between hover:shadow-md hover:border-blue-200 transition-all duration-300"
      >
        <div>
          <div class="flex items-start gap-4 mb-6">
            <div class="w-14 h-14 rounded-full overflow-hidden shrink-0 border border-gray-100 shadow-sm flex items-center justify-center bg-gray-50 text-2xl">
              {{ kelas.icon }}
            </div>
            <div>
              <h4 class="text-lg font-black text-[#2563EB] leading-tight mb-0.5">{{ kelas.subject }}</h4>
              <p class="text-xs font-bold text-gray-600 mb-2">{{ kelas.topic }}</p>
              
              <div class="space-y-1">
                <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5">
                  <span class="text-gray-400">👤</span> {{ kelas.tutor }}
                </p>
                <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5">
                  <span class="text-gray-400">📅</span> {{ kelas.schedule }}
                </p>
              </div>
            </div>
          </div>
        </div>
        
        <div>
          <div class="mb-4">
            <p class="text-xs font-bold text-gray-700 mb-2">Rata-Rata Evaluasi: <span class="text-[#2563EB]">{{ kelas.evaluasi }}</span></p>
            <div class="w-full bg-blue-100/50 rounded-full h-2 mb-1.5 overflow-hidden border border-blue-100">
              <div class="bg-[#2563EB] h-full rounded-full transition-all duration-1000" :style="`width: ${kelas.progress}%`"></div>
            </div>
            <div class="flex justify-end">
              <span class="text-[10px] font-black text-[#2563EB]">{{ kelas.progress }}%</span>
            </div>
          </div>
          
          <div class="flex justify-end">
            <button 
              @click="$emit('navigate', 'detail_kelas_anak')"
              class="bg-[#2563EB] text-white px-8 py-2 rounded-lg font-bold text-sm shadow-sm hover:bg-blue-700 transition"
            >
              Detail
            </button>
          </div>
        </div>
      </article>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const emit = defineEmits(['navigate']);

const activeTab = ref('hari_ini');

const jadwalList = ref([
  {
    id: 1,
    tab: 'hari_ini',
    subject: 'Matematika',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Selasa, 17:00-18:00',
    evaluasi: 84,
    progress: 15,
    icon: '📐'
  },
  {
    id: 2,
    tab: 'hari_ini',
    subject: 'Bahasa Jepang',
    topic: 'Huruf Hiragana',
    tutor: 'Tutor Renata',
    schedule: 'Selasa, 17:00-18:00',
    evaluasi: 84,
    progress: 60,
    icon: '🇯🇵'
  },
  {
    id: 3,
    tab: 'besok',
    subject: 'Matematika',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Rabu, 15:00-16:00',
    evaluasi: 84,
    progress: 15,
    icon: '📐'
  },
  {
    id: 4,
    tab: 'besok',
    subject: 'Bahasa Jepang',
    topic: 'Huruf Hiragana',
    tutor: 'Tutor Renata',
    schedule: 'Rabu, 17:00-18:00',
    evaluasi: 84,
    progress: 60,
    icon: '🇯🇵'
  },
  {
    id: 5,
    tab: 'mendatang',
    subject: 'Matematika',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Selasa, 17:00-18:00',
    evaluasi: 84,
    progress: 15,
    icon: '📐'
  },
  {
    id: 6,
    tab: 'mendatang',
    subject: 'Bahasa Jepang',
    topic: 'Huruf Hiragana',
    tutor: 'Tutor Renata',
    schedule: 'Selasa, 17:00-18:00',
    evaluasi: 84,
    progress: 62,
    icon: '🇯🇵'
  },
  {
    id: 7,
    tab: 'mendatang',
    subject: 'Bahasa Inggris',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Selasa, 17:00-18:00',
    evaluasi: 84,
    progress: 0,
    icon: '🇬🇧'
  },
  {
    id: 8,
    tab: 'mendatang',
    subject: 'Bahasa Indonesia',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Selasa, 17:00-18:00',
    evaluasi: 84,
    progress: 0,
    icon: '🇮🇩'
  }
]);

const currentList = computed(() => {
  return jadwalList.value.filter(k => k.tab === activeTab.value);
});
</script>
