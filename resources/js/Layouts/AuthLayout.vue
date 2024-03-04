<script setup>
import { Head, router } from "@inertiajs/vue3";
const props = defineProps({
    title: {
        type: String,
        default: "Playground",
    },
});

const handleLogout = () => {
    router.post(route("logout"));
};
</script>

<template>
    <Head :title="title" />

    <div class="bg-zinc-100 flex justify-between p-4">
        <p class="font-bold">Playground</p>

        <div class="">
            <p
                class="text-sm font-semibold hover:text-zinc-700 cursor-pointer"
                @click="handleLogout"
            >
                Logout
            </p>
        </div>
    </div>
    <div class="flex flex-col items-center">
        <div class="max-w-md w-full p-4">
            <slot />
        </div>
    </div>
</template>
