<script setup>
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    href: {
        type: String,
        required: true,
    },
    active: {
        type: Boolean,
        default: false,
    },
});
</script>

<template>
    <Link
        :href="href"
        class="text-sm font-medium px-2 py-1 rounded-lg inline-flex"
        :class="{
            'bg-zinc-100': active,
            'hover:bg-zinc-50': !active,
        }"
    >
        <slot />
    </Link>
</template>
