<template>
  <div class="max-w-6xl mx-auto w-full animate-fade-in space-y-6">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#E0F2FE] to-cyan-50 rounded-[24px] p-8 border border-blue-100/50 shadow-sm relative overflow-hidden">
      <div class="relative z-10 max-w-2xl">
        <h2 class="text-3xl font-black text-gray-900 mb-3">Pesan</h2>
        <p class="text-sm font-medium text-gray-600 leading-relaxed">
          Kirim dan lihat pesan Anda dengan tutor.<br>
          Jaga komunikasi agar belajar anak Anda semakin efektif!
        </p>
      </div>
    </div>

    <!-- Chat Interface -->
    <div class="bg-transparent flex flex-col md:flex-row gap-6 h-[600px]">
      
      <!-- Left Column: Chat List -->
      <div class="w-full md:w-1/3 flex flex-col bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
        <div class="overflow-y-auto flex-1 p-2 space-y-1 custom-scrollbar">
          
          <div v-for="chat in chatList" :key="chat.id" 
               @click="activeChat = chat.id"
               class="p-4 flex items-start gap-4 rounded-xl cursor-pointer transition-all duration-200"
               :class="activeChat === chat.id ? 'bg-blue-50/50 border border-blue-100 shadow-sm' : 'hover:bg-gray-50 border border-transparent'">
            
            <div class="relative shrink-0">
              <div class="w-12 h-12 rounded-full overflow-hidden border border-gray-100">
                <img :src="chat.avatar" class="w-full h-full object-cover" :alt="chat.name">
              </div>
              <div v-if="chat.online" class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 border-2 border-white rounded-full"></div>
            </div>
            
            <div class="flex-1 min-w-0">
              <div class="flex justify-between items-baseline mb-1">
                <h4 class="text-sm font-bold text-gray-900 truncate pr-2">{{ chat.name }}</h4>
                <span class="text-[10px] font-bold" :class="chat.unread ? 'text-blue-600' : 'text-gray-400'">{{ chat.time }}</span>
              </div>
              <p class="text-[11px] truncate" :class="chat.unread ? 'font-bold text-gray-800' : 'font-medium text-gray-500'">
                {{ chat.lastMessage }}
              </p>
            </div>
          </div>
          
        </div>
      </div>

      <!-- Right Column: Active Chat -->
      <div class="w-full md:w-2/3 flex flex-col bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden relative">
        
        <!-- Chat Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white z-10 shrink-0">
          <div class="flex items-center gap-4">
            <div class="relative shrink-0">
              <div class="w-12 h-12 rounded-full overflow-hidden border border-gray-100">
                <img :src="currentChatData.avatar" class="w-full h-full object-cover">
              </div>
            </div>
            <div>
              <h3 class="text-base font-bold text-gray-900 leading-tight">{{ currentChatData.name }}</h3>
              <p v-if="currentChatData.online" class="text-[11px] font-bold text-green-500">Online</p>
              <p v-else class="text-[11px] font-bold text-gray-400">Offline</p>
            </div>
          </div>
          <div class="flex items-center gap-4 text-gray-400">
            <button class="hover:text-blue-600 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
            </button>
            <button class="hover:text-gray-600 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path></svg>
            </button>
          </div>
        </div>

        <!-- Chat Area -->
        <div class="flex-1 overflow-y-auto p-6 space-y-6 bg-[#FAFAFA] custom-scrollbar">
          
          <div v-for="(msg, index) in currentChatData.messages" :key="index" class="flex flex-col" :class="msg.isMine ? 'items-end' : 'items-start'">
            
            <div class="max-w-[75%] px-5 py-3.5 shadow-sm relative group"
                 :class="msg.isMine ? 'bg-[#D1E8FF] text-gray-800 rounded-2xl rounded-tr-sm' : 'bg-white text-gray-600 border border-gray-100 rounded-2xl rounded-tl-sm'">
              <p class="text-sm font-medium leading-relaxed" v-html="msg.text"></p>
              
              <div class="flex items-center gap-1 mt-1 justify-end" :class="msg.isMine ? 'text-blue-500' : 'text-gray-400'">
                <span v-if="msg.isMine" class="text-[10px] font-bold opacity-70">
                  <svg v-if="msg.read" class="w-3.5 h-3.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7 M5 18l4 4L19 12"></path></svg>
                  <svg v-else class="w-3.5 h-3.5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                </span>
                <span class="text-[10px] font-bold" :class="msg.isMine ? 'text-blue-500/70' : 'text-gray-400'">{{ msg.time }}</span>
              </div>
            </div>

          </div>

        </div>

        <!-- Input Area -->
        <div class="p-4 bg-white border-t border-gray-100 shrink-0">
          <div class="flex items-end gap-3 bg-white border border-gray-200 rounded-[20px] p-2 focus-within:ring-2 focus-within:ring-blue-100 focus-within:border-blue-300 transition-all shadow-sm">
            <button class="p-2.5 text-gray-400 hover:text-gray-600 transition shrink-0 rounded-xl hover:bg-gray-50">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path></svg>
            </button>
            <textarea 
              v-model="newMessage"
              rows="1"
              placeholder="Tulis pesan..." 
              class="w-full bg-transparent border-none focus:ring-0 text-sm font-medium text-gray-700 resize-none max-h-32 py-3 px-1"
              @keydown.enter.prevent="sendMessage"
            ></textarea>
            <button @click="sendMessage" 
                    class="w-12 h-12 bg-[#2563EB] text-white rounded-xl flex items-center justify-center shrink-0 hover:bg-blue-600 transition shadow-md shadow-blue-500/20 group">
              <svg v-if="newMessage.trim()" class="w-5 h-5 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
              <svg v-else class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11a7 7 0 01-7 7m0 0a7 7 0 01-7-7m7 7v4m0 0H8m4 0h4m-4-8a3 3 0 01-3-3V5a3 3 0 116 0v6a3 3 0 01-3 3z"></path></svg>
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue';

