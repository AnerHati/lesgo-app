<template>
  <slot v-if="!error" />
  <div v-else class="bg-red-50 border border-red-200 rounded-2xl p-8 text-center">
    <span class="text-5xl mb-4 block">⚠️</span>
    <h3 class="text-lg font-bold text-red-800 mb-2">Terjadi Kesalahan</h3>
    <p class="text-sm text-red-600 font-medium mb-4">{{ error.message || 'Komponen ini mengalami error. Silakan coba lagi.' }}</p>
    <button
      @click="resetError"
      class="bg-red-600 text-white px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-red-700 transition shadow-sm"
    >
      Coba Lagi
    </button>
  </div>
</template>

<script setup>
import { ref, onErrorCaptured } from 'vue'

const error = ref(null)

onErrorCaptured((err, instance, info) => {
  console.error('ErrorBoundary caught:', err, info)
  error.value = err
  return false // Prevent the error from propagating further
})

function resetError() {
  error.value = null
}
</script>
