<script setup>
import GuestLayout from "../Layouts/GuestLayout.vue";
</script>

<template>
    <GuestLayout title="Index">
        <p>
            Going step by step to achieve fully serverless configuration for a
            simple app.
        </p>

        <ul class="text-sm space-y-3 mt-3">
            <li>
                <label class="flex space-x-2 items-center pointer-events-none">
                    <input type="checkbox" checked />
                    <p>Vue functionality with asset bundling to S3.</p>
                </label>
            </li>
            <li>
                <label class="flex space-x-2 items-center pointer-events-none">
                    <input type="checkbox" checked />
                    <p>Database setup with RDS.</p>
                </label>
            </li>
        </ul>
    </GuestLayout>
</template>
