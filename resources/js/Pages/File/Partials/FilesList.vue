<script setup>
import { inject, provide, ref } from "vue";
import FileCard from "@/Components/FileCard.vue";
import DeleteFileModal from "@/Pages/File/Partials/DeleteFileModal.vue";

const files = inject("files");
const showDeleteFileModal = ref(false);
const selectedFile = ref(null);

provide("file", selectedFile);


const handleDelete = (file) => {
    selectedFile.value = file;
    showDeleteFileModal.value = true;
};

const handleClosing = () => {
    showDeleteFileModal.value = false;
    selectedFile.value = null;
};
</script>

<template>
    <div>
        <div v-if="files.length > 0" class="space-y-3">
            <FileCard v-for="file in files" :key="file.id" :file="file" @delete="handleDelete(file)"/>
        </div>
        <div v-else>
            <p class="text-sm text-zinc-500">No documents uploaded.</p>
        </div>

        <DeleteFileModal :show="showDeleteFileModal" @close="handleClosing" />
    </div>
</template>
