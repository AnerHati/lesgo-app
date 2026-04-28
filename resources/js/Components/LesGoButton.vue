<script setup>
defineProps({
    type: {
        type: String,
        default: 'submit',
    },
    variant: {
        type: String,
        default: 'primary', // primary, secondary, danger, warning, ghost
    },
    processing: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <button
        :type="type"
        :disabled="processing"
        class="inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-xl font-bold text-sm transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transform active:scale-95"
        :class="{
            'bg-blue-600 text-white hover:bg-blue-700 shadow-md shadow-blue-200 focus:ring-blue-500': variant === 'primary',
            'bg-green-600 text-white hover:bg-green-700 shadow-md shadow-green-200 focus:ring-green-500': variant === 'secondary',
            'bg-white text-gray-700 border-gray-200 hover:bg-gray-50 focus:ring-gray-200': variant === 'ghost',
            'bg-red-600 text-white hover:bg-red-700 shadow-md shadow-red-200 focus:ring-red-500': variant === 'danger',
            'bg-yellow-400 text-white hover:bg-yellow-500 shadow-md shadow-yellow-200 focus:ring-yellow-500': variant === 'warning',
        }"
    >
        <svg v-if="processing" class="animate-spin -ml-1 mr-3 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <slot />
    </button>
</template>
