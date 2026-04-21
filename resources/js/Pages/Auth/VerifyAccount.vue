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
      <div class="h-[2px] w-12 bg-blue-600"></div>
      <div class="flex items-center gap-2">
        <div class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center font-bold text-sm">3</div>
        <span class="text-sm font-bold text-gray-900">Verifikasi</span>
      </div>
    </div>

    <div class="max-w-xl w-full px-6">
      <h2 class="text-3xl font-black text-gray-900 mb-2 text-center md:text-left">Proses Verifikasi Akun Anda</h2>
      <p class="text-gray-500 font-medium mb-10 text-center md:text-left">Unggah foto KTP dan Ijazah Anda untuk verifikasi keamanan.</p>

      <form @submit.prevent="finishRegistration" class="space-y-8">

        <div>
          <label class="block text-sm font-bold text-gray-800 mb-4 text-center md:text-left">Unggah foto KTP Anda atau seret kemari</label>
          <div class="border-2 border-dashed border-blue-200 bg-blue-50/30 rounded-[32px] p-12 flex flex-col items-center justify-center text-center group hover:border-blue-400 transition-all cursor-pointer">
            <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
               <span class="text-3xl">🗂️</span>
            </div>
            <button type="button" class="bg-yellow-400 hover:bg-yellow-500 text-white font-bold px-8 py-2.5 rounded-full text-sm shadow-sm transition-colors mb-2">
              Pilih Foto
            </button>
          </div>
        </div>

        <div>
          <label class="block text-sm font-bold text-gray-800 mb-2 text-center md:text-left">Ijazah Pendidikan Terakhir <span class="text-red-500">*</span></label>
          <div class="relative">
            <input type="file" class="hidden" id="upload-ijazah">
            <label for="upload-ijazah" class="flex items-center justify-between px-6 py-4 bg-gray-50 border border-gray-200 rounded-2xl cursor-pointer hover:bg-gray-100 transition">
              <div class="flex items-center gap-3">
                <span class="text-xl">📄</span>
                <span class="text-sm text-gray-400 font-medium">Unggah foto</span>
              </div>
            </label>
            <p class="text-[10px] text-gray-400 mt-2 text-center md:text-left italic">Format JPG, PNG, maks 5mb.</p>
          </div>
        </div>

        <div class="pt-4">
          <button type="submit" class="w-full bg-yellow-400 hover:bg-yellow-500 text-white font-black py-4 rounded-2xl shadow-[0_8px_20px_rgba(250,204,21,0.3)] transition-all text-lg">
            Kirim & Selesaikan
          </button>
        </div>
      </form>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const finishRegistration = () => {
  // Simulasi pengiriman data berhasil
  alert('Data verifikasi telah dikirim! Akun Anda sedang diproses oleh admin.');
  router.visit('/dashboard-siswa');
}
</script>
