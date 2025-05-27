<script setup>
import Container from "../../Components/Container.vue";
import Tittle from "../../Components/Title.vue";
import InputField from "../../Components/InputField.vue";
import PrimaryBtn from "../../Components/PrimaryBtn.vue";
import ErrorMessages from "../../Components/ErrorMessages.vue";

import { useForm } from "@inertiajs/vue3";
import { ref } from "vue";

const form = useForm({
    password: "",
});

const showConfirmaPassword = ref(false);
const submit = () => {
    form.delete(route("profile.destroy"), {
        onFinish: () => form.reset(),
        preserveScroll: true,
    });
};
</script>

<template>
    <Container class="mb-6">
        <div class="mb-6">
            <Tittle>Delete Account</Tittle>
            <p>Delete account</p>
        </div>
        <ErrorMessages :errors="form.errors" />
        <div v-if="showConfirmaPassword">
            <form @submit.prevent="submit" class="flex items-end gap-4">
                <InputField
                    label="Confirm Password"
                    icon="key"
                    class="w-1/2"
                    type="password"
                    v-model="form.password"
                />
                <PrimaryBtn :disabled="form.processing"> Confirm</PrimaryBtn>

                <!-- <button
                    @click="showConfirmaPassword = false"
                    class="text-indigo-500 px-4 font-medium underline dark:text-indigo-400"
                >
                    Cancel
                </button> -->
                <PrimaryBtn @click="showConfirmaPassword = false">
                    Cancel</PrimaryBtn
                >
            </form>
        </div>

        <button
            v-if="!showConfirmaPassword"
            @click="showConfirmaPassword = true"
            class="px-6 py-2 rounded-lg bg-red-500 text-white"
        >
            <i class="fa-solid fa-triangle-exclamation mr-2">
                Delete Account
            </i>
        </button>
    </Container>
</template>
