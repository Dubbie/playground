<script setup>
import { computed, defineProps } from "vue";

const props = defineProps({
    type: {
        type: String,
        default: "info",
    },
});

const alertClasses = computed(() => {
    return {
        info: "bg-blue-100 text-blue-800",
        success: "bg-green-100 text-green-800",
        warning: "bg-yellow-100 text-yellow-800",
        error: "bg-red-100 text-red-800",
    }[props.type];
});
</script>

<template>
    <div class="p-3 text-sm rounded-xl" :class="alertClasses">
        <slot />
    </div>
</template>
