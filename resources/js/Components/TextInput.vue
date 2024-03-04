<script setup>
import { onMounted, ref } from "vue";

defineProps({
    modelValue: String | Number,

    invalid: {
        type: Boolean,
        default: false,
    },
});

defineEmits(["update:modelValue"]);

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute("autofocus")) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
    <input
        ref="input"
        class="appearance-none px-3 py-1.5 rounded-lg text-sm bg-zinc-100 text-zinc-900 shadow-none focus:outline-none focus:ring-1 focus:ring-zinc-400"
        :class="{
            'ring-red-500': invalid,
            'ring-white/15 hover:ring-white/25': !invalid,
        }"
        :value="modelValue"
        @input="$emit('update:modelValue', $event.target.value)"
    />
</template>
