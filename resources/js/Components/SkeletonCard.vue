<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div v-for="i in count" :key="'skeleton-'+i" class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 animate-pulse">
      <div class="flex items-start gap-5 mb-4">
        <div class="w-16 h-16 rounded-full bg-gray-200 shrink-0"></div>
        <div class="flex-1 space-y-2 py-1">
          <div class="h-4 bg-gray-200 rounded w-3/4"></div>
          <div class="h-3 bg-gray-200 rounded w-1/2"></div>
          <div class="h-3 bg-gray-200 rounded w-1/4"></div>
        </div>
      </div>
      <div class="h-16 bg-gray-100 rounded-xl mb-6"></div>
      <div class="h-10 bg-gray-200 rounded-xl w-full"></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  count: { type: Number, default: 4 }
})
</script>
