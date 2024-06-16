<script lang="js" setup>
import { ref } from 'vue';

import ProfileSettingsInput from '@/Components/Profile/ProfileSettingsInput.vue';
import updatePasswordForm from '../Layouts/updatePasswordForm.vue';

const updatePasswordvalue = ref(false)

const updatePassword = (Event) => {
    Event.preventDefault()
    if ($('.modal').hasClass('snow')) return;

    $('.modal-content').append('<div>')
    updatePasswordvalue.value = true
    $('.modal').addClass('show');
}
const closeModal = () => {
    $('.modal').removeClass('show');
    $('.modal-content').empty()
    updatePasswordvalue.value = false
}

</script>

<template>
    <Teleport to='.modal-content div' v-if="updatePasswordvalue">
        <updatePasswordForm @closeModal="closeModal"></updatePasswordForm>
    </Teleport>

    <div class="row">
        <div class="settings">
            <div class="password-setting">
                <a href="" @click="updatePassword($event)">Сменить Пароль &rarr;</a>
            </div>
            <div class="settings__list">
                <ProfileSettingsInput :type="'email'" :type_input="'email'" />
                <ProfileSettingsInput :type="'first_name'" :type_input="'text'" />
                <ProfileSettingsInput :type="'last_name'" :type_input="'text'" />
                <ProfileSettingsInput :type="'nickname'" :type_input="'text'" />
            </div>
        </div>
    </div>
</template>
