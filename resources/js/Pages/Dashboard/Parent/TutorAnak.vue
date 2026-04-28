<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
             <!-- Header Section -->
             <div class="bg-gradient-to-r from-cyan-50 to-blue-100 rounded-[24px] p-6 border border-blue-100/50 shadow-sm relative overflow-hidden">
               <div class="relative z-10">
                 <h2 class="text-2xl font-black text-gray-900 mb-2">Tutor Saya</h2>
                 <p class="text-sm font-medium text-gray-600">Lihat tutor yang sudah mengkonfirmasi dan chat tutor.</p>
               </div>
               <div class="absolute right-0 top-0 bottom-0 w-1/3 bg-gradient-to-l from-white/40 to-transparent pointer-events-none"></div>
             </div>

             <!-- Tabs & Controls -->
             <div class="flex flex-col sm:flex-row justify-end items-center gap-4">
               <div class="flex items-center bg-white border border-gray-200 rounded-xl p-1 shadow-sm w-full sm:w-auto">
                 <button 
                   @click="activeTutorSayaTab = 'terkonfirmasi'"
                   :class="activeTutorSayaTab === 'terkonfirmasi' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                   class="flex-1 sm:flex-none px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200">
                   Terkonfirmasi
                 </button>
                 <button 
                   @click="activeTutorSayaTab = 'menunggu'"
                   :class="activeTutorSayaTab === 'menunggu' ? 'bg-[#2563EB] text-white shadow-md' : 'text-gray-500 hover:text-gray-700'"
                   class="flex-1 sm:flex-none px-6 py-2 rounded-lg font-bold text-sm transition-all duration-200">
                   Menunggu
                 </button>
               </div>
               <button class="bg-white border border-gray-200 text-gray-600 p-2.5 rounded-xl hover:bg-gray-50 transition shadow-sm w-full sm:w-auto flex justify-center">
                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
               </button>
             </div>

             <!-- Tab Content: Terkonfirmasi -->
             <div v-if="activeTutorSayaTab === 'terkonfirmasi'" class="space-y-6">
               <div v-for="tutor in tutorTerkonfirmasi" :key="tutor.id" class="bg-white rounded-[24px] border border-gray-100 shadow-sm overflow-hidden animate-fade-in">
                 <div v-if="tutor.status === 'dikonfirmasi'" class="bg-green-50/70 border-b border-green-100 px-6 py-4">
                   <h3 class="font-bold text-gray-900 text-sm">Jadwal dikonfirmasi</h3>
                 </div>
                 <div v-else-if="tutor.status === 'tidak_dikonfirmasi'" class="bg-red-50/70 border-b border-red-100 px-6 py-4">
                   <h3 class="font-bold text-gray-900 text-sm">Jadwal tidak dikonfirmasi</h3>
                 </div>

                 <div class="p-6">
                   <div class="flex flex-col sm:flex-row gap-6">
                     <div class="w-20 h-20 rounded-full overflow-hidden shrink-0 border-2 border-gray-50">
                       <img :src="'https://ui-avatars.com/api/?name=' + tutor.name.replace(' ', '+') + '&background=f3f4f6&color=374151&size=200'" class="w-full h-full object-cover">
                     </div>
                     <div class="flex-1">
                       <h4 class="text-xl font-black text-gray-900 leading-tight mb-1">{{ tutor.name }}</h4>
                       <div class="flex items-center gap-1 text-sm font-bold text-gray-600 mb-1.5">
                         <span class="text-[#FACC15] tracking-tighter">★★★★★</span>
                       </div>
                       <p class="text-xs font-bold text-gray-500 flex items-center gap-1.5 mb-3"><span class="text-base">📍</span> Denpasar Selatan</p>
                       
                       <div class="space-y-1">
                         <p class="text-[11px] font-bold text-gray-600 flex items-center gap-1.5"><span class="text-gray-400">📦</span> Paket: {{ tutor.paket }}</p>
                         <p class="text-[11px] font-bold text-gray-600 flex items-center gap-1.5"><span class="text-gray-400">🏠</span> Metode: {{ tutor.metode }}</p>
                       </div>
                       
                       <div v-if="tutor.status === 'tidak_dikonfirmasi'" class="mt-4 bg-red-50/50 text-red-600 text-[11px] font-bold px-3 py-2 rounded-lg inline-flex items-center gap-1.5 border border-red-100">
                         <span class="text-sm">!</span> {{ tutor.reason }}
                       </div>
                     </div>
                     
                     <div v-if="tutor.status === 'dikonfirmasi'" class="flex flex-col gap-2 mt-4 sm:mt-auto sm:ml-auto w-full sm:w-auto">
                       <div class="flex gap-2">
                         <button class="flex-1 sm:flex-none bg-white border border-[#2563EB] text-[#2563EB] px-6 py-2.5 rounded-xl font-bold text-xs hover:bg-blue-50 transition shadow-sm">
                           Chat
                         </button>
                         <button class="flex-1 sm:flex-none bg-white border border-[#2563EB] text-[#2563EB] px-6 py-2.5 rounded-xl font-bold text-xs hover:bg-blue-50 transition shadow-sm">
                           Lihat Jadwal
                         </button>
                       </div>
                     </div>
                   </div>
                 </div>
               </div>
             </div>

             <!-- Tab Content: Menunggu -->
             <div v-if="activeTutorSayaTab === 'menunggu'" class="space-y-6">
               <div v-for="tutor in tutorMenunggu" :key="tutor.id" class="bg-white rounded-[24px] border border-gray-100 shadow-sm overflow-hidden animate-fade-in">
                 <div class="bg-[#FDF8F3] border-b border-orange-100/50 px-6 py-4">
                   <h3 class="font-bold text-gray-900 text-sm">Menunggu Konfirmasi Tutor</h3>
                 </div>

                 <div class="p-6">
                   <div class="flex flex-col sm:flex-row gap-6">
                     <div class="w-20 h-20 rounded-full overflow-hidden shrink-0 border-2 border-gray-50">
                       <img :src="'https://ui-avatars.com/api/?name=' + tutor.name.replace(' ', '+') + '&background=f3f4f6&color=374151&size=200'" class="w-full h-full object-cover">
                     </div>
                     <div class="flex-1">
                       <h4 class="text-xl font-black text-gray-900 leading-tight mb-1">{{ tutor.name }}</h4>
                       <div class="flex items-center gap-1 text-sm font-bold text-gray-600 mb-1.5">
                         <span class="text-[#FACC15] tracking-tighter">★★★★★</span>
                       </div>
                       <p class="text-xs font-bold text-gray-500 flex items-center gap-1.5 mb-3"><span class="text-base">📍</span> Denpasar Selatan</p>
                       
                       <div class="space-y-1">
                         <p class="text-[11px] font-bold text-gray-600 flex items-center gap-1.5"><span class="text-gray-400">📦</span> Paket: {{ tutor.paket }}</p>
                         <p class="text-[11px] font-bold text-gray-600 flex items-center gap-1.5"><span class="text-gray-400">🏠</span> Metode: {{ tutor.metode }}</p>
                       </div>
                     </div>
                     
                     <div class="flex flex-col gap-2 mt-4 sm:mt-auto sm:ml-auto w-full sm:w-auto">
                       <button class="w-full bg-white border border-red-200 text-red-500 px-6 py-2.5 rounded-xl font-bold text-xs hover:bg-red-50 transition shadow-sm">
                         Batalkan Permintaan
                       </button>
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

const activeTutorSayaTab = ref('terkonfirmasi'); // 'terkonfirmasi' or 'menunggu'

const tutorTerkonfirmasi = ref([
  {
    id: 1,
    name: 'James Nathan',
    status: 'dikonfirmasi',
    paket: '4x Pertemuan',
    metode: 'Privat ke rumah'
  },
  {
    id: 2,
    name: 'Ananta Aldora',
    status: 'tidak_dikonfirmasi',
    paket: '4x Pertemuan',
    metode: 'Privat ke rumah',
    reason: 'Bentrok dengan jadwal lain'
  }
]);

const tutorMenunggu = ref([
  {
    id: 3,
    name: 'Isyana Randini',
    status: 'menunggu',
    paket: '4x Pertemuan',
    metode: 'Privat ke rumah'
  }
]);

</script>
