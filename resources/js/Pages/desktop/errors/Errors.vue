<script setup>
import { computed } from 'vue'
import { usePage, Link, Head } from '@inertiajs/vue3';

const title = computed(() => {
    return {
        503: '503: Service Unavailable',
        500: '500: Server Error',
        404: '404: Page Not Found',
        403: '403: Forbidden',
    }[usePage().props.status]
})

const description = computed(() => {
    return {
        503: 'Sorry, we are doing some maintenance. Please check back soon.',
        500: 'Whoops, something went wrong on our servers.',
        404: 'Sorry, the page you are looking for could not be found.',
        403: 'Sorry, you are forbidden from accessing this page.',
    }[usePage().props.status]
})
</script>

<template>

    <Head>
        <title>Ошибка {{ title }}</title>
    </Head>
    <div>
        <h1>{{ title }}</h1>
        <div>{{ description }}</div>
        <Link :href="route('index')">Вернуться назад</Link>
    </div>
</template>
