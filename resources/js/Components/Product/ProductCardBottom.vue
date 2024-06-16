<script setup lang="jsx">
import { ref } from 'vue';
import { router, usePage } from '@inertiajs/vue3';

const state = ref(usePage().props.states);
const descriptionSection = ref(null);

const snowTab = (event) => {
    const id = event.currentTarget.getAttribute('id');
    state.value = id;
};
switch (usePage().props.states.toLowerCase()) {
    case 'description':
    case 'reviews':
    case 'characteristic':
        setTimeout(() => {
            descriptionSection.value.scrollIntoView({ behavior: 'smooth' });
        }, 100);
        break;
    default:
        state.value = 'Description';
        break;
}

const reviews = () => {
    router.visit('/reviews/' + route().params['slug'])
}

const formatDate = function (inputDateString) {
    const inputDate = new Date(inputDateString);
    const day = inputDate.getDate().toString().padStart(2, '0');
    const month = (inputDate.getMonth() + 1).toString().padStart(2, '0');
    const year = inputDate.getFullYear();

    return `${day}.${month}.${year}`;
}
</script>


<template>
    <div class="row product-card-bottom-full" ref="descriptionSection">
        <ul class="product-card-tabs__list">
            <li @click="snowTab" :id="'Description'" :class="{ active: state == 'Description' }">
                Описание
            </li>
            <li @click="snowTab" :id="'Characteristic'" :class="{ active: state == 'Characteristic' }">
                Характеристика
            </li>
            <li @click="snowTab" :id="'Reviews'" :class="{ active: state == 'Reviews' }">
                Отзывы
            </li>
        </ul>
        <div class="product-card-tabs__contents">
            <div class="product-card-description" v-show="state == 'Description'" :id="'Description'">
                <h3 class="product-card-description__title">
                    Описание
                </h3>
                <div>
                    {{ $page.props.product.description }}
                </div>
            </div>
            <div class="product-card-characteristic" v-show="state == 'Characteristic'" :id="'Characteristic'">
                <h3 class="product-card-characteristic__title">
                    Характеристика
                </h3>
                <div>
                    <span>
                        Тип
                    </span>
                    <span>
                        {{ $page.props.product.type.name__ru }}
                    </span>
                </div>
                <div>
                    <span>
                        Производитель
                    </span>
                    <span>
                        {{ $page.props.product.manufacturer.name }}
                    </span>
                </div>
                <template v-for="item in $page.props.product.product_attributes">
                    <div v-if="item.value">
                        <span>
                            {{ item.attributes.name }}
                        </span>
                        <span>
                            {{ item.value }}
                        </span>
                    </div>
                </template>
            </div>
            <div class="product-card-reviews" v-show="state == 'Reviews'" :id="'Reviews'">
                <div class="d-flex justify-content-between mb-3 pb-2 ow-opinions__item">
                    <div>
                        <h3 class="product-card-reviews__title">
                            Отзывы
                        </h3>
                    </div>
                    <div>
                        <button class="btn btn-primary" @click="reviews" v-if="$page.props.user">
                            Оставить отзыв
                        </button>
                    </div>

                </div>
                <template v-if="Object.keys($page.props.product.reviews).length > 0"
                    v-for="item in $page.props.product.reviews">
                    <div class="ow-opinion ow-opinions__item">
                        <div class="ow-opinion__header">
                            <div class="ow-opinion__header-top">
                                <div class="ow-opinion__header-left">
                                    <div class="profile-info">
                                        <div class="profile-info__user">
                                            <div class="profile-info__avatar-wrapper">
                                                <div class="profile-info__avatar-wrapper">
                                                    <div class="profile-info__avatar">
                                                        <img alt="" class="loaded"
                                                            :src="'/storage/src/profile/' + item.user.img">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="profile-info__user-data">
                                                <div class="profile-info__name ">
                                                    {{ !item.user.nickname ? item.user.first_name + ' ' +
                                                        item.user.last_name : item.user.nickname }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="profile-info__activity">
                                        <div class="ow-opinion__date-site">
                                            <span> {{ formatDate(item.created_at) }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="ow-opinion__header-right">
                                    <div class="ow-opinion__date-site">
                                        <div class="star-rating">
                                            <span v-for="n in 5" :key="n"
                                                :class="{ filled: n <= item.grade }">&#9733;</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="ow-opinion__texts">
                            <div class="ow-opinion__text-title">Достоинства</div>
                            <div class="ow-opinion__text-desc">
                                <p>{{ item.plus }}</p>
                            </div>
                        </div>
                        <div class="ow-opinion__texts">
                            <div class="ow-opinion__text-title">Недостатки</div>
                            <div class="ow-opinion__text-desc">
                                <p>{{ item.minus }}</p>
                            </div>
                        </div>
                        <div class="ow-opinion__texts" v-if="item.comment">
                            <div class="ow-opinion__text-title">Комментарий</div>
                            <div class="ow-opinion__text-desc">
                                <p>{{ item.comment }}</p>
                            </div>
                        </div>
                    </div>
                </template>
                <template v-else-if="Object.keys($page.props.product.reviews).length <= 0">
                    <div>
                        <h5>Отзывы отсутствуют</h5>
                    </div>
                </template>
            </div>
        </div>
        <p></p>
    </div>
</template>
<style lang="scss">
.product-card-tabs__list {
    list-style: none;
    margin: 0;
    padding: 0;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
}

.product-card-tabs__list li {
    float: left;
    text-align: center;
    border: 1px solid #ccc;
    padding: 16px 0;
    cursor: pointer;
    user-select: none;
}

.product-card-description,
.product-card-characteristic,
.product-card-reviews {
    margin-top: 15px;
}

.product-card-description {
    div {
        white-space: pre-wrap
    }

}

.product-card-characteristic {
    div {
        display: grid;
        grid-template-columns: 2fr 3fr;
        padding: 5px 2px;
        margin: 5px 0 5px 0;
    }
}

.product-card-tabs__list .active {
    color: white;
    background: #0dcaf0;
}

.ow-opinion+.ow-opinion {
    margin-top: 20px;
}

.ow-opinions__item {
    border-bottom: 1px solid #d9d9d9;
}

.ow-opinion {
    padding-bottom: 15px;
    position: relative;
}

.ow-opinion__header {
    margin-bottom: 28px;
}

.ow-opinion__header-left {
    align-items: center;
    display: flex;
    justify-content: space-between;
    margin-bottom: 12px;
}

.profile-info__user,
.profile-info__user-data {
    align-items: center;
    display: flex;
}

.profile-info__avatar-wrapper {
    display: flex;
    height: 46px;
    margin-right: 15px;
    position: relative;
    width: 46px;
}

.profile-info__avatar-wrapper {
    display: flex;
    height: 46px;
    margin-right: 15px;
    position: relative;
    width: 46px;
}

.profile-info__avatar {
    align-items: center;
    border-radius: 50%;
    display: flex;
    height: 46px;
    justify-content: center;
    padding: 4px;
    width: 46px;
}

.profile-info__avatar img,
.profile-info__avatar svg {
    border-radius: 50%;
    height: 100%;
    width: 100%;
}

.profile-info__name {
    color: #0d61af;
    cursor: pointer;
    font-size: 16px;
    font-weight: 700;
    height: 26px;
    margin-right: 12px;
    transition-duration: .3s;
}

.profile-info__activity .ow-opinion__date-site {
    display: flex;
    flex-direction: column;
}

.ow-opinion__date-site {
    color: #8c8c8c;
    font-size: 14px;
}

.ow-opinion__date {
    margin-right: 9px;
}

.star-rating {
    width: fit-content;
    font-size: 25px;
    border-radius: 8px;
    background: #eee;
    padding: 0px 8px;

}

.star-rating span {
    cursor: pointer;
    color: #ccc;
}

.star-rating span.filled {
    color: orange;
}

.ow-opinion__text {
    color: #333;
    font-size: 16px;
}

.ow-opinion__text-title {
    align-items: center;
    display: flex;
    font-weight: 700;
    margin-bottom: 12px;
}

.ow-opinion__text-desc {
    line-height: 24px;
    white-space: pre-wrap;
    word-break: break-word;
}
</style>
