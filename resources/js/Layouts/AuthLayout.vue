<script setup>
import NavLink from "@/Components/NavLink.vue";
import { Head, Link, router } from "@inertiajs/vue3";
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

    <div class="bg-white border-b border-zinc-100">
        <div
            class="max-w-3xl space-x-6 px-4 py-3 w-full mx-auto flex justify-between items-center"
        >
            <Link :href="route('dashboard')">
                <p class="font-bold">Playground</p>
            </Link>

            <div class="flex-1 flex space-x-2">
                <NavLink
                    :href="route('file.index')"
                    :active="route().current('file*')"
                    >Documents</NavLink
                >
            </div>

            <div class="">
                <p
                    class="text-sm py-1 font-semibold hover:text-zinc-700 cursor-pointer"
                    @click="handleLogout"
                >
                    Logout
                </p>
            </div>
        </div>
    </div>
    <div class="flex flex-col items-center">
        <div class="max-w-3xl w-full p-4">
            <slot />
        </div>
    </div>
</template>
