<template>
  <div class="max-w-6xl mx-auto w-full space-y-5">
    <section class="bg-[#BFE4F8] rounded-xl border border-blue-100 p-6">
      <h2 class="text-4xl font-black text-gray-900">Tutor Saya</h2>
      <p class="text-sm text-gray-600 mt-2">Lihat tutor yang sudah mengkonfirmasi dan chat tutor.</p>
    </section>

    <section class="bg-white rounded-2xl border border-gray-200 shadow-sm p-4">
      <div class="flex items-center justify-between mb-4">
        <div class="inline-flex rounded-lg bg-gray-100 p-1">
          <button
            v-for="tab in tutorTabs"
            :key="tab.id"
            type="button"
            class="px-4 py-2 rounded-md text-sm font-bold transition"
            :class="tutorFilter === tab.id
              ? 'bg-[#2563EB] text-white'
              : 'text-gray-600 hover:text-gray-800'"
            @click="tutorFilter = tab.id"
          >
            {{ tab.label }}
          </button>
        </div>
        <button
          type="button"
          class="w-9 h-9 rounded-lg border border-gray-200 bg-white text-gray-500 hover:bg-gray-50 flex items-center justify-center"
          aria-label="Filter tutor"
        >
          ☰
        </button>
      </div>

      <div class="rounded-lg border border-amber-100 bg-amber-50 px-4 py-2.5 text-xs font-bold text-amber-700 mb-3">
        {{ tutorFilter === 'menunggu' ? 'Menunggu Konfirmasi Tutor' : 'Tutor Terkonfirmasi' }}
      </div>

      <div v-if="filteredTutorSaya.length" class="space-y-3">
        <article
          v-for="tutor in filteredTutorSaya"
          :key="tutor.id"
          class="rounded-xl border border-gray-200 p-4"
        >
          <div class="flex items-start justify-between gap-4">
            <div class="flex items-start gap-3 min-w-0">
              <div class="w-14 h-14 rounded-full bg-gray-100 flex items-center justify-center text-2xl shrink-0">{{ tutor.avatar }}</div>
              <div class="min-w-0">
                <h4 class="text-xl font-black text-gray-800">{{ tutor.name }}</h4>
                <p class="text-sm text-amber-500 font-semibold">★ ★ ★ ★ ★</p>
                <p class="text-xs text-gray-500 mt-1">📍 {{ tutor.location }}</p>
                <p class="text-xs text-gray-500 mt-1">🧑‍🏫 {{ tutor.method }}</p>
              </div>
            </div>

            <div class="flex flex-col items-end gap-2">
              <span
                class="text-[10px] font-bold px-2.5 py-1 rounded-full"
                :class="tutor.status === 'confirmed'
                  ? 'bg-emerald-100 text-emerald-700'
                  : 'bg-amber-100 text-amber-700'"
              >
                {{ tutor.status === 'confirmed' ? 'Terkonfirmasi' : 'Menunggu Konfirmasi' }}
              </span>

              <button
                v-if="tutor.status === 'pending'"
                type="button"
                class="px-3 py-1.5 rounded-lg text-xs font-bold border border-red-300 text-red-500 hover:bg-red-50"
              >
                Batalkan Permintaan
              </button>
              <div v-else class="flex gap-2">
                <button
                  type="button"
                  class="px-3 py-1.5 rounded-lg text-xs font-bold border border-blue-200 text-[#2563EB] hover:bg-blue-50"
                >
                  Lihat Profil
                </button>
                <button
                  @click="$emit('navigate', 'pesan')"
                  type="button"
                  class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#2563EB] text-white hover:bg-blue-700"
                >
                  Chat Tutor
                </button>
              </div>
            </div>
          </div>
        </article>
      </div>

      <div v-else class="rounded-xl border border-dashed border-gray-300 py-10 px-6 text-center">
        <p class="text-sm font-bold text-gray-600">Belum ada data tutor pada tab ini.</p>
        <p class="text-xs text-gray-400 mt-1">Coba pilih tab lain atau kirim permintaan tutor baru.</p>
      </div>

      <p class="text-xs text-gray-400 mt-4">
        Total tutor:
        <span class="font-bold text-gray-600">{{ filteredTutorSaya.length }}</span>
      </p>
    </section>
</div>
</template>

<script setup>
import { computed, ref } from 'vue'

defineEmits(['navigate'])

const tutorFilter = ref('menunggu')
const tutorTabs = [
  { id: 'terkonfirmasi', label: 'Terkonfirmasi' },
  { id: 'menunggu', label: 'Menunggu' },
]
const tutorSayaItems = [
  {
    id: 1,
    name: 'Isyana Randini',
    avatar: '👩🏻',
    location: 'Denpasar Selatan',
    method: 'Metode: Privat ke rumah',
    status: 'pending',
  },
  {
    id: 2,
    name: 'Renata Salsabila',
    avatar: '👩🏽',
    location: 'Denpasar Timur',
    method: 'Metode: Online & privat',
    status: 'confirmed',
  },
  {
    id: 3,
    name: 'Aldora Pratama',
    avatar: '👨🏻',
    location: 'Badung Utara',
    method: 'Metode: Privat ke rumah',
    status: 'confirmed',
  },
]

const filteredTutorSaya = computed(() => {
  if (tutorFilter.value === 'menunggu') {
    return tutorSayaItems.filter((item) => item.status === 'pending')
  }
  return tutorSayaItems.filter((item) => item.status === 'confirmed')
})
</script>
