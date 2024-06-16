<script setup lang="jsx">
import { ref } from 'vue';
import { Head, usePage, router } from '@inertiajs/vue3';

import TypeCard from "@/Components/Catalog/TypeCard.vue";
import TypeProduct from "@/Components/Catalog/TypeProduct.vue";

const filter = (params, text) => {
    if (!route().params[params]) return
    if (route().params[params].toLowerCase().split('-').indexOf(text.toLowerCase()) != -1) return true
}

const top = ref(null);
let timeoutId

const applyFilters = () => {
    top.value = null
    let price = ''
    let minPrice = $('#minPrice').val() == '' || $('#minPrice').val() == 0 ? 0 : $('#minPrice').val()
    let maxPrice = $('#maxPrice').val() == '' || $('#maxPrice').val() == 0 ? usePage().props.filter.AbsolutemaxPrice : $('#maxPrice').val()
    if (minPrice > maxPrice)
        [maxPrice, minPrice] = [minPrice, maxPrice]
    if ($('#minPrice').val() != '' | $('#maxPrice').val() != '')
        price = minPrice + '-' + maxPrice
    const _query = {};
    if (price) {
        _query.price = price;
    }
    if ($('input[name="brand"]:checked').length > 0) {
        _query.brand = $('input[name="brand"]:checked').map(function () { return $(this).val(); }).get().join('-').toLowerCase()
    }

    var attributes = $('.attributes_filter').map(function () {
        let title = $(this).find('.attributes_filter-title').text();
        let values = $(this).find('input:checked').map(function () { return $(this).val(); }).get().join('-');
        if (title && values) {
            let attr = [];
            attr = [title + '=' + values];
            return attr;
        }
    }).get();

    if (attributes.length > 0) {
        attributes.forEach(element => {
            const title = element.split('=')[0].replace(' ', '_')
            const value = element.split('=')[1]
            _query[title] = value
        })
    }

    // Выполнение запроса router.put
    router.put(route('type', { 'type': usePage().props.type, '_query': _query }));
}

const clearFilters = () => {
    router.put(route('type', usePage().props.type))
}

const box_show = (e) => {
    var filterBlock = document.querySelector(".filter_block");
    var filterBlockPosition = filterBlock.getBoundingClientRect();
    let minus

    if ((e.target).closest('li.d-flex').querySelector('input').checked != true) {
        (e.target).closest('li.d-flex').querySelector('input').checked = true;
    } else {
        (e.target).closest('li.d-flex').querySelector('input').checked = false;
    }
    var position = (e.target).closest('li.d-flex').querySelector('span').getBoundingClientRect();
    minus = 22

    top.value = position.top - filterBlockPosition.top - minus;

    clearTimeout(timeoutId);
    timeoutId = setTimeout(() => {
        top.value = null;
    }, 5000);
}

</script>

