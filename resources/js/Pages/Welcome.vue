<template>
  <div class="min-h-screen bg-white font-sans overflow-x-hidden">

    <nav class="max-w-7xl mx-auto px-6 py-6 flex justify-between items-center bg-white sticky top-0 z-50">
      <Link href="/" class="flex items-center gap-3">
        <div class="text-green-500 text-3xl">🌱</div>
        <div class="leading-tight">
          <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
          <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
        </div>
      </Link>
      <div class="hidden md:flex space-x-8 text-gray-700 font-medium text-sm">
        <Link href="/" class="text-blue-600 font-semibold">Beranda</Link>
        <a href="#program" class="hover:text-blue-600 transition">Program</a>
        <a href="#cara-kerja" class="hover:text-blue-600 transition">Cara Kerja</a>
        <a href="#cari-tutor" class="hover:text-blue-600 transition">Cari Tutor</a>
      </div>
      <div class="flex items-center space-x-6">
        <Link href="/pilih-masuk" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-2.5 rounded-lg font-bold shadow-sm transition">
          Masuk
        </Link>
        <Link href="/pilih-daftar" class="text-blue-600 font-bold hover:text-blue-800 transition cursor-pointer">
          Daftar
        </Link>
      </div>
    </nav>

    <section class="max-w-7xl mx-auto px-6 py-12 flex flex-col lg:flex-row items-center gap-12">
      <div class="lg:w-1/2 z-10">
        <h1 class="text-[56px] font-extrabold text-gray-900 leading-[1.1] mb-6 tracking-tight">
          Belajar dari yang <br>
          <span class="text-[#3B82F6]">Terdekat</span>, Lebih <br>
          Nyaman dan Efektif
        </h1>
        <p class="text-lg text-gray-500 font-medium mb-10 max-w-lg leading-relaxed">
          Temukan tutor berpengalaman di dekat lingkungan Anda. Belajar makin dekat, efektif, dan menyenangkan!
        </p>
        <div class="flex items-center bg-white border border-gray-200 rounded-xl shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-1.5 max-w-md">
          <div class="pl-4 pr-2 text-gray-400">📍</div>
          <input type="text" placeholder="Masukkan Lokasi Anda" class="flex-1 bg-transparent border-none outline-none text-gray-700 placeholder-gray-400 py-3">
          <button class="bg-[#3B82F6] hover:bg-blue-600 text-white w-12 h-12 rounded-lg flex justify-center items-center transition shadow-sm">
            🔍
          </button>
        </div>
      </div>
      <div class="lg:w-1/2 relative w-full flex justify-end mt-12 lg:mt-0">
        <div class="w-[85%] h-[500px] bg-[#3B82F6] rounded-3xl relative flex justify-center items-end">
          <div class="absolute bottom-0 w-[90%] h-[110%] bg-blue-300 rounded-t-full border-4 border-dashed border-white flex justify-center items-center text-white/50 text-center px-4 overflow-hidden">
            <span class="text-8xl">👩🏻‍🦱📚</span>
          </div>
        </div>
        <div class="absolute -bottom-8 left-0 bg-white p-6 rounded-2xl shadow-xl border border-gray-100 w-64 z-20">
          <div class="absolute -top-4 left-6 w-10 h-10 bg-green-500 rounded-full flex justify-center items-center shadow-lg text-white">🎓</div>
          <h3 class="font-bold text-gray-900 mt-2 mb-3">10k+ Siswa Terdaftar</h3>
          <div class="flex -space-x-2">
            <div v-for="i in 5" :key="i" class="w-8 h-8 rounded-full border-2 border-white bg-gray-200"></div>
          </div>
        </div>
        <div class="absolute top-16 -right-12 bg-white px-5 py-4 rounded-xl shadow-lg border border-gray-100 flex items-center gap-3 z-20">
          <div class="w-10 h-10 bg-yellow-400 rounded-full flex justify-center items-center text-white font-bold">💡</div>
          <div>
            <h4 class="font-bold text-gray-900 text-sm">Pengembangan Diri</h4>
            <p class="text-xs text-gray-500">30 Kelas</p>
          </div>
        </div>
        <div class="absolute top-40 -right-12 bg-white px-5 py-4 rounded-xl shadow-lg border border-gray-100 flex items-center gap-3 z-20">
          <div class="w-10 h-10 bg-red-500 rounded-full flex justify-center items-center text-white font-bold">🥇</div>
          <div>
            <h4 class="font-bold text-gray-900 text-sm">Tutor Terbaik</h4>
            <p class="text-xs text-gray-500">5k+ Tutor Terbaik</p>
          </div>
        </div>
      </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-20">
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="bg-blue-50/50 p-8 rounded-[32px] border border-blue-100 hover:shadow-lg transition">
          <div class="flex items-center gap-4 mb-4">
            <div class="text-4xl">👨🏻‍🏫</div>
            <h3 class="text-xl font-black text-gray-900 leading-tight">5000+ <br> Tutor Terdekat</h3>
          </div>
          <p class="text-gray-500 mb-6 text-sm">Tutor berpengalaman di dekat lingkungan Anda.</p>
          <a href="#" class="text-blue-600 font-bold text-sm flex items-center gap-2">Lihat Selengkapnya →</a>
        </div>
        <div class="bg-blue-50/50 p-8 rounded-[32px] border border-blue-100 hover:shadow-lg transition">
          <div class="flex items-center gap-4 mb-4">
            <div class="text-4xl">🎒</div>
            <h3 class="text-xl font-black text-gray-900 leading-tight">10.000+ <br> Siswa Terdaftar</h3>
          </div>
          <p class="text-gray-500 mb-6 text-sm">Sudah dipercaya oleh ribuan siswa dari berbagai jenjang.</p>
          <a href="#" class="text-blue-600 font-bold text-sm flex items-center gap-2">Lihat Selengkapnya →</a>
        </div>
        <div class="bg-blue-50/50 p-8 rounded-[32px] border border-blue-100 hover:shadow-lg transition">
          <div class="flex items-center gap-4 mb-4">
            <div class="text-4xl">🎯</div>
            <h3 class="text-xl font-black text-gray-900 leading-tight">100% <br> Belajar Efektif</h3>
          </div>
          <p class="text-gray-500 mb-6 text-sm">Materi relevan, kelompok kecil, belajar makin fokus.</p>
          <a href="#" class="text-blue-600 font-bold text-sm flex items-center gap-2">Lihat Selengkapnya →</a>
        </div>
      </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row items-center gap-16">
      <div class="md:w-1/3">
        <h2 class="text-[56px] font-black text-gray-900 leading-tight tracking-tight">Kenapa pilih <br> <span class="text-blue-500">LesGo</span>?</h2>
      </div>
      <div class="md:w-2/3 space-y-6">
        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex items-center gap-6">
          <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center text-2xl shrink-0">🏠</div>
          <div>
            <h3 class="text-xl font-bold text-gray-900 mb-1">Tutor Dekat & Terbaik</h3>
            <p class="text-gray-500 text-sm">Tutor dekat dengan Anda, lebih paham kebutuhan belajar siswa.</p>
          </div>
        </div>
        <div class="bg-white p-6 rounded-[24px] shadow-sm border border-gray-100 flex items-center gap-6">
          <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center text-2xl shrink-0">⏱️</div>
          <div>
            <h3 class="text-xl font-bold text-gray-900 mb-1">Belajar Fleksibel</h3>
            <p class="text-gray-500 text-sm">Atur jadwal belajar sesuai kebutuhan Anda.</p>
          </div>
        </div>
      </div>
    </section>

    <section class="mt-20">
      <div class="bg-blue-500 pt-16 pb-32">
        <div class="max-w-7xl mx-auto px-6">
          <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center text-white mb-16">
            <div>
              <h3 class="text-4xl font-black mb-2">5K+</h3>
              <p class="font-medium text-blue-100">Tutor Aktif</p>
            </div>
            <div>
              <h3 class="text-4xl font-black mb-2">10K+</h3>
              <p class="font-medium text-blue-100">Siswa Terdaftar</p>
            </div>
            <div>
              <h3 class="text-4xl font-black mb-2">20K+</h3>
              <p class="font-medium text-blue-100">Program Belajar</p>
            </div>
            <div>
              <h3 class="text-4xl font-black mb-2">8K</h3>
              <p class="font-medium text-blue-100">Jam Belajar</p>
            </div>
          </div>

          <div class="bg-white rounded-[40px] shadow-2xl flex flex-col md:flex-row overflow-hidden -mb-48 relative z-10 border-r-8 border-blue-800">
            <div class="md:w-1/2 bg-gray-100 min-h-[300px] flex items-center justify-center">
               <span class="text-8xl">👦🏻👧🏻✈️</span>
            </div>
            <div class="md:w-1/2 p-12 flex flex-col justify-center">
              <ul class="space-y-6 mb-10">
                <li class="flex items-center gap-4 text-gray-700 font-bold text-lg">
                  <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">✓</span>
                  Tutor terdekat dari lokasi kamu
                </li>
                <li class="flex items-center gap-4 text-gray-700 font-bold text-lg">
                  <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">✓</span>
                  Booking cepat & mudah
                </li>
                <li class="flex items-center gap-4 text-gray-700 font-bold text-lg">
                  <span class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center">✓</span>
                  Kelas lebih fokus & terarah
                </li>
              </ul>
              <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-xl w-fit flex items-center gap-3 transition">
                → Pesan Sekarang
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pt-64 pb-24 text-center">
      <h2 class="text-4xl font-black text-blue-700 mb-12">Apa Kata Mereka tentang LesGo?</h2>

      <div class="bg-blue-100 rounded-[40px] p-8 md:p-12 relative">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <div v-for="i in 4" :key="i" class="bg-white p-8 rounded-[24px] shadow-md text-left">
            <div class="flex gap-1 mb-4 text-yellow-400 text-xl">
              <span>★</span><span>★</span><span>★</span><span>★</span><span class="text-gray-300">★</span>
            </div>
            <p class="text-gray-600 font-medium leading-relaxed mb-6">
              "Anak saya jadi lebih berani bertanya dan tidak sungkan saat belajar, karena tutornya dekat rumah dan sudah dikenal."
            </p>
            <div class="flex items-center gap-4">
              <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center text-xl">👩🏽</div>
              <div>
                <h4 class="font-bold text-gray-900">Dina Putri</h4>
                <p class="text-xs text-gray-500 font-medium">Orang Tua Siswa SD</p>
              </div>
            </div>
          </div>
        </div>

        <div class="absolute -bottom-6 left-0 right-0 flex justify-center">
          <button @click="goTo('/pilih-daftar')" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-xl shadow-lg transition">
            Daftar Les
          </button>
        </div>
      </div>
    </section>

    <footer class="bg-blue-600 py-6 px-8 mt-12">
      <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center text-white">
        <p class="font-medium text-sm">© 2026. All rights reserved.</p>
        <div class="flex gap-4 mt-4 md:mt-0 text-2xl">
          <a href="#" class="hover:text-gray-200 transition">💬</a>
          <a href="#" class="hover:text-gray-200 transition">📷</a>
          <a href="#" class="hover:text-gray-200 transition">🎵</a>
        </div>
      </div>
    </footer>

  </div>
</template>

<script setup>
import { router, Link } from '@inertiajs/vue3'

const goTo = (url) => {
  router.visit(url)
}
</script>
