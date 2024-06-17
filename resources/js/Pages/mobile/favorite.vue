<script land="jsx" setup>
import { Head, Link, router } from '@inertiajs/vue3'
</script>
<template>

    <Head>
        <title>Избранное</title>
    </Head>

    <template v-if="Object.keys($page.props.favorite).length > 0">
        <div class="row favorite">
            <div class="product-cards">
                <div v-for="item in $page.props.favorite" class="product-card"
                    @click="router.visit('/product/' + item.product.slug)">
                    <div class="card-thumb">
                        <Link :href="'/product/' + item.product.slug">
                        <img loading="lazy"
                            :src="item.product.img ? '/storage/src/' + JSON.parse(item.product.img)[0] : '/storage/src/row/no-image.png'">
                        </Link>
                    </div>
                    <div class="card-caption">
                        <div class="card-title">
                            <Link :href="'/product/' + item.product.slug">
                            {{
                                item.product.name
                            }}
                            </Link>
                        </div>
                        <div class="card-price">
                            <span :class="item.product.old_price > 0 ? 'discount' : ''">
                                {{ item.product.price }}
                            </span>
                            <del v-if="item.product.old_price > 0">
                                {{ item.product.old_price }} руб.
                            </del>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    <template v-else>
        <div class="row">
            <h5 class="text-center">Тут пусто</h5>
        </div>
    </template>

</template>
<style lang="scss">
.favorite {
    .product-cards {
        height: fit-content;
        position: relative;
        width: 100%;
        max-height: fit-content;
        overflow: hidden;
        display: grid;
        grid-template-columns: 1fr 1fr;
    }

    .product-card,
    .type-card {
        /* border: 1px solid #ddd; */
        transition: all .5s;
        padding: 10px 20px;
        position: relative;
        float: left;
        height: 300px;
        word-wrap: break-word;

        flex: 0 1 20%;
        box-sizing: border-box;
    }

    .product-card:hover,
    .type-card:hover {
        box-shadow: 0 2px 16px rgba(0, 0, 0, .24);
        transform: translateY(-5px);
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
}
</style>