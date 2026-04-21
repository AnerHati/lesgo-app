<template>
  <div class="min-h-screen bg-[#F8FAFC] font-sans flex flex-col items-center">
    
    <nav class="max-w-7xl mx-auto w-full px-8 py-6 flex justify-between items-center bg-transparent">
      <Link href="/" class="flex items-center gap-3 cursor-pointer">
        <div class="text-[#10B981] text-3xl">🌱</div>
        <div class="leading-tight">
          <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
          <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
        </div>
      </Link>
      <div class="hidden md:flex space-x-8 text-gray-600 font-medium text-sm">
        <a href="#" class="hover:text-[#10B981] transition">Beranda</a>
        <a href="#" class="hover:text-[#10B981] transition">Program</a>
        <a href="#" class="hover:text-[#10B981] transition">Cara Kerja</a>
        <a href="#" class="hover:text-[#10B981] transition">Cari Tutor</a>
      </div>
      <div class="flex items-center space-x-8">
        <Link href="/pilih-masuk" class="text-blue-700 font-bold hover:underline cursor-pointer">
          Masuk
        </Link>
        <button class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold shadow-md cursor-default">
          Daftar
        </button>
      </div>
    </nav>

    <div class="flex-1 w-full flex justify-center items-center p-6 max-w-7xl">
      <div class="bg-white rounded-[40px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] w-full flex overflow-hidden border border-gray-100 min-h-[600px] relative">
        
        <div class="w-full md:w-1/2 p-12 lg:p-16 flex flex-col justify-center z-10">
          <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
            Daftar Sebagai <span class="text-[#10B981]">Orang Tua</span>
          </h1>
          <p class="text-gray-400 font-medium text-sm mb-8">
            Buat akun Vidya Loka untuk daftarkan anak dan mulai belajar dengan tutor terdekat.
          </p>

          <form class="space-y-5" @submit.prevent="goToNextStep">
            
            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Nama Lengkap Anak <span class="text-red-500">*</span></label>
              <input type="text" placeholder="Kenzo Aliza" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#10B981] outline-none placeholder-gray-400 transition-all">
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Nama Orang Tua <span class="text-red-500">*</span></label>
              <input type="text" placeholder="Harland Jumari" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#10B981] outline-none placeholder-gray-400 transition-all">
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Alamat Email Orang Tua <span class="text-red-500">*</span></label>
              <input type="email" placeholder="harlandjumari@gmail.com" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#10B981] outline-none placeholder-gray-400 transition-all">
            </div>

            <div class="flex gap-4">
              <div class="w-1/2">
                <label class="block text-sm font-bold text-gray-800 mb-2">Kata Sandi <span class="text-red-500">*</span></label>
                <input type="password" placeholder="********" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#10B981] outline-none placeholder-gray-400 tracking-widest transition-all">
              </div>
              <div class="w-1/2">
                <label class="block text-sm font-bold text-gray-800 mb-2">Konfirmasi Kata Sandi <span class="text-red-500">*</span></label>
                <input type="password" placeholder="********" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-[#10B981] outline-none placeholder-gray-400 tracking-widest transition-all">
              </div>
            </div>

            <div class="pt-2">
              <p class="text-[11px] text-gray-400 font-medium leading-relaxed text-center md:text-left">
                Dengan membuat akun, saya telah menyetujui <a href="#" class="text-[#10B981] font-bold hover:underline">Syarat</a><br class="hidden md:block">
                <a href="#" class="text-[#10B981] font-bold hover:underline">& Ketentuan</a> serta <a href="#" class="text-[#10B981] font-bold hover:underline">Kebijakan Privasi</a>
              </p>
            </div>

            <div class="pt-2">
              <button type="submit" :disabled="isProcessing" class="w-full bg-[#059669] hover:bg-green-700 active:scale-95 text-white font-bold py-4 rounded-xl shadow-md transition-all duration-200 text-base flex justify-center items-center disabled:opacity-70 disabled:cursor-not-allowed">
                <svg v-if="isProcessing" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                  <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                  <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                {{ isProcessing ? 'Memproses...' : 'Daftar Sebagai Orang Tua' }}
              </button>
            </div>

          </form>

          <div class="mt-6 text-center md:text-left pl-2">
            <p class="text-sm font-medium text-gray-400">
              Sudah memiliki akun? 
              <Link href="/masuk-orang-tua" class="text-[#10B981] font-bold hover:underline ml-1">Masuk</Link>
            </p>
          </div>

        </div>

        <div class="hidden md:flex w-1/2 relative items-center justify-center bg-white p-6">
          <div class="w-[95%] h-[95%] border-4 border-dashed border-gray-100 rounded-[30px] flex flex-col items-center justify-center bg-gray-50/50">
            <span class="text-8xl mb-6">👨‍👩‍👧‍👦💚📚</span>
            <p class="text-gray-400 font-bold text-lg text-center">
              Tempat Gambar 3D Keluarga<br>
              <span class="text-sm font-medium">(Masukkan tag img di sini nanti)</span>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import { Link, router } from '@inertiajs/vue3'

const isProcessing = ref(false)

const goToNextStep = () => {
  isProcessing.value = true
  setTimeout(() => {
    router.visit('/lengkapi-profil-orang-tua');
  }, 600) // Simulasi loading 0.6 detik agar animasi terlihat
}
</script>