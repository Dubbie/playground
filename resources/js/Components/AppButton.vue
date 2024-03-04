<script setup>
import { computed } from "vue";

const props = defineProps({
    color: {
        type: String,
        default: "dark/zinc",
    },
    type: {
        type: String,
        default: "button",
    },
    disabled: {
        type: Boolean,
        default: false,
    },
});

const colorClasses = computed(() => {
    return {
        "dark/zinc": "bg-zinc-900 text-white hover:bg-zinc-700",
    }[props.color];
});

const disabledClasses = computed(() => {
    return props.disabled ? "opacity-50 pointer-events-none" : "";
});
</script>

<template>
    <button
        :type="type"
        class="px-3 py-1.5 rounded-lg text-sm font-semibold"
        :class="[colorClasses, disabledClasses]"
    >
        <slot />
    </button>
</template>
