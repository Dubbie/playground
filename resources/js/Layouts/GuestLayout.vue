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

    <div class="bg-white border-b border-zinc-100">
        <div
            class="max-w-3xl space-x-4 px-4 py-3 w-full mx-auto flex justify-between items-center"
        >
            <Link :href="route('index')">
                <p class="font-bold">Playground</p>
            </Link>

            <div class="">
                <Link
                    :href="route('login')"
                    class="block text-sm py-1 font-semibold hover:text-zinc-700 cursor-pointer"
                    ><p>Login</p></Link
                >
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center">
        <div class="max-w-md w-full p-4">
            <slot />
        </div>
    </div>
</template>
