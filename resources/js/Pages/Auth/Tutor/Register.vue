<template>
  <div class="min-h-screen bg-[#F8FAFC] font-sans flex flex-col items-center">
    <nav class="max-w-7xl mx-auto w-full px-8 py-6 flex justify-between items-center bg-transparent">
      <Link href="/" class="flex items-center gap-3">
        <div class="text-green-500 text-3xl">🌱</div>
        <div class="leading-tight">
          <div class="text-2xl font-extrabold text-[#10B981] tracking-tight">LesGo</div>
          <div class="text-[10px] text-gray-500 font-medium tracking-wide">Digital Tutoring Ecosystem</div>
        </div>
      </Link>
      <div class="flex items-center space-x-8">
        <Link href="/login-tutor" class="text-blue-700 font-bold hover:underline">Masuk</Link>
        <button class="bg-blue-600 text-white px-8 py-2.5 rounded-lg font-bold shadow-md cursor-default">Daftar Tutor</button>
      </div>
    </nav>

    <div class="flex-1 w-full flex justify-center items-center p-6 max-w-7xl">
      <div class="bg-white rounded-[40px] shadow-sm w-full flex overflow-hidden border border-gray-100 min-h-[600px]">
        <div class="w-full md:w-1/2 p-12 lg:p-16 flex flex-col justify-center">
          <h1 class="text-4xl font-extrabold text-gray-900 mb-2">Daftar Menjadi <span class="text-blue-600">Tutor</span></h1>
          <p class="text-gray-400 font-medium text-sm mb-10">Bagikan ilmu Anda dan dapatkan penghasilan tambahan.</p>

          <form class="space-y-6" @submit.prevent="submit">
            <LesGoInput
                label="Nama Lengkap"
                v-model="form.name"
                :error="form.errors.name"
                required
            />
            <LesGoInput
                label="Email"
                type="email"
                v-model="form.email"
                :error="form.errors.email"
                required
            />
            <div class="flex gap-4">
              <LesGoInput
                  label="Kata Sandi"
                  type="password"
                  v-model="form.password"
                  required
              />
              <LesGoInput
                  label="Konfirmasi"
                  type="password"
                  v-model="form.password_confirmation"
                  required
              />
            </div>
            <p v-if="form.errors.password" class="text-xs text-red-500 mt-1">{{ form.errors.password }}</p>

            <LesGoButton :processing="form.processing" class="w-full">
              Daftar Sebagai Tutor
            </LesGoButton>
          </form>
          <div class="mt-6 text-center">
            <p class="text-sm font-medium text-gray-400">Sudah punya akun? <Link href="/login-tutor" class="text-blue-600 font-bold hover:underline">Masuk</Link></p>
          </div>
        </div>
        <div class="hidden md:flex w-1/2 bg-blue-50 items-center justify-center">
          <div class="w-[90%] h-[90%] border-4 border-dashed border-blue-100 rounded-[30px] flex flex-col items-center justify-center">
            <span class="text-9xl mb-6">👨🏻‍🏫📚✨</span>
            <p class="text-blue-400 font-bold text-lg text-center">Inspirasi Masa Depan<br>Melalui Pendidikan</p>
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
  role: 'tutor',
})

const submit = () => {
  form.post(route('register'), {
    onFinish: () => form.reset('password', 'password_confirmation'),
  })
}
</script>