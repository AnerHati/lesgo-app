<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
             <!-- Header Section -->
             <div class="bg-gradient-to-r from-cyan-50 to-blue-100 rounded-[24px] p-8 border border-blue-100/50 shadow-sm relative overflow-hidden">
               <div class="relative z-10 max-w-2xl">
                 <h2 class="text-3xl font-black text-gray-900 mb-3">Kelas Kenzo</h2>
                 <p class="text-sm font-medium text-gray-600 leading-relaxed">Belajar makin konsisten, Kenzo!<br>Pantau semua kelas yang diikuti anak Anda, termasuk jadwal, materi, dan perkembangan belajarnya.</p>
               </div>
               <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-white/40 to-transparent pointer-events-none"></div>
             </div>

             <!-- Tabs & Controls -->
             <div class="flex justify-end items-center gap-4">
               <div class="flex items-center bg-white border border-gray-200 rounded-xl p-1 shadow-sm w-full sm:w-auto overflow-x-auto hide-scrollbar">
                 <button 
                   @click="activeKelasTab = 'semua'"
                   :class="activeKelasTab === 'semua' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                   class="flex-1 sm:flex-none px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200 min-w-max">
                   Semua
                 </button>
                 <button 
                   @click="activeKelasTab = 'aktif'"
                   :class="activeKelasTab === 'aktif' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                   class="flex-1 sm:flex-none px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200 min-w-max">
                   Aktif
                 </button>
                 <button 
                   @click="activeKelasTab = 'selesai'"
                   :class="activeKelasTab === 'selesai' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                   class="flex-1 sm:flex-none px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200 min-w-max">
                   Selesai
                 </button>
               </div>
               <button class="bg-white border border-gray-200 text-gray-600 p-2.5 rounded-xl hover:bg-gray-50 transition shadow-sm shrink-0">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
               </button>
             </div>

             <!-- Class Grid -->
             <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pb-10">
               <div v-for="kelas in filteredKelasAnak" :key="kelas.id" class="bg-white rounded-[24px] border border-gray-100 p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                 <div>
                   <div class="flex justify-between items-start mb-4">
                     <div class="flex items-center gap-4">
                       <div class="w-14 h-14 rounded-full overflow-hidden shrink-0 border border-gray-50 shadow-sm">
                         <img :src="kelas.icon" class="w-full h-full object-cover">
                       </div>
                       <div>
                         <h4 class="text-lg font-black text-[#2563EB] leading-tight mb-0.5">{{ kelas.subject }}</h4>
                         <p class="text-xs font-bold text-gray-600">{{ kelas.topic }}</p>
                       </div>
                     </div>
                     <span v-if="kelas.status === 'akan_datang'" class="bg-yellow-100 text-yellow-700 text-[10px] font-black px-2.5 py-0.5 rounded-full whitespace-nowrap">Mulai Minggu Depan</span>
                     <span v-else-if="kelas.status === 'aktif'" class="bg-blue-100 text-[#2563EB] text-[10px] font-black px-2.5 py-0.5 rounded-full">Aktif</span>
                     <span v-else-if="kelas.status === 'selesai'" class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-2.5 py-0.5 rounded-full">Selesai</span>
                   </div>
                   
                   <div class="space-y-1.5 mb-6 pl-18">
                     <p class="text-[11px] font-bold text-gray-500 flex items-center gap-2"><span class="text-gray-400">👤</span> {{ kelas.tutor }}</p>
                     <p class="text-[11px] font-bold text-gray-500 flex items-center gap-2"><span class="text-gray-400">📅</span> {{ kelas.schedule }}</p>
                   </div>
                 </div>
                 
                 <div>
                   <!-- Progress Bar (Only for Aktif and Selesai) -->
                   <template v-if="kelas.status !== 'akan_datang'">
                     <div class="w-full bg-blue-100/50 rounded-full h-2 mb-1.5 overflow-hidden border border-blue-100">
                       <div class="bg-[#2563EB] h-2 rounded-full transition-all duration-1000" :style="`width: ${kelas.progress}%`"></div>
                     </div>
                     <div class="flex justify-end mb-4">
                       <span class="text-[10px] font-black text-[#2563EB]">{{ kelas.progress }}%</span>
                     </div>
                   </template>
                   
                   <!-- Buttons based on status -->
                   <div v-if="kelas.status === 'akan_datang'">
                     <button class="w-full bg-white border-2 border-[#2563EB] text-[#2563EB] py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-50 transition">
                       Lihat Jadwal
                     </button>
                   </div>
                   <div v-else-if="kelas.status === 'aktif'">
                     <button class="w-full bg-[#2563EB] text-white py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition">
                       Lihat Materi
                     </button>
                   </div>
                   <div v-else-if="kelas.status === 'selesai'" class="flex gap-3">
                     <button class="flex-1 bg-[#2563EB] text-white py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition">
                       Review Materi
                     </button>
                     <button class="flex-1 bg-[#2563EB] text-white py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition">
                       Sertifikat
                     </button>
                   </div>
                 </div>
               </div>
             </div>

          </div>
