<template>
    <Head title="Não encontrado" />
    <SiteLayout>
        <p>Nenhuma página encontrada</p>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";

export default {
    name: 'NotFound',
    components: { Head, SiteLayout },
}
</script>
