<template>
    <Head title="Disciplinas" />
    <SiteLayout>
        <div class="container-sm">
            <h1 class="fs-4 fw-bold mb-4">Explorar disciplinas</h1>
            <ClassifiableList :type="1"/>
        </div>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import ClassifiableList from "@/Components/Site/ClassifiableList.vue";
export default {
    name: 'DisciplinesList',
    components: {ClassifiableList, DataList, Head, SiteLayout },


}
</script>