<template>

    <Head>
        <title>
            {{ $page.props.name }}
        </title>
    </Head>
    <div class="catalogs" :class="$page.props.filter ? 'd-flex' : ''">
        <div class="w-25 me-5 row" v-if="$page.props.filter">
            <div class="p-0 m-0">
                <div class="filter_block">
                    <div v-if="top" @click="applyFilters" class="apply-filters-float-btn" :style="{ 'top': top + 'px' }"
                        data-label="Показать">
                    </div>
                    <div class="price">
                        <h6>Цена</h6>
                        <input type="number" name="minPrice" id="minPrice" class="my-1 p-1 w-100"
                            :placeholder="'Минимальная Цена ' + (Object.keys(route().params).length >= 1 ? usePage().props.filter.minPrice : usePage().props.filter.AbsoluteminPrice)"
                            :value="route().params['price'] ? (route().params['price'].split('-')[0] != 0 ? route().params['price'].split('-')[0] : '') : ''">

                        <input type="number" name="maxPrice" id="maxPrice" class="my-1 p-1 w-100"
                            :placeholder="'Максимальная Цена ' + (Object.keys(route().params).length >= 1 ? usePage().props.filter.maxPrice : usePage().props.filter.AbsolutemaxPrice)"
                            :value="route().params['price'] ? (route().params['price'].split('-')[1] != $page.props.filter.AbsolutemaxPrice ? route().params['price'].split('-')[1] : '') : ''">
                    </div>
                    <template v-if="$page.props.filter.manufacturers">
                        <div class="manufacturers">
                            <h6>Производитель</h6>
                            <div>
                                <ul class="ps-1">
                                    <li v-for="(item, index) in $page.props.filter.manufacturers" class="d-flex"
                                        @click="box_show($event)">
                                        <span>{{ item.name }}</span>
                                        <input type="checkbox" class="ui-checkbox__input" name="brand"
                                            :id="'brand-' + item.name" :value="item.name"
                                            :checked="filter('brand', item.name)">
                                        <span class="ui-checkbox__box"></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </template>
                    <template v-for="(item, index) in $page.props.filter.attributes_filter">
                        <template v-if="Object.keys(item).length > 1">
                            <div class="attributes_filter">
                                <h6 class="attributes_filter-title">{{ index }}</h6>
                                <div>
                                    <ul class="ps-1">
                                        <li v-for="item in item" class="d-flex" @click="box_show($event)">
                                            <template v-if="item">
                                                <span>{{ item }}</span>
                                                <input type="checkbox" class="ui-checkbox__input" :name="index"
                                                    :id="index.replace(' ', '-')" :value="item"
                                                    :checked="filter(index.replace(' ', '_'), item)">
                                                <span class="ui-checkbox__box ui-checkbox__box_list"></span>
                                            </template>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </template>
                    </template>
                    <button type="button" class="btn btn-primary  w-100" @click="applyFilters">Применить</button>
                    <button type="button" class="btn btn-light w-100" @click="clearFilters">Сброс</button>

                </div>
            </div>
        </div>
        <div class="row" :class="$page.props.filter ? 'w-75' : ''">
            <TypeCard v-if="$page.props.request == 'category'" />
            <TypeProduct v-else-if="$page.props.request == 'type'" />
        </div>
    </div>
</template>
<style lang="scss">
@keyframes checkbox-check {
    0% {
        border-color: #fff;
        height: 0;
        transform: translateZ(0) rotate(45deg);
        width: 0
    }

    33% {
        height: 0;
        transform: translateZ(0) rotate(45deg);
        width: .2em
    }

    to {
        border-color: #fff;
        height: .5em;
        transform: translate3d(0, -.5em, 0) rotate(45deg);
        width: .2em
    }
}

