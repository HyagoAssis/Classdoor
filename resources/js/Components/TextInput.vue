<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        class="tw-border-gray-300 focus:tw-border-indigo-500 focus:tw-ring-indigo-500 tw-rounded-md tw-shadow-sm"
        v-model="model"
        ref="input"
    />
</template>
