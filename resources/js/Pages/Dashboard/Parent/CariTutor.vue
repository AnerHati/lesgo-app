<template>
  <div class="max-w-6xl mx-auto w-full space-y-6">
            <template v-if="cariView === 'semua'">
            <!-- Header Section -->
            <div class="mb-8">
              <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                  <h2 class="text-3xl font-black text-gray-900 mb-2">Cari Tutor</h2>
                  <p class="text-gray-500 font-medium">Cari tutor terbaik dan terdekat sesuai kebutuhan anak Anda.</p>
                  <p class="text-gray-500 font-medium">Lihat profil tutor dan mulai sesi belajar anak Anda.</p>
                </div>
                <button @click="cariView = 'lokasi'" type="button" class="bg-[#2563EB] text-white px-6 py-3 rounded-xl font-bold text-sm inline-flex items-center gap-2 shadow-sm hover:bg-blue-700 transition">
                  📍 Cari Tutor Terdekat
                </button>
              </div>
            </div>

            <!-- Filters -->
            <div class="flex items-center gap-2 mb-6">
              <div class="flex items-center rounded-xl bg-white border border-gray-200 p-1 overflow-x-auto">
                <button
                  v-for="cat in cariTutorCategories"
                  :key="cat"
                  type="button"
                  class="px-5 py-2.5 rounded-lg text-sm font-bold whitespace-nowrap transition"
                  :class="cariTutorFilter === cat
                    ? 'bg-[#2563EB] text-white shadow-sm'
                    : 'text-gray-600 hover:text-gray-800'"
                  @click="cariTutorFilter = cat"
                >
                  {{ cat }}
                </button>
              </div>
              <button
                type="button"
                class="w-11 h-11 shrink-0 rounded-xl border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center shadow-sm"
              >
                <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                </svg>
              </button>
            </div>

            <!-- Skeleton Loader -->
            <SkeletonCard v-if="isLoading && tutorsData.length === 0" />

            <!-- Tutors Grid -->
            <div v-else class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <TutorCard
                v-for="(tutor, index) in filteredCariTutor"
                :key="tutor.id"
                :tutor="tutor"
                :highlight="index === 0 && currentPage === 1"
                @view="viewTutor"
              />
            </div>


            <!-- Pagination (Dynamic) -->
            <div class="flex justify-center items-center gap-2 mt-8 pb-4" v-if="hasMorePages">
              <button @click="loadMore" :disabled="isLoading" type="button" class="bg-[#2563EB] text-white px-6 py-2.5 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition disabled:opacity-50">
                {{ isLoading ? 'Memuat...' : 'Muat Lebih Banyak ↓' }}
              </button>
            </div>
            <div class="flex justify-center items-center gap-2 mt-8 pb-4" v-else-if="tutorsData.length > 0">
              <p class="text-sm font-bold text-gray-400">Semua tutor sudah dimuat.</p>
            </div>
            </template>

                        <template v-else-if="cariView === 'profil'">
              <TutorProfileView
                v-if="selectedTutor"
                :tutor="selectedTutor"
                @back="cariView = 'semua'"
                @book="bookTutor"
              />
            </template>


            <template v-else-if="cariView === 'lokasi' || cariView === 'lokasi_detail'">
              <TutorMap
                :view="cariView"
                :filtered-tutors="filteredCariTutor"
                :selected-tutor="selectedTutor"
                @back="v => cariView = v"
                @view-tutor="viewTutor"
                @book-tutor="bookTutor"
              />
            </template>

            <template v-else-if="cariView === 'pesan_tutor' || cariView === 'menunggu_konfirmasi' || cariView === 'booking_dikonfirmasi'">
              <BookingFlow
                :tutor="selectedTutor"
                @back="cariView = 'lokasi_detail'"
                @navigate="goNav"
                @submit-booking="submitBooking"
                @pay="payBooking"
                @cancel="cariView = 'lokasi_detail'"
                ref="bookingFlowRef"
              />
            </template>
