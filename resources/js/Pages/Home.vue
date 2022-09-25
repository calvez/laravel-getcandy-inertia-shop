<template>

    <Head>
        <title>Frontpage</title>
        <meta name="description" content="Recently uploaded videos" />
    </Head>
    <GuestVue>
    <pre class="text-white">
    {{$page.props.currentLanguage}}
    </pre>
        <div class="grid grid-cols-1 gap-8 md:grid-cols-3 xl:grid-cols-4">
            <div v-for="product in products.data" :key="product.id">
                <ProductCard :product="product"></ProductCard>
            </div>
        </div>
        <PaginationVue :links="products.links" />
    </GuestVue>
</template>

<script>
import { Head, Link } from "@inertiajs/inertia-vue3";
import ProductCard from "@/Components/ProductCard.vue";
import GuestVue from "@/Layouts/GuestLayout.vue";
import PaginationVue from "@/Components/Pagination.vue";
export default {
    components: {
        GuestVue,
        Head,
        ProductCard,
        PaginationVue,
    },
    props: {
        products: Object,
    }
};
</script>

