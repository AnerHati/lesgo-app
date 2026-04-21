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
          <div class="absolute left-0 right-0 top-3 h-[2px] bg-[#FACC15] -z-10"></div>

          <div class="flex flex-col items-center gap-2 bg-[#F8FAFC] px-2">
            <div class="w-6 h-6 rounded-full bg-[#FACC15] text-white flex items-center justify-center font-bold text-xs shadow-sm">1</div>
            <span class="text-xs font-bold text-[#FACC15]">Buat Akun</span>
          </div>

          <div class="flex flex-col items-center gap-2 bg-[#F8FAFC] px-2">
            <div class="w-6 h-6 rounded-full bg-[#FACC15] text-white flex items-center justify-center font-bold text-xs shadow-sm">2</div>
            <span class="text-xs font-bold text-[#FACC15]">Lengkapi Profil</span>
          </div>

          <div class="flex flex-col items-center gap-2 bg-[#F8FAFC] px-2">
            <div class="w-6 h-6 rounded-full bg-[#FACC15] text-white flex items-center justify-center font-bold text-xs shadow-sm">3</div>
            <span class="text-xs font-bold text-[#FACC15]">Verifikasi</span>
          </div>
        </div>
      </div>
    </header>

    <main class="flex-1 w-full flex justify-center items-center p-6 max-w-6xl -mt-4">
      <div class="bg-white rounded-[40px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] w-full flex overflow-hidden border border-gray-100 min-h-[550px] relative">
        
        <div class="w-full md:w-[55%] p-10 lg:p-14 flex flex-col justify-center z-10">
          <h1 class="text-4xl font-extrabold text-[#FACC15] mb-2 tracking-tight">
            Proses Verifikasi Akun Anda
          </h1>
          <p class="text-gray-400 font-medium text-sm mb-8">
            Unggah foto KTP dan Ijazah Anda.
          </p>

          <form class="space-y-6" @submit.prevent="submitVerification">
            
            <div class="border-[2px] border-dashed border-blue-200 rounded-[24px] p-8 flex flex-col items-center justify-center text-center hover:bg-gray-50 transition-colors cursor-pointer group">
              <div class="w-16 h-16 bg-green-50 rounded-2xl flex items-center justify-center mb-4 relative">
                <span class="text-3xl">📁</span>
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-2 border-white flex items-center justify-center">
                  <span class="text-white text-[10px] font-bold">✓</span>
                </div>
              </div>
              <p class="text-gray-500 text-sm font-medium mb-4">Unggah foto KTP Anda atau seret kemari</p>
              <button type="button" class="bg-[#FACC15] hover:bg-yellow-500 text-white px-8 py-2.5 rounded-xl font-bold text-sm transition-colors shadow-sm">
                Pilih Foto
              </button>
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Ijazah Pendidikan Terakhir <span class="text-red-500">*</span></label>
              <div class="relative">
                <input type="file" id="upload-ijazah" class="hidden">
                <label for="upload-ijazah" class="flex items-center gap-3 w-full px-4 py-3 bg-white border border-gray-200 rounded-xl cursor-pointer hover:bg-gray-50 transition-colors">
                  <span class="text-gray-400 text-lg">📄</span>
                  <div>
                    <p class="text-sm text-gray-500 font-medium leading-tight">Unggah foto</p>
                    <p class="text-[10px] text-gray-400">Format JPG, PNG, maks 5mb.</p>
                  </div>
                </label>
              </div>
            </div>

            <div class="pt-4">
              <button type="submit" class="w-full bg-[#FACC15] hover:bg-yellow-500 text-white font-bold py-4 rounded-xl shadow-md transition-colors text-lg">
                Kirim & Selesaikan
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

const submitVerification = () => {
  // Simulasi sukses mendaftar, arahkan ke halaman Masuk Akun 
  // (Sama seperti alur siswa sebelumnya)
  alert('Verifikasi Tutor Berhasil Dikirim! Silakan Masuk.');
  router.visit('/masuk-akun')
}
</script>