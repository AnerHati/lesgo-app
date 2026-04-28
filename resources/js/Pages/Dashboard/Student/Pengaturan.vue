<template>
  <!-- Main Pengaturan View -->
  <div v-if="pengaturanView === 'main'" class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
    <!-- Header Banner -->
    <section class="bg-gradient-to-r from-blue-50 via-sky-50 to-indigo-50 rounded-xl border border-blue-100 p-8 relative overflow-hidden">
      <div class="hero-orb-1 opacity-30"></div>
      <h2 class="text-4xl font-black text-gray-900 relative z-10">Pengaturan</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium relative z-10">Kelola akun dan pengaturanmu.</p>
      <p class="text-sm text-gray-700 font-medium relative z-10">Sesuaikan profil dan preferensi sesuai kebutuhanmu</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Profil Pengguna -->
      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col justify-between h-full">
        <div>
          <h3 class="font-bold text-gray-900 mb-6">Profil Pengguna</h3>
          <div class="flex flex-col items-center">
            <div class="w-24 h-24 rounded-full bg-orange-200 border-4 border-white shadow-md overflow-hidden flex items-center justify-center text-4xl mb-4">
              👦🏽
            </div>
            <h4 class="text-lg font-black text-gray-900 leading-tight">Kenzo Aliza</h4>
            <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">Siswa</p>
          </div>
        </div>
        
        <div class="mt-8">
          <button type="button" class="flex items-center gap-2 text-sm font-bold text-red-500 hover:bg-red-50 px-4 py-2 rounded-xl transition w-full">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
            Keluar
          </button>
        </div>
      </div>

      <!-- Settings List -->
      <div class="md:col-span-2 bg-white rounded-[24px] border border-gray-200 shadow-sm overflow-hidden">
        <div class="divide-y divide-gray-100">
          <!-- Profil -->
          <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
              <h4 class="text-2xl font-black text-gray-900">Kenzo Aliza</h4>
              <p class="text-sm font-medium text-gray-500 mt-1 flex items-center gap-1.5">
                <span class="text-gray-400">✉️</span> kenzoalizastudent@gmail.com
              </p>
            </div>
            <button @click="pengaturanView = 'profil'" type="button" class="px-6 py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition shadow-sm w-full sm:w-auto">
              Edit Profil
            </button>
          </div>

          <!-- Keamanan -->
          <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex gap-4">
              <span class="text-xl text-gray-400 mt-1">🛡️</span>
              <div>
                <h5 class="text-sm font-black text-gray-900">Keamanan</h5>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Lihat dan atur keamanan akun kamu</p>
              </div>
            </div>
            <button @click="pengaturanView = 'password'" type="button" class="px-6 py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition shadow-sm w-full sm:w-auto">
              Ganti Kata Sandi
            </button>
          </div>

          <!-- Aktifitas Login -->
          <div class="p-6 flex items-start gap-4 hover:bg-gray-50 transition cursor-pointer">
            <span class="text-xl text-gray-400 mt-1">👥</span>
            <div>
              <h5 class="text-sm font-black text-gray-900">Aktifitas Login</h5>
              <p class="text-xs font-medium text-gray-500 mt-0.5">Lihat aktifitas login kamu</p>
            </div>
          </div>

          <!-- Notifikasi -->
          <div class="p-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div class="flex gap-4">
              <span class="text-xl text-gray-400 mt-1">🔔</span>
              <div>
                <h5 class="text-sm font-black text-gray-900">Notifikasi</h5>
                <p class="text-xs font-medium text-gray-500 mt-0.5">Atur notifikasi akun kamu</p>
              </div>
            </div>
            <button @click="pengaturanView = 'notifikasi'" type="button" class="px-6 py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition shadow-sm w-full sm:w-auto">
              Atur Notifikasi
            </button>
          </div>

          <!-- Bahasa -->
          <div class="p-6 flex items-start gap-4 hover:bg-gray-50 transition cursor-pointer">
            <span class="text-xl text-gray-400 mt-1">🌐</span>
            <div>
              <h5 class="text-sm font-black text-gray-900">Bahasa</h5>
              <p class="text-xs font-medium text-gray-500 mt-0.5">Bahasa Indonesia</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Pengaturan Profil View -->
  <div v-else-if="pengaturanView === 'profil'" class="max-w-6xl mx-auto w-full space-y-6 animate-fade-in">
    <section class="bg-[#e0f2fe] rounded-xl border border-blue-100 p-8">
      <h2 class="text-4xl font-black text-gray-900">Pengaturan Profil</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium">Ubah dan kelola informasi akunmu untuk membuat profilmu lebih akurat.</p>
    </section>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      <!-- Profil Pengguna (Left) -->
      <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col justify-between h-[400px]">
        <div>
          <h3 class="font-bold text-gray-900 mb-6">Profil Pengguna</h3>
          <div class="flex flex-col items-center">
            <div class="w-24 h-24 rounded-full bg-orange-200 border-4 border-white shadow-md overflow-hidden flex items-center justify-center text-4xl mb-4">👦🏽</div>
            <h4 class="text-lg font-black text-gray-900 leading-tight">Kenzo Aliza</h4>
            <p class="text-xs font-bold text-gray-500 mt-1 uppercase tracking-wider">Siswa</p>
          </div>
        </div>
        <div>
          <button type="button" class="flex items-center gap-2 text-sm font-bold text-red-500 hover:bg-red-50 px-4 py-2 rounded-xl transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
            Hapus Akun
          </button>
        </div>
      </div>

      <!-- Form (Right) -->
      <div class="md:col-span-2 bg-white rounded-[24px] border border-gray-200 shadow-sm p-8">
        <div class="space-y-6">
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
            <div class="relative">
              <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">👤</span>
              <input type="text" value="Kenzo Aliza" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 pl-12 pr-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Email <span class="text-red-500">*</span></label>
            <div class="relative">
              <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">✉️</span>
              <input type="email" value="kenzoalizastudent@gmail.com" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 pl-12 pr-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
            <div class="relative">
              <span class="absolute inset-y-0 left-4 flex items-center text-gray-400">📞</span>
              <input type="text" value="0877936482680" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 pl-12 pr-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
            </div>
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Alamat Rumah <span class="text-red-500">*</span></label>
            <input type="text" value="Asrama Brimob Tohpati, Jln WR Supratman no...." class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-700 mb-2">Tentang Saya <span class="text-red-500">*</span></label>
            <textarea rows="3" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition resize-none">Halo! Saya Kenzo Aliza, seorang siswa SMP yang senang belajar Informatika dan Matematika. Mari belajar bersama!</textarea>
          </div>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
          <button @click="pengaturanView = 'main'" type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
            Kembali
          </button>
          <button @click="simulateSimpan('main')" :disabled="isSimpanLoading" type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-white bg-[#2563EB] hover:bg-blue-700 shadow-sm transition flex items-center justify-center min-w-[120px] disabled:opacity-70 disabled:cursor-not-allowed">
            <svg v-if="isSimpanLoading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span v-if="!isSimpanLoading">Simpan</span>
            <span v-else>Menyimpan</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Ganti Kata Sandi View -->
  <div v-else-if="pengaturanView === 'password'" class="max-w-4xl mx-auto w-full space-y-6 animate-fade-in">
    <section class="bg-[#e0f2fe] rounded-xl border border-blue-100 p-8">
      <h2 class="text-4xl font-black text-gray-900">Ganti Kata Sandi</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium">Pastikan akunmu tetap aman dengan memperbarui kata sandi secara berkala.</p>
    </section>

    <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-8">
      <div class="space-y-6 max-w-xl mx-auto">
        <div>
          <label class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Saat Ini</label>
          <input type="password" placeholder="••••••••" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>
        <div>
          <label class="block text-sm font-bold text-gray-700 mb-2">Kata Sandi Baru</label>
          <input type="password" placeholder="••••••••" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
          <p class="text-[11px] text-gray-400 mt-2 font-medium">Minimal 8 karakter, mengandung huruf dan angka.</p>
        </div>
        <div>
          <label class="block text-sm font-bold text-gray-700 mb-2">Konfirmasi Kata Sandi Baru</label>
          <input type="password" placeholder="••••••••" class="w-full bg-[#F9FAFB] border border-gray-200 rounded-xl py-3 px-4 text-sm font-medium text-gray-700 focus:ring-2 focus:ring-blue-100 outline-none transition">
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
          <button @click="pengaturanView = 'main'" type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
            Kembali
          </button>
          <button @click="simulateSimpan('main')" :disabled="isSimpanLoading" type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-white bg-[#2563EB] hover:bg-blue-700 shadow-sm transition flex items-center justify-center min-w-[140px] disabled:opacity-70 disabled:cursor-not-allowed">
            <svg v-if="isSimpanLoading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span v-if="!isSimpanLoading">Perbarui Sandi</span>
            <span v-else>Memproses</span>
          </button>
        </div>
      </div>
    </div>
  </div>

  <!-- Atur Notifikasi View -->
  <div v-else-if="pengaturanView === 'notifikasi'" class="max-w-4xl mx-auto w-full space-y-6 animate-fade-in">
    <section class="bg-[#e0f2fe] rounded-xl border border-blue-100 p-8">
      <h2 class="text-4xl font-black text-gray-900">Atur Notifikasi</h2>
      <p class="text-sm text-gray-700 mt-3 font-medium">Pilih jenis pemberitahuan yang ingin kamu terima agar tidak ketinggalan info penting.</p>
    </section>

    <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-8">
      <div class="space-y-6 max-w-2xl mx-auto">
        <div class="flex items-center justify-between pb-6 border-b border-gray-100">
          <div>
            <h4 class="text-sm font-bold text-gray-900">Notifikasi Tugas Baru</h4>
            <p class="text-xs text-gray-500 font-medium mt-1">Dapatkan pemberitahuan setiap ada tugas baru dari tutor.</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer" checked>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2563EB]"></div>
          </label>
        </div>

        <div class="flex items-center justify-between pb-6 border-b border-gray-100">
          <div>
            <h4 class="text-sm font-bold text-gray-900">Pengingat Jadwal Les</h4>
            <p class="text-xs text-gray-500 font-medium mt-1">Ingatkan saya 1 jam sebelum sesi belajar dimulai.</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer" checked>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2563EB]"></div>
          </label>
        </div>

        <div class="flex items-center justify-between pb-6 border-b border-gray-100">
          <div>
            <h4 class="text-sm font-bold text-gray-900">Pesan Masuk</h4>
            <p class="text-xs text-gray-500 font-medium mt-1">Beritahu saat ada pesan baru dari tutor.</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer" checked>
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2563EB]"></div>
          </label>
        </div>

        <div class="flex items-center justify-between">
          <div>
            <h4 class="text-sm font-bold text-gray-900">Promo & Penawaran</h4>
            <p class="text-xs text-gray-500 font-medium mt-1">Info diskon paket belajar dan promo menarik lainnya.</p>
          </div>
          <label class="relative inline-flex items-center cursor-pointer">
            <input type="checkbox" value="" class="sr-only peer">
            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-[#2563EB]"></div>
          </label>
        </div>

        <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end gap-4">
          <button @click="pengaturanView = 'main'" type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 transition">
            Kembali
          </button>
          <button @click="simulateSimpan('main')" :disabled="isSimpanLoading" type="button" class="px-8 py-3 rounded-xl text-sm font-bold text-white bg-[#2563EB] hover:bg-blue-700 shadow-sm transition flex items-center justify-center min-w-[150px] disabled:opacity-70 disabled:cursor-not-allowed">
            <svg v-if="isSimpanLoading" class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span v-if="!isSimpanLoading">Simpan Perubahan</span>
            <span v-else>Menyimpan</span>
          </button>
</div>
</div>
</div>
</div>
</template>

<script setup>
import { ref } from 'vue'

const pengaturanView = ref('main')
const isSimpanLoading = ref(false)

function simulateSimpan(targetView = 'main') {
  isSimpanLoading.value = true
  setTimeout(() => {
    isSimpanLoading.value = false
    pengaturanView.value = targetView
  }, 1000)
}
</script>
