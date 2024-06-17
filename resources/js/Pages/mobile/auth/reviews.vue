<script setup lang="js">
import { reactive } from 'vue';
import { Head, router } from '@inertiajs/vue3'


const form = reactive({
    slug: route().params['product'],
    plus: null,
    minus: null,
    comment: null,
    grade: 0
})

const applyActiveClass = (e) => {
    const element = $(e.target).closest('.opinion-part-input__input-row-container')
    $(element).find('.opinion-part-input__input-row-container-label').addClass('opinion-part-input__input-row-container-label_active');
    $(element).addClass('opinion-part-input__input-row-container_active');
}
const removeActiveClass = (e) => {
    const element = $(e.target).closest('.opinion-part-input__input-row-container')

    $(element).find('.opinion-part-input__input-row-container-label').removeClass('opinion-part-input__input-row-container-label_active');
    $(element).removeClass('opinion-part-input__input-row-container_active');
}

const setRating = (rating) => {
    form.grade = rating;
}

const addReview = () => {
    router.post(route('reviewsAdd'), form)
}

</script>

<template>

    <Head>
        <title>Отзывы</title>
    </Head>

    {{ $page.props.errors.error_text }}
    <div class="row reviews">
        <div class="opinion-add-form__usage-experience-container">
            <div class="usage-experience">
                <p class="usage-experience__button-container">Опыт использования <span
                        class="usage-experience__hint-button">Что написать?</span></p><!--v-if-->
            </div>
            <div>
                <div class="star-rating">
                    <span v-for="n in 5" :key="n" :class="{ filled: n <= form.grade }"
                        @click="setRating(n)">&#9733;</span>
                </div>
                <p>Рейтинг: {{ form.grade }}</p>
            </div>

            <div class="opinion-part-input">
                <div class="opinion-part-input__input-row">
                    <div class="opinion-part-input__input-row-container">
                        <label for="opinion" class="opinion-part-input__input-row-container-label">Достоинства</label>
                        <textarea class="opinion-part-input__input" @focus="applyActiveClass($event)"
                            @blur="removeActiveClass($event)" v-model="form.plus"></textarea>
                    </div>
                </div>
                <div class="opinion-part-input__error-block" style="display: none;">
                    <div class="opinion-part-input__error-block-body"></div>
                </div>
            </div>
            <div class="opinion-part-input">
                <div class="opinion-part-input__input-row">
                    <div class="opinion-part-input__input-row-container">
                        <label for="opinion" class="opinion-part-input__input-row-container-label">Недостатки</label>
                        <textarea class="opinion-part-input__input" @focus="applyActiveClass($event)"
                            @blur="removeActiveClass($event)" v-model="form.minus"></textarea>
                    </div>
                </div>
                <div class="opinion-part-input__error-block" style="display: none;">
                    <div class="opinion-part-input__error-block-body"></div>
                </div>
            </div>
            <div class="opinion-part-input">
                <div class="opinion-part-input__input-row">
                    <div class="opinion-part-input__input-row-container">
                        <label for="opinion" class="opinion-part-input__input-row-container-label">Комментарий</label>
                        <textarea class="opinion-part-input__input" @focus="applyActiveClass($event)"
                            @blur="removeActiveClass($event)" v-model="form.comment"></textarea>
                    </div>
                </div>
                <div class="opinion-part-input__error-block opinion-add-form__usage-experience-container"
                    style="display: none;">
                    <div class="opinion-part-input__error-block-body"></div>
                </div>
            </div>
            <button class="btn btn-primary send-button__button w-100" @click.prevent="addReview">Добавить отзыв</button>

        </div>
    </div>

</template>

<style lang="scss">
.row.reviews {

    &>* {
        box-sizing: border-box;
        padding: 0;
    }

    .usage-experience__button-container {
        color: #333;
        font-size: 18px;
        font-weight: 700;
        line-height: 130%;
    }

    .opinion-part-input__input-row {
        line-height: 1.42857;
        margin: 12px 0 0;
        width: 100%;
    }

    .opinion-part-input__input-row-container {
        background-color: #f2f2f2;
        border: none;
        border-radius: 8px;
        box-sizing: border-box;
        color: #333;
        display: inline-block;
        height: 44px;
        overflow: hidden;
        position: relative;
        transition: height .2s ease 0s;
        width: 100%;
        z-index: 0;
    }

    .opinion-part-input__input-row-container-label {
        color: #8c8c8c;
        display: inline-block;
        font-size: 16px;
        font-weight: 400;
        left: 0;
        letter-spacing: .3px;
        line-height: 20px;
        margin-bottom: 5px;
        max-width: 100%;
        padding: 0 20px;
        pointer-events: none;
        position: absolute;
        top: 10px;
        transition: top .2s, font-size .2s;
        z-index: 10;
    }

    .opinion-part-input__input {
        background: transparent;
        border: none;
        box-sizing: border-box;
        color: #333;
        cursor: text;
        font-family: inherit;
        font-size: 16px;
        font-weight: 400;
        height: 100%;
        left: 0;
        line-height: 20px;
        outline: none;
        overflow: hidden;
        padding: 28px 16px 20px;
        resize: none;
        top: 0;
        width: 100%;
        z-index: 9;
    }

    .opinion-part-input__input-row-container_active,
    .opinion-part-input__input-row-container_active .input-row__input {
        min-height: 95px
    }

    .opinion-part-input__input-row-container-label_active {
        font-size: 14px;
        padding: 0 16px;
    }

    .send-button__button {
        align-items: center;
        border: none;
        display: flex;
        height: 64px;
        justify-content: center;
        outline: none;
        width: 144px;
    }

    .star-rating {
        font-size: 30px;
    }

    .star-rating span {
        cursor: pointer;
        color: #ccc;
    }

    .star-rating span.filled {
        color: orange;
    }
}
</style>
