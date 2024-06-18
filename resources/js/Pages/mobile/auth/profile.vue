<script setup lang="jsx">
import { ref, onMounted, provide } from 'vue';
import { Head, usePage, Link } from '@inertiajs/vue3';
import { useUserStore } from '@/stores/userStore';


import ProfileInfo from '@/Components/Profile/ProfileInfo.vue';
import ProfileSettings from '@/Components/Profile/ProfileSettings.vue';

const toggleSettings = ref('settings');
const userStore = useUserStore();
const page = usePage();

onMounted(() => {
    const userData = page.props.user;

    userStore.user.id = userData.id;
    userStore.user.first_name = userData.first_name;
    userStore.user.last_name = userData.last_name;
    userStore.user.nickname = userData.nickname;
    userStore.user.email = userData.email;
    userStore.user.img = userData.img;
    userStore.user.status = userData.status;
});

provide('userStore', userStore);
</script>

<template>

    <Head>
        <title>Профиль</title>
    </Head>
    <div class="profile">
        <ProfileInfo />
        <div class="d-flex flex-wrap">
            <div class="w-100">
                <div class="row p-2 sticky-top">
                    <ul class="nav nav-pills">
                        <li class="nav-item w-100">
                            <span class="nav-link" @click="toggleSettings = 'settings'"
                                :class="{ 'active': toggleSettings == 'settings' }">Настройки</span>
                        </li>
                        <li class="nav-item w-100">
                            <span class="nav-link" @click="toggleSettings = 'orders'"
                                :class="{ 'active': toggleSettings == 'orders' }">Заказы</span>
                        </li>
                        <li class="nav-item w-100" v-if="Object.keys($page.props.user.role).length > 0">
                            <a class="nav-link" href="/admin">
                                Панель Администратора
                                <i class="fa-solid fa-up-right-from-square"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="w-100">
                <template v-if="toggleSettings == 'settings'">
                    <ProfileSettings />
                </template>
                <template v-else-if="toggleSettings == 'orders'">
                    <div class="row">
                        <div class="m-0 p-0">
                            <h4 class="text-left">Ваши Заказы</h4>
                        </div>
                        <template v-if="Object.keys($page.props.orders).length <= 0">
                            <h5>У вас нет заказов</h5>
                        </template>
                        <template v-else>
                            <div class="page-body" v-for="item in $page.props.orders">

                                <div class="order-wrapper">
                                    <div class="order-header order-header_relative-position">
                                        <div class="order-header__body">
                                            <div class="order-header__info-block">
                                                <div class="order-header__name-and-date">
                                                    <p>
                                                        <span class="order-header__order-name">
                                                            Заказ {{ item.id }}
                                                        </span>
                                                        <span class="order-header__order-date">
                                                            от
                                                            {{
                                                                new Date(item.created_at).toLocaleString('ru-RU', {
                                                                    day:
                                                                        '2-digit', month: '2-digit', year: 'numeric', hour:
                                                                        '2-digit', minute: '2-digit'
                                                                }).replace(',', '')
                                                            }}
                                                        </span>
                                                    </p>
                                                </div>
                                                <div class="order-header__statuses">
                                                    <div class="order-header__status"
                                                        style="background: rgb(242, 237, 255);">
                                                        <div style="color: rgb(124, 76, 255);">{{ item.Status }}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-body">
                                        <div class="order-product__wrapper" v-for="index in item.item">
                                            <div class="order-product order-product_order">
                                                <div class="order-product__image-description">
                                                    <div class="order-product__image-block">
                                                        <Link :href="'/product/' + index.product.slug">
                                                        <img :src="'/storage/src/' + JSON.parse(index.product.img)[0]"
                                                            class="order-product__image order-product__image_active">
                                                        </Link>
                                                    </div>
                                                    <div class="order-product__description">
                                                        <Link :href="'/product/' + index.product.slug"
                                                            class="order-product__name text-dark">
                                                        {{ index.product.name }}
                                                        </Link>
                                                    </div>
                                                </div>
                                                <div class="order-price-block">
                                                    <div class="order-price-block__line">
                                                        <span>Цена: {{ index.price * index.quantity }} ₽</span>
                                                    </div>
                                                    <div class="order-price-block__line order-price-block__sub-info">
                                                        {{ index.quantity }} шт. x {{ index.price }} ₽
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-footer">
                                        <div class="order-summary">
                                            <p class="order-summary__sum-line">
                                                Итого:
                                                <span class="order-summary__sum">{{ item.total_sum }} ₽</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </template>
            </div>
        </div>
    </div>
