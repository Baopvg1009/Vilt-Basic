<script setup>
import { useForm } from "@inertiajs/vue3";
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import TextLink from "../../Components/TextLink.vue";
import Title from "../../Components/Title.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
const form = useForm({
    name: "",
    email: "",
    password: "",
    password_confirmation: "",
});

const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};
</script>

<template>
    <Head title="- Register" />
    <Container>
        <div class="mb-8 text-center">
            <Title>Register a new account</Title>
            <p>
                Already have account?
                <TextLink routeName="login" label="Login" />
            </p>
        </div>
        <!-- Error message -->
        <ErrorMessages :errors="form.errors" class="mb-4" />
        <form @submit.prevent="submit" class="space-y-6">
            <InputField
                label="Name"
                icon="id-badge"
                placeholder="Name"
                v-model="form.name"
            />
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
            <p class="text-slate-500 text-sm dark:text-slate-400">
                By creating an account, you argree to our Terms of Service and
                Privacy Policy.
            </p>
            <PrimaryBtn :disabled="form.processing">Register</PrimaryBtn>
        </form>
    </Container>
</template>
