<template>
          
          <!-- Row 1: Hero + Notifikasi -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Hero Banner -->
            <div class="lg:col-span-8 bg-gradient-to-r from-[#0EA5E9] to-[#3B82F6] rounded-[32px] p-8 lg:p-10 flex justify-between items-center text-white relative overflow-hidden animate-fade-in shadow-md shadow-blue-500/10">
              <!-- Decorative Orbs -->
              <div class="absolute top-0 right-1/4 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
              <div class="absolute bottom-0 left-1/4 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
              
              <div class="z-10 max-w-md relative">
                <h2 class="text-3xl lg:text-4xl font-black mb-2">Selamat datang, Bu Sarah!</h2>
                <p class="text-blue-50 font-bold mb-6 text-sm">Pantau perkembangan Kenzo hari ini</p>
                <p class="text-blue-100 font-medium mb-8 text-xs max-w-[280px] leading-relaxed">Lihat perkembangan Kenzo dan jadwal Kenzo hari ini!</p>
                
                <button type="button" class="group bg-[#2563EB] hover:bg-blue-700 px-6 py-2.5 rounded-xl font-bold text-sm inline-flex items-center gap-2 transition-all duration-300 shadow-sm">
                  <span class="text-lg">📊</span> Lihat Progres
                </button>
              </div>
              <div class="absolute right-0 bottom-0 w-[300px] h-full hidden md:flex items-end justify-end p-4">
                 <img src="https://ui-avatars.com/api/?name=Family&background=random&color=fff&size=200" alt="Family Illustration" class="w-48 h-48 rounded-full border-4 border-white/20 opacity-90 object-cover rotate-12 translate-x-4 translate-y-4">
                 <!-- Using UI Avatars as placeholder for the illustration, rotating to make it look a bit dynamic like the Figma asset -->
              </div>
            </div>

            <!-- Notifikasi -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300">
              <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">🔔 Notifikasi</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-6">
                <div class="flex gap-4 items-start">
                  <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-lg shrink-0">📅</div>
                  <div>
                    <p class="text-[13px] font-bold text-gray-800 leading-tight">Tugas Baru</p>
                    <p class="text-[11px] text-gray-500 mt-1">Tutor Rian menambahkan tugas baru untuk kamu</p>
                    <p class="text-[10px] text-[#0EA5E9] font-bold mt-1.5 text-right">2 menit lalu</p>
                  </div>
                </div>
                <div class="flex gap-4 items-start">
                  <div class="w-10 h-10 bg-blue-50 text-blue-500 rounded-xl flex items-center justify-center text-lg shrink-0">📖</div>
                  <div>
                    <p class="text-[13px] font-bold text-gray-800 leading-tight">Pengumpulan Tugas</p>
                    <p class="text-[11px] text-gray-500 mt-1">Kumpulkan tugas Bahasa Indonesia hari ini!</p>
                    <p class="text-[10px] text-[#0EA5E9] font-bold mt-1.5 text-right">2 jam lalu</p>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Row 2: Jadwal, Tugas, Kalender -->
          <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
            
            <!-- Jadwal Hari Ini -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300">
              <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">🗓️ Jadwal Hari Ini</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-4">
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 border border-gray-100">
                    <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=f3f4f6&color=374151" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-[13px] font-bold text-[#0EA5E9] leading-tight mb-1">Matematika</h4>
                    <p class="text-[11px] text-gray-500 font-medium">Tutor Isyana Randini</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Hari ini, 15:00-17:30</p>
                  </div>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 border border-gray-100">
                    <img src="https://ui-avatars.com/api/?name=John+Doe&background=f3f4f6&color=374151" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-[13px] font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Indonesia</h4>
                    <p class="text-[11px] text-gray-500 font-medium">Tutor John Doe</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Jumat, 19:00-20:30</p>
                  </div>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 rounded-full overflow-hidden shrink-0 border border-gray-100">
                    <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=f3f4f6&color=374151" class="w-full h-full object-cover">
                  </div>
                  <div>
                    <h4 class="text-[13px] font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Inggris</h4>
                    <p class="text-[11px] text-gray-500 font-medium">Tutor Isyana Randini</p>
                    <p class="text-[10px] text-gray-400 mt-0.5">Minggu, 15:00-17:30</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Tugas -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm flex flex-col hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300">
              <div class="flex justify-between items-center mb-6">
                <h3 class="font-bold text-gray-900 flex items-center gap-2">📓 Tugas</h3>
                <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
              </div>
              <div class="space-y-5">
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 bg-blue-50 text-2xl rounded-xl flex items-center justify-center shrink-0">🧮</div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-[13px] font-bold text-[#0EA5E9] leading-tight mb-1">Matematika</h4>
                    <p class="text-[11px] text-gray-500 font-medium truncate">Transformasi Geometri</p>
                    <p class="text-[10px] text-gray-400 mt-1 text-right">24 Menit Lalu</p>
                  </div>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 bg-orange-50 text-2xl rounded-xl flex items-center justify-center shrink-0">📋</div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-[13px] font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Indonesia</h4>
                    <p class="text-[11px] text-gray-500 font-medium truncate">Paragraf Deduktif</p>
                    <p class="text-[10px] text-gray-400 mt-1 text-right">1 Jam Lalu</p>
                  </div>
                </div>
                <div class="flex items-center gap-4">
                  <div class="w-12 h-12 bg-yellow-50 text-2xl rounded-xl flex items-center justify-center shrink-0">🇯🇵</div>
                  <div class="flex-1 min-w-0">
                    <h4 class="text-[13px] font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Jepang</h4>
                    <p class="text-[11px] text-gray-500 font-medium truncate">Huruf Hiragana</p>
                    <p class="text-[10px] text-gray-400 mt-1 text-right">22 Jam Lalu</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Kalender -->
            <div class="lg:col-span-4 bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm hover:-translate-y-1 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300">
               <div class="flex justify-between items-center mb-6">
                  <h3 class="font-bold text-gray-900 flex items-center gap-2">📅 Februari 2026</h3>
                  <div class="flex gap-2">
                     <button class="w-6 h-6 border rounded-md text-gray-400 hover:bg-gray-50 flex items-center justify-center focus:outline-none">‹</button>
                     <button class="w-6 h-6 border rounded-md text-gray-400 hover:bg-gray-50 flex items-center justify-center focus:outline-none">›</button>
                  </div>
               </div>
               <div class="grid grid-cols-7 text-center text-[10px] text-gray-500 font-medium mb-4">
                  <span>Sun</span><span>Mon</span><span>Tue</span><span>Wed</span><span>Thu</span><span>Fri</span><span>Sat</span>
               </div>
               <div class="grid grid-cols-7 text-center gap-y-2">
                  <div class="py-2 text-[11px] font-medium text-transparent">0</div>
                  <div class="py-2 text-[11px] font-medium text-transparent">0</div>
                  <div class="py-2 text-[11px] font-medium text-transparent">0</div>
                  <div class="py-2 text-[11px] font-medium text-transparent">0</div>
                  <div class="py-2 text-[11px] font-medium text-transparent">0</div>
                  <div class="py-2 text-[11px] font-medium text-transparent">0</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">1</div>
                  
                  <div class="py-2 text-[11px] font-medium text-red-500">2</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">3</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">4</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">5</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">6</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">7</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">8</div>
                  
                  <div class="py-2 text-[11px] font-medium text-red-500">9</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">10</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">11</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">12</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">13</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">14</div>
                  <div class="py-1 flex justify-center"><div class="w-7 h-7 bg-[#3B82F6] text-white rounded-full flex items-center justify-center text-[11px] font-bold shadow-md shadow-blue-500/30">15</div></div>
                  
                  <div class="py-2 text-[11px] font-medium text-red-500">16</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">17</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">18</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">19</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">20</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">21</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">22</div>
                  
                  <div class="py-2 text-[11px] font-medium text-red-500">23</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">24</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">25</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">26</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">27</div>
                  <div class="py-2 text-[11px] font-medium text-gray-700">28</div>
               </div>
            </div>
          </div>

          <!-- Row 3: Progres -->
          <section class="bg-white rounded-[32px] p-6 border border-gray-100 shadow-sm hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 mt-6">
            <div class="flex justify-between items-center mb-6">
              <h3 class="font-bold text-gray-900 flex items-center gap-2">📊 Progres</h3>
              <a href="#" class="text-xs text-gray-400 font-bold hover:text-blue-600 transition">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 lg:gap-8">
              
              <!-- Card 1 -->
              <div class="p-4 lg:p-6 rounded-2xl border border-gray-100 bg-gray-50/50">
                <h4 class="text-sm font-bold text-[#0EA5E9] leading-tight mb-1">Matematika</h4>
                <p class="text-xs text-gray-600 font-medium mb-4">Transformasi Geometri</p>
                <div class="space-y-1.5 mb-6">
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">👤</span> Tutor Isyana Randini</p>
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">📅</span> Jumat, 15:00-17:30</p>
                </div>
                <div>
                  <div class="flex justify-between items-center text-[11px] font-bold text-[#2563EB] mb-2">
                    <span>Progres</span>
                    <span>15%</span>
                  </div>
                  <div class="h-1.5 rounded-full bg-gray-200 overflow-hidden">
                    <div class="h-full rounded-full bg-[#2563EB] w-[15%]"></div>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="p-4 lg:p-6 rounded-2xl border border-gray-100 bg-gray-50/50">
                <h4 class="text-sm font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Jepang</h4>
                <p class="text-xs text-gray-600 font-medium mb-4">Huruf Hiragana</p>
                <div class="space-y-1.5 mb-6">
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">👤</span> Tutor Renata</p>
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">📅</span> Rabu, 12:00-13:30</p>
                </div>
                <div>
                  <div class="flex justify-between items-center text-[11px] font-bold text-[#2563EB] mb-2">
                    <span>Progres</span>
                    <span>65%</span>
                  </div>
                  <div class="h-1.5 rounded-full bg-gray-200 overflow-hidden">
                    <div class="h-full rounded-full bg-[#2563EB] w-[65%]"></div>
                  </div>
                </div>
              </div>

              <!-- Card 3 -->
              <div class="p-4 lg:p-6 rounded-2xl border border-gray-100 bg-gray-50/50">
                <h4 class="text-sm font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Inggris</h4>
                <p class="text-xs text-gray-600 font-medium mb-4">Simple Present Tense</p>
                <div class="space-y-1.5 mb-6">
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">👤</span> Tutor Jhon Doe</p>
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">📅</span> Kamis, 17:00-18:30</p>
                </div>
                <div>
                  <div class="flex justify-between items-center text-[11px] font-bold text-[#2563EB] mb-2">
                    <span>Progres</span>
                    <span>40%</span>
                  </div>
                  <div class="h-1.5 rounded-full bg-gray-200 overflow-hidden">
                    <div class="h-full rounded-full bg-[#2563EB] w-[40%]"></div>
                  </div>
                </div>
              </div>

              <!-- Card 4 -->
              <div class="p-4 lg:p-6 rounded-2xl border border-gray-100 bg-gray-50/50">
                <h4 class="text-sm font-bold text-[#0EA5E9] leading-tight mb-1">Bahasa Indonesia</h4>
                <p class="text-xs text-gray-600 font-medium mb-4">Paragraf Deduktif</p>
                <div class="space-y-1.5 mb-6">
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">👤</span> Tutor Jonathan</p>
                  <p class="text-[11px] text-gray-500 flex items-center gap-2"><span class="text-gray-400">📅</span> Sabtu, 15:00-17:30</p>
                </div>
                <div>
                  <div class="flex justify-between items-center text-[11px] font-bold text-[#2563EB] mb-2">
                    <span>Progres</span>
                    <span>95%</span>
                  </div>
                  <div class="h-1.5 rounded-full bg-gray-200 overflow-hidden">
                    <div class="h-full rounded-full bg-[#2563EB] w-[95%]"></div>
                  </div>
                </div>
              </div>
              
            </div>
          </section>

</template>


<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { ref, computed } from 'vue';

const emit = defineEmits(['navigate']);
const goNav = (id) => emit('navigate', id);

</script>
