<template>
  <div class="min-h-screen bg-[#F8FAFC] font-sans flex flex-col items-center">
    
    <header class="max-w-7xl mx-auto w-full px-8 py-8 flex items-center justify-between relative">
      <Link href="/" class="flex items-center gap-3 cursor-pointer z-10 absolute left-8">
        <div class="text-green-500 text-3xl">🌱</div>
        <div class="leading-tight">
          <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
          <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
        </div>
      </Link>

      <div class="flex-1 flex justify-center items-center w-full">
        <div class="flex items-center w-full max-w-lg justify-between relative">
          <div class="absolute left-0 right-0 top-3 h-[2px] bg-gray-200 -z-10"></div>
          <div class="absolute left-0 w-1/2 top-3 h-[2px] bg-[#FACC15] -z-10"></div>

          <div class="flex flex-col items-center gap-2 bg-[#F8FAFC] px-2">
            <div class="w-6 h-6 rounded-full bg-[#FACC15] text-white flex items-center justify-center font-bold text-xs shadow-sm">1</div>
            <span class="text-xs font-bold text-[#FACC15]">Buat Akun</span>
          </div>

          <div class="flex flex-col items-center gap-2 bg-[#F8FAFC] px-2">
            <div class="w-6 h-6 rounded-full bg-[#FACC15] text-white flex items-center justify-center font-bold text-xs shadow-sm">2</div>
            <span class="text-xs font-bold text-[#FACC15]">Lengkapi Profil</span>
          </div>

          <div class="flex flex-col items-center gap-2 bg-[#F8FAFC] px-2">
            <div class="w-6 h-6 rounded-full bg-gray-300 text-white flex items-center justify-center font-bold text-xs">3</div>
            <span class="text-xs font-medium text-gray-400">Verifikasi</span>
          </div>
        </div>
      </div>
    </header>

    <main class="flex-1 w-full flex justify-center items-center p-6 max-w-6xl -mt-4">
      <div class="bg-white rounded-[40px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] w-full flex overflow-hidden border border-gray-100 min-h-[550px] relative">
        
        <div class="w-full md:w-[55%] p-10 lg:p-14 flex flex-col justify-center z-10">
          <h1 class="text-4xl font-extrabold text-[#FACC15] mb-2 tracking-tight">
            Lengkapi Profil Anda
          </h1>
          <p class="text-gray-400 font-medium text-sm mb-8">
            Isi informasi berikut untuk pengalaman belajar yang lebih baik dan personal.
          </p>

          <form class="space-y-5" @submit.prevent="submitForm">
            
            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
              <div class="relative flex items-center">
                <span class="absolute left-4 text-gray-400 text-lg">📞</span>
                <input type="text" placeholder="0877056283649" class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-yellow-400 outline-none placeholder-gray-400 font-medium transition-all">
              </div>
            </div>

            <div>
              <div class="flex justify-between items-center mb-2">
                <label class="block text-sm font-bold text-gray-800">Tempat Tinggal <span class="text-red-500">*</span></label>
                <button type="button" class="text-xs font-bold text-[#FACC15] hover:underline">Gunakan Lokasi</button>
              </div>
              <div class="relative flex items-center">
                <span class="absolute left-4 text-gray-400 text-lg">📍</span>
                <input type="text" placeholder="Jl. Danau Tamblingan VIII No.3, Jimbaran, Kuta Selatan, Badung, Bali." class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-yellow-400 outline-none placeholder-gray-400 font-medium transition-all truncate">
              </div>
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
              <div class="relative flex items-center">
                <span class="absolute left-4 text-gray-400 text-lg">📅</span>
                <input type="text" placeholder="DD/MM/YY" class="w-full pl-12 pr-4 py-3 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-yellow-400 outline-none placeholder-gray-400 font-medium transition-all">
              </div>
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Latar Belakang Pendidikan <span class="text-red-500">*</span></label>
              <div class="relative">
                <input type="file" id="upload-pendidikan" class="hidden">
                <label for="upload-pendidikan" class="flex items-center gap-3 w-full px-4 py-3 bg-white border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                  <span class="text-gray-400 text-lg">📁</span>
                  <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Unggah foto</p>
                    <p class="text-[10px] text-gray-400">Format JPG, PNG, maks 5mb.</p>
                  </div>
                </label>
              </div>
            </div>

            <div class="pt-4">
              <button type="submit" class="w-full bg-[#FACC15] hover:bg-yellow-500 text-white font-bold py-3.5 rounded-xl shadow-md transition-colors text-lg">
                Selanjutnya
              </button>
            </div>

          </form>
        </div>

        <div class="hidden md:flex w-[45%] relative items-center justify-center bg-white p-6">
          <div class="w-full h-full border-4 border-dashed border-gray-100 rounded-[30px] flex flex-col items-center justify-center bg-gray-50/50">
            <span class="text-8xl mb-6">👨🏻‍🏫📝💡</span>
            <p class="text-gray-400 font-bold text-sm text-center italic">
              Ilustrasi 3D Tutor<br>
              LesGo
            </p>
          </div>
        </div>

      </div>
    </main>
  </div>
</template>

<script setup>
import { Link, router } from '@inertiajs/vue3'

const submitForm = () => {
  // Arahkan ke halaman tahap 3 (Verifikasi Tutor) setelah diklik
  // Kita siapkan rutenya mengarah ke /verifikasi-tutor
  router.visit('/verifikasi-tutor')
}
</script>