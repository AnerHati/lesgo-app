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
        <div class="flex items-center gap-2">
           <h3 class="text-lg font-black text-[#2563EB] leading-tight">{{ tutor.name }}</h3>
           <div v-if="tutor.tutor_profile?.is_verified" class="bg-blue-600 text-white p-0.5 rounded-full" title="Verified Tutor">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                 <path d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path>
              </svg>
           </div>
        </div>
        <p class="text-xs font-bold text-gray-500 mt-0.5">{{ tutor.subjects.map(s => s.name).join(', ') }}</p>
        <div class="flex items-center gap-3 mt-1">
           <p class="text-[10px] text-gray-400 font-bold flex items-center gap-1">
              <span class="text-blue-500">🎓</span> Expert
           </p>
           <p v-if="tutor.tutor_profile?.total_teaching_hours" class="text-[10px] text-gray-400 font-bold flex items-center gap-1">
              <span class="text-emerald-500">⏱️</span> {{ tutor.tutor_profile.total_teaching_hours }} jam mengajar
           </p>
        </div>
        <div class="flex items-center gap-1 mt-1.5 text-xs font-bold">
          <span class="text-amber-400 text-sm tracking-widest">{{ stars }}</span>
          <span class="text-gray-600 ml-1">{{ tutor.tutor_profile?.rating || '5.0' }}</span>
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
