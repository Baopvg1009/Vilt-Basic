<script setup>
import { ref } from "vue";

const emit = defineEmits(["image"]);

const props = defineProps({
    listingImage: String,
});
const currentImage = props.listingImage
    ? `/storage/${props.listingImage} `
    : null;

const preview = ref(currentImage);
const oversizedImage = ref(false);
const showReverBtn = ref(false);
const imageSelected = (e) => {
    preview.value = URL.createObjectURL(e.target.files[0]);
    oversizedImage.value = e.target.files[0].size > 3145728;
    showReverBtn.value = true;
    emit("image", e.target.files[0]);
    console.log("Image selected:", e.target.files[0]);
    console.log("Preview URL:", preview.value);
};
const reverImageChage = (e) => {
    showReverBtn.value = false;
    preview.value = currentImage;
    oversizedImage.value = false;
    emit("image", null);
};
</script>

<template>
    <div>
        <span
            class="block text-sm font-medium text-slate-700 dark:text-slate-300"
            :class="{ '!text-red-500': oversizedImage }"
        >
            {{
                oversizedImage
                    ? "The selected image exceeds 3Mb"
                    : "Image (Max size 3Mb)"
            }}
        </span>

        <label
            for="image"
            class="block rounded-md mt-1 bg-slate-300 h-[140px] overflow-hidden cursor-pointer border-slate-300 border relative"
            :class="{ '!border-red-500': oversizedImage }"
        >
            <img
                :src="preview ?? '/storage/images/listing/default.jpg'"
                class="object-cover object-center h-full w-full"
                alt=""
            />
            <button
                @click.prevent="reverImageChage"
                class="absolute top-2 right-2 bg-white/75 w-8 h-8 rounded-full grid place-items-center text-slate-700"
                v-if="showReverBtn"
                type="button"
            >
                <i class="fa-solid fa-rotate-left"></i>
            </button>
        </label>

        <input
            @input="imageSelected"
            type="file"
            name="image"
            id="image"
            hidden
        />
    </div>
</template>
