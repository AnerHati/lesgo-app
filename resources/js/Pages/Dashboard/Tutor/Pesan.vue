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
        <div v-if="contacts.length > 0">
          <div v-for="c in contacts" :key="c.id"
            @click="selectContact(c)"
            class="flex items-center gap-3 px-5 py-4 cursor-pointer transition border-l-4"
            :class="activeContact?.id === c.id ? 'bg-blue-50 border-[#2563EB]' : 'border-transparent hover:bg-gray-50'"
          >
            <div class="relative shrink-0">
              <div class="w-11 h-11 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                <img :src="`https://ui-avatars.com/api/?name=${c.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb&size=88`" class="w-full h-full object-cover">
              </div>
              <span class="absolute bottom-0 right-0 w-3 h-3 rounded-full bg-emerald-400 border-2 border-white"></span>
            </div>
            <div class="flex-1 min-w-0">
              <div class="flex justify-between items-center">
                <p class="text-sm font-bold text-gray-900 truncate">{{ c.name }}</p>
                <div v-if="c.unread_count > 0" class="w-5 h-5 rounded-full bg-red-500 text-white flex items-center justify-center text-[10px] font-bold shrink-0 ml-2">
                  {{ c.unread_count }}
                </div>
              </div>
              <p class="text-[11px] text-gray-400 font-medium truncate mt-0.5">Klik untuk melihat pesan</p>
            </div>
          </div>
        </div>
        <div v-else class="flex flex-col items-center justify-center p-8 text-center text-gray-500">
           Belum ada kontak siswa.
        </div>
      </div>

      <!-- Chat Area -->
      <div class="lg:col-span-2 flex flex-col notranslate">
        <template v-if="activeContact">
          <!-- Chat Header -->
          <div class="flex items-center justify-between px-6 py-4 border-b border-gray-100">
            <div class="flex items-center gap-3">
              <div class="w-10 h-10 rounded-full bg-blue-50 overflow-hidden border border-gray-100">
                <img :src="`https://ui-avatars.com/api/?name=${activeContact.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb&size=80`" class="w-full h-full object-cover">
              </div>
              <div>
                <p class="text-sm font-black text-gray-900">{{ activeContact.name }}</p>
                <p class="text-[10px] font-bold text-emerald-500">Online</p>
              </div>
            </div>
          </div>

          <!-- Messages -->
          <div id="tutor-chat-container" class="flex-1 overflow-y-auto px-6 py-5 space-y-4" style="max-height:380px">
            <div v-for="msg in messages" :key="msg.id" class="flex" :class="msg.sender_id === props.user.id ? 'justify-end' : 'justify-start'">
              <div class="max-w-[70%] px-4 py-3 rounded-2xl text-sm font-medium leading-relaxed"
                :class="msg.sender_id === props.user.id ? 'bg-[#2563EB] text-white rounded-br-md' : 'bg-gray-100 text-gray-800 rounded-bl-md'"
              >
                <p class="whitespace-pre-wrap">{{ msg.message }}</p>
                <p class="text-[9px] mt-1.5 text-right" :class="msg.sender_id === props.user.id ? 'text-blue-200' : 'text-gray-400'">
                   <span v-if="msg.sender_id === props.user.id && msg.is_read">✓✓ </span>
                   <span v-else-if="msg.sender_id === props.user.id">✓ </span>
                   {{ formatTime(msg.created_at) }}
                </p>
              </div>
            </div>
            <div v-if="messages.length === 0" class="text-center text-gray-400 text-sm font-bold mt-10">
              Mulai percakapan dengan {{ activeContact.name }}
            </div>
          </div>

          <!-- Input -->
          <div class="px-6 py-4 border-t border-gray-100">
            <form @submit.prevent="sendMessage" class="flex items-center gap-3">
              <input v-model="newMessage" type="text" placeholder="Ketik pesan..." class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-sm font-medium focus:outline-none focus:border-blue-400 transition">
              <button type="submit" class="w-10 h-10 shrink-0 rounded-xl bg-[#2563EB] text-white flex items-center justify-center hover:bg-blue-700 transition shadow-sm" :disabled="!newMessage.trim()">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
              </button>
            </form>
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
            fetchContacts()
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
                const el = document.getElementById('tutor-chat-container')
                if (el) el.scrollTop = el.scrollHeight
            }, 100)
        }
        
        router.reload({ only: ['unreadSendersCount'] })
        
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
            const el = document.getElementById('tutor-chat-container')
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
