<script lang="jsx" setup>
import { ref, inject, computed } from 'vue';

import ModalCrop from '@/Components/Layouts/ModalCrop.vue'
import ProfileInfoEmail from './ProfileInfoStatus.vue';

const viewModalCrop = ref(false)
const userStore = inject('userStore');
const user = computed(() => userStore.user);

const snowFileInput = () => {
    $("#fileInput").trigger('click');
}
const snowModalCrop = () => {
    if ($('.modal').hasClass('snow')) return;

    $('.modal-content').append('<div>')
    viewModalCrop.value = true
    $('.modal').addClass('show');
}
const updateviewModalCrop = () => {
    viewModalCrop.value = false;
}

</script>
<template>

    <Teleport to=".modal-content div" v-if="viewModalCrop">
        <ModalCrop @updateviewModalCrop="updateviewModalCrop" />
    </Teleport>

    <div class="row">
        <div class="user-settings-info">
            <div class="user-settings-info__left-block">
                <input @change="snowModalCrop" accept=".jpg,.jpeg,.png,.gif" type="file" id="fileInput"
                    autocomplete="off" style="display: none;">
                <div class="user-settings-info__avatar-settings-wrapper user-settings-info__avatar-settings-wrapper_editable"
                    @click="snowFileInput">
                    <a class="user-settings-info__load-photo-btn">
                        <img class="user-settings-info__avatar-image"
                            :src='user.img ? "/storage/src/profile/" + user.img : "/storage/src/profile/plug.png"'
                            data-role="avatar">
                    </a>
                </div>
            </div>
            <div class="user-settings-info__info">
                <div class="user-settings-info__nickname">
                    {{ user.nickname }}
                </div>
                <div class="user-settings-info__fullname">
                    {{ user.first_name + ' ' + user.last_name }}
                </div>
                <!-- <div class="user-settings-info__status">
                    <div class="user-settings-info__status-show">Изменить Статус</div>
                </div> -->
            </div>
            <ProfileInfoEmail v-if="$page.props.user.email_verified_at == null"></ProfileInfoEmail>
            <div class="publish-toggle">
                <a href="/logout" type="button" class="bg-light text-dark button-profile-ui exit">Выход</a>
            </div>
        </div>
    </div>
</template>
