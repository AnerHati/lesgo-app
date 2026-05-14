<template>
  <div>
    <!-- Pesan Tutor View -->
    <div v-if="view === 'pesan_tutor'" class="animate-fade-in">
      <div class="mb-6">
        <button @click="$emit('back')" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
          <span aria-hidden="true">←</span> Kembali
        </button>
      </div>
      <h2 class="text-3xl font-black mb-6 text-gray-900">Pesan Tutor</h2>

      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-8">
        <!-- Tutor Header -->
        <div class="flex items-center gap-5 pb-6 border-b border-gray-100 mb-6">
          <div class="w-20 h-20 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-blue-100 flex items-center justify-center text-4xl">
            <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" :alt="tutor.name" class="w-full h-full object-cover">
          </div>
          <div>
            <h3 class="text-2xl font-black text-gray-900 leading-tight">{{ tutor.name }}</h3>
            <div class="flex items-center gap-1 mt-1 text-sm font-bold">
              <span class="text-amber-400">⭐⭐⭐⭐⭐</span>
            </div>
            <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
              <span class="text-gray-400 text-base w-4 text-center">📚</span> {{ tutor.subjects?.[0]?.name || 'Umum' }}
            </p>
            <p class="text-sm font-bold text-gray-500 mt-1 flex items-center gap-2">
              <span class="text-gray-400 text-base w-4 text-center">📍</span> {{ tutor.address || 'Denpasar' }}
            </p>
          </div>
        </div>

        <h3 class="text-[#2563EB] text-xl font-black mb-6">Pilih paket sesuai yang kamu mau.</h3>

        <!-- 1. Metode Belajar -->
        <div class="mb-8">
          <h4 class="text-lg font-black text-gray-900 mb-4">1. Pilih Metode Belajar</h4>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex items-center gap-4 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
              <input type="radio" v-model="form.metode_belajar" value="rumah" class="hidden">
              <div class="text-gray-400 text-2xl w-8 text-center shrink-0">🏠</div>
              <div>
                <p class="text-sm font-bold text-gray-800 leading-snug">Tutor datang ke rumah kamu</p>
                <p class="text-xs font-bold text-[#2563EB] mt-1">Area: Sesuai domisili</p>
              </div>
            </label>
            <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex items-center gap-4 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
              <input type="radio" v-model="form.metode_belajar" value="online" class="hidden">
              <div class="text-gray-400 text-2xl w-8 text-center shrink-0">💻</div>
              <div>
                <p class="text-sm font-bold text-gray-800 leading-snug">Online</p>
                <p class="text-xs font-bold text-[#2563EB] mt-1">Zoom / Google Meet</p>
              </div>
            </label>
          </div>
        </div>

        <!-- 2. Paket Mengajar -->
        <div class="mb-8">
          <h4 class="text-lg font-black text-gray-900 mb-4">2. Pilih Paket Mengajar</h4>
          <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex flex-col has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
              <input type="radio" v-model="form.paket_mengajar" value="4x" class="hidden">
              <p class="text-sm font-bold text-gray-900 mb-2">4x Pertemuan</p>
              <p class="text-2xl font-black text-gray-900 mb-1">Rp400.000 <span class="text-[10px] font-bold text-gray-400 uppercase">sebulan</span></p>
              <p class="text-xs text-gray-500 font-medium">1 Minggu sekali selama 1 bulan</p>
            </label>
            <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex flex-col has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
              <input type="radio" v-model="form.paket_mengajar" value="8x" class="hidden">
              <p class="text-sm font-bold text-gray-900 mb-2">8x Pertemuan</p>
              <p class="text-2xl font-black text-gray-900 mb-1">Rp760.000 <span class="text-[10px] font-bold text-gray-400 uppercase">sebulan</span></p>
              <p class="text-xs text-gray-500 font-medium">2 Minggu sekali selama 1 bulan</p>
            </label>
            <label class="relative border-2 border-gray-200 rounded-2xl p-5 cursor-pointer hover:border-blue-300 transition flex flex-col has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
              <input type="radio" v-model="form.paket_mengajar" value="12x" class="hidden">
              <div class="absolute -top-3 -right-3 bg-[#2563EB] text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-sm whitespace-nowrap">Paling Hemat</div>
              <p class="text-sm font-bold text-gray-900 mb-2">12x Pertemuan</p>
              <p class="text-2xl font-black text-gray-900 mb-1">Rp1.100.000 <span class="text-[10px] font-bold text-gray-400 uppercase">sebulan</span></p>
              <p class="text-xs text-gray-500 font-medium">3 Minggu sekali selama 1 bulan</p>
            </label>
          </div>
        </div>

        <!-- 3. Pilih Jadwal Preferensi -->
        <div class="mb-8">
          <h4 class="text-lg font-black text-gray-900 mb-4">3. Pilih Jadwal Preferensi</h4>
          <p class="text-xs font-bold text-gray-500 mb-4">Pilih waktu mulai yang sesuai dengan ketersediaan tutor.</p>
          
          <div v-if="isLoadingAvailabilities" class="py-4 text-center">
            <span class="text-sm font-bold text-gray-400 italic">Memuat ketersediaan tutor...</span>
          </div>
          <div v-else-if="availabilities.length === 0" class="py-6 px-4 bg-orange-50 border border-orange-100 rounded-2xl text-center">
            <p class="text-sm font-bold text-orange-600">Tutor ini belum mengatur jadwal ketersediaan.</p>
            <p class="text-[10px] text-orange-400 mt-1 uppercase">Silakan chat tutor terlebih dahulu untuk menanyakan jadwal.</p>
          </div>
          <div v-else class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
            <label v-for="slot in availabilities" :key="slot.id" class="relative border-2 border-gray-100 rounded-xl p-3 cursor-pointer hover:border-blue-200 transition flex flex-col items-center text-center has-[:checked]:border-blue-500 has-[:checked]:bg-blue-50/50">
              <input type="radio" v-model="form.preferred_start_time" :value="`${days[slot.day_of_week]}, ${formatTime(slot.start_time)}`" class="hidden">
              <span class="text-[10px] font-black text-blue-600 uppercase mb-1">{{ days[slot.day_of_week] }}</span>
              <span class="text-sm font-black text-gray-900">{{ formatTime(slot.start_time) }}</span>
              <span class="text-[9px] font-bold text-gray-400 uppercase mt-1">Mulai</span>
            </label>
          </div>
          <p v-if="form.preferred_start_time" class="mt-4 text-sm font-bold text-blue-600 flex items-center gap-2">
            <span class="w-2 h-2 bg-blue-600 rounded-full animate-pulse"></span>
            Terpilih: {{ form.preferred_start_time }}
          </p>
        </div>

        <!-- 4. Rincian Biaya -->
        <div>
          <h4 class="text-lg font-black text-gray-900 mb-4">4. Rincian Biaya Mengajar</h4>
          <div class="border border-gray-200 rounded-2xl overflow-hidden">
            <div class="p-5 flex justify-between items-center border-b border-gray-100 bg-[#FAFBFC]">
              <span class="text-base font-black text-gray-900">Paket {{ form.paket_mengajar }} pertemuan</span>
              <span class="text-base font-bold text-gray-900">{{ priceFormatted }}</span>
            </div>
            <div class="p-5 flex justify-between items-center border-t border-gray-100 bg-[#FAFBFC]">
              <span class="text-sm font-bold text-gray-700">Total Estimasi</span>
              <span class="text-xl font-black text-gray-900">{{ priceFormatted }}</span>
            </div>
          </div>
        </div>

        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
          <p class="text-xs font-bold text-gray-500">Kamu bisa membayar setelah jadwal dikonfirmasi oleh tutor.</p>
          <button @click="submitBooking" type="button" class="bg-[#2563EB] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition w-full sm:w-auto">
            Kirim Permintaan
          </button>
        </div>
      </div>
    </div>

    <!-- Menunggu Konfirmasi View -->
    <div v-else-if="view === 'menunggu_konfirmasi'" class="animate-fade-in">
      <div class="mb-6">
        <button @click="view = 'pesan_tutor'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
          <span aria-hidden="true">←</span> Kembali
        </button>
      </div>
      
      <h2 class="text-3xl font-black mb-6 text-gray-900">Booking Saya</h2>

      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden max-w-4xl">
        <div class="bg-[#FFF8F1] px-6 py-4 border-b border-gray-200">
          <h3 class="font-bold text-gray-900">Menunggu Konfirmasi Tutor</h3>
        </div>

        <div class="p-8">
          <div class="flex items-start gap-6 mb-8">
            <div class="w-28 h-28 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 flex items-center justify-center text-4xl shadow-sm">
              <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" class="w-full h-full object-cover">
            </div>
            <div class="pt-2">
              <h3 class="text-2xl font-black text-gray-900 leading-tight">{{ tutor.name }}</h3>
              <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                <span class="text-gray-400 text-base w-5 text-center">📦</span> Paket: {{ form.paket_mengajar }}
              </p>
              <p class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                <span class="text-gray-400 text-base w-5 text-center">🏠</span> Metode: {{ form.metode_belajar === 'rumah' ? 'Privat ke rumah' : 'Online' }}
              </p>
              <p v-if="form.preferred_start_time" class="text-sm font-bold text-gray-500 mt-2 flex items-center gap-2">
                <span class="text-gray-400 text-base w-5 text-center">🕒</span> Jadwal: {{ form.preferred_start_time }}
              </p>
            </div>
          </div>

          <div class="bg-[#FFF8F1] border border-orange-100 rounded-xl p-4 flex items-center gap-3 mb-6">
            <span class="text-orange-400 text-xl font-black">🕒</span>
            <p class="text-sm font-bold text-orange-400">Status: Menunggu Konfirmasi</p>
          </div>

          <div class="flex flex-col sm:flex-row gap-4 mb-4">
            <button @click="$emit('navigate', 'pesan')" type="button" class="flex-1 py-3.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition text-center shadow-sm">
              Chat Tutor
            </button>
            <button @click="$emit('cancel')" type="button" class="flex-1 py-3.5 rounded-xl text-sm font-bold border-2 border-red-500 text-red-500 hover:bg-red-50 transition text-center shadow-sm">
              Batalkan Permintaan
            </button>
          </div>

          <p @click="view = 'booking_dikonfirmasi'" class="text-xs font-bold text-gray-400 mt-6 cursor-pointer hover:text-[#2563EB] transition">Tunggu konfirmasi dalam waktu 24 jam dari tutor (Klik ini simulasi diterima)</p>
        </div>
      </div>
    </div>

    <!-- Booking Dikonfirmasi View -->
    <div v-else-if="view === 'booking_dikonfirmasi'" class="animate-fade-in">
      <div class="mb-6">
        <button @click="view = 'menunggu_konfirmasi'" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
          <span aria-hidden="true">←</span> Kembali
        </button>
      </div>
      
      <h2 class="text-3xl font-black mb-6 text-gray-900">Booking Saya</h2>

      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden max-w-4xl">
        <div class="bg-[#E7FFE7] px-8 py-5 border-b border-gray-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
          <div>
            <h3 class="text-2xl font-black text-gray-900">Booking Dikonfirmasi</h3>
            <p class="text-sm font-medium text-gray-700 mt-1">Selesaikan pembayaran untuk memulai les</p>
          </div>
          <button @click="showPaymentModal = true" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm shadow-sm flex items-center justify-center gap-2 hover:bg-blue-700 transition w-full sm:w-auto relative">
            <span>💳</span> Bayar Sekarang
          </button>
        </div>

        <div class="p-8">
          <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-6">
            <div class="flex flex-col sm:flex-row items-start gap-6">
              <div class="w-28 h-28 rounded-full bg-blue-50 overflow-hidden shrink-0 border border-gray-100 flex items-center justify-center text-4xl shadow-sm">
                <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" class="w-full h-full object-cover">
              </div>
              <div class="pt-2">
                <h3 class="text-2xl font-black text-gray-900 leading-tight">{{ tutor.name }}</h3>
                <p class="text-sm font-bold text-gray-500 mt-3 flex items-center gap-2">
                  <span class="text-gray-400 text-base w-5 text-center">📦</span> Paket: {{ form.paket_mengajar }}
                </p>
                
                <div class="mt-5 inline-flex items-center gap-2 bg-[#009966] text-white px-4 py-2.5 rounded-xl text-sm font-bold shadow-sm">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                  Telah Diterima
                </div>
              </div>
            </div>
            
            <button @click="$emit('navigate', 'pesan')" type="button" class="w-full sm:w-auto px-10 py-3.5 rounded-xl text-sm font-bold border-2 border-transparent bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white hover:shadow-lg hover:shadow-blue-500/30 transition-all text-center">
              Chat Tutor
            </button>
          </div>
        </div>
      </div>

      <!-- Payment Modal -->
      <div v-if="showPaymentModal" class="fixed inset-0 z-[100] bg-gray-900/40 backdrop-blur-sm flex items-center justify-center p-4 animate-fade-in" @click.self="showPaymentModal = false">
        <div class="bg-white rounded-3xl w-full max-w-md p-8 shadow-2xl border border-gray-100 transform transition-all">
          <div class="flex justify-between items-start mb-6">
            <div>
              <h3 class="text-xl font-bold text-gray-900">Total Pembayaran</h3>
              <p class="text-2xl font-black text-[#2563EB] mt-1">{{ priceFormatted }}</p>
            </div>
            <button @click="showPaymentModal = false" class="text-gray-400 hover:text-gray-600 bg-gray-50 hover:bg-gray-100 rounded-full p-2 transition">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
          </div>

          <p class="text-sm font-bold text-gray-700 mb-4">Pilih metode pembayaran:</p>
          <div class="flex flex-col gap-3 mb-8">
            <label v-for="method in ['qris', 'ewallet', 'transfer']" :key="method" class="flex items-center gap-4 p-4 rounded-xl border-2 cursor-pointer transition-all has-[:checked]:border-[#2563EB] has-[:checked]:bg-blue-50 border-gray-200 hover:border-blue-300">
              <input type="radio" v-model="selectedPaymentMethod" :value="method" class="hidden">
              <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center shrink-0">
                <span class="text-xl text-[#2563EB]">{{ method === 'qris' ? '📱' : method === 'ewallet' ? '💳' : '🏦' }}</span>
              </div>
              <div>
                <p class="font-bold text-gray-900 capitalize">{{ method }}</p>
              </div>
            </label>
          </div>

          <button type="button" @click="$emit('pay', selectedPaymentMethod)" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white py-4 rounded-xl font-bold text-sm hover:shadow-lg transition-all focus:outline-none">
            Bayar Sekarang
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue'
import axios from 'axios'

