<script setup lang="js">
import { Link } from '@inertiajs/vue3';
import { ref } from 'vue';


const showSubmenu = ref(false);
const currentCategory = ref('');

function catalogshow(catalogs) {
    currentCategory.value = catalogs[0]['name'];
    $('.fa-angle-down').toggleClass('fa-rotate-180');
    showSubmenu.value = !showSubmenu.value;

}

function showSubMenu(categoryName) {
    currentCategory.value = categoryName;
}

function hideSubMenu() {
    // $('.fa-angle-down').toggleClass('fa-rotate-180');
    // showSubmenu.value = false;
}

function inputSearch(event) {
    console.log(event.target.value);
}

function hideAll() {
    $('.fa-angle-down').removeClass('fa-rotate-180');
    $('.search').val('')
    showSubmenu.value = false
}
</script>

<template>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid container-xxl mt-0">
            <div class="navbar-collapses">
                <div class="catalog-container mx-2" id="catalog">
                    <div class="catalog">
                        <div class="me-3">
                            <div class="d-flex h-100">
                                <Link class="btn btn-primary category-dropdown-toggle navbar-brand p-0 m-0 px-3"
                                    href="/" @click="hideAll">
                                <img height="45vh" src="/favicon.svg" alt="">
                                </Link>
                                <div class="btn btn-primary category-dropdown-toggle"
                                    v-on:click="catalogshow($page.props.CategoryList)">
                                    <i class="m-1"> Каталог</i>
                                    <i class="m-1 fa-solid fa-angle-down"></i>
                                </div>
                            </div>
                        </div>
                        <form class="input-group" autocomplete="off">
                            <input @input="inputSearch($event)"
                                :value="route().params['search'] ? route().params['search'].replace(/-/g, ' ') : ''"
                                class="form-control mr-sm-2 search" type="search" name="search" placeholder="Поиск"
                                aria-label="Search">
                            <button class="btn btn-primary my-2 my-sm-0" type="submit">Поиск</button>
                        </form>
                        <div class="homepage__catalog-container categories" @mouseleave="hideSubMenu"
                            v-show="showSubmenu">
                            <div class="homepage__catalog">
                                <ul>
                                    <li v-for="catalog in $page.props.CategoryList" :key="catalog.id"
                                        class="homepage__catalog__item"
                                        :class="{ 'active': currentCategory === catalog.name }"
                                        @mouseenter="showSubMenu(catalog.name)">
                                        <Link :href="'/category/' + catalog.name" @click="hideAll">
                                        {{ catalog.name_ru }}
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                            <div class="homepage-catalog-submenu">
                                <ul>
                                    <li class="homepage-catalog-submenu__item"
                                        v-for="catalog in $page.props.CategoryList" :key="catalog.id" :id="catalog.name"
                                        v-show="currentCategory === catalog.name">
                                        <Link v-for="catalogtype in catalog.product_type" :key="catalogtype.id"
                                            class="category_tabs_item" :href="'/type/' + catalogtype.name"
                                            @click="hideAll">
                                        {{ catalogtype.name__ru }}
                                        </Link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-inline mx-2">
                    <div class="d-flex h-100">
                        <Link class="btn btn-primary category-dropdown-toggle navbar-brand p-0 m-0 px-3"
                            :href="route('cart')" @click="hideAll">
                        <i class="fa-solid fa-cart-shopping"></i>
                        </Link>
                        <Link class="btn btn-primary category-dropdown-toggle navbar-brand p-0 m-0 px-3"
                            :href="route('favorite')" @click="hideAll">
                        <i class="fa-regular fa-heart"></i>
                        </Link>
                    </div>
                </div>
                <div class="form-inline mx-2">
                    <Link v-if="$page.props.user" class="btn btn-info auth" :href="route('profile')"
                        v-on:click="hideAll">
                    Профиль</Link>
                    <Link v-else class="btn btn-info auth" :href="route('form')" v-on:click="hideAll">
                    <span>Авторизоваться</span>
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>
<style lang="scss">
.navbar {
    margin: 0;

    .catalog {
        display: grid;
        grid-template-rows: auto;
        grid-template-columns: 1fr 11fr;

        .homepage-catalog-submenu,
        .homepage__catalog {
            padding: 0.5rem 2rem 0.5rem 0;
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

        .homepage__catalog {
            float: left;
            height: 100%;
            border-right: 1px solid rgba(0, 0, 0, 0.1);
        }

        .homepage__catalog a {
            text-decoration: none;
            color: black;
        }

        .homepage__catalog .active {
            font-weight: bold;
            border-left: 2px solid #fc8507;
        }

        .homepage__catalog-container {
            display: grid;
            grid-template-columns: 325px 750px;

            height: 420px;

            overflow: hidden;

            position: absolute;
            z-index: 100;
            top: 100%;
            margin-top: 1%;

            background-color: #fff;
            box-shadow:
                0 0 0 1px rgba(0, 0, 0, 0.04),
                0 4px 4px rgba(0, 0, 0, 0.04),
                0 20px 40px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
        }

        .homepage__catalog>ul>li {
            cursor: pointer;
            margin-top: 5px;
            margin-bottom: 5px;
            padding: 10px;
        }

        .homepage-catalog-submenu {
            width: 750px;
            z-index: 1050;
            background-color: #fff;

            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
        }

        .homepage-catalog-submenu>ul {
            width: 100%;
            height: 100%;
        }

        .homepage-catalog-submenu__item {
            display: flex;
            flex-wrap: wrap;
            flex-direction: column;
            float: left;
            margin: 10px;
            text-decoration: none;
            color: #333;
            height: 100%;
        }

    }

    .category-dropdown-toggle {
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        align-items: center;
        text-align: center;
        justify-content: center;
        height: 100%;
    }

    .category-dropdown-toggle {
        border-radius: 0.375rem 0 0 0.375rem;
    }

    .category-dropdown-toggle:nth-child(even) {
        border-radius: 0 0.375rem 0.375rem 0;
    }

    .navbar-collapses {
        display: grid;
        grid-template-rows: 0.5fr;
        grid-template-columns: 11fr 1fr 1fr;
    }

    .cart-button,
    .auth {
        display: flex;
        flex-wrap: nowrap;
        flex-direction: row;
        align-items: center;
        text-align: center;
        justify-content: center;
        height: 100%;
        font-size: 18px;
    }
}
</style>
