<template>
  <div class="min-h-screen bg-white font-sans flex flex-col items-center">

    <div class="py-10">
      <div class="flex items-center gap-2">
        <div class="text-green-500 text-2xl">🌱</div>
        <div class="text-2xl font-extrabold text-blue-600 tracking-tight">LesGo</div>
      </div>
    </div>

    <div class="flex items-center gap-4 mb-12">
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">1</div>
        <span class="text-sm font-bold text-gray-900">Buat Akun</span>
      </div>
      <div class="h-[2px] w-12 bg-blue-600"></div>
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">2</div>
        <span class="text-sm font-bold text-gray-900">Lengkapi Profil</span>
      </div>
      <div class="h-[2px] w-12 bg-gray-200"></div>
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center font-bold text-sm">3</div>
        <span class="text-sm font-medium text-gray-400">Verifikasi</span>
      </div>
    </div>

    <div class="max-w-xl w-full px-6">
      <h2 class="text-3xl font-black text-gray-900 mb-2">Lengkapi Profil Anda</h2>
      <p class="text-gray-500 font-medium mb-10">Isi informasi berikut untuk pengalaman belajar yang lebih baik dan personal.</p>

      <form @submit.prevent="goToVerification" class="space-y-6">

        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
          <input type="text" placeholder="0877056283649" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none">
        </div>

        <div>
          <div class="flex justify-between items-center mb-2">
            <label class="text-sm font-bold text-gray-800">Tempat Tinggal <span class="text-red-500">*</span></label>
            <button type="button" class="text-blue-600 text-xs font-bold flex items-center gap-1">
              📍 Gunakan Lokasi
            </button>
          </div>
          <textarea placeholder="Jl. Danau Tamblingan VIII No.3, Jimbaran..." class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none h-24 resize-none"></textarea>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label class="block text-sm font-bold text-gray-800 mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
            <input type="date" class="w-full px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 outline-none text-gray-500">
          </div>
          <div>
            <label class="block text-sm font-bold text-gray-800 mb-2">Pendidikan Terakhir <span class="text-red-500">*</span></label>
            <div class="relative">
              <input type="file" class="hidden" id="upload-edu">
              <label for="upload-edu" class="flex items-center justify-between px-4 py-3.5 bg-gray-50 border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-100 transition">
                <span class="text-sm text-gray-400 font-medium">Unggah foto</span>
                <span class="text-blue-600 text-xl">📷</span>
              </label>
              <p class="text-[10px] text-gray-400 mt-1">Format JPG, PNG, maks 5mb.</p>
            </div>
          </div>
        </div>

        <div class="pt-6">
          <button type="submit" class="w-full bg-[#1A56DB] hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-md transition-colors">
            Selanjutnya
          </button>
        </div>

      </form>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const goToVerification = () => {
  // Sementara kita arahkan ke halaman dummy verifikasi
  alert('Data tersimpan! Lanjut ke Verifikasi KTP.');
}
</script>
