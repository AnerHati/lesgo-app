<template>
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div v-for="i in count" :key="'skel-list-'+i" class="flex items-center justify-between p-4 animate-pulse">
      <div class="flex items-center gap-3">
        <div class="w-12 h-12 rounded-full bg-gray-200 shrink-0"></div>
        <div class="space-y-2">
          <div class="h-3 bg-gray-200 rounded w-24"></div>
          <div class="h-2 bg-gray-200 rounded w-16"></div>
        </div>
      </div>
      <div class="h-3 bg-gray-200 rounded w-10"></div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  count: { type: Number, default: 4 }
})
</script>
