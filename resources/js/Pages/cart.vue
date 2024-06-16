<script setup lang="jsx">
import { Head, Link, usePage } from '@inertiajs/vue3'
import { ref, defineProps, computed } from 'vue';
import axios from 'axios';

const State = ref(true);
const count = ref(0);
const price = ref(0);
const counCheck = ref(false);

const props = defineProps({
    products: Object,
    cart: Object
})
const isAnyProductOutOfStock = computed(() => props.products.some(item => item.count <= 0));

function update(id, quantity) {
    let formData = new FormData();
    formData.append('product_id', id)
    formData.append('quantity', quantity)
    count.value = 0
    price.value = 0
    for (const element of Object.values(props.products)) {
        if (element.count > 1) {
            count.value += parseInt(props.cart[element.id].quantity)
            price.value += parseInt(element.price) * parseInt(props.cart[element.id].quantity)
        }
    };
    axios.post(route('updateQuantity'), formData).then(function (resp) {
        State.value = true;
    })
};
const removeFromCart = (item, carts) => {
    if (State.value == false) return
    let formData = new FormData()
    let productIndex = Object.values(props.products).indexOf(item);

    formData.append('product_id', item.id)
    State.value = false

    props.products.splice(productIndex, 1);
    delete props.cart[item.id]
    axios.post(route('removeFromCart'), formData).then(function (resp) {
        State.value = true;
    })
};
const countMinus = (item, cart, event) => {
    if (cart.quantity <= 1) return
    if (State.value == false) return

    State.value = false
    cart.quantity--;

    update(item.id, cart.quantity)
};
const countPlus = (item, cart, event) => {
    if (State.value == false) return
    if (cart.quantity >= item.count)
        return
    State.value = false
    cart.quantity++

    update(item.id, cart.quantity)
};
const countChange = (item, cart, event) => {
    if (State.value == false) return;
    if (event.target.value < 1) {
        event.target.value = cart.quantity
        return
    }
    if (event.target.value >= item.count) event.target.value = item.count
    State.value = false;
    cart.quantity = event.target.value

    update(item.id, cart.quantity)

};

const clearCart = () => {
    if (State.value == false) return;
    State.value = false;
    axios.post(route('clearCart')).then(function (resp) {
        State.value = true;
        props.cart.length = 0;
        props.products.length = 0;
    })
};

const Wishlist = (item) => {
    const formData = new FormData();
    formData.append('product_id', item.id);


    if (usePage().props.favorite[item.id]) {
        axios.post(route('removeFromFavorite'), formData).then(function (resp) {
            delete usePage().props.favorite[item.id]
        })
    } else {
        axios.post(route('addToFavorite'), formData).then(function (resp) {
            usePage().props.favorite[item.id] = { "product_id": item.id }
        })
    }
}
for (const element of Object.values(props.products)) {
    if (element.count > 1) {
        count.value += parseInt(props.cart[element.id].quantity)
        price.value += parseInt(element.price) * parseInt(props.cart[element.id].quantity)
    }
};


</script>

