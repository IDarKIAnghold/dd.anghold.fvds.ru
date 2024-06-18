<script setup lang="js">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const tab = ref('')

const showSubmenu = ref(false);
const currentCategory = ref('');

function showTab(catalogs) {
    if (tab.value == catalogs)
        tab.value = ''
    else
        tab.value = catalogs
}

function hideTabs() {
    tab.value = ''
}

function inputSearch(event) {
    console.log(event.target.value);
}


</script>
<template>
    <div class="tabs_lists" v-show="tab !== ''">
        <div class="homepage__catalog-container categories" v-show="tab == 'catalog'">
            <div class="homepage__catalog">
                <ul>
                    <li>
                        <Link class="category_tabs_item" href="/category/Guitars" v-on:click="hideTabs">
                        Гитары
                        </Link>
                    </li>
                    <li>
                        <Link class="category_tabs_item" href="/category/Guitar_equipment" v-on:click="hideTabs">
                        Гитарное оборудываине
                        </Link>
                    </li>
                    <li>
                        <Link class="category_tabs_item" href="/category/Accessories" v-on:click="hideTabs">
                        Аксессуары
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
        <div class="homepage__catalog-container categories" v-show="tab == 'profile'">
            <div class="homepage__catalog">
                <ul>
                    <li>
                        <template v-if="$page.props.user">
                            <Link class="category_tabs_item" :href="route('profile')" v-on:click="hideTabs">
                            <i class="fa-solid fa-user"></i>
                            Профиль
                            </Link>
                        </template>
                        <template v-else>
                            <Link class="category_tabs_item" :href="route('form')" v-on:click="hideTabs">
                            <i class="fa-solid fa-user"></i>
                            Авторизация
                            </Link>
                        </template>
                    </li>
                    <li>
                        <Link class="category_tabs_item" href="/favorite" v-on:click="hideTabs">
                        <i class="fa-solid fa-heart"></i>
                        Избранное
                        </Link>
                    </li>
                    <li>
                        <Link class="category_tabs_item" href="/cart" v-on:click="hideTabs">
                        <i class="fa-solid fa-cart-shopping"></i>
                        Корзина
                        </Link>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container-xxl mt-0">
            <div class="navbar-collapses d-flex">
                <span @click="hideTabs()">
                    <Link href="/">
                    <i class="fa-solid fa-house"></i>
                    <p>Главная</p>
                    </Link>
                </span>

                <span @click="showTab('catalog')">
                    <i class="fa-solid fa-list"></i>
                    <p>Каталог</p>
                </span>

                <span @click="showTab('search')">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <p>Поиск</p>
                </span>

                <span @click="showTab('profile')">
                    <i class="fa-solid fa-user"></i>
                    <p>Профиль</p>
                </span>
            </div>
        </div>
    </nav>
</template>
<style lang="scss">
.tabs_lists {
    height: 100vh;
    width: 100%;
    margin-bottom: 10%;
    background-color: white;
    position: fixed;
    top: 0;
    left: 0;
    z-index: 1;
    padding: 5% 1%;

    .fa-solid.fa-heart {
        color: black;
    }

    .categories {
        .homepage__catalog>ul {
            display: flex;
            flex-wrap: wrap;
            height: fit-content;
        }

        .homepage__catalog>ul>li {
            width: 100%;
            cursor: pointer;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 10px;
        }

        .category_tabs_item {
            float: left;
            margin: 10px;
            text-decoration: none;
            color: #333;

            &:hover {
                color: #0dcaf0;
            }

        }
    }
}

.navbar {
    margin: 0;
    position: fixed;
    bottom: 0;
    left: 0;
    width: 100%;
    z-index: 2;

    .navbar-collapses {
        width: 100%;
        justify-content: space-between;
        margin: 0 2%;
        padding-top: 1%;
        color: white;
        height: fit-content;

        span {
            text-align: center;
            margin-bottom: -5%;

            a {
                color: white;
                text-decoration: none;
            }
        }

        i {
            font-size: 18px;
        }
    }
}
</style>
