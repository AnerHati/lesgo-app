<template>
  <div class="max-w-6xl mx-auto w-full space-y-6">
    <section class="bg-gradient-to-r from-blue-50 via-sky-50 to-indigo-50 rounded-xl border border-blue-100 p-8 relative overflow-hidden">
      <div class="hero-orb-1 opacity-30"></div>
      <h2 class="text-4xl font-black text-gray-900 relative z-10">Pesan</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium relative z-10">Kirim dan lihat pesanmu dengan kolega.</p>
      <p class="text-sm text-gray-700 font-medium relative z-10">Jaga komunikasi agar belajar semakin efektif!</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 h-[600px]">
      <!-- Chat List -->
      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden flex flex-col h-full">
        <div v-if="contacts.length > 0" class="overflow-y-auto flex-1 p-2 space-y-1">
          <div 
            v-for="contact in contacts" 
            :key="contact.id"
            @click="selectContact(contact)"
            class="p-3 border-b border-gray-100 hover:bg-gray-50 rounded-xl cursor-pointer transition flex items-center justify-between"
            :class="activeContact?.id === contact.id ? 'bg-blue-50/50 border-blue-100' : ''"
          >
            <div class="flex items-center gap-3 min-w-0">
              <img :src="`https://ui-avatars.com/api/?name=${contact.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" class="w-12 h-12 rounded-full shrink-0">
              <div class="min-w-0 pr-2">
                <h4 class="text-sm font-black text-gray-900 truncate">{{ contact.name }}</h4>
                <p class="text-xs font-medium text-gray-500 mt-0.5 truncate w-32">Klik untuk melihat pesan</p>
              </div>
            </div>
            <div v-if="contact.unread_count > 0" class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-[10px] font-bold shrink-0">
              {{ contact.unread_count }}
            </div>
          </div>
        </div>
        
        <div v-else class="flex-1 flex flex-col items-center justify-center p-6 text-center">
          <span class="text-6xl mb-4 opacity-80">📭</span>
          <h3 class="text-lg font-bold text-gray-900">Belum ada kontak</h3>
          <p class="text-xs text-gray-500 mt-2 font-medium">Kamu baru bisa mengirim pesan jika sudah memiliki kelas yang aktif.</p>
        </div>
      </div>

      <!-- Active Chat Area -->
      <div v-if="activeContact" class="md:col-span-2 bg-white rounded-[24px] border border-gray-200 shadow-sm flex flex-col h-full notranslate">
        <!-- Chat Header -->
        <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between bg-white rounded-t-[24px]">
            <div class="flex items-center gap-3">
            <div class="relative">
              <img :src="`https://ui-avatars.com/api/?name=${activeContact.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" class="w-10 h-10 rounded-full">
              <span class="absolute bottom-0 right-0 pulse-dot"></span>
            </div>
            <div>
              <h4 class="text-sm font-black text-gray-900 leading-tight">{{ activeContact.name }}</h4>
              <p class="text-[10px] font-bold text-emerald-500 mt-0.5 flex items-center gap-1">Online</p>
            </div>
          </div>
        </div>

        <!-- Chat Messages -->
        <div id="chat-container" class="flex-1 overflow-y-auto p-6 space-y-4 bg-gray-50/30">
          <div v-for="msg in messages" :key="msg.id" class="flex w-full" :class="msg.sender_id === props.user.id ? 'justify-end' : 'justify-start'">
            <div v-if="msg.sender_id === props.user.id" class="flex items-end justify-end gap-2 max-w-[80%]">
              <div class="bg-[#C8EEFF] text-gray-900 rounded-2xl rounded-br-none px-5 py-3.5">
                <p class="text-sm font-medium leading-relaxed whitespace-pre-wrap">{{ msg.message }}</p>
                <div class="flex items-center justify-end gap-1 mt-2">
                  <span v-if="msg.is_read" class="text-blue-500 font-bold text-xs">✓✓</span>
                  <span v-else class="text-gray-400 font-bold text-xs">✓</span>
                  <span class="text-[10px] text-gray-500 font-bold">{{ formatTime(msg.created_at) }}</span>
                </div>
              </div>
            </div>
            <div v-else class="flex items-end gap-2 max-w-[80%]">
              <div class="bg-[#F3F4F6] text-gray-800 rounded-2xl rounded-bl-none px-5 py-3.5">
                <p class="text-sm font-medium leading-relaxed">{{ msg.message }}</p>
                <span class="text-[10px] text-gray-400 font-bold block mt-2">{{ formatTime(msg.created_at) }}</span>
              </div>
            </div>
          </div>
          
          <div v-if="messages.length === 0" class="text-center text-gray-400 text-sm font-bold mt-10">
            Mulai percakapan dengan {{ activeContact.name }}
          </div>
        </div>

        <!-- Chat Input -->
        <div class="p-4 bg-white border-t border-gray-100 rounded-b-[24px]">
          <form @submit.prevent="sendMessage" class="flex items-center gap-3 bg-white border border-gray-200 rounded-full pr-1.5 pl-4 py-1.5 shadow-sm focus-within:border-blue-400 focus-within:ring-1 focus-within:ring-blue-100 transition">
            <input v-model="newMessage" type="text" placeholder="Ketik pesan..." class="flex-1 bg-transparent border-none focus:ring-0 text-sm font-medium text-gray-700 px-2">
            <button type="submit" class="w-10 h-10 rounded-full bg-[#2563EB] text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm shrink-0" :disabled="!newMessage.trim()">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
            </button>
          </form>
        </div>
      </div>
      
      <div v-else class="md:col-span-2 bg-gray-50 rounded-[24px] border border-gray-200 shadow-sm flex flex-col items-center justify-center h-full text-center">
          <span class="text-6xl mb-4 opacity-50">💬</span>
          <p class="text-gray-400 font-bold">Pilih kontak untuk melihat obrolan</p>
      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue'
