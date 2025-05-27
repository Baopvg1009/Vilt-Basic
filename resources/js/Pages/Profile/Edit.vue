<script setup>
import DeleteAccount from "../Section/DeleteAccount.vue";
import UpdateInfo from "../Section/UpdateInfo.vue";
import UpdatePassword from "../Section/UpdatePassword.vue";

defineProps({
    user: Object,
    status: String,
});
</script>
<template>
    <Head title="- Upadate Profile" />
    <UpdateInfo :user="user" :status="status" />
    <UpdatePassword />
    <DeleteAccount />
</template>
