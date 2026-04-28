<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
             
             <!-- View: Overview -->
             <div v-if="progresAnakView === 'overview'" class="space-y-6">
               <!-- Top Summary Card -->
               <div class="bg-white rounded-[24px] border border-gray-100 p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                 <div class="flex items-center gap-5">
                   <div class="relative">
                     <div class="w-20 h-20 rounded-full overflow-hidden shrink-0 border-4 border-gray-50 shadow-sm">
                       <img src="https://ui-avatars.com/api/?name=Kenzo+Aliza&background=f97316&color=fff&size=200" class="w-full h-full object-cover">
                     </div>
                   </div>
                   <div>
                     <div class="flex items-center gap-3 mb-1">
                       <h3 class="text-xl font-black text-gray-900 leading-tight">Kenzo Aliza</h3>
                       <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-2.5 py-0.5 rounded-full">Aktif</span>
                     </div>
                     <div class="space-y-1 mt-2">
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5"><span class="text-gray-400">🎓</span> Matematika - SD</p>
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5"><span class="text-gray-400">🏠</span> Metode: Datang ke rumah Tukad Badung, no 12</p>
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5"><span class="text-gray-400">📅</span> Senin & Rabu, 16.00-17.00</p>
                     </div>
                   </div>
                 </div>
                 
                 <div class="md:w-1/2 w-full">
                   <div class="flex justify-between items-end mb-2">
                     <span class="text-sm font-black text-gray-900">Progres Belajar</span>
                     <span class="text-[10px] font-bold text-gray-500">Keseluruhan {{ overallProgress.keseluruhan }}</span>
                   </div>
                   <div class="w-full bg-blue-100/50 rounded-full h-2.5 mb-4 overflow-hidden border border-blue-100">
                     <div class="bg-[#2563EB] h-2.5 rounded-full transition-all duration-1000" style="width: 75%"></div>
                   </div>
                   <div class="flex justify-between items-center bg-gray-50/50 rounded-xl p-3 border border-gray-100">
                     <div class="text-center">
                       <div class="flex items-center gap-1.5 justify-center mb-0.5">
                         <span class="text-blue-500 text-lg">👥</span>
                         <span class="font-black text-gray-900 text-sm">{{ overallProgress.sesiSelesai }}</span>
                       </div>
                       <span class="text-[10px] font-bold text-gray-500">Sesi Selesai</span>
                     </div>
                     <div class="w-px h-8 bg-gray-200"></div>
                     <div class="text-center">
                       <div class="flex items-center gap-1.5 justify-center mb-0.5">
                         <span class="text-blue-500 text-lg">📝</span>
                         <span class="font-black text-gray-900 text-sm">{{ overallProgress.tugasSelesai }}</span>
                       </div>
                       <span class="text-[10px] font-bold text-gray-500">Tugas Selesai</span>
                     </div>
                     <div class="w-px h-8 bg-gray-200"></div>
                     <div class="text-center">
                       <div class="flex items-center gap-1.5 justify-center mb-0.5">
                         <span class="text-blue-400 text-lg">⭐</span>
                         <span class="font-black text-gray-900 text-sm">{{ overallProgress.rataRataNilai }}</span>
                       </div>
                       <span class="text-[10px] font-bold text-gray-500">Rata-rata nilai</span>
                     </div>
                   </div>
                 </div>
               </div>

               <!-- Subject Grid -->
               <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                 <div v-for="subject in subjectProgressList" :key="subject.id" class="bg-white rounded-[24px] border border-gray-100 p-6 shadow-sm flex flex-col justify-between hover:shadow-md transition">
                   <div>
                     <div class="flex justify-between items-start mb-4">
                       <div class="flex items-center gap-4">
                         <div class="w-14 h-14 rounded-full overflow-hidden shrink-0 border border-gray-50 shadow-sm">
                           <img :src="subject.icon" class="w-full h-full object-cover">
                         </div>
                         <div>
                           <h4 class="text-lg font-black text-[#2563EB] leading-tight mb-0.5">{{ subject.title }}</h4>
                           <p class="text-xs font-bold text-gray-600">{{ subject.topic }}</p>
                         </div>
                       </div>
                       <span class="bg-blue-100 text-[#2563EB] text-[10px] font-black px-2.5 py-0.5 rounded-full">Aktif</span>
                     </div>
                     
                     <div class="space-y-1.5 mb-6 pl-18">
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-2"><span class="text-gray-400">👤</span> {{ subject.tutor }}</p>
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-2"><span class="text-gray-400">📅</span> {{ subject.schedule }}</p>
                     </div>
                   </div>
                   
                   <div>
                     <div class="w-full bg-blue-100/50 rounded-full h-2 mb-1.5 overflow-hidden border border-blue-100">
                       <div class="bg-[#2563EB] h-2 rounded-full transition-all duration-1000" :style="`width: ${subject.progress}%`"></div>
                     </div>
                     <div class="flex justify-end mb-4">
                       <span class="text-[10px] font-black text-[#2563EB]">{{ subject.progress }}%</span>
                     </div>
                     <button @click="progresAnakView = 'detail'" class="w-full bg-[#2563EB] text-white py-3 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition">
                       Lihat Materi
                     </button>
                   </div>
                 </div>
               </div>
             </div>

             <!-- View: Detail -->
             <div v-else-if="progresAnakView === 'detail'" class="space-y-6">
               <button @click="progresAnakView = 'overview'" class="bg-white border border-gray-200 text-gray-700 px-5 py-2.5 rounded-xl font-bold text-sm flex items-center gap-2 hover:bg-gray-50 transition shadow-sm w-fit">
                 <span aria-hidden="true">←</span> Kembali
               </button>

               <!-- Subject Header Card -->
               <div class="bg-white rounded-[24px] border border-gray-100 p-6 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-6">
                 <div class="flex items-center gap-5">
                   <div class="w-20 h-20 rounded-full overflow-hidden shrink-0 border border-gray-50 shadow-sm p-2 bg-blue-50/50">
                     <img src="https://ui-avatars.com/api/?name=Math&background=e0e7ff&color=3730a3&rounded=true" class="w-full h-full object-cover">
                   </div>
                   <div>
                     <div class="flex items-center gap-3 mb-1">
                       <h3 class="text-2xl font-black text-gray-900 leading-tight">Matematika</h3>
                       <span class="bg-emerald-100 text-emerald-700 text-[10px] font-black px-2.5 py-0.5 rounded-full">Aktif</span>
                     </div>
                     <div class="space-y-1 mt-2">
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5"><span class="text-gray-400">🎓</span> Matematika - SD</p>
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5"><span class="text-gray-400">🏠</span> Metode: Datang ke rumah Tukad Badung, no 12</p>
                       <p class="text-[11px] font-bold text-gray-500 flex items-center gap-1.5"><span class="text-gray-400">📅</span> Senin & Rabu, 16.00-17.00</p>
                     </div>
                   </div>
                 </div>
                 
                 <div class="md:w-1/2 w-full">
                   <div class="flex justify-between items-end mb-2">
                     <span class="text-sm font-black text-gray-900">Progres Belajar</span>
                     <span class="text-[10px] font-bold text-gray-500">Keseluruhan {{ overallProgress.keseluruhan }}</span>
                   </div>
                   <div class="w-full bg-blue-100/50 rounded-full h-2.5 mb-4 overflow-hidden border border-blue-100">
                     <div class="bg-[#2563EB] h-2.5 rounded-full transition-all duration-1000" style="width: 75%"></div>
                   </div>
                   <div class="flex justify-between items-center bg-gray-50/50 rounded-xl p-3 border border-gray-100">
                     <div class="text-center">
                       <div class="flex items-center gap-1.5 justify-center mb-0.5">
                         <span class="text-blue-500 text-lg">👥</span>
                         <span class="font-black text-gray-900 text-sm">{{ overallProgress.sesiSelesai }}</span>
                       </div>
                       <span class="text-[10px] font-bold text-gray-500">Sesi Selesai</span>
                     </div>
                     <div class="w-px h-8 bg-gray-200"></div>
                     <div class="text-center">
                       <div class="flex items-center gap-1.5 justify-center mb-0.5">
                         <span class="text-blue-500 text-lg">📝</span>
                         <span class="font-black text-gray-900 text-sm">{{ overallProgress.tugasSelesai }}</span>
                       </div>
                       <span class="text-[10px] font-bold text-gray-500">Tugas Selesai</span>
                     </div>
                     <div class="w-px h-8 bg-gray-200"></div>
                     <div class="text-center">
                       <div class="flex items-center gap-1.5 justify-center mb-0.5">
                         <span class="text-blue-400 text-lg">⭐</span>
                         <span class="font-black text-gray-900 text-sm">{{ overallProgress.rataRataNilai }}</span>
                       </div>
                       <span class="text-[10px] font-bold text-gray-500">Rata-rata nilai</span>
                     </div>
                   </div>
                 </div>
               </div>

               <!-- Split Layout -->
               <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                 <!-- Left: Tingkat Kemajuan Per Materi -->
                 <div class="bg-white rounded-[24px] border border-gray-100 shadow-sm overflow-hidden flex flex-col">
                   <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/30 flex items-center gap-2">
                     <span class="text-gray-500 text-lg">📖</span>
                     <h3 class="font-bold text-gray-900 text-sm">Tingkat Kemajuan Per Materi</h3>
                   </div>
                   <div class="p-6 space-y-6 flex-1">
                     <div v-for="(topic, index) in subjectDetail.topics" :key="index" class="relative">
                       <div class="flex items-start gap-4">
                         <!-- Icon / Number -->
                         <div class="w-10 h-10 rounded-xl bg-blue-50 border border-blue-100 flex items-center justify-center shrink-0 text-[#2563EB] font-black shadow-sm">
                           <span v-if="index === 0" class="text-lg">➕</span>
                           <span v-else-if="index === 1" class="text-lg">➗</span>
                           <span v-else class="text-lg">%</span>
                         </div>
                         <div class="flex-1 pt-1">
                           <div class="flex justify-between items-start mb-2 gap-2">
                             <h4 class="text-sm font-bold text-gray-900 leading-tight">{{ topic.title }}</h4>
                             <span v-if="topic.status === 'Selesai'" class="shrink-0 bg-green-100 text-green-700 text-[10px] font-black px-2.5 py-1 rounded-full whitespace-nowrap">Selesai</span>
                             <span v-else class="shrink-0 bg-blue-50 text-[#2563EB] text-[10px] font-black px-2.5 py-1 rounded-full whitespace-nowrap">Belum dipelajari</span>
                           </div>
                           <div class="w-full bg-blue-100/50 rounded-full h-1.5 mb-1 overflow-hidden border border-blue-100">
                             <div class="bg-[#2563EB] h-1.5 rounded-full transition-all duration-1000" :style="`width: ${topic.progress}%`"></div>
                           </div>
                           <p class="text-[9px] font-black text-[#2563EB] text-right">{{ topic.progress }}%</p>
                         </div>
                       </div>
                     </div>
                   </div>
                 </div>

                 <!-- Right: Notes & Tasks -->
                 <div class="space-y-6">
                   <!-- Catatan Terakhir -->
                   <div class="bg-[#F0F7FF] rounded-[24px] border border-blue-100 shadow-sm overflow-hidden">
                     <div class="px-6 py-4 border-b border-blue-100/50 flex justify-between items-center">
                       <div class="flex items-center gap-2">
                         <span class="text-blue-500 text-lg">🎓</span>
                         <h3 class="font-bold text-gray-900 text-sm">Catatan Terakhir</h3>
                       </div>
                       <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-[#2563EB]">Lihat Semua</a>
                     </div>
                     <div class="p-6">
                       <p class="text-xs font-medium text-gray-700 leading-relaxed mb-4">
                         Kenzo sudah menunjukkan perkembangan yang sangat baik dalam memahami materi pecahan, terutama pada operasi penjumlahan dan pengurangan.
                       </p>
                       <p class="text-[10px] font-medium text-gray-400">Dibuat: 12 Mei, 18.00 - Isyana Randini</p>
                     </div>
                   </div>

                   <!-- Tugas Terbaru -->
                   <div class="bg-[#FFFDF0] rounded-[24px] border border-yellow-100 shadow-sm overflow-hidden">
                     <div class="px-6 py-4 border-b border-yellow-100/50 flex justify-between items-center">
                       <div class="flex items-center gap-2">
                         <span class="text-yellow-500 text-lg">📝</span>
                         <h3 class="font-bold text-gray-900 text-sm">Tugas Terbaru</h3>
                       </div>
                       <a href="#" class="text-[10px] font-bold text-gray-400 hover:text-[#2563EB]">Lihat Semua</a>
                     </div>
                     <div class="p-6 space-y-4">
                       <div v-for="(task, index) in subjectDetail.tasks" :key="index" class="flex items-start gap-3 p-3 bg-white rounded-xl border border-yellow-50 shadow-sm">
                         <div class="w-8 h-8 rounded-lg bg-gray-50 flex items-center justify-center shrink-0">
                           <span class="text-gray-400">📄</span>
                         </div>
                         <div class="flex-1 flex justify-between items-start pt-0.5">
                           <div>
                             <h4 class="text-xs font-bold text-gray-900 mb-1">{{ task.title }}</h4>
                             <p class="text-[9px] font-medium text-gray-500">Dikumpulkan: {{ task.date }}</p>
                           </div>
                           <span v-if="task.status === 'dinilai'" class="bg-green-100 text-green-700 text-[9px] font-black px-2 py-0.5 rounded-full">dinilai</span>
                           <span v-else class="bg-gray-100 text-gray-500 text-[9px] font-black px-2 py-0.5 rounded-full">belum dikerjakan</span>
                         </div>
                       </div>
                     </div>
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

const progresAnakView = ref('overview'); // 'overview' or 'detail'

const overallProgress = ref({
  sesiSelesai: 8,
  tugasSelesai: 2,
  rataRataNilai: 4.8,
  keseluruhan: '3/4'
});

const subjectProgressList = ref([
  {
    id: 'matematika',
    title: 'Matematika',
    topic: 'Transformasi Geometri',
    tutor: 'Tutor Isyana Randini',
    schedule: 'Jumat, 15:00-17:30',
    progress: 15,
    icon: 'https://ui-avatars.com/api/?name=Math&background=e0e7ff&color=3730a3&rounded=true'
  },
  {
    id: 'bahasa_jepang',
    title: 'Bahasa Jepang',
    topic: 'Huruf Hiragana',
    tutor: 'Tutor Renata',
    schedule: 'Rabu, 12:00-13:30',
    progress: 85,
    icon: 'https://ui-avatars.com/api/?name=Jepang&background=fef3c7&color=92400e&rounded=true'
  },
  {
    id: 'bahasa_inggris',
    title: 'Bahasa Inggris',
    topic: 'Simple Present Tense',
    tutor: 'Tutor Jhon Doe',
    schedule: 'Jumat, 17:00-18:30',
    progress: 40,
    icon: 'https://ui-avatars.com/api/?name=Inggris&background=dbeafe&color=1e40af&rounded=true'
  },
  {
    id: 'bahasa_indonesia',
    title: 'Bahasa Indonesia',
    topic: 'Paragraf Deduktif',
    tutor: 'Tutor Jonathan',
    schedule: 'Sabtu, 15:00-17:30',
    progress: 95,
    icon: 'https://ui-avatars.com/api/?name=Indo&background=ffedd5&color=9a3412&rounded=true'
  }
]);

const subjectDetail = ref({
  topics: [
    { title: 'Operasi Pecahan (Penjumlahan & Pengurangan)', status: 'Selesai', progress: 15 },
    { title: 'Operasi Pecahan (Perkalian & Pembagian)', status: 'Belum dipelajari', progress: 15 },
    { title: 'Bilangan Bulat (Operasi Hitung)', status: 'Belum dipelajari', progress: 0 },
    { title: 'Bilangan Bulat (Operasi Hitung)', status: 'Belum dipelajari', progress: 0 }
  ],
  tasks: [
    { title: 'Latihan Soal Pecahan', date: '13 Mei', status: 'dinilai' },
    { title: 'Quiz Desimal', date: '13 Mei', status: 'belum dikerjakan' }
  ]
});

</script>