.catalogs {
    margin: 0;
    padding: 0;
    z-index: 1;

    .row {
        height: fit-content;
    }

    .row .p-0.m-0 {
        position: relative;
    }

    .row.w-75 {
        height: fit-content;
    }

    .filter_block {
        padding: 0;
        margin: 0;

        span,
        h6 {
            user-select: none;
        }

        .apply-filters-float-btn {
            background-image: linear-gradient(0deg, #0a4eb3, #0b5ed7);
            border: none;
            border-radius: 8px;
            color: #fff;
            cursor: pointer;
            font-size: 16px;
            font-weight: 700;
            height: 64px;
            line-height: 64px;
            outline: none;
            padding: 0;
            position: absolute;
            right: -135px;
            text-align: center;
            width: 120px;
            z-index: 1010;
        }

        .apply-filters-float-btn:before {
            background-image: linear-gradient(45deg, #0a4eb3, #0b5ed7);
            border-radius: 4px;
            content: "";
            display: block;
            height: 45px;
            left: -5px;
            position: absolute;
            top: 10px;
            transform: rotate(135deg);
            width: 45px;
            z-index: 0;
        }

        .apply-filters-float-btn:after {
            background-image: inherit;
            border-radius: inherit;
            box-shadow: inherit;
            content: attr(data-label);
            display: block;
            height: 100%;
            left: 0;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 1;
        }

        .price {

            input {
                border-radius: 6px;
                border: 1px solid black;

                &:focus {
                    border: 1px solid;
                }
            }


        }

        div ul {
            font-size: 14px;

            li {
                position: relative;
                margin: 0;
                padding: 6px 0 6px 41px;
                transition: .3s;

                &:hover {
                    background-color: #007bff98;
                }
            }
        }

        .ui-checkbox__input {
            height: 0;
            margin: 0 !important;
            opacity: 0;
            position: absolute;
            top: 50%;
        }

        .ui-checkbox__box {
            background: #fff;
            border: 1px solid #afafaf;
            border-radius: 4px;
            box-sizing: border-box;
            height: 16px;
            left: 10px;
            position: absolute;
            top: 10px;
            transition: all .25s cubic-bezier(.4, 0, .23, 1);
            width: 16px;

            &:hover {
                background-color: #007bff;
            }
        }

        .ui-checkbox__input:checked+.ui-checkbox__box {
            animation: shrink-bounce .2s cubic-bezier(.4, 0, .23, 1);
            background-color: #007bff;
            border: 6px solid #007bff;
            ;
        }

        .ui-checkbox__box_list {
            left: 15px;
            top: 7px;
        }

        .ui-checkbox__input:checked+.ui-checkbox__box::after {
            animation: checkbox-check 125ms cubic-bezier(.4, 0, .23, 1) .25s forwards;
            border-bottom: 2px solid transparent;
            border-right: 2px solid transparent;
            box-sizing: content-box;
            content: "";
            height: 7px;
            left: -3px;
            position: absolute;
            top: 1px;
            transform: rotate(45deg);
            transform-origin: 0 100%;
            width: 3px;
        }
    }

    span a {
        cursor: pointer;
        color: #4a88ec;
    }

    .card-thumb img {
        max-width: 100%;
        height: auto;
    }

    .card-thumb a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .product-cards {
        height: fit-content;
        position: relative;
        width: 100%;
        max-height: fit-content;
        overflow: hidden;
        display: flex;
        flex-wrap: wrap;
    }

    .product-card,
    .type-card {
        /* border: 1px solid #ddd; */
        transition: all .5s;
        padding: 10px 20px;
        position: relative;
        float: left;
        width: 220px;
        height: 300px;
        word-wrap: break-word;

        flex: 0 1 25%;
        box-sizing: border-box;
    }

    .product-card:hover,
    .type-card:hover {
        box-shadow: 0 2px 16px rgba(0, 0, 0, .24);
        transform: translateY(-5px);
    }

    .type-thumb {
        width: 100%;
        height: 220px;
        text-align: center
    }

    .type-thumb>a {
        display: block;
        width: 100%;
        height: 100%;
    }

    .type-thumb img {
        max-width: 100%;
        max-height: 220px;
        height: auto;
    }

    .type-caption {
        width: 100%;
        height: 120px;
    }

    .type-title {
        height: 100%;
        overflow: hidden;
    }

    .type-title a {
        text-decoration: none;
        color: #354751;
    }

    .offer {
        color: #fff;
        position: absolute;
        top: 5px;
        left: 5px;
        z-index: 10;
        text-transform: uppercase;
    }

    .offer>div {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        font-weight: bold;
        margin-bottom: 3px;
        font-size: 14px;
        user-select: none;
    }

    .offer-hit {
        background-color: #ff8400;
    }

    .offer-sale {
        background-color: #007bff;
    }

    .fa-xmark {
        color: red;
    }

    .card-thumb {
        height: 150px;
        text-align: center;
    }

    .card-thumb img {
        max-height: 150px;
    }

    .card-caption {
        margin-top: 20px;
    }

    .card-title {
        height: 75px;
        overflow: hidden;
    }

    .card-title a {
        text-decoration: none;
        color: #354751;
    }

    .card-title a:hover,
    .product-card:hover .card-title a {
        display: inline;
        border-bottom: 1px solid #354751;
    }

    .card-price {
        font-size: 16px;
        // margin-top: 15px;
    }

    .product-buy del {
        color: #337ab7;
    }

    .card-desc {
        width: 100%;
        max-height: 200px;
        overflow: hidden scroll;
    }

    .product-item-thumb {
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .product-item-thumb img {
        max-height: 500px;
        display: block;
        max-width: 100%;
    }

    .nan__product {
        display: flex;
        margin-bottom: 15px;
        width: 100%;
        height: 100%;
        justify-content: center;
        align-items: center;
    }

    .product-characteristics__spec {
        grid-gap: 16px;
        align-items: center;
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        height: 45px;
    }

    .product-characteristics-content {
        height: auto;
    }

    .product-characteristics__spec-title {
        border-bottom: 1px dotted #ddd;
    }

    .hits,
    .sales {
        height: 370px;
        padding-left: 40px;
        padding-right: 40px;
    }
}
</style>
