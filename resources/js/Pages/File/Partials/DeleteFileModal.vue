<script setup>
import { ref, inject } from "vue";
import Modal from "@/Components/Modal.vue";
import AppButton from "@/Components/AppButton.vue";
import AppAlert from "@/Components/AppAlert.vue";

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const emitter = inject("emitter");
const file = inject("file");
const loading = ref(false);
const serverError = ref(false);
const emit = defineEmits(["close"]);

const handleSubmit = () => {
    // Handle form submission
    loading.value = true;
    serverError.value = false;

    axios
        .delete(route('api.file.destroy', file.value.id))
        .then(response => {
            emitter.emit("files-updated", response.data.data);
            emit("close");
        })
        .catch(() => {
            serverError.value = true;
        })
        .finally(() => {
            loading.value = false;
        });
};
</script>

<template>
    <Modal :show="show" max-width="sm" @close="emit('close')">
        <div class="p-6">
            <p class="font-semibold mb-3 text-lg">Delete file</p>

            <p class="mb-3 text-zinc-500 text-sm">Are you sure you want to delete this file?<br/>This action is not reversible.</p>

            <p class="font-semibold text-sm" :class="{
                'text-zinc-300': !file,
                'text-zinc-900': file,
            }">{{ file?.name ?? "No file selected" }}</p>

            <AppAlert type="error" v-if="serverError" class="mt-3">An error occurred while deleting the file.</AppAlert>

            <div class="mt-6 flex justify-end space-x-2">
                <AppButton plain @click="emit('close')">Cancel</AppButton>

                <AppButton @click="handleSubmit" :loading="loading" :disabled="loading">Delete file</AppButton>
            </div>
        </div>
    </Modal>
</template>
