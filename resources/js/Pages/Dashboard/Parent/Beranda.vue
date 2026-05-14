<template>
  <div class="animate-fade-in space-y-8 pb-20">
    
    <!-- Pairing Section (Always visible if no children, or as a collapsible section if desired) -->
    <div v-if="childrenList.length === 0" class="max-w-4xl mx-auto py-6">
      <div class="bg-white rounded-[32px] border border-gray-100 shadow-xl overflow-hidden transition-all hover:shadow-2xl">
        <div class="bg-gradient-to-br from-blue-600 to-indigo-700 p-10 text-white relative">
          <div class="relative z-10">
            <h2 class="text-3xl font-black mb-3 italic">Mulai Memantau Belajar Anak</h2>
            <p class="text-blue-100 font-medium text-lg leading-relaxed max-w-xl">
              Hubungkan akun Anda dengan akun anak menggunakan kode unik 6-digit untuk melihat progres, nilai, dan jadwal belajarnya secara real-time.
            </p>
          </div>
          <!-- Decorative Icon -->
          <div class="absolute right-8 top-1/2 -translate-y-1/2 opacity-20 pointer-events-none hidden md:block">
            <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg>
          </div>
        </div>
        
        <div class="p-10 bg-white">
          <form @submit.prevent="submitPairing" class="grid grid-cols-1 md:grid-cols-12 gap-8 items-end">
            <div class="md:col-span-5">
              <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Kode Pairing (6 Digit)</label>
              <input 
                type="text" 
                v-model="pairingForm.token" 
                placeholder="ABC123" 
                class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl py-4 px-6 text-2xl font-black text-center tracking-[0.3em] text-blue-600 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 outline-none transition uppercase" 
                maxlength="6" 
                required
              >
            </div>
            
            <div class="md:col-span-4">
              <label class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-3">Hubungan Keluarga</label>
              <select v-model="pairingForm.relationship" class="w-full bg-gray-50 border-2 border-gray-100 rounded-2xl py-4 px-6 text-sm font-bold text-gray-700 focus:border-blue-500 focus:bg-white focus:ring-4 focus:ring-blue-100 outline-none transition appearance-none cursor-pointer">
                <option value="Ayah">Ayah</option>
                <option value="Ibu">Ibu</option>
                <option value="Wali">Wali</option>
              </select>
            </div>

            <div class="md:col-span-3">
              <button 
                type="submit" 
                :disabled="isPairing" 
                class="w-full bg-[#2563EB] hover:bg-blue-700 text-white py-4 rounded-2xl font-black text-sm shadow-lg shadow-blue-500/30 transition-all transform active:scale-95 flex items-center justify-center gap-3 disabled:opacity-70"
              >
                <svg v-if="isPairing" class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span>{{ isPairing ? 'Menghubungkan' : 'Tautkan Akun' }}</span>
              </button>
            </div>
          </form>
          <div class="mt-6 flex items-start gap-2 text-gray-400">
            <span class="text-sm">ℹ️</span>
            <p class="text-[11px] font-medium leading-relaxed">Dapatkan kode pairing dari dashboard akun anak Anda di menu <span class="text-gray-600 font-bold">"Pengaturan"</span>. Kode bersifat sementara dan akan kedaluwarsa dalam 30 menit.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Dashboard Content -->
    <div v-else class="space-y-10">
      
      <!-- List of Linked Children -->
      <section>
        <div class="flex items-center justify-between mb-6">
          <h3 class="text-xl font-black text-gray-900 flex items-center gap-2">
            <span class="w-8 h-8 bg-blue-100 text-blue-600 rounded-lg flex items-center justify-center text-sm">👥</span>
            Daftar Anak
          </h3>
          <button @click="showPairingForm = !showPairingForm" class="text-xs font-bold text-blue-600 hover:text-blue-700 bg-blue-50 px-4 py-2 rounded-xl transition">
            {{ showPairingForm ? 'Tutup Form' : '+ Tautkan Anak Lain' }}
          </button>
        </div>

        <!-- Inline Pairing Form (Collapsible) -->
        <div v-if="showPairingForm" class="mb-8 animate-slide-in">
           <div class="bg-blue-50 border-2 border-blue-100 rounded-3xl p-6">
              <form @submit.prevent="submitPairing" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1">
                  <input type="text" v-model="pairingForm.token" placeholder="KODE 6 DIGIT" class="w-full bg-white border-2 border-transparent focus:border-blue-500 rounded-2xl py-3 px-6 text-sm font-black tracking-widest uppercase outline-none transition" maxlength="6" required>
                </div>
                <div class="flex-1">
                  <select v-model="pairingForm.relationship" class="w-full bg-white border-2 border-transparent focus:border-blue-500 rounded-2xl py-3 px-6 text-sm font-bold text-gray-700 outline-none transition">
                    <option value="Ayah">Ayah</option>
                    <option value="Ibu">Ibu</option>
                    <option value="Wali">Wali</option>
                  </select>
                </div>
                <button type="submit" :disabled="isPairing" class="bg-blue-600 text-white px-8 py-3 rounded-2xl font-bold text-sm hover:bg-blue-700 transition flex items-center gap-2">
                  {{ isPairing ? '...' : 'Tautkan' }}
                </button>
              </form>
           </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="child in childrenList" :key="child.id" class="bg-white rounded-[28px] p-6 border border-gray-100 shadow-sm hover:shadow-md transition-all group cursor-pointer">
            <div class="flex items-center gap-4">
              <div class="w-16 h-16 rounded-2xl border-2 border-blue-50 overflow-hidden shrink-0 shadow-inner group-hover:scale-105 transition-transform">
                <img v-if="child.profile_photo_path" :src="child.profile_photo_path" class="w-full h-full object-cover">
                <div v-else class="w-full h-full bg-blue-50 flex items-center justify-center text-xl">👦</div>
              </div>
              <div>
                <h4 class="font-black text-gray-900 group-hover:text-blue-600 transition-colors">{{ child.name }}</h4>
                <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mt-0.5">{{ child.pivot?.relationship || 'Anak' }}</p>
              </div>
              <div class="ml-auto">
                 <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-300 group-hover:bg-blue-50 group-hover:text-blue-500 transition-colors">
                   <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M9 5l7 7-7 7"></path></svg>
                 </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Dashboard Stats & Info -->
      <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Hero Summary -->
        <div class="lg:col-span-8 bg-gradient-to-br from-[#1E293B] to-[#334155] rounded-[32px] p-8 lg:p-10 relative overflow-hidden shadow-xl text-white">
          <div class="relative z-10">
            <h2 class="text-3xl font-black mb-2">Halo, {{ $page.props.auth.user.name }}!</h2>
            <p class="text-slate-300 font-medium mb-8">Pantau aktivitas belajar anak-anak Anda hari ini.</p>
            
            <div class="flex flex-wrap gap-4">
               <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10">
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Total Anak</p>
                  <p class="text-2xl font-black">{{ childrenList.length }} <span class="text-sm font-medium text-slate-400">Siswa</span></p>
               </div>
               <div class="bg-white/10 backdrop-blur-md px-6 py-4 rounded-2xl border border-white/10">
                  <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-1">Kelas Aktif</p>
                  <p class="text-2xl font-black">{{ activeClassesCount }} <span class="text-sm font-medium text-slate-400">Kursus</span></p>
               </div>
            </div>
          </div>
          <!-- Abstract Background Shape -->
          <div class="absolute right-0 top-0 w-64 h-64 bg-blue-500/10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>
        </div>

        <!-- Notifications/Recent Activity -->
        <div class="lg:col-span-4 bg-white rounded-[32px] p-8 border border-gray-100 shadow-sm flex flex-col">
          <div class="flex justify-between items-center mb-6">
            <h3 class="font-black text-gray-800 text-lg">Aktivitas Terbaru</h3>
            <span class="text-[10px] font-black bg-blue-50 text-blue-600 px-2 py-1 rounded-md">LIVE</span>
          </div>
          <div class="space-y-6 flex-1">
             <div class="flex gap-4 items-start">
                <div class="w-10 h-10 rounded-xl bg-orange-50 text-orange-500 flex items-center justify-center shrink-0">📝</div>
                <div>
                   <p class="text-xs font-black text-gray-800">Tugas Selesai</p>
                   <p class="text-[10px] text-gray-400 font-medium mt-0.5">Siswa telah mengerjakan Tugas Matematika.</p>
                </div>
             </div>
             <div class="flex gap-4 items-start opacity-50">
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-500 flex items-center justify-center shrink-0">✅</div>
                <div>
                   <p class="text-xs font-black text-gray-800">Pembayaran Berhasil</p>
                   <p class="text-[10px] text-gray-400 font-medium mt-0.5">Tagihan paket belajar telah dibayar.</p>
                </div>
             </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { router } from '@inertiajs/vue3';
