<script setup lang='jsx'>
import { Link } from '@inertiajs/vue3'

</script>
<template>
    <div class="product-cards">
        <div v-for="item in $page.props.catalog" class="type-card">
            <div class="type-thumb">
                <Link :href="'/type/' + item.name">
                <img loading="lazy" :src="'/storage//src/row/type/' + item.name + '.png'" alt="">
                </Link>
            </div>
            <div class="type-caption">
                <div class="type-title">
                    <Link :href="'/type/' + item.name">
                    {{ item.name__ru }}
                    </Link>
                </div>
            </div>
        </div>
    </div>
</template>
