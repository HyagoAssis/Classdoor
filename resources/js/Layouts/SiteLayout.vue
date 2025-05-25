<script>
    import Navbar from "@/Components/Site/Navbar.vue";

    export default {
        name: 'SiteLayout',
        components: {Navbar},
    }
</script>

<template>
    <div class="tw-min-h-screen bg-body-tertiary tw-flex tw-flex-col">
        <div>
            <Navbar />
        </div>

        <main class="container-sm pt-3 pb-3">
                <slot />
        </main>

        <div class="bg-success tw-mt-auto text-center pt-2 pb-2">
            <p class="text-white">Projeto desenvolvido no Trabalho de Conclusão do Curso de Ciências Exatas</p>
            <small class="text-white">Hyago Assis de Novais Oliveira</small>
        </div>
    </div>
</template>
