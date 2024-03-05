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
    outline: {
        type: Boolean,
        default: false,
    },
    plain: {
        type: Boolean,
        default: false,
    },
    size: {
        type: String,
        default: "sm",
    },
    square: {
        type: Boolean,
        default: false,
    },
});

const colorClasses = computed(() => {
    if (props.outline) {
        return {
            "dark/zinc": "ring-1 ring-black/10 hover:bg-black/5",
        }[props.color];
    }

    if (props.plain) {
        return {
            "dark/zinc": "hover:bg-black/5",
        }[props.color];
    }

    return {
        "dark/zinc": "bg-zinc-900 text-white hover:bg-zinc-700",
    }[props.color];
});

const sizeClasses = computed(() => {
    if (props.square) {
        return {
            xs: "p-1",
            sm: "p-2",
        }[props.size];
    }

    return {
        xs: "px-1 py-0.5 text-xs",
        sm: "px-3 py-1.5 text-sm",
        md: "px-4 py-2 text-sm",
    }[props.size];
});

const disabledClasses = computed(() => {
    return props.disabled ? "opacity-50 pointer-events-none" : "";
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center justify-center group/button select-none rounded-lg font-semibold"
        :class="[colorClasses, disabledClasses, sizeClasses]"
    >
        <slot />
    </button>
</template>
