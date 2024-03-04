<script setup>
import { ref } from "vue";
const showDiv = ref(false);
</script>

<template>
    <div class="p-12">
        <h1 class="text-xl font-semibold mb-6">Playground</h1>

        <p>Currently testing if I can get Vue to work with Bref.</p>

        <div class="mt-3">
            <div class="flex">
                <p
                    @click="showDiv = !showDiv"
                    class="cursor-pointer text-sm font-semibold px-3 py-1.5 border rounded-xl hover:bg-zinc-50"
                >
                    Button
                </p>
            </div>
            <div v-if="showDiv" class="mt-4 p-4 bg-black text-white">
                We work!
            </div>
        </div>
    </div>
</template>
