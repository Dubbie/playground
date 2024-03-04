<script setup>
import AppButton from "@/Components/AppButton.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import FilesList from "@/Pages/File/Partials/FilesList.vue";
import UploadDocumentModal from "@/Pages/File/Partials/UploadDocumentModal.vue";
import axios from "axios";
import { ref, onMounted, provide } from "vue";

const loading = ref(true);
const files = ref([]);
const showUploadDocumentModal = ref(false);

provide("files", files.value);

const updateFiles = () => {
    console.log("Grabbing files from API");
    loading.value = true;
    axios
        .get(route("api.file.get"))
        .then((response) => {
            console.log(response);
        })
        .catch((error) => {
            console.log(error.response);
        })
        .finally(() => {
            loading.value = false;
        });
};

onMounted(() => {
    updateFiles();
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
    </AuthLayout>
</template>