const props = defineProps({
  tutor: { type: Object, required: true },
})

const emit = defineEmits(['back', 'navigate', 'submit-booking', 'pay', 'cancel'])

const view = ref('pesan_tutor')
const showPaymentModal = ref(false)
const selectedPaymentMethod = ref('qris')

const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu']
const availabilities = ref([])
const isLoadingAvailabilities = ref(false)

const form = ref({
  metode_belajar: 'rumah',
  paket_mengajar: '4x',
  preferred_start_time: null
})

onMounted(() => {
  fetchTutorAvailabilities()
})

async function fetchTutorAvailabilities() {
  isLoadingAvailabilities.value = true
  try {
    const response = await axios.get(`/api/tutor/availabilities?tutor_id=${props.tutor.id}`)
    availabilities.value = response.data.availabilities
  } catch (error) {
    console.error('Gagal mengambil ketersediaan tutor')
  } finally {
    isLoadingAvailabilities.value = false
  }
}

const priceFormatted = computed(() => {
  if (form.value.paket_mengajar === '4x') return 'Rp400.000';
  if (form.value.paket_mengajar === '8x') return 'Rp760.000';
  return 'Rp1.100.000';
})

function formatTime(time) {
  if (!time) return ''
  return time.substring(0, 5)
}

function submitBooking() {
  if (availabilities.value.length > 0 && !form.value.preferred_start_time) {
    alert('Silakan pilih jadwal preferensi terlebih dahulu.');
    return;
  }
  emit('submit-booking', form.value);
}
</script>
