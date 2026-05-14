<template>
  <div class="min-h-screen bg-[#F8FAFC] font-sans flex flex-col items-center">

    <nav class="max-w-7xl mx-auto w-full px-8 py-6 flex justify-between items-center bg-transparent">
      <div class="flex items-center gap-6">
        <Link href="/pilih-daftar" class="flex items-center gap-2 text-gray-500 hover:text-blue-600 transition font-bold group">
          <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
          <span class="hidden sm:inline">Kembali</span>
        </Link>
        <Link href="/" class="flex items-center gap-3 cursor-pointer">
          <div class="text-green-500 text-3xl">🌱</div>
          <div class="leading-tight">
            <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
            <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
          </div>
        </Link>
      </div>
      <div class="hidden md:flex space-x-8 text-gray-600 font-medium text-sm">
        <Link href="/" class="hover:text-blue-600 transition">Beranda</Link>
        <a href="#" class="hover:text-blue-600 transition">Program</a>
        <a href="#" class="hover:text-blue-600 transition">Cara Kerja</a>
        <a href="#" class="hover:text-blue-600 transition">Cari Tutor</a>
      </div>
      <div class="flex items-center space-x-8">
        <Link href="/masuk-siswa" class="text-blue-700 font-bold hover:underline cursor-pointer">
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
            Daftar Sebagai <span class="text-[#3B82F6]">Siswa</span>
          </h1>
          <p class="text-gray-400 font-medium text-sm mb-10">
            Buat akun LesGo untuk mulai belajar dengan tutor terbaik.
          </p>

          <form class="space-y-6" @submit.prevent="submit">
            <LesGoInput
                label="Nama Lengkap"
                v-model="form.name"
                placeholder="Kenzo Aliza"
                :error="form.errors.name"
                required
            />

            <LesGoInput
                label="Alamat Email"
                type="email"
                v-model="form.email"
                placeholder="kenzoaliza@gmail.com"
                :error="form.errors.email"
                required
            />

            <div class="flex gap-4">
              <LesGoInput
                  label="Kata Sandi"
                  type="password"
                  v-model="form.password"
                  placeholder="********"
                  required
              />
              <LesGoInput
                  label="Konfirmasi"
                  type="password"
                  v-model="form.password_confirmation"
                  placeholder="********"
                  required
              />
            </div>
            <p v-if="form.errors.password" class="text-xs text-red-500 mt-1">{{ form.errors.password }}</p>

            <div class="pt-2">
              <LesGoButton :processing="form.processing" class="w-full">
                Daftar Sebagai Siswa
              </LesGoButton>
            </div>
          </form>

          <div class="mt-6 text-center">
            <p class="text-sm font-medium text-gray-400">
              Sudah memiliki akun?
              <Link href="/masuk-siswa" class="text-blue-600 font-bold hover:underline">Masuk</Link>
            </p>
          </div>
        </div>

        <div class="hidden md:flex w-1/2 relative items-center justify-center bg-gray-50/50">
          <div class="w-[90%] h-[90%] border-4 border-dashed border-gray-100 rounded-[30px] flex flex-col items-center justify-center">
            <span class="text-8xl mb-6">👧🏽🎒🌟</span>
            <p class="text-gray-400 font-bold text-lg text-center">Bergabunglah dengan<br>Ribuan Siswa Lainnya</p>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script setup>
import { Link, useForm } from '@inertiajs/vue3'
import LesGoInput from '@/Components/LesGoInput.vue'
import LesGoButton from '@/Components/LesGoButton.vue'

const form = useForm({
  name: '',
  email: '',
  password: '',
  password_confirmation: '',
  role: 'siswa',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>
