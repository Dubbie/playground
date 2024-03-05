<script setup>
import AppButton from "@/Components/AppButton.vue";
import GuestLayout from "../../Layouts/GuestLayout.vue";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import { ref } from "vue";
import { Link, router, useForm } from "@inertiajs/vue3";
import InputError from "@/Components/InputError.vue";

const loading = ref(false);
const form = useForm({
    email: "",
    password: "",
});

const handleSubmit = () => {
    loading.value = true;
    axios
        .post(route("login.do"), form.data())
        .then(() => {
            console.log("Logged in!");
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

            if (error.response && error.response.status === 400) {
                form.setError(
                    "email",
                    "Failed to log in using your credentials."
                );
            }
        })
        .finally(() => {
            loading.value = false;
        });
};
</script>

<template>
    <GuestLayout title="Login">
        <div>
            <p class="text-lg font-bold mb-6">Sign in to your account</p>

            <div class="space-y-3">
                <div>
                    <InputLabel for="email">Email address</InputLabel>
                    <TextInput
                        type="email"
                        v-model="form.email"
                        class="w-full"
                        @keyup="form.clearErrors('email')"
                    />

                    <InputError :message="form.errors.email" />
                </div>
                <div>
                    <InputLabel for="password">Password</InputLabel>
                    <TextInput
                        type="password"
                        v-model="form.password"
                        class="w-full"
                        @keyup="form.clearErrors('password')"
                        @keydown.enter="handleSubmit"
                    />

                    <InputError :message="form.errors.password" />
                </div>
            </div>
            <div class="mt-6 flex flex-col space-y-2">
                <AppButton
                    class="w-full"
                    @click="handleSubmit"
                    :disabled="loading"
                    >Login</AppButton
                >
                <Link
                    :href="route('register')"
                    class="text-sm font-semibold block text-center"
                    >Don't have an account yet?</Link
                >
            </div>
        </div>
    </GuestLayout>
</template>
