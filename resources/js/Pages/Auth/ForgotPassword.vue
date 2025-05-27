<script setup>
import Container from "../../Components/Container.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";
import SessionMessages from "../../Components/SessionMessages.vue";
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    email: "",
});

const submit = () => {
    form.post(route("password.email"));
};
defineProps({
    status: String,
});
</script>

<template>
    <Head title="- Forgot password" />
    <Container class="w-1/2">
        <div class="mb-8 text-center">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Quisquam voluptatibus, quibusdam, voluptates, quisquam
                voluptatibus voluptatibus, quibusdam, voluptates, quisquam
                voluptatibus,
            </p>
        </div>

        <!-- Errors messages -->
        <ErrorMessages :errors="form.errors" />
        <SessionMessages :status="status" />
        <form @submit.prevent="submit" class="space-y-6">
            <InputField label="Email" icon="at" v-model="form.email" />

            <PrimaryBtn :disabled="form.processing"
                >Send password reset link!
            </PrimaryBtn>
        </form>
    </Container>
</template>
