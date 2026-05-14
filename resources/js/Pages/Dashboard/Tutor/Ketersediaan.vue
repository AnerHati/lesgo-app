<template>
  <div class="space-y-6 max-w-4xl mx-auto">
    <!-- Header Section -->
    <div class="mb-8">
      <h2 class="text-3xl font-black text-gray-900 mb-2">Jam Mengajar Saya</h2>
      <p class="text-gray-500 font-medium">Tentukan hari dan jam berapa saja Anda bersedia menerima pesanan kelas.</p>
    </div>

    <!-- Alert / Pesan Status -->
    <div v-if="$page.props.flash && $page.props.flash.success" class="bg-[#E7FFE7] text-[#009966] p-4 rounded-xl border border-[#009966]/20 font-bold flex items-center gap-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
      {{ $page.props.flash.success }}
    </div>

    <div v-if="$page.props.errors && Object.keys($page.props.errors).length > 0" class="bg-red-50 text-red-600 p-4 rounded-xl border border-red-200 font-bold flex items-center gap-3">
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
      Terdapat kesalahan saat menyimpan. Pastikan jam mulai lebih awal dari jam selesai.
    </div>

    <!-- Form Ketersediaan -->
    <form @submit.prevent="submit" class="bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
      <div class="bg-[#FAFBFC] px-8 py-5 border-b border-gray-200 flex items-center gap-3">
        <span class="text-2xl">📅</span>
        <h3 class="text-xl font-bold text-gray-900">Jadwal Mingguan</h3>
      </div>

      <div class="p-8">
        <div class="space-y-4">
          <div v-for="day in days" :key="day.id" class="flex flex-col sm:flex-row items-start sm:items-center p-4 rounded-xl border-2 transition-all"
               :class="day.active ? 'border-[#2563EB] bg-blue-50/30' : 'border-gray-100 bg-white'">
            
            <!-- Checkbox Hari -->
            <label class="flex items-center gap-3 cursor-pointer sm:w-48 shrink-0">
              <input type="checkbox" v-model="day.active" class="w-5 h-5 rounded border-gray-300 text-[#2563EB] focus:ring-[#2563EB]">
              <span class="font-bold text-gray-900 text-lg">{{ day.name }}</span>
            </label>

            <!-- Input Jam (Muncul jika hari aktif) -->
            <div v-if="day.active" class="mt-4 sm:mt-0 flex items-center gap-3 w-full animate-fade-in">
              <div class="flex-1">
                <label class="text-xs font-bold text-gray-500 mb-1 block">Jam Mulai</label>
                <input type="time" v-model="day.start_time" required class="w-full rounded-xl border-gray-200 focus:border-[#2563EB] focus:ring focus:ring-[#2563EB] focus:ring-opacity-20 font-bold text-gray-700">
              </div>
              <span class="text-gray-400 font-bold mt-5">-</span>
              <div class="flex-1">
                <label class="text-xs font-bold text-gray-500 mb-1 block">Jam Selesai</label>
                <input type="time" v-model="day.end_time" required class="w-full rounded-xl border-gray-200 focus:border-[#2563EB] focus:ring focus:ring-[#2563EB] focus:ring-opacity-20 font-bold text-gray-700">
              </div>
            </div>

            <!-- Placeholder jika hari nonaktif -->
            <div v-else class="mt-4 sm:mt-0 text-sm font-bold text-gray-400 sm:pl-4">
              Libur / Tidak Mengajar
            </div>
          </div>
        </div>

        <div class="mt-10 border-t border-gray-100 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
          <p class="text-xs font-bold text-gray-500">Jadwal ini akan otomatis diterapkan untuk semua pesanan kelas baru.</p>
          <button type="submit" :disabled="form.processing" class="w-full sm:w-auto bg-[#2563EB] text-white px-8 py-3.5 rounded-xl font-bold text-sm shadow-sm hover:bg-blue-700 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
            <svg v-if="form.processing" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
            Simpan Jadwal
          </button>
        </div>
      </div>
    </form>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';

const props = defineProps({
  availabilities: {
    type: Array,
    default: () => []
  }
});

// Daftar hari master
const daysMaster = [
  { id: 1, name: 'Senin' },
  { id: 2, name: 'Selasa' },
  { id: 3, name: 'Rabu' },
  { id: 4, name: 'Kamis' },
  { id: 5, name: 'Jumat' },
  { id: 6, name: 'Sabtu' },
  { id: 0, name: 'Minggu' }
];

const days = ref([]);

// Mapping data dari backend saat komponen di-load
onMounted(() => {
  days.value = daysMaster.map(masterDay => {
    // Cari apakah tutor sudah pernah setting jadwal hari ini di backend
    const existing = props.availabilities.find(a => a.day_of_week === masterDay.id);
    
    if (existing) {
      // Ambil jam:menit (hapus detiknya agar kompatibel dengan <input type="time">)
      const start = existing.start_time.substring(0, 5);
      const end = existing.end_time.substring(0, 5);
      
      return {
        ...masterDay,
        active: true,
        start_time: start,
        end_time: end
      };
    }

    // Default kosong
    return {
      ...masterDay,
      active: false,
      start_time: '09:00',
      end_time: '17:00'
    };
  });
});

const form = useForm({
  availabilities: []
});

function submit() {
  // Hanya ambil hari yang dicentang (active = true)
  const activeDays = days.value.filter(d => d.active).map(d => ({
    day_of_week: d.id,
    start_time: d.start_time,
    end_time: d.end_time
  }));

  form.availabilities = activeDays;

  form.post(route('tutor.availability.store'), {
    preserveScroll: true,
    onSuccess: () => {
      // Berhasil
    }
  });
}
</script>

<style scoped>
.animate-fade-in {
  animation: fadeIn 0.3s ease-in-out;
}
@keyframes fadeIn {
  from { opacity: 0; transform: translateY(-5px); }
  to { opacity: 1; transform: translateY(0); }
}
</style>
