<script setup>
import AppButton from "@/Components/AppButton.vue";
import { IconDownload, IconX } from "@tabler/icons-vue";
import FileIcon from "@/Components/FileIcon.vue";

const props = defineProps({
    file: {
        type: Object,
        required: true,
    },
});

const formatFileSize = (sizeInBytes) => {
    const units = ["B", "KB", "MB", "GB", "TB"];

    let size = sizeInBytes;
    let unitIndex = 0;

    while (size >= 1024 && unitIndex < units.length - 1) {
        size /= 1024;
        unitIndex++;
    }

    return `${size.toFixed(1)} ${units[unitIndex]}`;
};

const emit = defineEmits(["delete"]);
</script>

<template>
    <div class="border p-3 rounded-xl">
        <div class="flex items-center justify-between space-x-3">
            <FileIcon :file="file" />
            <div class="flex-1">
                <p class="text-sm font-bold">{{ file.name }}</p>
                <p class="text-xs text-zinc-500">{{ formatFileSize(file.size) }}</p>
            </div>
            <div class="flex space-x-1 items-center">
<a :href="file.download_link" download="true" target="_blank" v-if="file.download_link">
                    <AppButton plain square size="xs">
                        <IconDownload
                            class="text-zinc-400 group-hover/button:text-zinc-700 size-5"
                        />
                    </AppButton>
                </a>
                <AppButton plain square size="xs" @click="$emit('delete')">
                    <IconX
                        class="text-zinc-400 group-hover/button:text-zinc-700 size-5"
                    />
                </AppButton>
            </div>
        </div>
    </div>
</template>
