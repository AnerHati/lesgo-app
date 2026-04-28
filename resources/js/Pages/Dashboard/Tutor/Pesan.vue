<template>
          <div class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
            <div>
              <h2 class="text-3xl font-black text-gray-900 mb-2">Pesan</h2>
              <p class="text-gray-500 font-medium text-sm">Kirim dan lihat pesanmu dengan siswa.</p>
              <p class="text-gray-500 font-medium text-sm">Jaga komunikasi agar belajar semakin efektif!</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-0 bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden" style="min-height:520px">
              <!-- Contact List -->
              <div class="lg:col-span-1 border-r border-gray-100 overflow-y-auto" style="max-height:520px">
                <div v-for="c in pesanContacts" :key="c.id"
                  @click="selectedChat = c"
                  class="flex items-center gap-3 px-5 py-4 cursor-pointer transition border-l-4"
                  :class="selectedChat?.id === c.id ? 'bg-blue-50 border-[#2563EB]' : 'border-transparent hover:bg-gray-50'"
                >
                  <div class="relative shrink-0">
                    <div class="w-11 h-11 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                      <img :src="`https://ui-avatars.com/api/?name=${c.name.replace(' ','+')}&background=${c.avatarBg}&color=${c.avatarColor}&size=88`" class="w-full h-full object-cover">
                    </div>
                    <span v-if="c.online" class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-400 border-2 border-white"></span>
                  </div>
                  <div class="flex-1 min-w-0">
                    <div class="flex justify-between items-center">
                      <p class="text-sm font-bold text-gray-900 truncate">{{ c.name }}</p>
                      <span class="text-[10px] text-gray-400 font-medium shrink-0 ml-2">{{ c.time }}</span>
                    </div>
                    <p class="text-[11px] text-gray-400 font-medium truncate mt-0.5">{{ c.lastMsg }}</p>
                  </div>
                </div>
              </div>

              <!-- Chat Area -->
              <div class="lg:col-span-2 flex flex-col">
                <template v-if="selectedChat">
                  <!-- Chat Header -->
                  <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                      <div class="w-10 h-10 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                        <img :src="`https://ui-avatars.com/api/?name=${selectedChat.name.replace(' ','+')}&background=${selectedChat.avatarBg}&color=${selectedChat.avatarColor}&size=80`" class="w-full h-full object-cover">
                      </div>
                      <div>
                        <p class="text-sm font-black text-gray-900">{{ selectedChat.name }}</p>
                        <p class="text-[10px] font-bold" :class="selectedChat.online ? 'text-emerald-500' : 'text-gray-400'">{{ selectedChat.online ? 'Online' : 'Offline' }}</p>
                      </div>
                    </div>
                    <div class="flex items-center gap-2">
                      <button type="button" class="w-9 h-9 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center hover:bg-emerald-100 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                      </button>
                      <button type="button" class="w-9 h-9 rounded-lg bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="5" r="2"/><circle cx="12" cy="12" r="2"/><circle cx="12" cy="19" r="2"/></svg>
                      </button>
                    </div>
                  </div>

                  <!-- Messages -->
                  <div class="flex-1 overflow-y-auto px-6 py-5 space-y-4" style="max-height:380px">
                    <div v-for="msg in selectedChat.messages" :key="msg.id" class="flex" :class="msg.from === 'me' ? 'justify-end' : 'justify-start'">
                      <div class="max-w-[70%] px-4 py-3 rounded-2xl text-sm font-medium leading-relaxed"
                        :class="msg.from === 'me' ? 'bg-[#2563EB] text-white rounded-br-md' : 'bg-gray-100 text-gray-800 rounded-bl-md'"
                      >
                        <p>{{ msg.text }}</p>
                        <p class="text-[9px] mt-1.5 text-right" :class="msg.from === 'me' ? 'text-blue-200' : 'text-gray-400'">{{ msg.time }}</p>
                      </div>
                    </div>
                  </div>

                  <!-- Input -->
                  <div class="px-6 py-4 border-t border-gray-100">
                    <div class="flex items-center gap-3">
                      <button type="button" class="w-10 h-10 shrink-0 rounded-xl bg-gray-100 text-gray-500 flex items-center justify-center hover:bg-gray-200 transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
                      </button>
                      <input type="text" placeholder="Ketik pesan..." class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium focus:outline-none focus:border-blue-400 transition">
                      <button type="button" class="w-10 h-10 shrink-0 rounded-xl bg-[#2563EB] text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                      </button>
                    </div>
                  </div>
                </template>
                <template v-else>
                  <div class="flex-1 flex items-center justify-center text-center p-8">
                    <div>
                      <span class="text-5xl mb-3 block">💬</span>
                      <p class="text-lg font-bold text-gray-700">Pilih percakapan</p>
                      <p class="text-sm text-gray-400 mt-1">Klik kontak di sebelah kiri untuk mulai chat.</p>
                    </div>
                  </div>
                </template>
              </div>
            </div>
          </div>
</template>

<script setup>
import { ref } from 'vue'
const selectedChat = ref(null)
const pesanContacts = [
  { id: 1, name: 'Ananta Aldora', avatarBg: 'fce7f3', avatarColor: 'db2777', online: true, time: '10.30', lastMsg: 'Perbaiki bagian esensial...', messages: [
    { id: 1, from: 'them', text: 'Bu Isyana, hari ini kita belajar tentang pecahan kan?', time: '10:00' },
    { id: 2, from: 'me', text: 'Betul, hari ini kita belajar tentang pecahan.', time: '10:50' },
  ]},
  { id: 2, name: 'Aditya Satria', avatarBg: 'dbeafe', avatarColor: '2563eb', online: false, time: '07.00', lastMsg: 'Perbaiki bagian esensial...', messages: [
    { id: 1, from: 'them', text: 'Selamat pagi bu, tugas sudah saya kerjakan.', time: '06:45' },
    { id: 2, from: 'me', text: 'Bagus Aditya! Nanti saya periksa ya.', time: '07:00' },
  ]},
]
</script>
