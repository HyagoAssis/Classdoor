<script>
    import Navbar from "@/Components/Site/Navbar.vue";

    export default {
        name: 'SiteLayout',
        components: {Navbar},
    }
</script>

<template>
    <div>
        <Navbar />
        <div class="container-sm">
            <slot />
        </div>
    </div>
</template>
