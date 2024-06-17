<script setup lang="jsx">
import { Head, Link } from '@inertiajs/vue3'
</script>

<template>

    <Head>
        <title>
            Подтверждение почты
        </title>
    </Head>

    <div class="row">
        <div class="d-flex justify-content-center flex-wrap flex-column">
            <h1 class="text-center">{{ $page.props.message }}</h1>
            <div class="d-flex justify-content-center">
                <Link :href="route('profile')" class="btn btn-primary text-white">
                Вернуться в профиль
                </Link>
            </div>
        </div>
    </div>
</template>
<script lang="scss"></script>
