<script setup>
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message" class="text-center bg-danger p-2">
        <p class="text-sm text-white my-auto">
            {{ message }}
        </p>
    </div>
</template>
