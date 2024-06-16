<script setup lang="js">
import { Head, router, Link } from '@inertiajs/vue3'
import { reactive } from 'vue';

const loginForm = reactive({
    email: null,
    password: null,
})
const LoginSubmit = () => {
    router.post(route('user.login'), loginForm)
};

</script>
<template>
    <Head>
        <title>Авторизация</title>
    </Head>
    <div class="form login">
        <div class="frame">
            <div class="nav">
                <ul>
                    <li class="signin-active">
                        <a class="btn__form" name="Signin">Авторизация</a>
                    </li>
                </ul>
                <div v-if="$page.props.errors.error" id="error_block">
                    <p class='errorText text-center'>
                        {{ $page.props.errors.error_text }}
                    </p>
                </div>
            </div>

            <div class="ng-scope">
                <form class="form-signin" @submit.prevent="LoginSubmit">
                    <label for="email">Email</label>
                    <input class="form-styling" type="text" name="email" id="email-signin" v-model="loginForm.email" />
                    <label for="password">Пароль</label>
                    <input class="form-styling" type="password" name="password" v-model="loginForm.password" />
                    <button type="submit" id="btn-signin" class="btn btn-primary btn-signin">Авторизация</button>
                    <span>Не помните пароль?
                        <Link href="">Восстановить.</Link>
                    </span>
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


    .signin-active a,
    .signup-active a,
    .password-reset a {
        padding-bottom: 10px;
        text-decoration: none;
        border-bottom: solid 2px #1059FF;
        cursor: pointer;
        color: black;
        user-select: none;
    }

    .signin-inactive a,
    .sinup-inactive a {
        color: #ccc;
        text-decoration: none;
        cursor: pointer;
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
