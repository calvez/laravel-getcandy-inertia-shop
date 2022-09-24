<template>
    <div>
        <div class="card w-96 bg-base-100 shadow-xl">
            <div v-if="product.media" v-for="media in product.media">
                <figure>
                    <img class="w-full aspect-square rounded-lg" :src="media.original_url"
                        :alt="product.attribute_data.name" :title="product.attribute_data.name" />
                </figure>
            </div>
            <div v-else>
                <figure>
                    <img class="w-full aspect-square rounded-lg" src="/storage/placeholder.jpg"
                        :alt="product.attribute_data.name" :title="product.attribute_data.name" />
                </figure>
            </div>
            <div class="card-body">
                <h2 class="card-title">{{ product.attribute_data.name }}</h2>
                <p>{{ product.attribute_data.description ?? "&nbsp;" }}</p>
                <p>{{ product.brand ?? "&nbsp;" }}</p>
                <p>{{ product.attribute_data.description ?? "&nbsp;" }}</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Buy Now</button>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
export default {
    name: "VideoCard",
    components: {
        Link,
    },
    props: {
        product: { type: Object, required: true },
    },
    data() {
        return {
            currentUrl: location.toString(),
            host: location.host,
        };
    },
};
</script>

