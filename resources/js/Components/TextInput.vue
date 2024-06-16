<script setup>
import { onMounted, ref } from 'vue';

const model = defineModel({
    type: String,
    required: true,
});

const input = ref(null);

onMounted(() => {
    if (input.value.hasAttribute('autofocus')) {
        input.value.focus();
    }
});

defineExpose({ focus: () => input.value.focus() });
</script>
<template>
        <input class="input-row__container" v-model="model" ref="input" />
</template>
<style lang="scss">
.input-row__container {
    background: #fff;
    border: 1px solid #e5e5e5;
    border-radius: 8px;

    box-sizing: border-box;

    display: inline-block;
    overflow: hidden;
    position: relative;
    width: 100%;
    height: 48px;
    padding: 0 10px 0 10px;

    line-height: inherit;
    font-weight: 700;
    font-size: 16px;
    font-family: inherit;
    z-index: 0;
    color: #4e4e4e;
}
</style>
