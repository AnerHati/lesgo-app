<script setup>
import { onMounted, ref } from 'vue';

defineProps({
    modelValue: {
        type: [String, Number],
        required: true,
    },
    label: String,
    type: {
        type: String,
        default: 'text',
    },
    placeholder: String,
    error: String,
    required: {
        type: Boolean,
        default: false,
    },
});

defineEmits(['update:modelValue']);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <div class="w-full">
        <label v-if="label" class="block text-sm font-bold text-gray-800 mb-2">
            {{ label }} <span v-if="required" class="text-red-500">*</span>
        </label>
        <input
            :type="type"
            :value="modelValue"
            @input="$emit('update:modelValue', $event.target.value)"
            ref="input"
            class="w-full px-4 py-3.5 bg-white border rounded-xl text-sm transition-all outline-none placeholder-gray-400"
            :class="[
                error 
                    ? 'border-red-500 focus:ring-2 focus:ring-red-100' 
                    : 'border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-blue-500'
            ]"
            :placeholder="placeholder"
            :required="required"
        >
        <p v-if="error" class="mt-1.5 text-xs text-red-600 font-medium">
            {{ error }}
        </p>
    </div>
</template>
