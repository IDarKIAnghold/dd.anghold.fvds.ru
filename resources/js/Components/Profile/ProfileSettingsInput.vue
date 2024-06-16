<script setup lang="jsx">
import { ref, inject, computed, defineProps } from 'vue';
import axios from 'axios';

const props = defineProps({
    type: String,
    type_input: String
})

const inputName = ref('')
const errorMessage = ref('');
const showConfirmBtnContainer = ref(false);
const userStore = inject('userStore')
const user = computed(() => userStore.user);

switch (props.type) {
    case 'email':
        inputName.value = 'Email'
        break;
    case 'first_name':
        inputName.value = 'Имя'
        break;
    case 'last_name':
        inputName.value = 'Фамилия'
        break;
    case 'nickname':
        inputName.value = 'Nickname'
        break;
}

const handleFocus = (event) => {
    showConfirmBtnContainer.value = true;
    $(event.target).closest('.personal-info-confirm-container').find('.input-row__container').addClass('input-row__container_filled');
};
const handleUnFocus = (event) => {
    if (event.target.value == '') {
        $(event.target).closest('.personal-info-confirm-container').find('.input-row__container').removeClass('input-row__container_filled');
    }
}
const handleCancel = (event, user_select) => {
    showConfirmBtnContainer.value = false;
    errorMessage.value = ''
    if (!user_select) {
        $(event.target).closest('.personal-info-confirm-container').find('.input-row__container').removeClass('input-row__container_filled');
    }
};

const handleSubmit = () => {
    errorMessage.value = ''
    const formData = new FormData();
    formData.append(props.type, $('#ir-' + props.type).val());
    let old = $('#ir-' + props.type).val()
    axios.post(route('update', { type: props.type }), formData, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            if (response.data.error == 'NotEmail') {
                errorMessage.value = 'Указана не почта'
                $('#ir-' + props.type).val(old)
                return
            }
            if (response.data.error == 'Uses') {
                errorMessage.value = 'Данный адресс ' + props.type + ' занят'
                $('#ir-' + props.type).val(old)
                return
            }
            if (response.data.error == 'LongString') {
                errorMessage.value = 'Это поле не может быть пустым'
                $('#ir-' + props.type).val(old)
                return
            }
            userStore.user[props.type] = $('#ir-' + props.type).val();
            showConfirmBtnContainer.value = false;
        })
        .catch(error => {
            errorMessage.value = 'Error updating ' + inputName.value + ': ' + error;
            console.log('Error updating ' + inputName.value + ': ', error);
        });
};
</script>
<template>
    <div class="personal-info-confirm-container">

        <div v-show="errorMessage != ''" class="input-row__error">
            <div class="input-row__error-message">{{ errorMessage }}</div>
        </div>

        <div class="input-row">
            <div class="input-row__container" :class="{ 'input-row__container_filled': user[props.type] }">
                <input :type="type_input" class="input-row__input" :id="'ir-' + props.type" :value="user[props.type]"
                    @focus="handleFocus($event)" @blur="handleUnFocus($event)">
                <label for="ir-email" class="input-row__label">{{ inputName }}</label>
            </div>
        </div>

        <div v-show="showConfirmBtnContainer" class="personal-info-confirm-container__confirm-btn-container">
            <button class="personal-info-confirm-container__btn ns-btn btn-info"
                @click="handleSubmit">Подтвердить</button>
            <button class="personal-info-confirm-container__btn-cancel ns-btn"
                @click="handleCancel($event, user[props.type])">Отмена</button>
        </div>
    </div>
</template>
<style lang="scss">
.personal-info-confirm-container {
    .input-row {
        line-height: 1.42857;
        margin-bottom: 20px;
        max-width: 300px;
        visibility: visible !important;
        width: 100%;
    }

    .input-row__container {
        background: #fff;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        box-sizing: border-box;
        display: inline-block;
        height: 64px;
        overflow: hidden;
        position: relative;
        width: 100%;
        z-index: 0;
    }

    .input-row__placeholder {
        color: #d9d9d9;
        font-size: 16px;
        font-weight: 700;
        left: 20px;
        position: absolute;
        top: 29px;
        z-index: 9;
    }

    .input-row__input {
        background: transparent;
        border: none;
        box-sizing: border-box;
        color: #4e4e4e;
        font-family: inherit;
        font-size: 16px;
        font-weight: 700;
        height: 100%;
        left: 0;
        line-height: inherit;
        outline: none;
        padding: 18px 0 0 20px;
        position: absolute;
        top: 0;
        width: 100%;
        z-index: 9;
    }

    .input-row__label {
        color: #8c8c8c;
        font-size: 16px;
        left: 0;
        letter-spacing: .3px;
        padding: 0 20px;
        pointer-events: none;
        position: absolute;
        top: 20px;
        transition: top .2s, font-size .2s;
        z-index: 10;
    }

    .input-row__container_filled .input-row__label {
        font-size: 14px;
        top: 5px;
    }

    .input-row__placeholder span {
        color: transparent;
    }
}
</style>
