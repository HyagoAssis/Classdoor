<template>
    <Head title="Disciplinas" />
    <SiteLayout>
        <div class="container-sm">
            <div class="flex-grid row">
                <h1 class="fs-4 fw-bold mb-4 col-sm-8">Explorar disciplinas</h1>
                <div class="col-sm-4 text-end">
                    <button class="btn btn-dark">+ Nova Disciplina</button>
                </div>
            </div>
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
