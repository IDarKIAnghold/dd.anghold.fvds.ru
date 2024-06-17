    <script setup lang="jsx">
    import { Link, usePage } from '@inertiajs/vue3'
    import { ref, onMounted } from 'vue';
    import axios from 'axios';

    const buyStatus = ref(false);
    const cartIsset = ref(false);
    const favoriteIseet = ref(false)
    const rating = usePage().props.product.reviews_avg_grade;

    const formData = new FormData();
    formData.append('product_id', usePage().props.product.id);

    const snowImage = (event) => {
        $('.product-images-slider__img').attr('src', event.target.src);
    };

    const addToCart = () => {
        axios.post(route('addToCart'), formData).then(function (resp) {
            cartIsset.value = true
        })
    };

    const Favorite = () => {
        if (favoriteIseet.value == true) {
            axios.post(route('removeFromFavorite'), formData).then(function (resp) {
                favoriteIseet.value = false
            })
        } else {
            axios.post(route('addToFavorite'), formData).then(function (resp) {
                favoriteIseet.value = true
            })
        }
    }

    onMounted(() => {
        let checkCart = axios.post(route('checkCart'), formData).then(function (resp) {
            if (resp.data['message'] == 'isset') { cartIsset.value = true }
        })
        let checkFavorite = axios.post(route('checkFavorite'), formData).then(function (resp) {
            if (resp.data['message'] == 'isset') { favoriteIseet.value = true }
        })
        if (checkFavorite && checkCart) { buyStatus.value = true }
    })
</script>

<template>
    <h1 class="product-card-title">
        {{ $page.props.product.name }}
    </h1>
    <div class="row product-card-top-full">
        <div class="product-card-top-right">
            <div class="product-images-gallery__images">
                <ul v-if="$page.props.product.img" style="display: grid; grid-template-columns: 1f;">
                    <li class="product-images-gallery__pic mb-2"
                        v-for="(image, index) in JSON.parse($page.props.product.img)" :key="index" @click="snowImage">
                        <img loading="lazy" :src="'/storage/src/' + image" class="product-images-gallery__img" alt="">
                    </li>
                </ul>
            </div>
            <div class="product-card-top__images">
                <img loading="lazy"
                    :src="$page.props.product.img ? '/storage/src/' + JSON.parse($page.props.product.img)[0] : '/storage/src/row/no-image.png'"
                    class="product-images-slider__img" alt="">
            </div>
        </div>
        <div class="product-card-top-left">
            <div class="product-card-top__specs">
                <div class="product-card-top__specs__content">
                    {{ $page.props.product.content }}
                    <Link :href="'/product/' + $page.props.product.slug + '/Characteristic'">Подробнее</Link>
                </div>
                <div class="product-card-top__specs__manufacturer">
                    <img src="" alt="">
                </div>
            </div>
            <div class="product-card-top__stat">
                <span class="ui-checkbox">
                    <span class="ui-checkbox__box"></span>
                    <span>Сравнить</span>
                    <input type="checkbox" name="" id="" class="ui-checkbox__input">
                </span>
                <div class="star-rating">
                    <span v-for="n in 5" :key="n" :class="{ filled: n <= rating }">&#9733;</span>
                </div>

            </div>
            <div class="product-card-top__buy">
                <div v-if="buyStatus" class="product-buy product-buy_one-line">
                    <div class="product-buy__price-wrap">
                        <div class="product-buy__price">
                            <span :class="$page.props.product.discount > 0 ? 'discount' : ''">
                                {{ (1 - $page.props.product.discount / 100) * $page.props.product.price }}
                            </span>
                            <span v-if="$page.props.product.discount > 0" class="product-buy__prev">
                                {{ $page.props.product.price }}
                            </span>
                        </div>
                    </div>
                    <button class="button-ui wishlist-btn" @click="Favorite()">
                        <i :class="!favoriteIseet ? 'fa-regular' : 'fa-solid'" class="fa-heart"></i>
                    </button>
                    <template v-if="$page.props.product.count > 0">
                        <Link v-if="cartIsset" :href="route('cart')" class="button-ui buy-btn btn" style="">
                        В корзину
                        </Link>
                        <button v-else @click="addToCart" class="button-ui buy-btn btn btn-primary">
                            Купить
                        </button>
                    </template>
                    <template v-else>
                        <button class="button-ui buy-btn btn">
                            Уведомить
                        </button>
                    </template>
                </div>
                <div v-else class="product-buy product-buy_one-line product-buy_one-line__load"></div>
            </div>
            <div></div>
        </div>
    </div>