import { router } from '@inertiajs/vue3'

const props = defineProps({
  user: { type: Object, required: true }
})

defineEmits(['navigate'])

const contacts = ref([])
const activeContact = ref(null)
const messages = ref([])
const newMessage = ref('')
const pollingInterval = ref(null)

onMounted(() => {
    fetchContacts()
    pollingInterval.value = setInterval(() => {
        if (activeContact.value) {
            fetchMessages(activeContact.value.id, false)
            fetchContacts() // Also polling contacts to update unread_count per contact
        }
    }, 5000)
})

onUnmounted(() => {
    if (pollingInterval.value) clearInterval(pollingInterval.value)
})

async function fetchContacts() {
    try {
        const res = await window.axios.get('/api/chat/contacts')
        contacts.value = res.data
        if (contacts.value.length > 0 && !activeContact.value) {
            selectContact(contacts.value[0])
        }
    } catch (e) {
        console.error("Gagal load contacts", e)
    }
}

function selectContact(contact) {
    activeContact.value = contact
    fetchMessages(contact.id, true)
}

async function fetchMessages(contactId, scroll = false) {
    try {
        const res = await window.axios.get(`/api/chat/messages/${contactId}`)
        messages.value = res.data
        if (scroll) {
            setTimeout(() => {
                const el = document.getElementById('chat-container')
                if (el) el.scrollTop = el.scrollHeight
            }, 100)
        }
        
        // Reload global notification badge and contact list unread counts
        router.reload({ only: ['unreadSendersCount'] })
        
        // Mark locally as read
        const contact = contacts.value.find(c => c.id === contactId)
        if (contact) contact.unread_count = 0
        
    } catch (e) {
        console.error("Gagal load messages", e)
    }
}

async function sendMessage() {
    if (!newMessage.value.trim() || !activeContact.value) return
    try {
        const text = newMessage.value
        newMessage.value = ''
        const res = await window.axios.post('/api/chat/messages', {
            receiver_id: activeContact.value.id,
            message: text
        })
        messages.value.push(res.data)
        setTimeout(() => {
            const el = document.getElementById('chat-container')
            if (el) el.scrollTop = el.scrollHeight
        }, 100)
    } catch (e) {
        console.error("Gagal send message", e)
    }
}

function formatTime(dateString) {
    if (!dateString) return ''
    const d = new Date(dateString)
    return `${d.getHours().toString().padStart(2,'0')}:${d.getMinutes().toString().padStart(2,'0')}`
}
</script>
