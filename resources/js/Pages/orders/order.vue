<script setup>
import { Head, usePage, router } from '@inertiajs/vue3';
import { onBeforeMount, reactive, ref } from 'vue';
import InputMask from 'primevue/inputmask';
import axios from 'axios';
import ymaps from 'ymaps';

const errorMessage = ref('');
const suggestions = ref([]);
const isSuggestionsVisible = ref(false);
let mapInstance;

const orderForm = reactive({
    first_name: usePage().props.user ? usePage().props.user.first_name : null,
    last_name: usePage().props.user ? usePage().props.user.last_name : null,
    phone: null,
    address: null
});

async function getAddressFromCoords(coords) {
    const ymapsInstance = await ymaps.load('https://api-maps.yandex.ru/2.1/?apikey=d6414e4b-20b1-486f-af2b-1681cecc4ada&lang=ru_RU');
    const geocoder = ymapsInstance.geocode(coords);
    const result = await geocoder.then(res => res.geoObjects.get(0).getAddressLine());
    return result;
}

onBeforeMount(async () => {

    const ymapsInstance = await ymaps.load('https://api-maps.yandex.ru/2.1/?apikey=d6414e4b-20b1-486f-af2b-1681cecc4ada&suggest_apikey=431b11fa-b589-4418-bd92-c204362d695f&lang=ru_RU&load=package.full');
    mapInstance = new ymapsInstance.Map('yandexmap', {
        center: [52.2978, 104.2964], // Coordinates of Irkutsk
        zoom: 5, // Zoom level
        controls: ['zoomControl'] // Show only zoom control
    }, {
        restrictMapArea: [
            [52.222, 103.49], // Southwest coordinates of Irkutsk
            [52.379, 104.415] // Northeast coordinates of Irkutsk
        ]
    });

    mapInstance.events.add('click', async (e) => {
        const coords = e.get('coords');
        const address = await getAddressFromCoords(coords);
        if (address) {
            orderForm.address = address;
        }
    });
});

const suggestAddresses = async (query) => {
    const ymapsInstance = await ymaps.load('https://api-maps.yandex.ru/2.1/?apikey=d6414e4b-20b1-486f-af2b-1681cecc4ada&lang=ru_RU');
    const suggest = await ymapsInstance.suggest(query, { results: 5, boundedBy: [[52.222, 103.49], [52.379, 104.415]] });
    return suggest.map(item => item.displayName);
};

const handleAddressInput = async (event) => {
    const query = event.target.value;

    if (query.length > 2) {
        suggestions.value = await suggestAddresses(query);
        isSuggestionsVisible.value = true;
    } else {
        suggestions.value = [];
        isSuggestionsVisible.value = false;
    }
};

const selectSuggestion = (suggestion) => {
    orderForm.address = suggestion;
    isSuggestionsVisible.value = false;
};

const setOrder = () => {
    axios.post(route('orderSet'), orderForm, {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    })
        .then(response => {
            console.log(response['data']);
            if (response['data'].error) {
                errorMessage.value = response['data'].error_text;
                window.scrollBy(0, 0)
            }
            if (response['data'] === true) {
                router.put(route('orderViewDone'));
            }
        })
        .catch(error => {
            console.log('Error updating: ', error);
        });
};

const handleFocus = (event) => {
    errorMessage.value = '';
    $(event.target).closest('.personal-info-confirm-container').find('.input-row__container').addClass('input-row__container_filled');
};

const addressHandleFocus = (event) => {
    isSuggestionsVisible.value = true;
}

const handleUnFocus = (event) => {
    setTimeout(() => {
        isSuggestionsVisible.value = false;
    }, 100);
    if (event.target.value === '') {
        $(event.target).closest('.personal-info-confirm-container').find('.input-row__container').removeClass('input-row__container_filled');
    }
};
</script>

