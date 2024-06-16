<script setup lang='jsx'>
import { Link, usePage, router } from '@inertiajs/vue3'
import { ref, computed } from 'vue';

const page = ref(usePage().props.page);
const count = ref(usePage().props.pageCount);

let baseUrl = window.location.pathname.split('?')[0];

const getPageLink = (pageNumber) => {
    if (pageNumber > pageLast || pageNumber < 1) return
    let params = route().params
    params['page'] = pageNumber
    page.value = pageNumber
    router.put(route('type', params))
};
</script>

<template>

    <template v-if="$page.props.catalog.length > 0">
        <div class="product-cards">

            <div v-for="item in $page.props.catalog" class="product-card"
                @click="router.visit('/product/' + item.slug)">
                <div class="card-thumb">
                    <Link :href="'/product/' + item.slug">
                    <img loading="lazy"
                        :src="item.img ? '/storage/src/' + JSON.parse(item.img)[0] : '/storage/src/row/no-image.png'">
                    </Link>
                </div>
                <div class="card-caption">
                    <div class="card-title">
                        <Link :href="'/product/' + item.slug">
                        {{
                            item.name
                        }}
                        </Link>
                    </div>
                    <div class="card-price">
                        <span :class="item.old_price > 0 ? 'discount' : ''">
                            {{ item.price }}
                        </span>
                        <del v-if="item.old_price > 0">
                            {{ item.old_price }} руб.
                        </del>
                    </div>
                </div>
            </div>

        </div>
           
    </template>

    <template v-else-if="$page.props.catalog.length <= 0">
        <div class="d-flex flex-row justify-content-between">
            <div class="text-center w-100">
                <h5>Здесь ничего нет</h5>
            </div>
        </div>
    </template>
</template>
<style lang='scss'>
.pagenav {
    display: flex;
    justify-content: center;
    margin: 20px 0;

    .pagenav-item {
        width: 40px;
        height: 40px;
        margin: 0 3px;

        color: #333;
        text-align: center;
        text-decoration: none;
        line-height: 40px;

        user-select: none;

        background-color: #ddd;
    }

    .pagenav-item:hover {
        background-color: #ccc;
        color: #333;
    }


}

.pagenav-item.active {
    cursor: pointer;
    background-color: #0dcaf0;
    color: #fff;
}

.card-price {
    span {
        margin-right: 5px;
        font-size: 18px;

        &::after {
            content: "₽";
            margin-left: 4px;
            position: relative;
        }
    }

    .discount {
        color: #337ab7;
    }

    del {
        font-size: 13px;

        &::after {
            content: "₽";
            margin-left: 4px;
            position: relative;
        }
    }

}
</style>
