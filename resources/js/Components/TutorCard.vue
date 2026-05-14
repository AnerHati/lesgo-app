<template>
  <article
    class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 flex flex-col hover:shadow-md transition"
    :class="{ 'border-2 border-blue-500 shadow-blue-100': highlight }"
  >
    <!-- Top Row: Avatar & Info -->
    <div class="flex items-start gap-5 mb-4">
      <div class="w-16 h-16 rounded-full bg-blue-50 flex items-center justify-center text-3xl shrink-0 overflow-hidden border border-gray-100 shadow-inner">
        <img :src="`https://ui-avatars.com/api/?name=${tutor.name.replace(/ /g, '+')}&background=eff6ff&color=2563eb`" alt="Avatar" class="w-full h-full object-cover" />
      </div>
      <div>
        <h3 class="text-lg font-black text-[#2563EB] leading-tight">{{ tutor.name }}</h3>
        <p class="text-xs font-bold text-gray-500 mt-0.5">{{ tutor.subjects.map(s => s.name).join(', ') }}</p>
        <p class="text-[11px] text-gray-400 mt-1 font-semibold flex items-center gap-1">🎓 Tutor Ahli</p>
        <div class="flex items-center gap-1 mt-1.5 text-xs font-bold">
          <span class="text-amber-400 text-sm tracking-widest">{{ stars }}</span>
          <span class="text-gray-600 ml-1">{{ tutor.rating || '5.0' }}</span>
        </div>
      </div>
    </div>

    <!-- Middle Row: Description -->
    <p class="text-xs text-gray-500 leading-relaxed line-clamp-3 mb-6">
      {{ tutor.tutor_profile?.bio || 'Tidak ada deskripsi.' }}
    </p>

    <!-- Bottom Row: Button -->
    <div class="mt-auto">
      <button
        @click="$emit('view', tutor)"
        type="button"
        class="w-full py-2.5 rounded-xl text-sm font-bold border-2 border-[#2563EB] text-[#2563EB] hover:bg-blue-50 transition"
      >
        Lihat Profil
      </button>
    </div>
  </article>
</template>

<script setup>
import { computed } from 'vue'

const props = defineProps({
  tutor: { type: Object, required: true },
  highlight: { type: Boolean, default: false }
})

defineEmits(['view'])

const stars = computed(() => {
  const rating = props.tutor.rating || 5
  return '⭐'.repeat(Math.round(rating))
})
</script>
