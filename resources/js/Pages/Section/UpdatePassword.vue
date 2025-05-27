<script setup>
import Container from "../../Components/Container.vue";
import Tittle from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import SessionMessages from "../../Components/SessionMessages.vue";

import { useForm } from "@inertiajs/vue3";

const form = useForm({
    current_password: "",
    password: "",
    password_confirmation: "",
});
const submit = () => {
    form.put(route("profile.password"), {
        preserveScroll: true, // Keep the scroll position
        onSuccess: () => form.reset(),
        onError: () => form.reset(),
    });
};
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Tittle>Update Password</Tittle>
            <p>Update your password</p>
        </div>
        <ErrorMessages :errors="form.errors" />
        <form @submit.prevent="submit" class="space-y-6">
            <InputField
                label="Currtent Password"
                icon="key"
                class="w-1/2"
                type="password"
                v-model="form.current_password"
            />
            <InputField
                label="Password"
                icon="key"
                class="w-1/2"
                type="password"
                v-model="form.password"
            />
            <InputField
                label="Confirm New Password"
                icon="key"
                class="w-1/2"
                type="password"
                v-model="form.password_confirmation"
            />

            <p v-if="form.recentlySuccessful" class="text-green-500 text-sm">
                Password updated successfully!
            </p>
            <PrimaryBtn :disabled="form.processing"> Save</PrimaryBtn>
        </form>
    </Container>
</template>
