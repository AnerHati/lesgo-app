<template>
  <div class="min-h-screen bg-[#F8FAFC] font-sans flex flex-col items-center">

    <nav class="max-w-7xl mx-auto w-full px-8 py-6 flex justify-between items-center bg-transparent">
      <div class="flex items-center gap-3 cursor-pointer" @click="goTo('/')">
        <div class="text-green-500 text-3xl">🌱</div>
        <div class="leading-tight">
          <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
          <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
        </div>
      </div>
      <div class="hidden md:flex space-x-8 text-gray-600 font-medium text-sm">
        <a href="#" class="hover:text-blue-600 transition">Beranda</a>
        <a href="#" class="hover:text-blue-600 transition">Program</a>
        <a href="#" class="hover:text-blue-600 transition">Cara Kerja</a>
        <a href="#" class="hover:text-blue-600 transition">Cari Tutor</a>
      </div>
      <div class="flex items-center space-x-8">
        <button class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold shadow-md cursor-default">
          Masuk
        </button>
        <button @click="goTo('/pilih-daftar')" class="text-blue-700 font-bold hover:underline cursor-pointer">
          Daftar
        </button>
      </div>
    </nav>

    <div class="flex-1 w-full flex justify-center items-center p-6 max-w-7xl">
      <div class="bg-white rounded-[40px] shadow-[0_8px_30px_rgb(0,0,0,0.04)] w-full flex overflow-hidden border border-gray-100 min-h-[600px] relative">

        <div class="w-full md:w-1/2 p-12 lg:p-16 flex flex-col justify-center z-10">
          <h1 class="text-4xl font-extrabold text-gray-900 mb-2">
            Selamat Datang Kembali
          </h1>
          <p class="text-gray-400 font-medium text-sm mb-10">
            Masuk akun Vidya Loka untuk belajar dengan tutor terbaik.
          </p>

          <form class="space-y-6" @submit.prevent="goTo(route('dashboard.siswa'))">

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Alamat Email <span class="text-red-500">*</span></label>
              <input type="email" placeholder="kenzoaliza@gmail.com" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none placeholder-gray-400 transition-all">
            </div>

            <div>
              <label class="block text-sm font-bold text-gray-800 mb-2">Kata Sandi <span class="text-red-500">*</span></label>
              <input type="password" placeholder="********" class="w-full px-4 py-3.5 bg-white border border-gray-200 rounded-xl text-sm focus:ring-2 focus:ring-blue-500 outline-none placeholder-gray-400 tracking-widest transition-all">
            </div>

            <div class="flex items-center justify-between pt-2">
              <div class="flex items-center">
                <input type="checkbox" id="remember" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 cursor-pointer">
                <label for="remember" class="ml-2 text-xs text-gray-500 font-medium cursor-pointer">Ingat saya saat masuk</label>
              </div>
              <a href="#" class="text-xs font-bold text-gray-400 hover:text-blue-600 transition-colors">Lupa kata sandi?</a>
            </div>

            <div class="pt-4">
              <button type="submit" class="w-full bg-[#1A56DB] hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-md transition-colors">
                Masuk Sebagai Siswa
              </button>
            </div>

          </form>

          <div class="mt-8 text-center md:text-left pl-2">
            <p class="text-xs font-medium text-gray-400">
              Belum memiliki akun?
              <button @click="goTo('/pilih-daftar')" class="text-blue-600 font-bold hover:underline ml-1">Daftar</button>
            </p>
          </div>

        </div>

        <div class="hidden md:flex w-1/2 relative items-center justify-center bg-white">
          <div class="w-[90%] h-[90%] border-4 border-dashed border-gray-100 rounded-[30px] flex flex-col items-center justify-center bg-gray-50/50">
            <span class="text-8xl mb-6">👧🏽🎒🌟</span>
            <p class="text-gray-400 font-bold text-lg text-center">
              Tempat Gambar 3D Anak<br>
              <span class="text-sm font-medium">(Masukkan tag img di sini nanti)</span>
            </p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { router } from '@inertiajs/vue3'

const goTo = (url) => {
  router.visit(url)
}
</script>