</template>


<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const emit = defineEmits(['navigate']);
const goNav = (id) => emit('navigate', id);

const activeKelasTab = ref('semua'); // 'semua', 'aktif', 'selesai'

const kelasAnakList = ref([
  {
    id: 1,
    subject: 'Informatika',
    topic: 'UI/UX Design',
    tutor: 'Tutor Ananta Aldora',
    schedule: 'Jumat, 15:00-17:30',
    status: 'akan_datang', // 'akan_datang', 'aktif', 'selesai'
    icon: 'https://ui-avatars.com/api/?name=Info&background=e0e7ff&color=3730a3&rounded=true'
  },
  {
    id: 2,
    subject: 'Fisika',
    topic: 'Listrik dan Magnet',
    tutor: 'Tutor Yura Agustina',
    schedule: 'Rabu, 12:00-13:30',
    status: 'akan_datang',
    icon: 'https://ui-avatars.com/api/?name=Fisika&background=fee2e2&color=991b1b&rounded=true'
  },
  {
    id: 3,
    subject: 'Matematika',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Jumat, 15:00-17:30',
    status: 'aktif',
    progress: 15,
    icon: 'https://ui-avatars.com/api/?name=Math&background=e0e7ff&color=3730a3&rounded=true'
  },
  {
    id: 4,
    subject: 'Bahasa Jepang',
    topic: 'Huruf Hiragana',
    tutor: 'Tutor Renata',
    schedule: 'Rabu, 12:00-13:30',
    status: 'aktif',
    progress: 85,
    icon: 'https://ui-avatars.com/api/?name=Jepang&background=fef3c7&color=92400e&rounded=true'
  },
  {
    id: 5,
    subject: 'Bahasa Inggris',
    topic: 'Simple Present Tense',
    tutor: 'Tutor Jhon Doe',
    schedule: 'Jumat, 17:00-18:30',
    status: 'aktif',
    progress: 40,
    icon: 'https://ui-avatars.com/api/?name=Inggris&background=dbeafe&color=1e40af&rounded=true'
  },
  {
    id: 6,
    subject: 'Bahasa Indonesia',
    topic: 'Paragraf Deduktif',
    tutor: 'Tutor Jonathan',
    schedule: 'Sabtu, 15:00-17:30',
    status: 'aktif',
    progress: 95,
    icon: 'https://ui-avatars.com/api/?name=Indo&background=ffedd5&color=9a3412&rounded=true'
  },
  {
    id: 7,
    subject: 'Biologi',
    topic: 'Asam Nukleat',
    tutor: 'Tutor Oliver James',
    schedule: 'Senin, 10:00-11:30',
    status: 'selesai',
    progress: 100,
    icon: 'https://ui-avatars.com/api/?name=Bio&background=d1fae5&color=065f46&rounded=true'
  },
  {
    id: 8,
    subject: 'Kimia',
    topic: 'Reaksi Kimia',
    tutor: 'Tutor Noah Jack',
    schedule: 'Kamis, 19:00-20:00',
    status: 'selesai',
    progress: 100,
    icon: 'https://ui-avatars.com/api/?name=Kimia&background=cffafe&color=164e63&rounded=true'
  },
  {
    id: 9,
    subject: 'Sejarah',
    topic: 'Sejarah Dunia Modern',
    tutor: 'Tutor James Smith',
    schedule: 'Minggu, 09:00-11:00',
    status: 'selesai',
    progress: 100,
    icon: 'https://ui-avatars.com/api/?name=Sejarah&background=f3f4f6&color=1f2937&rounded=true'
  },
  {
    id: 10,
    subject: 'Matematika',
    topic: 'Bangun Ruang',
    tutor: 'Tutor Emma Watson',
    schedule: 'Selasa, 19:00-20:00',
    status: 'selesai',
    progress: 100,
    icon: 'https://ui-avatars.com/api/?name=Math&background=e0e7ff&color=3730a3&rounded=true'
  }
]);

const filteredKelasAnak = computed(() => {
  if (activeKelasTab.value === 'semua') {
    return kelasAnakList.value;
  }
  return kelasAnakList.value.filter(k => k.status === activeKelasTab.value);
});

</script>
