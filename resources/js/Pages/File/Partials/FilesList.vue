<script setup>
import { inject, provide, ref } from "vue";
import FileCard from "@/Components/FileCard.vue";
import DeleteFileModal from "@/Pages/File/Partials/DeleteFileModal.vue";
import AppButton from "@/Components/AppButton.vue";
import { IconSearch } from "@tabler/icons-vue";
import { IconUpload } from "@tabler/icons-vue";

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

const emit = defineEmits(["open-upload-modal"]);
</script>

<template>
    <div>
        <div v-if="files.length > 0" class="space-y-3">
            <FileCard
                v-for="file in files"
                :key="file.id"
                :file="file"
                @delete="handleDelete(file)"
            />
        </div>
        <div v-else class="flex flex-col items-center mt-12">
            <div
                class="p-3 mb-3 bg-white shadow-lg shadow-black/5 border border-zinc-200 rounded-2xl"
            >
                <IconSearch :size="24" class="text-zinc-500" />
            </div>

            <p class="text-zinc-900 font-semibold">No documents found</p>
            <p class="text-zinc-500 text-sm">
                You have not uploaded any documents yet.
            </p>

            <div class="mt-6">
                <AppButton size="sm" @click="$emit('open-upload-modal')">
                    <IconUpload :size="16" class="mr-2" />
                    <p>Upload documents</p>
                </AppButton>
            </div>
        </div>

        <DeleteFileModal :show="showDeleteFileModal" @close="handleClosing" />
    </div>
</template>