<template>

    <Head>
        <title>Корзина</title>
    </Head>
    <div class="cart">
        <template v-if="products.length > 0">
            <div class="d-flex">
                <div class="w-75 me-5">
                    <div class="product-widget row p-3">
                        <span @click="clearCart" class="text-danger user-select-none pe-auto w-auto"
                            role="button">Очистить
                            корзину</span>
                    </div>
                    <template v-for="(item, index) in products">
                        <div v-if="item.count > 0" class="product-widget row">
                            <div class="windget-header single-product-widget-header">
                                <div class="windget-header__img">
                                    <Link :href="`/product/` + item.slug" class="widget-header__link">
                                    <img loading="lazy"
                                        :src="item.img ? '/storage/src/' + JSON.parse(item.img)[0] : '/storage/src/row/no-image.png'">
                                    </Link>
                                    <div class="widget-header__code">
                                        {{ item.id }}
                                    </div>
                                </div>
                                <div class="windget-header__title">
                                    <Link :href="`/product/` + item.slug" class="text-decoration-none text-dark">
                                    {{
                                        item.name
                                    }}
                                    </Link>
                                </div>
                                <div class="windget-header__menu">
                                    <div class="wishlist-button_cart" @click="Wishlist(item)">
                                        <i :class="!$page.props.favorite[item.id] ? 'fa-regular ' : 'fa-solid'"
                                            class="fa-heart"></i>
                                    </div>
                                    <div class="remove-button" @click="removeFromCart(item, cart[item.id])">
                                        <i class="fa-regular fa-trash-can btn-block"></i>
                                    </div>
                                </div>
                                <div class="windget-header__bottom widget-header__bottom-row">
                                    <div>
                                        <div class="count-buttons">
                                            <div class="count-buttons__button-wrapper">
                                                <button @click="countMinus(item, cart[item.id], $event)"
                                                    class="count-buttons__button"
                                                    :class="{ 'windget-header__bottom__disable': State == false || cart[item.id].quantity == 1 }"
                                                    :disabled="State == false || cart[item.id].quantity == 1">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                            </div>
                                            <input type="number" name="" id="" step="1" min="0" max="1162"
                                                class="count-buttons__input"
                                                @change="countChange(item, cart[item.id], $event)"
                                                :class="{ 'windget-header__bottom__disable': State == false }"
                                                :disabled="State == false" :value="cart[item.id].quantity">
                                            <div class="count-buttons__button-wrapper">
                                                <button @click="countPlus(item, cart[item.id], $event)"
                                                    class="count-buttons__button"
                                                    :class="{ 'windget-header__bottom__disable': State == false || cart[item.id].quantity == item.count }"
                                                    :disabled="State == false || cart[item.id].quantity == item.count">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <span v-if="cart[item.id].quantity > 1" class="widget-header__cost-per-item">
                                            {{ item.price }} ₽ / шт.
                                        </span>
                                    </div>
                                </div>
                                <div class="windget-heager__price widget-header__bottom-row">
                                    <div class="price">
                                        <div v-if="item.old_price > 0" class="price__prev">
                                            {{ item.old_price * cart[item.id].quantity }}
                                        </div>
                                        <div class="price__current">
                                            {{ item.price * cart[item.id].quantity }}
                                        </div>

                                    </div>
                                </div>
                                <div class="windget-header__avails">
                                    <div style="font-size: 14px;">
                                        <span>
                                            В наличии: {{ item.count }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>

                    <div v-if="isAnyProductOutOfStock" class="product-widget m-2">
                        <h5 class="m-0 text-center">Нет в наличии</h5>
                    </div>
                    <template v-for="(item, index) in products">
                        <div v-if="item.count <= 0" class="product-widget row">
                            <div class="windget-header single-product-widget-header">
                                <div class="windget-header__img">
                                    <Link :href="`/product/` + item.slug" class="widget-header__link">
                                    <img loading="lazy"
                                        :src="item.img ? '/storage/src/' + JSON.parse(item.img)[0] : '/storage/src/row/no-image.png'">
                                    </Link>
                                    <div class="widget-header__code">
                                        {{ item.id }}
                                    </div>
                                </div>
                                <div class="windget-header__title">
                                    <Link :href="`/product/` + item.slug" class="text-decoration-none text-dark">
                                    {{
                                        item.name
                                    }}
                                    </Link>
                                </div>
                                <div class="windget-header__menu">
                                    <div class="wishlist-button_cart" @click="Wishlist(item)">
                                        <i :class="!$page.props.favorite[item.id] ? 'fa-regular ' : 'fa-solid'"
                                            class="fa-heart"></i>
                                    </div>
                                    <div class="remove-button" @click="removeFromCart(item, cart[item.id])">
                                        <i class="fa-regular fa-trash-can btn-block"></i>
                                    </div>
                                </div>
                                <div class="windget-header__bottom widget-header__bottom-row">
                                </div>
                                <div class="windget-heager__price widget-header__bottom-row">
                                    <div class="price">
                                        <div v-if="item.old_price > 0" class="price__prev">
                                            {{ item.old_price * cart[item.id].quantity }}
                                        </div>
                                        <div class="price__current">
                                            {{ item.price * cart[item.id].quantity }}
                                        </div>

                                    </div>
                                </div>
                                <div class="windget-header__avails">
                                    <div style="font-size: 14px;">
                                        <span>
                                            В наличии: {{ item.count }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="w-25">
                    <div class="row p-0 sticky-top">
                        <div class="border-bottom border-secondary p-3">
                            <button class="btn btn-block w-100 bg-success text-white p-3"><Link :href="route('orderView')" class="text-white text-decoration-none">Перейти к оформлению</Link></button>
                            <span style="font-size: 14px;">Доступные способы оплаты и время доставки можно выбрать при
                                оформлении
                                заказа</span>
                        </div>
                        <div class="d-flex flex-column p-3">
                            <div class="d-flex justify-content-between border-bottom border-secondary pb-2 mb-1">
                                <span>Ваша корзина</span>
                                <span>
                                    {{ count }}
                                    <span v-if="count == 1" style="font-size: 12px;">товар</span>
                                    <span v-if="count > 1 && count < 5" style="font-size: 12px;">товара</span>
                                    <span v-if="count >= 5" style="font-size: 12px;">товаров</span>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between pb-2 mb-1">
                                <span>Стоимость</span>
                                <span class="full-price">
                                    {{ price }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        <template v-if="products.length < 1">
            <div class="row">
                <h5 class="text-center">Корзина Пуста</h5>
            </div>
        </template>
    </div>
</template>

<style lang="scss">
div.cart {
    margin: 0;
    padding: 0;

    .product-widget {
        margin-bottom: 30px;
    }

    .product-widget .windget-header {
        display: grid;

    }

    .single-product-widget-header {
        grid-template-columns: auto minmax(0%, 1fr) auto;
        grid-template-areas:
            "img title menu"
            "img bottom price"
            "img avails price"
        ;
    }

    .windget-header__img {
        text-align: center;
        grid-area: img;
    }

    .widget-header__code {
        color: #afafaf;
        font-size: 14px;
        pointer-events: none;
    }

    .widget-header__link {
        width: 100px;
        display: block;
    }

    .widget-header__link img {
        max-height: 100px;
        max-width: 100px;
        margin: auto;
    }

    .windget-header__title {
        grid-area: title;
    }

    .windget-header__menu {
        grid-area: menu;
        display: flex;
        justify-content: flex-end;
        flex-direction: row;
    }

    .wishlist-button_cart,
    .remove-button {
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 8px;
        width: 32px;
        height: 32px;
    }

    .wishlist-button_cart:hover,
    .remove-button:hover {
        background-color: #dadada;
    }

    .windget-header__bottom {
        height: 75px;
        display: flex;
        justify-content: space-between;
        grid-area: bottom;
        position: relative;
    }

    .count-buttons {
        min-width: 98px;
        height: 34px;
        position: relative;
        border: 1px solid #e5e5e5;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        box-sizing: border-box;
        background-color: #fff;
    }

    .count-buttons__input {
        display: inline-block;
        text-align: center;
        vertical-align: top;
        line-height: 33px;
        height: 100%;
        margin: 0 auto;
        padding: 0;
        border: none;
        background: rgba(0, 0, 0, 0);
        color: #4e4e4e;
        font-size: 16px;
        outline: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .widget-header__cost-per-item {
        display: block;
        margin-top: 8px;
        color: #8c8c8c;
        font-size: 14px;
    }

    .count-buttons__button-wrapper {
        display: inline-block;
        border-radius: 8px;
        overflow: hidden;
        cursor: not-allowed;
    }


    .count-buttons__button {
        box-shadow: none;
        color: #afafaf;
        font-size: 18px;
        font-weight: 400;
        overflow: hidden;
        padding: 0;
        line-height: 1.5;
        outline: none;
        height: 100%;
        width: 40px;
        border: none;
        background: rgba(0, 0, 0, 0);
        color: black;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .windget-header__bottom__disable,
    .windget-header__bottom__limit {
        color: #ddd;
        cursor: not-allowed;
    }

    .windget-heager__price {
        grid-area: price;
    }

    .widget-header__bottom-row {
        padding-top: 12px;
    }

    .price__prev {
        font-size: 12px;
        line-height: 14px;
        text-decoration: line-through;
    }

    .price__current {
        font-size: 18px;
        line-height: 20px;
        font-weight: 700;


    }

    .full-price,
    .price__current {
        &::after {
            content: "₽";
            margin-left: 4px;
            position: relative;
        }
    }

    .windget-header__avails {
        grid-area: avails;
    }
}
</style>
