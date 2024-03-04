<script setup>
import { inject } from "vue";
const files = inject("files");
</script>

<template>
    <div>
        <div v-if="files.length > 0">
            <div v-for="file in files" :key="file.id">
                <p>{{ file.name }}</p>
            </div>
        </div>
        <div v-else>
            <p class="text-sm text-zinc-500">No documents uploaded.</p>
        </div>
    </div>
</template>
