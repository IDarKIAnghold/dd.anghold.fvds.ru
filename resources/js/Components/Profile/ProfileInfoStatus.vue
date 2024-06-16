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

</script>
<template>
    <Teleport to=".main" v-if="toastView">
        <Toast :title="toastTitle" :text="toastText" @updateToast_view="updateToast_view"></Toast>
    </Teleport>

    <div class="warning__icon" style="width:18px">
        <i @mouseenter="SnowEmailAcceptBody = true" class="fa-solid fa-circle-exclamation" style="color: #FFD43B;"></i>
    </div>
    <div v-show="SnowEmailAcceptBody" @mouseleave="SnowEmailAcceptBody = false"
        class='border border-warning bg-white warning__body'>
        <span class>
            Ваш адресс электронной почты не подтверждён.
            <a @click="emailSand" class='text-info warning__email-button'>
                Нажмите сюда чтобы подтвердить.
            </a>
        </span>
    </div>
</template>
