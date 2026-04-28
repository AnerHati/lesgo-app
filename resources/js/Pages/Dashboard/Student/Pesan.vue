<template>
  <div class="max-w-6xl mx-auto w-full space-y-6">
    <section class="bg-gradient-to-r from-blue-50 via-sky-50 to-indigo-50 rounded-xl border border-blue-100 p-8 relative overflow-hidden">
      <div class="hero-orb-1 opacity-30"></div>
      <h2 class="text-4xl font-black text-gray-900 relative z-10">Pesan</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium relative z-10">Kirim dan lihat pesanmu dengan tutor.</p>
      <p class="text-sm text-gray-700 font-medium relative z-10">Jaga komunikasi agar belajar semakin efektif, Kenzo!</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[600px]">
      <!-- Chat List -->
      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full">
        <div v-if="pesanList.length > 0" class="overflow-y-auto flex-1 p-2">
          <div class="p-3 border-b border-gray-100 hover:bg-gray-50 rounded-xl cursor-pointer transition flex items-center justify-between bg-blue-50/50">
            <div class="flex items-center gap-3">
              <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" class="w-12 h-12 rounded-full">
              <div>
                <h4 class="text-sm font-black text-gray-900">Isyana Randini</h4>
                <p class="text-xs font-medium text-gray-500 mt-0.5 truncate w-32">Permintaan booking kamu sudah sa...</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-gray-400">10.30</span>
          </div>
          
          <div class="p-3 border-b border-gray-100 hover:bg-gray-50 rounded-xl cursor-pointer transition flex items-center justify-between">
            <div class="flex items-center gap-3">
              <img src="https://ui-avatars.com/api/?name=James+Smith&background=f3f4f6&color=4b5563" class="w-12 h-12 rounded-full">
              <div>
                <h4 class="text-sm font-black text-gray-900">James Smith</h4>
                <p class="text-xs font-medium text-gray-500 mt-0.5 truncate w-32">Perbaiki bagian esensial, sisanya su...</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-gray-400">07.00</span>
          </div>

          <div class="p-3 border-b border-gray-100 hover:bg-gray-50 rounded-xl cursor-pointer transition flex items-center justify-between">
            <div class="flex items-center gap-3">
              <img src="https://ui-avatars.com/api/?name=Jonathan+Jack&background=f3f4f6&color=4b5563" class="w-12 h-12 rounded-full">
              <div>
                <h4 class="text-sm font-black text-gray-900">Jonathan Jack</h4>
                <p class="text-xs font-medium text-gray-500 mt-0.5 truncate w-32">Perbaiki bagian esensial, sisanya su...</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-gray-400">Kemarin</span>
          </div>

          <div class="p-3 border-b border-gray-100 hover:bg-gray-50 rounded-xl cursor-pointer transition flex items-center justify-between">
            <div class="flex items-center gap-3">
              <img src="https://ui-avatars.com/api/?name=James+Smith&background=f3f4f6&color=4b5563" class="w-12 h-12 rounded-full">
              <div>
                <h4 class="text-sm font-black text-gray-900">James Smith</h4>
                <p class="text-xs font-medium text-gray-500 mt-0.5 truncate w-32">Perbaiki bagian esensial, sisanya su...</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-gray-400">Kemarin</span>
          </div>

          <div class="p-3 hover:bg-gray-50 rounded-xl cursor-pointer transition flex items-center justify-between">
            <div class="flex items-center gap-3">
              <img src="https://ui-avatars.com/api/?name=Jonathan+Jack&background=f3f4f6&color=4b5563" class="w-12 h-12 rounded-full">
              <div>
                <h4 class="text-sm font-black text-gray-900">Jonathan Jack</h4>
                <p class="text-xs font-medium text-gray-500 mt-0.5 truncate w-32">Perbaiki bagian esensial, sisanya su...</p>
              </div>
            </div>
            <span class="text-[10px] font-bold text-gray-400">Kemarin</span>
          </div>
        </div>
        
        <div v-else class="flex-1 flex flex-col items-center justify-center p-6 text-center">
          <span class="text-6xl mb-4 opacity-80">📭</span>
          <h3 class="text-lg font-bold text-gray-900">Belum ada obrolan</h3>
          <p class="text-xs text-gray-500 mt-2 font-medium">Mulai ngobrol dengan tutor untuk mendiskusikan materi pelajaranmu!</p>
          <button @click="$emit('navigate', 'cari')" class="mt-6 px-6 py-2.5 rounded-xl text-sm font-bold bg-[#2563EB] text-white hover:bg-blue-700 shadow-sm transition focus:outline-none focus:ring-2 focus:ring-blue-100">Cari Tutor</button>
        </div>
      </div>

      <!-- Active Chat Area -->
      <div class="md:col-span-2 bg-white rounded-[24px] border border-gray-200 shadow-sm flex flex-col h-full">
        <!-- Chat Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-[24px]">
            <div class="flex items-center gap-3">
            <div class="relative">
              <img src="https://ui-avatars.com/api/?name=Isyana+Randini&background=eff6ff&color=2563eb" class="w-10 h-10 rounded-full">
              <span class="absolute bottom-0 right-0 pulse-dot"></span>
            </div>
            <div>
              <h4 class="text-sm font-black text-gray-900 leading-tight">Isyana Randini</h4>
              <p class="text-[10px] font-bold text-emerald-500 mt-0.5 flex items-center gap-1">Online</p>
            </div>
          </div>
          <div class="flex items-center gap-3 text-gray-400">
            <button class="w-8 h-8 rounded-full hover:bg-gray-50 flex items-center justify-center transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            </button>
            <button class="w-8 h-8 rounded-full hover:bg-gray-50 flex items-center justify-center transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
        </div>

        <!-- Chat Messages -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-gray-50/30">
          <!-- Received Message -->
          <div class="flex items-end gap-2">
            <div class="bg-[#F3F4F6] text-gray-800 rounded-2xl rounded-bl-none px-5 py-3.5 max-w-[80%]">
              <p class="text-sm font-medium leading-relaxed">Permintaan booking kamu sudah saya terima, apakah bisa mulai pada Senin, 16 Mei 15:30?</p>
              <span class="text-[10px] text-gray-400 font-bold block mt-2">10:00</span>
            </div>
          </div>

          <!-- Sent Message -->
          <div class="flex items-end justify-end gap-2">
            <div class="bg-[#C8EEFF] text-gray-900 rounded-2xl rounded-br-none px-5 py-3.5 max-w-[80%]">
              <p class="text-sm font-medium leading-relaxed">Baik, Pastikan datang ke rumah saya sesuai alamat saya ya</p>
              <div class="flex items-center justify-end gap-1 mt-2">
                <span class="text-blue-500 font-bold text-xs">✓</span>
                <span class="text-[10px] text-gray-500 font-bold">10:50</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Chat Input -->
        <div class="p-4 bg-white border-t border-gray-100 rounded-b-[24px]">
          <div class="flex items-center gap-3 bg-white border border-gray-200 rounded-full pr-1.5 pl-4 py-1.5 shadow-sm focus-within:border-blue-400 focus-within:ring-1 focus-within:ring-blue-100 transition">
            <button class="text-gray-400 hover:text-gray-600 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
            </button>
            <input type="text" placeholder="..." class="flex-1 bg-transparent border-none focus:ring-0 text-sm font-medium text-gray-700 px-2">
            <button class="w-10 h-10 rounded-full bg-[#2563EB] text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
            </button>
</div>
</div>
</div>
</div>
</div>
</template>

<script setup>
import { ref } from 'vue'

defineEmits(['navigate'])

const pesanList = ref([1, 2, 3, 4, 5])
</script>
