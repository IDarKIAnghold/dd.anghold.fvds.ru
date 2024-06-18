<script lang="jsx" setup>
import { ref } from 'vue';
import axios from 'axios';

import Toast from '@/Components/Layouts/Toast.vue';

const SnowEmailAcceptBody = ref(false)
const toastView = ref(false)
const toastTitle = ref('')
const toastText = ref('')

const emailSand = () => {
    axios.post(route('verification.verifyEmailSend'))
        .then(function (response) {
            toastText.value = response.data.message;
            toastView.value = true;
            console.log(response);
        })
        .catch(function (error) {
            console.log(error);
        });


}
const updateToast_view = () => {
    toastView.value = false;
}

const funSnowEmailAcceptBody = () => {
    SnowEmailAcceptBody.value = !SnowEmailAcceptBody.value
}

</script>
<template>
    <Teleport to=".main" v-if="toastView">
        <Toast :title="toastTitle" :text="toastText" @updateToast_view="updateToast_view"></Toast>
    </Teleport>

    <div class="warning__icon">
        <i @click="funSnowEmailAcceptBody" class="fa-solid fa-circle-exclamation"></i>
    </div>
    <div v-show="SnowEmailAcceptBody" class='border border-warning bg-white warning__body'>
        <span class>
            Ваш адресс электронной почты не подтверждён.
            <a v-on:click="emailSand" class='text-info warning__email-button'>
                Нажмите сюда чтобы подтвердить.
            </a>
        </span>
    </div>
</template>
<style lang="scss">
.warning__icon {
    width: 28px;
    height: 28px;
    margin: 3% 0 3% 5%;

    i.fa-solid.fa-circle-exclamation {
        color: #FFD43B;
        font-size: 24px;
    }
}
</style>