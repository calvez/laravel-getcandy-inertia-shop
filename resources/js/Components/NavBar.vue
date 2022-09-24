<template>
    <div class="navbar bg-base-100">
        <nav class="container px-6 py-8 mx-auto md:flex md:justify-between md:items-center">
            <div class="flex items-center justify-between">
                <BreezeNavLink class="text-xl font-bold md:text-2xl "
                    :href="route('home')" :active="route().current('home')">
                    demo shop
                </BreezeNavLink>
                <!-- Mobile menu button -->
                <div @click="toggleNav" class="flex md:hidden">
                    <button type="button"
                        class=" focus:outline-none">
                        <svg viewBox="0 0 24 24" class="w-6 h-6 fill-current">
                            <path fill-rule="evenodd"
                                d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z">
                            </path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
            <ul :class="showMenu ? 'flex' : 'hidden'"
                class="flex-col mt-8 space-y-4 md:flex md:space-y-0 md:flex-row md:items-center md:space-x-10 md:mt-0">
                <BreezeNavLink class="" :href="route('home')"
                    :active="route().current('home')">
                    Videos
                </BreezeNavLink>
                <Themes/>
                <Languages/>
                <!-- <BreezeNavLink
          class="text-gray-100 hover:text-indigo-400"
          :href="route('videoList')"
          :active="route().current('videoList')"
        >
          Videos
        </BreezeNavLink> -->
            </ul>
        </nav>
    </div>
</template>
<script>
import { ref } from "vue";
import BreezeDropdown from "@/Components/Dropdown.vue";
import BreezeDropdownLink from "@/Components/DropdownLink.vue";
import BreezeNavLink from "@/Components/NavLink.vue";
import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.vue";
import { Link } from "@inertiajs/inertia-vue3";
import Themes from "@/Components/Themes.vue";
import Languages from "@/Components/LanguageSwitcher.vue";
export default {
    setup() {
        let showMenu = ref(false);
        const toggleNav = () => (showMenu.value = !showMenu.value);
        return { showMenu, toggleNav };
    },
    components: {
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
        Themes,
        Languages
    },
};
</script>

