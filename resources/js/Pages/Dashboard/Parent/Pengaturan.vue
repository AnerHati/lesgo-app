<template>
  <div class="max-w-6xl mx-auto w-full animate-fade-in space-y-6 pb-10">
    
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-[#E0F2FE] to-cyan-50 rounded-[24px] p-8 border border-blue-100/50 shadow-sm relative overflow-hidden flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
      <div class="relative z-10 max-w-2xl">
        <h2 class="text-3xl font-black text-gray-900 mb-2">Pengaturan</h2>
        <p class="text-sm font-medium text-gray-600 leading-relaxed">
          Kelola akun anak dan pengaturan Anda.<br>
          Sesuaikan profil dan preferensi sesuai kebutuhan anak.
        </p>
      </div>
      <button 
        v-if="activeView === 'menu' || activeView === 'edit_child'"
        @click="activeView = 'edit_parent'"
        class="relative z-10 px-6 py-2.5 border-2 border-[#2563EB] text-[#2563EB] font-bold rounded-xl hover:bg-blue-50 transition shadow-sm bg-white whitespace-nowrap">
        Edit Profil Anda
      </button>
    </div>

    <div class="flex flex-col md:flex-row gap-6 items-start">
      
      <!-- Left Column: Profile Widget -->
      <div class="w-full md:w-1/4 bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col items-center min-h-[400px] relative">
        <h3 class="w-full text-left font-bold text-gray-900 mb-6">Profil Pengguna</h3>
        
        <div class="flex flex-col items-center flex-1 w-full">
          <!-- Dynamically show parent or child based on active view -->
          <template v-if="activeView !== 'edit_child'">
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-50 shadow-sm mb-4">
              <img src="https://ui-avatars.com/api/?name=Sarah+Ambarawati&background=fdf4ff&color=86198f" alt="Sarah Ambarawati" class="w-full h-full object-cover">
            </div>
            <h4 class="text-lg font-bold text-gray-900 text-center leading-tight">Sarah Ambarawati</h4>
            <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-wider">Orang Tua</p>
          </template>
          <template v-else>
            <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-gray-50 shadow-sm mb-4">
              <img src="https://ui-avatars.com/api/?name=Kenzo+Aliza&background=ffedd5&color=c2410c" alt="Kenzo Aliza" class="w-full h-full object-cover">
            </div>
            <h4 class="text-lg font-bold text-gray-900 text-center leading-tight">Kenzo Aliza</h4>
            <p class="text-xs font-bold text-gray-400 mt-1 uppercase tracking-wider">Siswa</p>
          </template>
        </div>

        <div class="w-full mt-auto pt-6">
          <button v-if="activeView !== 'edit_child'" class="flex items-center gap-2 text-red-500 hover:text-red-600 font-bold text-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar
          </button>
          <button v-else class="flex items-center justify-center w-full gap-2 text-red-500 hover:text-red-600 font-bold text-sm transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Akun
          </button>
        </div>
      </div>

      <!-- Right Column: Content Area -->
      <div class="w-full md:w-3/4 bg-white rounded-[24px] border border-gray-200 shadow-sm p-8">
        
        <!-- State 1: Menu List -->
        <div v-if="activeView === 'menu'" class="space-y-4 animate-fade-in">
          
          <!-- Child Settings Widget -->
          <div class="flex items-center justify-between p-4 border border-gray-100 rounded-2xl bg-gray-50/50 mb-6">
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 rounded-full overflow-hidden border border-gray-200 shrink-0">
                <img src="https://ui-avatars.com/api/?name=Kenzo+Aliza&background=ffedd5&color=c2410c" class="w-full h-full object-cover">
              </div>
              <div>
                <h4 class="text-sm font-bold text-gray-900">Kenzo Aliza <span class="text-gray-400 font-medium">(SD)</span></h4>
                <p class="text-xs text-gray-500 font-medium mt-0.5">Lihat dan atur keamanan akun anak Anda</p>
              </div>
            </div>
            <button @click="activeView = 'edit_child'" class="px-5 py-2 border-2 border-blue-100 text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition text-sm whitespace-nowrap">
              Edit Profil Anak
            </button>
          </div>

          <!-- Settings Items -->
          <div class="space-y-0 border border-gray-100 rounded-2xl overflow-hidden divide-y divide-gray-100">
            
            <div class="flex items-center justify-between p-5 hover:bg-gray-50 transition">
              <div class="flex items-center gap-4">
                <div class="text-gray-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                </div>
                <div>
                  <h4 class="text-sm font-bold text-gray-900">Keamanan</h4>
                  <p class="text-xs text-gray-500 font-medium mt-0.5">Lihat dan atur keamanan akun kamu</p>
                </div>
              </div>
              <button class="px-5 py-2 border-2 border-blue-100 text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition text-sm">
                Ganti Kata Sandi
              </button>
            </div>

            <div class="flex items-center justify-between p-5 hover:bg-gray-50 transition cursor-pointer">
              <div class="flex items-center gap-4">
                <div class="text-gray-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                  <h4 class="text-sm font-bold text-gray-900">Aktifitas Login</h4>
                  <p class="text-xs text-gray-500 font-medium mt-0.5">Lihat aktifitas login kamu</p>
                </div>
              </div>
            </div>

            <div class="flex items-center justify-between p-5 hover:bg-gray-50 transition">
              <div class="flex items-center gap-4">
                <div class="text-gray-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                </div>
                <div>
                  <h4 class="text-sm font-bold text-gray-900">Notifikasi</h4>
                  <p class="text-xs text-gray-500 font-medium mt-0.5">Atur notifikasi akun kamu</p>
                </div>
              </div>
              <button class="px-5 py-2 border-2 border-blue-100 text-blue-600 font-bold rounded-xl hover:bg-blue-50 transition text-sm">
                Atur Notifikasi
              </button>
            </div>

            <div class="flex items-center justify-between p-5 hover:bg-gray-50 transition cursor-pointer">
              <div class="flex items-center gap-4">
                <div class="text-gray-400">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                  <h4 class="text-sm font-bold text-gray-900">Bahasa</h4>
                  <p class="text-xs text-gray-500 font-medium mt-0.5">Bahasa Indonesia</p>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- State 2: Edit Form (Parent or Child) -->
        <div v-else class="animate-fade-in">
          <form @submit.prevent="saveProfile" class="space-y-5">
            
            <div class="space-y-1">
              <label class="block text-sm font-bold text-gray-800">Nama Lengkap <span class="text-red-500">*</span></label>
              <div class="relative flex items-center">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                </div>
                <input type="text" v-model="formData.name" class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition" required>
              </div>
            </div>

            <div class="space-y-1">
              <label class="block text-sm font-bold text-gray-800">Alamat Email <span class="text-red-500">*</span></label>
              <div class="relative flex items-center">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                </div>
                <input type="email" v-model="formData.email" class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition" required>
              </div>
            </div>

            <div class="space-y-1">
              <label class="block text-sm font-bold text-gray-800">Nomor Telepon <span class="text-red-500">*</span></label>
              <div class="relative flex items-center">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-400">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                </div>
                <input type="tel" v-model="formData.phone" class="w-full pl-10 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition" required>
              </div>
            </div>

            <div class="space-y-1">
              <label class="block text-sm font-bold text-gray-800">Alamat Rumah <span class="text-red-500">*</span></label>
              <textarea v-model="formData.address" rows="2" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition resize-none" required></textarea>
            </div>

            <div class="space-y-1">
              <label class="block text-sm font-bold text-gray-800">Tentang Saya <span class="text-red-500">*</span></label>
              <textarea v-model="formData.about" rows="3" class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl text-sm font-medium text-gray-700 outline-none focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition resize-none" required></textarea>
            </div>

            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-100">
              <button type="button" @click="activeView = 'menu'" class="px-6 py-2.5 bg-gray-100 text-gray-600 font-bold rounded-xl hover:bg-gray-200 transition text-sm">
                Kembali
              </button>
              <button type="submit" class="px-6 py-2.5 bg-[#2563EB] text-white font-bold rounded-xl hover:bg-blue-600 transition shadow-md shadow-blue-500/20 text-sm">
                Simpan
              </button>
            </div>
          </form>
        </div>

      </div>

    </div>
  </div>
</template>

<script setup>
import { ref, watch } from 'vue';

const activeView = ref('menu'); // 'menu', 'edit_parent', 'edit_child'

const parentData = {
  name: 'Sarah Ambarawati',
  email: 'sarah.ambarawati@gmail.com',
  phone: '0877936482680',
  address: 'Asrama Brimob Tohpati, Jln WR Supratman no.....',
  about: 'Halo! Saya Sarah, orang tua dari Kenzo yang senang belajar Informatika dan Matematika. Mari belajar bersama!'
};

const childData = {
  name: 'Kenzo Aliza',
  email: 'kenzoalizastudent1@gmail.com',
  phone: '0877936482680',
  address: 'Asrama Brimob Tohpati, Jln WR Supratman no.....',
  about: 'Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar Informatika dan Matematika. Mari belajar bersama!'
};

const formData = ref({ ...parentData });

watch(activeView, (newVal) => {
  if (newVal === 'edit_parent') {
    formData.value = { ...parentData };
  } else if (newVal === 'edit_child') {
    formData.value = { ...childData };
  }
});

const saveProfile = () => {
  // Simulate saving data
  if (activeView.value === 'edit_parent') {
    Object.assign(parentData, formData.value);
  } else if (activeView.value === 'edit_child') {
    Object.assign(childData, formData.value);
  }
  // Return to menu
  activeView.value = 'menu';
};
</script>
