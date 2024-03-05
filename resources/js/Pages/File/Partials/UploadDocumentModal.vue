<script setup>
import Modal from "@/Components/Modal.vue";
import AppButton from "@/Components/AppButton.vue";
import { inject, ref } from "vue";
import { useForm } from "@inertiajs/vue3";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import FileCard from "@/Components/FileCard.vue";
import AppAlert from "@/Components/AppAlert.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emitter = inject("emitter");
const loading = ref(false);
const serverError = ref(false);
const fileInput = ref(null);
const form = useForm({
    files: [],
});

const handleClick = () => {
    fileInput.value.click();
    form.clearErrors("files");
};

const handleFileChange = (event) => {
    const selectedFiles = event.target.files;

    // Loop through the selected files and add them to the form.files array
    for (let i = 0; i < selectedFiles.length; i++) {
        form.files.push(selectedFiles[i]);
    }
};

const handleDeleteFile = (index) => {
    // Ensure the index is within the valid range
    if (index >= 0 && index < form.files.length) {
        // Remove the file at the specified index
        form.files.splice(index, 1);
    }
};

const handleSubmit = async () => {
    // Create FormData object
    const formData = new FormData();

    // Add each file from form.files to FormData
    form.files.forEach((file) => {
        formData.append("files[]", file);
    });

    try {
        // Send POST request using Axios
        loading.value = true;
        serverError.value = false;
        const response = await axios.post(route("api.file.create"), formData, {
            headers: {
                "Content-Type": "multipart/form-data",
            },
        });

        // Handle the response as needed
        emitter.emit("files-updated", response.data.data);
        emit("close");
    } catch (error) {
        if (error.response && error.response.status === 422) {
            for (const [key, value] of Object.entries(
                error.response.data.errors
            )) {
                form.setError(key, value[0]);
            }
        } else {
            console.error("Error uploading files:", error);
            serverError.value = true;
        }
    }

    loading.value = false;
};

const emit = defineEmits(["close"]);
</script>

<template>
    <Modal :show="show" @close="$emit('close')">
        <div class="p-6">
            <p class="mb-3 text-lg font-semibold">Upload documents</p>
            <p class="text-sm text-zinc-500">
                Please select the files you would like to archive.
            </p>

            <div class="relative mt-6">
                <input
                    type="file"
                    multiple
                    ref="fileInput"
                    class="absolute bottom-0 h-0"
                    @change="handleFileChange"
                />

                <div
                    class="cursor-pointer flex flex-col border rounded-2xl p-3 items-center select-none hover:border-indigo-400"
                    @click="handleClick"
                >
                    <div
                        class="p-2 rounded-xl border shadow shadow-black/5 mb-3"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke-width="1.5"
                            stroke="currentColor"
                            class="w-6 h-6 text-zinc-600"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z"
                            />
                        </svg>
                    </div>

                    <p class="text-sm text-zinc-600 mb-1">
                        <span class="text-indigo-500 font-semibold"
                            >Click here</span
                        >
                        to start browsing your files
                    </p>
                    <p class="text-xs text-zinc-500">(max. 6Mb per file)</p>
                </div>
            </div>

            <div class="space-y-3 mt-3" v-if="form.files.length > 0">
                <FileCard v-for="(file, index) in form.files" :key="index" :file="file" @delete="handleDeleteFile(index)" />
            </div>

            <InputError :message="form.errors.files" class="mt-2" />

            <AppAlert class="mt-2" type="error" v-if="serverError">
                An error occurred while uploading the files. Please try again
                later.
            </AppAlert>

            <div class="mt-6 flex space-x-2 justify-end">
                <AppButton plain @click="$emit('close')">Close</AppButton>
                <AppButton @click="handleSubmit" :disabled="loading"
                    >Upload documents</AppButton
                >
            </div>
        </div>
    </Modal>
</template>
