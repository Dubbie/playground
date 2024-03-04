<script setup>
import { Head, Link } from "@inertiajs/vue3";
const props = defineProps({
    title: {
        type: String,
        default: "Playground",
    },
});
</script>

<template>
    <Head :title="title" />

    <div class="bg-zinc-100 flex justify-between p-4">
        <p class="font-bold">Playground</p>

        <div class="">
            <Link
                :href="route('login')"
                class="font-semibold text-sm px-3 py-1.5 rounded-lg hover:text-zinc-700 hover:bg-zinc-900/5"
                >Login</Link
            >
        </div>
    </div>
    <div class="flex flex-col items-center">
        <div class="max-w-md w-full p-4">
            <slot />
        </div>
    </div>
</template>
