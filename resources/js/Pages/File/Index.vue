<script setup>
import AppButton from "@/Components/AppButton.vue";
import AuthLayout from "@/Layouts/AuthLayout.vue";
import FilesList from "@/Pages/File/Partials/FilesList.vue";
import UploadDocumentModal from "@/Pages/File/Partials/UploadDocumentModal.vue";
import FilesLoading from "@/Pages/File/Partials/FilesLoading.vue";
import axios from "axios";
import { ref, onUnmounted, onMounted, provide, inject } from "vue";
import { IconUpload } from "@tabler/icons-vue";

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
                    >
                        <IconUpload :size="16" class="mr-2" />
                        <p>Upload documents</p>
                    </AppButton>
                </div>
            </div>

            <div class="mt-6">
                <transition
                    enter-active-class="transition ease-out duration-300"
                    enter-from-class="transform opacity-0 translate-y-2"
                    enter-to-class="transform opacity-100 translate-y-0"
                    leave-active-class="transition ease-in duration-200"
                    leave-from-class="transform opacity-100 translate-y-0"
                    leave-to-class="transform opacity-0 translate-y-2"
                    mode="out-in"
                >
                    <FilesLoading v-if="loading" />
                    <div v-else>
                        <FilesList
                            @open-upload-modal="showUploadDocumentModal = true"
                        />
                    </div>
                </transition>
            </div>
        </div>

        <UploadDocumentModal
            :show="showUploadDocumentModal"
            @close="showUploadDocumentModal = false"
        />
    </AuthLayout>
</template>
