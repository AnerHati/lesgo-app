<template>
  <div v-if="tutor" class="animate-fade-in">
    <!-- Back Button -->
    <div class="mb-6">
      <button @click="$emit('back')" type="button" class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg font-bold text-sm inline-flex items-center gap-2 hover:bg-gray-50 transition shadow-sm">
        <span aria-hidden="true">←</span> Kembali
      </button>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      <!-- Left Column: Profile Details -->
      <div class="lg:col-span-2 bg-white rounded-[24px] border border-gray-200 p-8 shadow-sm flex flex-col">
        <!-- Header -->
        <div class="flex flex-col md:flex-row gap-8 items-start">
          <div class="w-32 h-32 rounded-full overflow-hidden bg-blue-50 shrink-0 border-4 border-white shadow-md">
            <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb&size=256`" :alt="tutor.name" class="w-full h-full object-cover">
          </div>
          <div class="pt-2">
            <h2 class="text-3xl font-black text-gray-900 mb-2">{{ tutor.name }}</h2>
            <div class="flex items-center gap-1 mb-3">
              <span class="text-amber-400 text-lg">⭐⭐⭐⭐⭐</span>
            </div>
            <div class="space-y-2">
              <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                <span class="w-5 text-center text-lg">📚</span> {{ tutor.subjects.map(s => s.name).join(', ') }}
              </p>
              <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                <span class="w-5 text-center text-lg">📍</span> Tersedia Area Lokal / Online
              </p>
            </div>
          </div>
        </div>

        <!-- Description Box -->
        <div class="mt-8 bg-[#F5F7FF] rounded-2xl p-5">
          <p class="text-sm text-gray-600 leading-relaxed font-medium">
            {{ tutor.description || tutor.tutor_profile?.bio || 'Tidak ada deskripsi.' }}
          </p>
        </div>

        <!-- Details List -->
        <div class="mt-8 space-y-6">
          <div>
            <h4 class="flex items-center gap-2 text-base font-bold text-gray-900 mb-3">
              <span class="text-emerald-500 text-xl">☑</span> Kursus yang diajarkan
            </h4>
            <div class="ml-7 space-y-2">
              <p class="flex items-center gap-2 text-sm font-bold text-gray-500">
                <span class="text-gray-400">🎓</span> Semua Jenjang
              </p>
              <p v-for="sub in tutor.subjects" :key="sub.id" class="flex items-center gap-2 text-sm font-bold text-gray-500">
                <span class="text-gray-400">{{ sub.icon || '📚' }}</span> {{ sub.name }}
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Right Column: Pricing -->
      <div class="lg:col-span-1 space-y-6">
        <div class="bg-white rounded-[24px] border border-gray-200 p-6 shadow-sm">
          <h3 class="text-lg font-black text-gray-900 mb-4">Biaya Mengajar</h3>
          <div class="space-y-0">
            <div v-for="sub in tutor.subjects" :key="sub.id" class="flex justify-between items-center py-4 border-b border-gray-100 last:border-0">
              <span class="text-sm font-bold text-gray-800">{{ sub.name }}</span>
              <div class="text-right">
                <span class="text-[11px] font-bold text-gray-400 block mb-0.5">1 Jam</span>
                <span class="text-sm font-black text-gray-900">Rp{{ sub.price?.toLocaleString('id-ID') || '-' }}</span>
              </div>
            </div>
          </div>

          <button @click="$emit('book')" type="button" class="mt-4 w-full bg-[#2563EB] text-white py-3.5 rounded-xl text-sm font-bold shadow-sm hover:bg-blue-700 transition">
            Pesan Tutor
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  tutor: { type: Object, required: true }
})

defineEmits(['back', 'book'])
</script>
