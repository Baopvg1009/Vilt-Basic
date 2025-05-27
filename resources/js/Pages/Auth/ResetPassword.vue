<script setup>
import { useForm } from "@inertiajs/vue3";
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import Title from "../../Components/Title.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";

const props = defineProps({
    token: String,
    email: String,
});
const form = useForm({
    token: props.token,
    email: props.email,
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("password.update"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="- Reset password" />
    <Container>
        <div class="mb-8 text-center">
            <Title>Enter a new password</Title>
        </div>
        <!-- Error message -->
        <ErrorMessages :errors="form.errors" class="mb-4" />
        <form @submit.prevent="submit" class="space-y-6">
            <InputField
                label="Email"
                icon="at"
                placeholder="Email"
                type="email"
                v-model="form.email"
            />
            <InputField
                label="Password"
                icon="key"
                placeholder="Password"
                type="password"
                v-model="form.password"
            />
            <InputField
                label="Confirm Password"
                icon="key"
                placeholder="Confirm Password"
                type="password"
                v-model="form.password_confirmation"
            />

            <PrimaryBtn :disabled="form.processing">Reset Password</PrimaryBtn>
        </form>
    </Container>
</template>
