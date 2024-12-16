<template>
    <Head title="Locais"/>
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Explorar locais</h1>
        <ClassifiableList :type="3"/>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import ClassifiableList from "@/Components/Site/ClassifiableList.vue";

export default {
    name: 'PlacesList',
    components: {ClassifiableList, Head, SiteLayout},


}
</script>
