<script lang="jsx">
export default {
    props: {
        title: String,
        text: String
    },
    methods: {
        CloseToast(event) {
            this.$emit('updateToast_view')
            $('.toast-container').remove()
        }
    }
}
</script>
<template>
    <div class="toast-container">
        <div class="toast-header">
            <strong class="me-auto">{{ title }}</strong>
            <button type="button" class="btn btn-close m-0 p-2" @click="CloseToast($event)"></button>
        </div>
        <div class="toast-body">
            {{ text }}
        </div>
        <div class="toast-footer"></div>
    </div>
</template>
<style lang="scss">
.toast-container {
    background: #fff;
    z-index: 1000;
    padding: 0.5rem 0.75rem;
    
    position: fixed;
    right:0%;
    top: 1%;

    font-size: 0.875rem;
    max-width: 100%;

    border: 1px solid gray;
    border-radius: 8px;
    pointer-events: all;

    div {
        padding: 0;
        margin: 0;
    }

    .toast-header {
        display: flex;

        button {
            float: left;
        }
    }
}
</style>
