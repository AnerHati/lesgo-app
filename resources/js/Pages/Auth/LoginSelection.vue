<template>
  <div class="min-h-screen bg-[#FAFAFA] font-sans flex flex-col">

    <nav class="max-w-7xl mx-auto w-full px-8 py-6 flex justify-between items-center bg-transparent">
      <Link href="/" class="flex items-center gap-3 cursor-pointer">
        <div class="text-green-500 text-3xl">🌱</div>
        <div class="leading-tight">
          <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
          <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
        </div>
      </Link>
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
        <Link href="/pilih-daftar" class="text-blue-700 font-bold hover:underline cursor-pointer">
          Daftar
        </Link>
      </div>
    </nav>

    <div class="text-center mt-12 mb-12">
      <h1 class="text-5xl font-extrabold text-gray-900 tracking-tight mb-4">
        Masuk <span class="text-blue-600">Sesuai Kebutuhan</span> Anda!
      </h1>
    </div>

    <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 pb-20">

      <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-10 flex flex-col items-center text-center hover:border-blue-500 border-2 hover:shadow-lg transition-all group relative pt-16 mt-8">
        <div class="absolute -top-12 w-24 h-24 flex items-center justify-center bg-blue-50 rounded-full shadow-md border-4 border-white">
          <span class="text-5xl">🎒</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Masuk sebagai <span class="text-[#0EA5E9]">Siswa</span></h2>
        <p class="text-gray-400 font-medium text-sm leading-relaxed mb-8">
          Masuk sebagai siswa untuk belajar dengan tutor terbaik untuk Anda.
        </p>
        <div class="mb-8 flex-1 flex items-end">
          <span class="text-7xl group-hover:scale-110 transition-transform">👧🏽</span>
        </div>
        <Link href="/masuk-siswa" class="w-full bg-[#2563EB] hover:bg-blue-700 active:scale-95 text-white font-bold py-3.5 rounded-xl transition-all duration-200 block text-center">
          Masuk Sebagai Siswa
        </Link>
      </div>

      <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-10 flex flex-col items-center text-center hover:border-yellow-400 hover:shadow-lg transition-all group relative pt-16 mt-8">
        <div class="absolute -top-12 w-24 h-24 flex items-center justify-center bg-blue-50 rounded-full shadow-md border-4 border-white">
          <span class="text-5xl">🎓</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Masuk sebagai <span class="text-yellow-400">Tutor</span></h2>
        <p class="text-gray-400 font-medium text-sm leading-relaxed mb-8">
          Masuk untuk menjadi tutor dan mengajar murid di LesGo.
        </p>
        <div class="mb-8 flex-1 flex items-end">
          <span class="text-7xl group-hover:scale-110 transition-transform">👦🏻</span>
        </div>
       <Link href="/login-tutor" class="w-full bg-[#2563EB] hover:bg-blue-700 active:scale-95 text-white font-bold py-3.5 rounded-xl transition-all duration-200 block text-center shadow-sm">
  Masuk Sebagai Tutor
</Link>
      </div>

      <div class="bg-white rounded-3xl border border-gray-100 shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-10 flex flex-col items-center text-center hover:border-green-400 hover:shadow-lg transition-all group relative pt-16 mt-8">
        <div class="absolute -top-12 w-24 h-24 flex items-center justify-center bg-blue-50 rounded-full shadow-md border-4 border-white">
          <span class="text-5xl">👪</span>
        </div>
        <h2 class="text-2xl font-bold text-gray-900 mb-3">Masuk sebagai <span class="text-green-500">Orang Tua</span></h2>
        <p class="text-gray-400 font-medium text-sm leading-relaxed mb-8">
          Temukan tutor terbaik yang dekat dengan Anda.
        </p>
        <div class="mb-8 flex-1 flex items-end">
          <span class="text-7xl group-hover:scale-110 transition-transform">👩‍👦</span>
        </div>
        <Link href="/masuk-orang-tua" class="w-full bg-[#2563EB] hover:bg-blue-700 active:scale-95 text-white font-bold py-3.5 rounded-xl transition-all duration-200 block text-center">
          Masuk Sebagai Orang Tua
        </Link>
      </div>

    </div>
  </div>
</template>

<script setup>
// Cukup import Link dari Inertia, tidak perlu fungsi manual lagi
import { Link } from '@inertiajs/vue3'
</script>
