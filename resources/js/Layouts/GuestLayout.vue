<script setup>
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import NavBar from "@/Components/NavBar.vue";
import { onMounted } from 'vue'
import { themeChange } from 'theme-change'
const theme = onMounted(() => {
    themeChange(false)
});
</script>
<template>
    <NavBar></NavBar>
    <section class="bg-white dark:bg-gray-900">
        <div class="container flex px-4 py-10 mx-auto">
            <div class="flex flex-col flex-auto h-full p-2">
                <slot />
            </div>
        </div>
    </section>
</template>


