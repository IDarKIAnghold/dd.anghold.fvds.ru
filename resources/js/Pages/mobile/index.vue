<script setup lang="js">
import { Head, Link } from '@inertiajs/vue3'
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/swiper-bundle.css';

</script>

<template>

    <Head>
        <title>Главная страница</title>
    </Head>

    <div class="index row">
        <div class="container mb-5">
            <div class="fw-bold mb-4 fs-3">Каталог</div>
            <div class="catalog-block-menu">
                <template v-for="item in $page.props.CategoryList">
                    <Link v-for="catalog in item.product_type" :href="'/type/' + catalog.name"
                        class="catalog-block-menu__item">
                    <div class="catalog-block-menu__name">{{ catalog.name__ru }}</div>
                    <div class="catalog-block-menu__image">
                        <picture>
                            <img loading="lazy" :src="'/storage/src/row/type/' + catalog.name + '.png'" alt="">
                        </picture>
                    </div>
                    </Link>
                </template>
            </div>
        </div>

        <div class="container mb-4">
            <div class="fw-bold mb-4 fs-3">Классические гитары</div>
            <Swiper :spaceBetween="20" :slidesPerView="2.3" class="product-slider-block__list">
                <SwiperSlide v-for="catalog in $page.props.classical" :key="catalog.id">
                    <Link :href="'/product/' + catalog.slug" class="product-slider-block__card">
                    <div class="product-slider-block__image">
                        <img loading="lazy" :src="'/storage/src/' + JSON.parse(catalog.img)[0]" alt="">
                    </div>
                    <div class="product-slider-block__name">
                        {{ catalog.name }}
                    </div>
                    <div class="product-slider-block__price">
                        {{ catalog.price }}
                    </div>
                    </Link>
                </SwiperSlide>
            </Swiper>
        </div>

        <div class="container mb-4">
            <div class="fw-bold mb-4 fs-3">Акустические гитары</div>
            <Swiper :spaceBetween="20" :slidesPerView="2.3" class="product-slider-block__list">
                <SwiperSlide v-for="catalog in $page.props.acoustic" :key="catalog.id">
                    <Link :href="'/product/' + catalog.slug" class="product-slider-block__card">
                    <div class="product-slider-block__image">
                        <img loading="lazy" :src="'/storage/src/' + JSON.parse(catalog.img)[0]" alt="">
                    </div>
                    <div class="product-slider-block__name">
                        {{ catalog.name }}
                    </div>
                    <div class="product-slider-block__price">
                        {{ catalog.price }}
                    </div>
                    </Link>
                </SwiperSlide>
            </Swiper>
        </div>

        <div class="container mb-4">
            <div class="fw-bold mb-4 fs-3">Электрогитары</div>
            <Swiper :spaceBetween="20" :slidesPerView="2.3" class="product-slider-block__list">
                <SwiperSlide v-for="catalog in $page.props.electricguitar" :key="catalog.id">
                    <Link :href="'/product/' + catalog.slug" class="product-slider-block__card">
                    <div class="product-slider-block__image">
                        <img loading="lazy" :src="'/storage/src/' + JSON.parse(catalog.img)[0]" alt="">
                    </div>
                    <div class="product-slider-block__name">
                        {{ catalog.name }}
                    </div>
                    <div class="product-slider-block__price">
                        {{ catalog.price }}
                    </div>
                    </Link>
                </SwiperSlide>
            </Swiper>
        </div>

        <div class="container mb-4">
            <div class="fw-bold mb-4 fs-3">Бас-гитары</div>
            <Swiper :spaceBetween="20" :slidesPerView="2.3" class="product-slider-block__list">
                <SwiperSlide v-for="catalog in $page.props.basguitar" :key="catalog.id">
                    <Link :href="'/product/' + catalog.slug" class="product-slider-block__card">
                    <div class="product-slider-block__image">
                        <img loading="lazy" :src="'/storage/src/' + JSON.parse(catalog.img)[0]" alt="">
                    </div>
                    <div class="product-slider-block__name">
                        {{ catalog.name }}
                    </div>
                    <div class="product-slider-block__price">
                        {{ catalog.price }}
                    </div>
                    </Link>
                </SwiperSlide>
            </Swiper>
        </div>

    </div>
</template>

<style lang="scss">
.index.row {
    z-index: 1;
    .container {
        width: 100%;
        max-width: 1440px;
        margin: 0 auto;
        padding: 0;

        .catalog-block-menu {
            display: grid;
            grid-template-columns: 1fr 1fr;
            column-gap: 40px;
            row-gap: 40px;

            .catalog-block-menu__item {
                position: relative;
                padding: 15px;

                background-color: #fff;
                // border: 1px solid #000;
                border-radius: 8px;
                overflow: hidden;

                // box-shadow: 6px 6px 0 rgba(62, 15, 85, .25) ;

                text-decoration: none;
                color: #000;

                &:hover {
                    box-shadow: 0 2px 16px rgba(0, 0, 0, .24);
                    transform: translateY(-5px);
                }


                .catalog-block-menu__name {
                    display: block;
                    // height: 2.5em;
                    font-size: 18px;
                    line-height: 1.2em;
                    text-align: center;
                }

                .catalog-block-menu__image {
                    position: relative;
                    width: 100%;
                    height: 230px;

                    img {
                        position: absolute;
                        display: block;
                        top: 0;
                        left: 0;
                        width: 100%;
                        height: 100%;
                        -o-object-fit: contain;
                        object-fit: contain;
                        filter: blur(0);
                    }
                }
            }
        }

        .product-slider-block__list {
            list-style: none;
            padding: 0 10px;
            margin: 0;

            .swiper-wrapper {
                .swiper-slide {
                    width: 186px;
                    margin-right: 20px;

                    .product-slider-block__card {
                        display: flex;
                        flex-direction: column;
                        height: 100%;
                        padding: 14px 10px 9px;
                        position: relative;
                        border-radius: 8px;
                        user-select: none;
                        transition: opacity .5s;
                        text-decoration: none !important;
                        text-align: left;

                        &:hover {
                            box-shadow: 0 2px 16px rgba(0, 0, 0, .24);
                            transform: translateY(-5px);
                        }

                        .product-slider-block__image {
                            position: relative;
                            aspect-ratio: 1;
                            user-select: none;

                            img {
                                user-select: none;
                                position: absolute;
                                display: block;
                                top: 0;
                                left: 0;
                                width: 100%;
                                height: 100%;
                                -o-object-fit: contain;
                                object-fit: contain;
                                filter: blur(0);
                            }
                        }

                        .product-slider-block__name {
                            font-size: 14px;
                            overflow: hidden;
                            text-overflow: ellipsis;
                            font-weight: 600;
                            height: 1%;
                            margin-top: 0;
                            margin-bottom: 4px;
                        }

                        .product-slider-block__price {
                            margin: 0 0 2px;
                            font-weight: 700;
                            font-size: 24px;
                            line-height: 130%;
                            display: flex;
                            align-items: flex-start;

                            &::after {
                                content: "₽";
                                margin-left: 4px;
                                position: relative;
                            }
                        }
                    }
                }
            }
        }
    }

}
</style>
