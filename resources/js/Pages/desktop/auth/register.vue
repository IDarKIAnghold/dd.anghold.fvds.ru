<script setup lang="js">
import { Head, router } from '@inertiajs/vue3'
import { reactive } from 'vue';


const registerForm = reactive({
    first_name: null,
    last_name: null,
    email: null,
    password: null,
    password_confirmation: null,
})
const RegisterSubmit = () => {
    router.post(route('user.register'), registerForm)
};

</script>
<template>

    <Head>
        <title>Авторизация</title>
    </Head>

    <div class="form login">
        <div class="frame frame-long">
            <div class="nav">
                <ul>
                    <li class="signup-active">
                        <a class="btn__form" name="Signup">Регистрация</a>
                    </li>
                </ul>
                <div v-if="$page.props.errors.error" id="error_block">
                    <p class='errorText text-center'>
                        {{ $page.props.errors.error_text }}
                    </p>
                </div>
            </div>

            <div class="ng-scope">
                <form class="form-signup" @submit.prevent="RegisterSubmit">
                    <label for="fullname">Имя</label>
                    <input class="form-styling" type="text" name="first_name" id="first_name"
                        v-model="registerForm.first_name" />
                    <label for="fullname">Фамилия</label>
                    <input class="form-styling" type="text" name="last_name" id="last_name"
                        v-model="registerForm.last_name" />
                    <label for="email">Email</label>
                    <input class="form-styling" type="email" name="email" id="email" v-model="registerForm.email" />
                    <label for="password">Пароль</label>
                    <input class="form-styling" type="password" name="password" v-model="registerForm.password" />
                    <label for="password_check">Подтвердите Пароль</label>
                    <input class="form-styling" type="password" name="password_confirmation" id="password_check"
                        v-model="registerForm.password_confirmation" />
                    <button type="submit" id="btn-signup" class="btn btn-primary btn-signup">Зарегистрироваться</button>
                </form>

            </div>
        </div>
    </div>
</template>
<style lang="scss">
.login {
    margin: 0;
    padding: 0;
    z-index: 1;

    .frame {
        border-radius: 20px;
        max-height: 530px;
        width: 430px;
        background-size: cover;
        margin-left: auto;
        margin-right: auto;
        box-shadow: 0px 2px 7px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .frame-long {
        max-height: 800px;
    }

    .nav {
        width: 100%;
        height: 125px;
        opacity: 1;
        margin-top: 45px;

        ul {
            width: 100%;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;

            li {
                font-size: 18px;
                display: inline;
                text-align: left;
                text-transform: uppercase;
            }
        }
    }

    #error_block {
        width: 100%;
        box-sizing: border-box;
    }

    .error {
        border: solid 1px red !important
    }

    .errorText {
        display: block;
        padding: 10px;

        background-color: red;

        font-family: inherit;
        font-size: 16px;
        color: white;
    }


    .signup-active a {
        padding-bottom: 10px;
        text-decoration: none;
        border-bottom: solid 2px #1059FF;
        cursor: pointer;
        color: black;
        user-select: none;
    }


    .form-signin,
    .form-signup {
        width: 430px;
        height: 500px;
        font-weight: 300;
        padding-left: 37px;
        padding-right: 37px;

    }

    .form-signin input:focus,
    .form-signup input:focus {
        outline-style: none;
        box-shadow: none;
        border: 1px solid;
    }

    .form-styling {
        width: 100%;
        height: 35px;
        padding: 8px 10px;
        border-radius: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
    }

    label {
        font-weight: 400;
        text-transform: uppercase;
        padding-left: 15px;
        display: block;
    }

    .btn-signup,
    .btn-signin,
    .btn-resetpass {
        text-decoration: none;
        float: left;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 13px;
        text-align: center;
        color: #ffffff;
        padding-top: 10px;
        width: 100%;
        border: none;
        margin-top: 23px;
        margin-bottom: 10px;
        background-color: #1059FF;
        user-select: none;
    }

    .btn-signup:hover,
    .btn-signin:hover,
    .btn-resetpass:hover {
        text-decoration: none;
        cursor: pointer;
        background-color: #0F4FE6;
        color: #ffffff;
    }
}
</style>