</div>
</template>

<script setup>
import { computed, ref, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'
import TutorCard from '@/Components/TutorCard.vue'
import TutorProfileView from '@/Components/TutorProfile.vue'
import SkeletonCard from '@/Components/SkeletonCard.vue'
import BookingFlow from '@/Components/BookingFlow.vue'
import TutorMap from '@/Components/TutorMap.vue'

const props = defineProps({
  kelas: { type: Array, default: () => [] }
})

const tutorsData = ref([])
const currentPage = ref(1)
const hasMorePages = ref(false)
const isLoading = ref(false)

async function fetchTutors(page = 1) {
    if (isLoading.value) return;
    isLoading.value = true;
    try {
        const response = await axios.get(`/api/tutors?page=${page}`)
        if (page === 1) {
            tutorsData.value = response.data.data
        } else {
            tutorsData.value = [...tutorsData.value, ...response.data.data]
        }
        currentPage.value = response.data.current_page
        hasMorePages.value = response.data.current_page < response.data.last_page
    } catch (error) {
        console.error("Gagal mengambil data tutor", error)
    } finally {
        isLoading.value = false;
    }
}

onMounted(() => {
    fetchTutors(1)
})

function loadMore() {
    if (hasMorePages.value) {
        fetchTutors(currentPage.value + 1)
    }
}

const emit = defineEmits(['navigate'])

const cariTutorQuery = ref('')
const cariTutorFilter = ref('Semua')
const cariView = ref('semua')
const showPaymentModal = ref(false)
const selectedPaymentMethod = ref('qris')
const selectedPackage = ref('4x')
const selectedMethod = ref('rumah')

// Kategori dinamis berdasarkan mata pelajaran tutor yang tersedia
const cariTutorCategories = computed(() => {
  const subjects = new Set(['Semua']);
  tutorsData.value.forEach(t => t.subjects?.forEach(s => subjects.add(s.name)));
  return Array.from(subjects);
});

// Menyimpan tutor yang diklik untuk dilihat detailnya
const selectedTutor = ref(null);

const filteredCariTutor = computed(() => {
  let items = [...tutorsData.value]
  if (cariTutorFilter.value !== 'Semua') {
      items = items.filter(item => item.subjects?.some(s => s.name === cariTutorFilter.value))
  }
  if (cariTutorQuery.value) {
    const q = cariTutorQuery.value.toLowerCase()
    items = items.filter(item => 
        item.name.toLowerCase().includes(q) || 
        item.subjects?.some(s => s.name.toLowerCase().includes(q))
    )
  }
  return items
})

function viewTutor(tutor) {
    selectedTutor.value = tutor;
    cariView.value = 'profil';
}

function bookTutor() {
    cariView.value = 'pesan_tutor';
}

const bookingFlowRef = ref(null)

function submitBooking(form) {
    router.post('/booking-tutor', {
        tutor_id: selectedTutor.value.id,
        subject_id: selectedTutor.value.subjects[0].id, 
        metode_belajar: form.metode_belajar,
        paket_mengajar: form.paket_mengajar
    }, {
        onSuccess: () => {
            cariView.value = 'menunggu_konfirmasi';
            if (bookingFlowRef.value) {
                bookingFlowRef.value.view = 'menunggu_konfirmasi';
            }
        }
    });
}

// Untuk pembayaran
const activeClassToPay = computed(() => {
    if (!props.kelas) return null;
    return props.kelas.find(k => k.status === 'active' || k.status === 'pending');
})

function payBooking(paymentMethod) {
    if (!activeClassToPay.value) {
        alert("Belum ada kelas yang bisa dibayar.");
        return;
    }
    router.post(`/student/booking/${activeClassToPay.value.id}/pay`, {
        payment_method: paymentMethod
    }, {
        onSuccess: () => {
            alert("Pembayaran Berhasil! Kelas sekarang aktif.");
            cariView.value = 'semua';
        }
    });
}

function goNav(id) { emit('navigate', id) }
</script>
