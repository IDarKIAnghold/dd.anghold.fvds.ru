<script setup lang="jsx">
import { Head } from '@inertiajs/vue3'

import ProductCardTop from '@/Components/Product/ProductCardTop.vue';
import ProductCardBottom from '@/Components/Product/ProductCardBottom.vue';


</script>
<template>

    <Head>
        <title>
            Характеристика
            {{
                $page.props.product.name
            }}
        </title>
    </Head>
    <ProductCardTop />
    <ProductCardBottom />
</template>
<style></style>
