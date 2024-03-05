<script setup>
import AppButton from "@/Components/AppButton.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import FilesList from "@/Pages/File/Partials/FilesList.vue";
import UploadDocumentModal from "@/Pages/File/Partials/UploadDocumentModal.vue";
import axios from "axios";
import { ref, onUnmounted, onMounted, provide, inject } from "vue";

const emitter = inject("emitter");
const loading = ref(true);
const files = ref([]);
const showUploadDocumentModal = ref(false);

provide("files", files);

const updateFiles = (newFiles) => {
    files.value = newFiles;
};

const fetchFiles = () => {
    loading.value = true;
    axios
        .get(route("api.file.get"))
        .then((response) => {
            updateFiles(response.data.data);
        })
        .catch((error) => {
            console.log(error.response);
        })
        .finally(() => {
            loading.value = false;
        });
};

onMounted(() => {
    fetchFiles();

    emitter.on("files-updated", updateFiles);
});

onUnmounted(() => {
    emitter.off("files-updated");
});
</script>

<template>
    <AuthLayout title="Documents">
        <div>
            <div class="flex items-start justify-between">
                <p class="text-3xl font-bold">Documents</p>

                <div class="flex space-x-2">
                    <AppButton
                        size="sm"
                        outline
                        @click="showUploadDocumentModal = true"
                        >Upload documents</AppButton
                    >
                </div>
            </div>

            <div class="mt-6">
                <p v-if="loading">Loading available files...</p>
                <div v-else>
                    <FilesList />
                </div>
            </div>
        </div>

        <UploadDocumentModal
            :show="showUploadDocumentModal"
            @close="showUploadDocumentModal = false"
        />
    </Authlayout>
</template>
