<script setup lang="js">
import { Head } from '@inertiajs/vue3'
</script>

<template>

    <Head>
        <title>О нас</title>
    </Head>

    <div class="about">
        <div class="row">
            <div class="about mb-4">
                <div class="about-about__title mb-4">
                    <h2>Мы продаём товары</h2>
                </div>
                <div class="about-about__subtitle">Мы что-то продаём, а вы покупаете)</div>
            </div>
            <div class="info-for-everyone">
                <div class="info-for-everyone__section-box">
                    <div class="info-for-everyone__title"><i class="fa-solid fa-user"></i><span>Для
                            клиентов</span></div>
                    <div class="info-for-everyone__list">
                        <span>
                            <ul>
                                <li>Наши клиенты – в центре всего, что мы делаем,</li>
                                <li>Доверие - главное. Мы строим долгосрочные отношения,</li>
                                <li>Во всём, чем занимаемся, стремимся быть экспертами,</li>
                                <li>Открыты для предложений и улучшений.</li>
                            </ul>
                        </span>
                    </div>
                </div>
                <div class="info-for-everyone__section-box">
                    <div class="info-for-everyone__title"><i class="fa-solid fa-handshake"></i><span>Для
                            партнёров</span></div>
                    <div class="info-for-everyone__list">
                        <span>
                            <ul>
                                <li>Прозрачность - основа совместного бизнеса,</li>
                                <li>Работаем, соблюдая этику бизнеса,</li>
                                <li>Выполняем обязательства и берем ответственность за свои решения,</li>
                                <li>Во всём, чем занимаемся, стремимся быть экспертами,</li>
                                <li>Нетерпимы к коррупции.</li>
                            </ul>
                        </span>
                    </div>
                </div>
                <div class="info-for-everyone__section-box">
                    <div class="info-for-everyone__title"><span>Для сотрудников</span></div>
                    <div class="info-for-everyone__list"><span>

                        </span></div>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
.about {
    margin: 0;
    padding: 0;
    z-index: 1;

    .info-for-everyone {
        display: grid;
        grid-template-columns: 100%;
        grid-column-gap: 1em;
        margin-bottom: 40px;
    }

    .info-for-everyone__title {
        font-weight: 700;
        font-size: 20px;
        line-height: 26px;
        color: #333;
        margin-bottom: 8px;
    }

    .info-for-everyone__list ul {
        padding-left: 25px;
    }

    .info-for-everyone__title i {
        padding: 0 10px;
    }
}
</style>
