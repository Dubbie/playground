<script setup>
import AppButton from "@/Components/AppButton.vue";
import GuestLayout from "../../Layouts/GuestLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import axios from "axios";
import InputError from "@/Components/InputError.vue";
import { Link, router, useForm } from "@inertiajs/vue3";

const loading = ref(false);
const form = useForm({
    name: "",
    email: "",
    password: "",
});

const handleSubmit = () => {
    loading.value = true;
    axios
        .post(route("register.do"), form.data())
        .then(() => {
            router.get(route("dashboard"));
        })
        .catch((error) => {
            if (error && error.response.status === 422) {
                for (const [key, value] of Object.entries(
                    error.response.data.errors
                )) {
                    form.setError(key, value[0]);
                }
            }
        })
        .finally(() => {
            loading.value = false;
        });
};
</script>

<template>
    <GuestLayout title="Register">
        <div>
            <p class="text-lg font-bold mb-6">Register a new account</p>

            <div class="space-y-3">
                <div>
                    <InputLabel for="name">Name</InputLabel>
                    <TextInput type="text" v-model="form.name" class="w-full" />
                    <InputError :message="form.errors.name" />
                </div>
                <div>
                    <InputLabel for="email">Email address</InputLabel>
                    <TextInput
                        type="email"
                        v-model="form.email"
                        class="w-full"
                    />
                    <InputError :message="form.errors.email" />
                </div>
                <div>
                    <InputLabel for="password">Password</InputLabel>
                    <TextInput
                        type="password"
                        v-model="form.password"
                        class="w-full"
                    />

                    <InputError :message="form.errors.password" />
                </div>
            </div>
            <div class="mt-6 flex flex-col space-y-2">
                <AppButton
                    :disabled="loading"
                    @click="handleSubmit"
                    class="w-full"
                    >Register</AppButton
                >
                <Link
                    :href="route('login')"
                    class="text-sm font-semibold block text-center"
                    >Already have an account?</Link
                >
            </div>
        </div>
    </GuestLayout>
</template>