import axios from 'axios';

const childrenList = ref([]);
const isPairing = ref(false);
const showPairingForm = ref(false);
const activeClassesCount = ref(0);

const pairingForm = ref({
  token: '',
  relationship: 'Ayah'
});

onMounted(() => {
  fetchChildren();
});

async function fetchChildren() {
  try {
    const response = await axios.get('/api/pairing/children');
    childrenList.value = response.data.children;
    
    // Simple count of active classes from children (assuming API provides this info or we fetch separately)
    // For now, let's keep it static or derived if data exists
  } catch (error) {
    console.error('Gagal mengambil daftar anak');
  }
}

async function submitPairing() {
  isPairing.value = true;
  try {
    const response = await axios.post('/api/pairing/pair', pairingForm.value);
    alert(response.data.message || 'Berhasil menautkan akun anak!');
    pairingForm.value.token = '';
    showPairingForm.value = false;
    fetchChildren(); // Refresh list
  } catch (error) {
    alert(error.response?.data?.message || 'Gagal menautkan akun. Pastikan kode benar dan belum kedaluwarsa.');
  } finally {
    isPairing.value = false;
  }
}
</script>

<style scoped>
.animate-slide-in {
    animation: slideIn 0.3s ease-out forwards;
}

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.select-all {
  user-select: all;
}
</style>