</template>

<style lang="scss">
.row.product-card-top-full {
    margin-bottom: 30px;
}

.product-buy__price {
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

    .product-buy__prev {
        font-size: 14px;
        line-height: 14px;
        text-decoration: line-through;

        font-size: 13px;

        span::after {
            content: "₽";
            margin-left: 4px;
            position: relative;
        }
    }


}

.product-card-title {
    display: inline-block;
    width: 100%;
    font-size: 40px
}

.product-card-top-full {
    position: relative;
    display: grid;
    grid-template-columns: 60% 40%;
    grid-template-rows: auto auto;
}

.product-card-top-right {
    height: 475px;
    display: grid;
    grid-template-columns: 15% 85%;
}

.product-card-top__specs {
    font-size: 14px;
    height: 84px;
    display: grid;
    grid-template-columns: 85% 15%;
    overflow: hidden;
}

@media screen and (max-width: 768px) {
    .product-card-top-full {
        grid-template-columns: 100%;
        grid-template-rows: auto;
    }

    .product-card-top-right {
        grid-template-columns: 25% 75%;
    }
}

.product-card-top__specs__manufacturer>img {
    width: 100%;
    height: auto;
}

.product-card-top__stat {
    display: flex;
    flex-wrap: wrap;
    gap: 4px;
    margin: 0 0 16px;

    .ui-checkbox {
        border-radius: 8px;
        padding: 6px 8px;

        position: relative;
        display: inline-block;
        margin-bottom: 0;
        padding-left: 28px;
        background: #f7f7f7
    }

    .ui-checkbox__box {
        background: #fff;
        border: 1px solid #afafaf;
        border-radius: 4px;
        box-sizing: border-box;
        height: 16px;

        position: absolute;
        left: 8px;
        top: 12px;
        transition: all .25s cubic-bezier(.4, 0, .23, 1);
        width: 16px;
    }

    .ui-checkbox__input {
        height: 0;
        margin: 0 !important;
        opacity: 0;
        position: absolute;
        top: 50%;
    }

    .star-rating {
        font-size: 25px;
        border-radius: 8px;
        background: #f7f7f7;
        padding: 0px 8px;

        span {
            cursor: pointer;
            color: #ccc;

            .filled {
                color: orange;
            }
        }
    }
}

@media screen and (max-width: 768px) {
    .product-card-top__specs__content{
        font-size: 18px;
    }
    .product-card-top__specs {
        margin-bottom: 5%;
    }
}

.product-card-top__buy .product-buy {
    display: flex;
    flex-direction: row;
    margin-bottom: 16px;
    min-height: 64px;
}

.product-buy__price-wrap,
.product-buy_one-line__load {
    background: #f7f7f7;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: center;
    min-height: 44px;
    padding: 0 16px 0 12px;
    position: relative;
    border-radius: 8px;
}

.button-ui {
    background: #f7f7f7;
    border-radius: 8px;
    margin-left: 4px;
    border: none;
}

.button-ui:hover {
    background-color: #0d6efd;
    color: white;
}

.btn-primary {
    background: #0d6efd;
}

.buy-btn {
    border: 1px solid #0d6efd;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

.wishlist-btn {
    min-height: 25px;
    min-width: 64px;
}

.product-buy__price {
    font-size: 22px;
    font-weight: 700;
    line-height: 20px;
}


.buy-btn {
    min-height: 64px;
    width: 151px;
}

.product-images-gallery__images {
    display: flex;
    justify-content: center;
    align-items: start;
    height: 100%;
    overflow: hidden scroll;
    width: 100%;
}

.product-images-gallery__images ul {
    padding: 0;
    margin: 0;
    width: 100%;
}

.product-images-gallery__img {
    cursor: zoom-in;
    aspect-ratio: auto;
    height: auto;
    border-radius: 8px;
    max-height: 80px;
    max-width: 80px;
    position: relative;
    width: auto;
    z-index: 1;
}

.product-images-gallery__pic {
    align-items: center;
    display: inline-flex;
    height: auto;
    justify-content: center;
    position: relative;
}

.product-images-slider__img {
    aspect-ratio: auto;
    height: auto;
    max-height: 475px;
    max-width: 100%;
    width: auto;
}
</style>