const activeChat = ref(1);
const newMessage = ref('');

const chatList = ref([
  {
    id: 1,
    name: 'Ananta Aldora',
    avatar: 'https://ui-avatars.com/api/?name=Ananta+Aldora&background=e0e7ff&color=3730a3',
    time: '10.30',
    lastMessage: 'Perbaiki bagian esensial, sisanya su...',
    online: true,
    unread: false,
    messages: [
      { text: 'Pagi bu Sarah, untuk progres Kenzo dan tugas sudah saya cantumkan di folder tugas ya...', time: '10:00', isMine: false, read: true },
      { text: 'Terima kasih, bu Ananta.', time: '10:50', isMine: true, read: true }
    ]
  },
  {
    id: 2,
    name: 'James Smith',
    avatar: 'https://ui-avatars.com/api/?name=James+Smith&background=fce7f3&color=9d174d',
    time: '07.00',
    lastMessage: 'Pagi bu Sarah, untuk progres Kenzo...',
    online: false,
    unread: true,
    messages: [
      { text: 'Pagi bu Sarah, untuk progres Kenzo minggu ini sangat baik. Dia sudah mulai memahami konsep dasar pecahan.', time: '07:00', isMine: false, read: false }
    ]
  },
  {
    id: 3,
    name: 'Jonathan Jack',
    avatar: 'https://ui-avatars.com/api/?name=Jonathan+Jack&background=dcfce7&color=166534',
    time: 'Kemarin',
    lastMessage: 'Pagi bu Sarah, untuk progres Kenzo...',
    online: false,
    unread: false,
    messages: [
      { text: 'Pagi bu Sarah, untuk progres Kenzo hari ini...', time: 'Kemarin', isMine: false, read: true }
    ]
  },
  {
    id: 4,
    name: 'James Smith',
    avatar: 'https://ui-avatars.com/api/?name=James+Smith&background=fce7f3&color=9d174d',
    time: 'Kemarin',
    lastMessage: 'Pagi bu Sarah, untuk progres Kenzo...',
    online: false,
    unread: false,
    messages: [
      { text: 'Pagi bu Sarah, untuk progres Kenzo hari ini...', time: 'Kemarin', isMine: false, read: true }
    ]
  },
  {
    id: 5,
    name: 'Jonathan Jack',
    avatar: 'https://ui-avatars.com/api/?name=Jonathan+Jack&background=dcfce7&color=166534',
    time: 'Kemarin',
    lastMessage: 'Pagi bu Sarah, untuk progres Kenzo...',
    online: false,
    unread: false,
    messages: [
      { text: 'Pagi bu Sarah, untuk progres Kenzo hari ini...', time: 'Kemarin', isMine: false, read: true }
    ]
  }
]);

const currentChatData = computed(() => {
  return chatList.value.find(c => c.id === activeChat.value) || chatList.value[0];
});

const sendMessage = () => {
  if (!newMessage.value.trim()) return;
  
  const chatIndex = chatList.value.findIndex(c => c.id === activeChat.value);
  if (chatIndex !== -1) {
    chatList.value[chatIndex].messages.push({
      text: newMessage.value.replace(/\n/g, '<br>'),
      time: new Date().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' }).replace(':', '.'),
      isMine: true,
      read: false
    });
    chatList.value[chatIndex].lastMessage = newMessage.value;
    chatList.value[chatIndex].time = 'Baru saja';
  }
  
  newMessage.value = '';
};
</script>

<style scoped>
.custom-scrollbar::-webkit-scrollbar {
  width: 5px;
}
.custom-scrollbar::-webkit-scrollbar-track {
  background: transparent;
}
.custom-scrollbar::-webkit-scrollbar-thumb {
  background: #E5E7EB;
  border-radius: 10px;
}
.custom-scrollbar::-webkit-scrollbar-thumb:hover {
  background: #D1D5DB;
}
</style>