<template>
    {{ $page.props.totalPrice }}
    <Head>
        <title>Оформление заказа</title>
    </Head>
    <div class="orders">
        <div class="row">
            <div v-show="errorMessage !== ''" class="input-row__error">
                <div class="input-row__error-message">{{ errorMessage }}</div>
            </div>
            <div class="base-step-label_su9">
                <div class="number-step-label">1</div>
                Данные пользователя
            </div>
            <div class="userInfo div-border-style">
                <div class="personal-info-confirm-container">
                    <div class="input-row">
                        <div class="input-row__container"
                            :class="{ 'input-row__container_filled': orderForm.first_name }">
                            <input type="text" class="input-row__input" @focus="handleFocus($event)"
                                @blur="handleUnFocus($event)" v-model="orderForm.first_name">
                            <label for="ir-email" class="input-row__label">Имя</label>
                        </div>
                    </div>
                </div>
                <div class="personal-info-confirm-container">
                    <div class="input-row">
                        <div class="input-row__container"
                            :class="{ 'input-row__container_filled': orderForm.last_name }">
                            <input type="text" class="input-row__input" @focus="handleFocus($event)"
                                @blur="handleUnFocus($event)" v-model="orderForm.last_name">
                            <label for="ir-email" class="input-row__label">Фамилия</label>
                        </div>
                    </div>
                </div>
                <div class="personal-info-confirm-container">
                    <div class="input-row">
                        <div class="input-row__container">
                            <InputMask type="tel" class="input-row__input" @focus="handleFocus($event)"
                                @blur="handleUnFocus($event)" v-model="orderForm.phone" mask="+7 (999) 999-99-99">
                            </InputMask>
                            <label for="ir-email" class="input-row__label">Номер телефона</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="base-step-label_su9">
                <div class="number-step-label">2</div>
                Адресс доставки
            </div>
            <div class="div-border-style">
                <div class="personal-info-confirm-container">
                    <div class="input-row">
                        <div class="input-row__container" :class="{ 'input-row__container_filled': orderForm.address }">
                            <input type="text" class="input-row__input" id="address-input"
                                @focus="handleFocus($event), addressHandleFocus($event)" @blur="handleUnFocus($event)"
                                v-model="orderForm.address" @input="handleAddressInput" autocomplete="off">
                            <label for="ir-email" class="input-row__label">Адресс</label>
                        </div>
                    </div>
                    <ul v-if="isSuggestionsVisible && suggestions.length" class="suggestions-list">
                        <li v-for="suggestion in suggestions" :key="suggestion" @click="selectSuggestion(suggestion)">
                            {{ suggestion }}
                        </li>
                    </ul>
                </div>
                <div class="yandexmap" id="yandexmap"></div>
            </div>
        </div>
        <div class="row">
            <div class="base-step-label_su9">
                <div class="number-step-label">3</div>
                Подтверждение заказа
            </div>
            <div class="div-border-style">
                <div class="mb-2">
                    <p>Оплата производиться наличными или картой курьеру при получении товара</p>
                    <p>Сумма к оплате {{ $page.props.totalPrice }} рублей</p>
                </div>
                <div>
                    <button type="button" @click="setOrder" class="btn btn-success text-white">Оформить Заказ</button>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
.orders {
    .row {
        box-shadow: none;
        padding: 0;

        &:not(:last-child) {
            margin-bottom: 30px;
        }

        &>* {
            padding: 0;
        }

        .div-border-style {
            padding-left: 1%;

            &:not(:last-child) {
                padding-bottom: 2%;
            }

            #yandexmap {
                width: 100%;
                /* Ширина карты будет равна ширине родительского элемента */
                height: 400px;
                /* Высоту карты можно установить в любое подходящее значение */
            }

            border-left: 1px solid #e6e6e6;

            .personal-info-confirm-container {
                max-width: 350px;
                min-width: 350px;
                margin-right: 10px;
                position: relative;

                .suggestions-list {
                    width: 100%;
                    position: absolute;
                    top: 71px;
                    z-index: 100;
                    padding: 0;
                    border: 1px solid #e5e5e5;

                    li {
                        padding: 1% 2%;
                        background: #fff;
                    }
                }

                .input-row {
                    line-height: 1.42857;
                    max-width: 350px;
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

        }

        .userInfo {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
        }

        .base-step-label_su9 {
            font-size: 20px;
            font-weight: bold;
            margin: 0 0 12px 0;
            color: #444444de;
            display: flex;

            .number-step-label {
                box-shadow: 0 2px 4px 0 rgba(94, 94, 94, .1), 0 3px 14px 0 rgba(0, 0, 0, .1);
                background-color: #fff;
                border-radius: 40%;
                display: inline-flex;
                font-size: 14px;
                padding: 4px 7px 0 7px;
                margin-right: 1%;
            }
        }
    }
}
</style>