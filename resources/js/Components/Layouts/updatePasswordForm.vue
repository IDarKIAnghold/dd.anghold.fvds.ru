<script lang="jsx" setup>
import { useForm } from '@inertiajs/vue3';
import { ref, defineEmits } from 'vue';

import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';

const passwordInput = ref(null);
const currentPasswordInput = ref(null);

const emits = defineEmits(['closeModal']);

const form = useForm({
    current_password: '',
    password: '',
    password_confirmation: '',
});

const updatePassword = () => {
    form.post(route('passwordUpdate'), {
        preserveScroll: true,
        onError: () => {
            if (form.errors.error_code == 'passwordIncorrect') {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.error_code == 'oldPassword') {
                form.reset('password', 'password_confirmation');
                passwordInput.value.focus();
            }
            if (form.errors.error_code == 'PasswordMismatch') {
                form.reset('password_confirmation');
                currentPasswordInput.value.focus();
            }
        },
    });
};

const CloseModal = (event) => {
    emits('closeModal');
}
</script>

<template>
    <section>
        <div class="modal-header p-0">
            <h2 class="text-lg font-medium text-gray">Изменить Пароль</h2>
            <button type="button" class="btn btn-close m-0 p-2" @click="CloseModal($event)"></button>
        </div>

        <form @submit.prevent="updatePassword" class="mt-6 space-y-6">
            <InputError v-if="form.errors.error_code == 'emptyInput' || form.errors.error_code == 'oldPassword'"
                :message="form.errors.error_text" class="mt-2" />
            <div>
                <InputLabel for="current_password" value="Текущий Пароль" />

                <TextInput id="current_password" ref="currentPasswordInput" v-model="form.current_password"
                    type="password" class="mt-1 block w-full" autocomplete="current-password" />

                <InputError v-if="form.errors.error_code == 'passwordIncorrect'" :message="form.errors.error_text"
                    class="mt-2" />
            </div>

            <div>
                <InputLabel for="password" value="Новый Пароль" />

                <TextInput id="password" ref="passwordInput" v-model="form.password" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" />

                <InputError v-if="form.errors.error_code == 'Passwordmismatch'" :message="form.errors.error_text"
                    class="mt-2" />
            </div>

            <div>
                <InputLabel for="password_confirmation" value="Повторите Пароль" />

                <TextInput id="password_confirmation" v-model="form.password_confirmation" type="password"
                    class="mt-1 block w-full" autocomplete="new-password" />

                <InputError v-if="form.errors.error_code == 'Passwordmismatch'" :message="form.errors.error_text"
                    class="mt-2" />
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Сохранить</PrimaryButton>

                <Transition>
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Пароль сохранён.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
<style lang="scss">
    @media screen and (max-width: 768px) {
        .modal-content{
            width: 100%;
            min-width: 100%;
            max-width: 100%;
        }
    }
section {
    form div {
        display: grid;
        grid-template-columns: 1fr;
        margin: 5px 0;
    }
}
</style>
