<script setup>
defineProps({
    value: String,
});
</script>

<template>
    <label class="block select-none font-medium text-sm/6 text-zinc-600 mb-2">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