</template>

<style lang="scss">
.profile {
    margin: 0;
    padding: 0;
    z-index: 1;
    position: relative;


    .w-25 .row {

        span,
        a {
            cursor: pointer;
            user-select: none;
            padding: 10px 0 10px 10px;
        }
    }

    a {
        color: rgb(0, 148, 217);
        text-decoration: none;
    }

    .user-settings-info {
        display: flex;
        flex-direction: column;
        height: 100%;
        min-height: 165px;
        position: relative;
    }

    .user-settings-info__left-block {
        align-items: center;
        display: flex;
        flex-direction: row;
        width: 200px;
    }

    .user-settings-info__avatar-settings-wrapper {
        border-radius: 50%;
        height: 132px;
        position: relative;
        width: 132px;
    }

    .user-settings-info__avatar-image {
        border-radius: 50%;
        height: 132px;
        width: 132px;
    }

    .user-settings-info__left-block {
        display: flex;
        justify-content: center;
        width: 100%;

        &>* {
            user-select: none;
        }
    }

    .user-settings-info__info {
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .user-settings-info__nickname {
        height: 32px;
        margin: 0 10px 8px;
        color: #4e4e4e;
        font-size: 30px;
        font-weight: 700;
        letter-spacing: .8px;
        line-height: 32px;
    }

    .user-settings-info__fullname {
        color: #333;
        font-size: 18px;
        height: 19px;
        margin-bottom: 12px;
        margin-left: 10px;
    }

    .user-settings-info__status {
        margin-bottom: 20px;
    }

    .user-settings-info__status-show {
        border: none;
        color: #333;
        cursor: pointer;
        padding: 10px;
        width: 100%;
    }

    .password-setting {
        margin-bottom: 20px;
    }

    .personal-info-confirm-container {
        display: grid;
        grid-template-columns: 1fr;
        position: relative;

        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            transition: background-color 5000s ease-in-out 0s;
            -webkit-text-fill-color: #000 !important;
        }

        .input-row__error {
            margin: 0 0 5px 0;
            padding: 5px;
            vertical-align: top;
            max-width: 300px;
            background: red;

            .input-row__error-message {
                color: white;
                font-size: 14px;
                font-weight: 700;
                line-height: 20px;
                margin: 8px 0;
                width: 100%;
            }
        }

        .input-row__error_hidden,
        .personal-info-confirm-container__confirm-btn-container_hidden {
            display: none;
        }
    }

    .user-settings-info__avatar-settings-wrapper:hover:after,
    .user-settings-info__avatar-settings-wrapper:hover:before {
        display: block;
    }

    .user-settings-info__avatar-settings-wrapper_editable:before {
        background-color: #fff;
        border-radius: 50%;
        content: " ";
        cursor: pointer;
        display: none;
        height: 132px;
        opacity: .5;
        position: absolute;
        width: 132px;
        z-index: 1;
    }

    .user-settings-info__avatar-settings-wrapper_editable:after {
        color: rgb(0, 0, 0);
        content: "Сменить аватар";
        cursor: pointer;
        display: none;
        left: 35px;
        position: absolute;
        top: 40px;
        z-index: 50;
    }

    .personal-info-confirm-container__confirm-btn-container {
        display: flex;
        margin-bottom: 20px;
        vertical-align: top;
        width: 100%;
    }

    .personal-info-confirm-container__btn:first-child {
        margin-right: 16px;
    }

    .personal-info-confirm-container__btn-cancel {
        background: none;
        border: 1px solid #d9d9d9;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .16);
        color: #333;
        font-weight: 400;
        min-height: 40px;
        padding-left: 12px;
        padding-right: 12px;
    }

    .ns-btn {
        border: none;
        border-radius: 8px;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .16);
        box-sizing: border-box;
        color: #4e4e4e;
        font-size: 16px;
        font-stretch: normal;
        font-style: normal;
        height: 40px;
        letter-spacing: .2px;
        line-height: 40px;
        min-width: 133px;
        padding-left: 0;
        padding-right: 0;
        position: relative;
        text-align: center;
    }

    .ns-btn.btn-info {
        background: linear-gradient(0deg, #0dcaf0, #31d2f2);
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .16);
        color: #fff;
        font-weight: 700;
        padding-left: 12px;
        padding-right: 12px;
    }

    .ns-btn:hover {
        background: #0dcaf0;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, .16);
        color: #fff;
        font-weight: 700;
    }

    .button-profile-ui {
        border: none;
        border-radius: 8px;
        cursor: pointer;
        display: inline-block;
        font-size: 16px;
        line-height: 38px;
        min-width: 138px;
        outline: none;
        overflow: hidden;
        padding: 0;
        text-align: center;
        transition: opacity .3s;
    }

    .warning__body {
        width: 60%;
        position: absolute;
        top: 25%;
        padding: 10px 5px;
    }

    .warning__body>* {
        user-select: none;
    }

    .page-body {
        width: 100%;
        margin-bottom: 20px;

        &:last-child {
            padding-bottom: 0;
        }

        .order-wrapper {
            border-radius: 8px;
            margin: auto;
            position: relative;
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0, 0, 0, .16);

            .order-header {
                display: flex;
                width: 100%;
                padding: 12px 16px 12px 20px;
                z-index: 2;
                background: #fff;
                border-bottom: 1px solid #eee;
                border-radius: 8px 8px 0 0;

                .order-header__body {
                    align-items: center;
                    flex-wrap: nowrap;
                    justify-content: space-between;
                    padding-right: 35px;
                    width: 100%;

                    .order-header__info-block {
                        display: flex;
                        align-items: flex-start;
                        flex-shrink: 0;

                        .order-header__name-and-date {
                            display: flex;
                            align-items: center;
                            cursor: pointer;
                            line-height: 24px;

                            .order-header__order-name {
                                font-size: 16px;
                                font-weight: bold;
                                margin-right: 4px;
                            }

                            .order-header__order-date {
                                margin-right: 16px;
                                font-size: 16px;
                            }
                        }

                        .order-header__statuses {
                            display: flex;

                            .order-header__status {
                                position: relative;
                                display: flex;
                                cursor: default;
                                border-radius: 4px;
                                padding: 3px 8px;
                                color: #fff;
                                font-weight: bold;
                                font-size: 12px;
                                z-index: 200;
                            }
                        }
                    }
                }
            }

            .order-body {
                transition: transform .3s ease-out, max-height .4s ease-in;
                border-radius: 8px;

                .order-product__wrapper {
                    position: relative;
                    max-height: inherit;

                    &:before {
                        position: absolute;
                        bottom: 0;
                        left: 0;
                        width: 100%;
                        border-bottom: 1px solid #eee;
                        content: "";
                    }

                    .order-product {
                        display: flex;
                        flex-direction: row;
                        padding: 24px 20px;
                        min-height: 150px;
                        max-height: inherit;

                        .order-product__image-description {
                            display: flex;
                            flex-direction: row;
                            width: 100%;

                            .order-product__image-block {
                                position: relative;
                                display: flex;
                                padding-right: 15px;
                                align-items: flex-start;

                                .order-product__image_active {
                                    cursor: pointer;
                                }

                                .order-product__image {
                                    width: 100px;
                                    max-height: 100px;
                                    object-fit: contain;
                                }
                            }

                            .order-product__description {
                                width: 100%;

                            }
                        }

                        .order-price-block {
                            max-width: 200px;
                            display: flex;
                            flex-direction: column;
                            align-items: flex-end;
                            width: 100%;
                            color: #4e4e4e;

                            .order-price-block__line {
                                display: flex;
                                margin-bottom: 4px;
                                justify-content: flex-end;
                                align-items: baseline;

                                .order-price-block__value_big {
                                    font-size: 18px;
                                    font-weight: bold;
                                    line-height: 130%;
                                }

                                .order-price-block__value {
                                    margin-left: 4px;
                                    color: #333;
                                }
                            }

                            .order-price-block__sub-info {
                                margin-bottom: 12px;
                                text-align: right;
                                font-size: 14px;
                            }

                            .order-price-block__line {
                                display: flex;
                                margin-bottom: 4px;
                                justify-content: flex-end;
                                align-items: baseline;
                            }

                            .order-price-block__sub-info {
                                margin-bottom: 12px;
                                text-align: right;
                                font-size: 14px;
                            }

                        }
                    }

                }
            }

            .order-footer {
                display: flex;
                justify-content: space-between;
                max-height: inherit;
                padding: 20px;

                .order-summary {
                    display: flex;
                    flex-direction: column;
                    align-items: flex-end;

                    .order-summary__sum-line {
                        margin-bottom: 8px;
                        font-size: 18px;
                        display: flex;

                        .order-summary__sum {
                            font-weight: 600;
                            font-size: 18px;
                            white-space: nowrap;
                            margin-left: 4px;
                        }
                    }
                }
            }
        }
    }
}
</style>
