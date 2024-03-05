<script setup>
import { IconFile } from "@tabler/icons-vue";
import { computed, defineProps } from "vue";

const props = defineProps({
    file: {
        type: Object,
        required: true,
    },
});

const extensionBgClass = computed(() => {
    const colors = {
        "application/pdf": "bg-red-500",
        "application/msword": "bg-blue-500",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            "bg-blue-500",
        "application/vnd.ms-excel": "bg-green-500",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            "bg-green-500",
        "application/vnd.ms-powerpoint": "bg-yellow-500",
        "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            "bg-yellow-500",
        "image/jpeg": "bg-pink-500",
        "image/png": "bg-pink-500",
        "image/gif": "bg-pink-500",
        default: "bg-gray-500",
    };

    return colors[props.file.type] || colors.default;
});

const extension = computed(() => {
    const extensions = {
        "application/pdf": "pdf",
        "application/msword": "doc",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
            "docx",
        "application/vnd.ms-excel": "xls",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
            "xlsx",
        "application/vnd.ms-powerpoint": "ppt",
        "application/vnd.openxmlformats-officedocument.presentationml.presentation":
            "pptx",
        "image/jpeg": "jpg",
        "image/png": "png",
        "image/gif": "gif",
    };

    return extensions[props.file.type] || "default";
});
</script>

<template>
    <div class="relative">
        <div>
            <IconFile class="text-zinc-300" size="48" :stroke-width="1" />
        </div>
        <p
            class="absolute bottom-2.5 left-1 text-xs font-bold text-[11px] rounded text-white leading-none px-1 uppercase py-0.5"
            :class="extensionBgClass"
        >
            {{ extension }}
        </p>
    </div>
</template>
