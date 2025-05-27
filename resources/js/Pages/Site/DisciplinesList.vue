<template>
    <Head title="Disciplinas"/>
    <SiteLayout>

        <div class="container-sm">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fs-4 fw-bold">Explorar disciplinas</h1>
                <Link class="btn btn-dark" :href="route('classifiable_manager.new', {'type' : 'discipline'})">+ Nova
                    Disciplina
                </Link>
            </div>
            <ClassifiableList :type="2"/>
        </div>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import ClassifiableList from "@/Components/Site/ClassifiableList.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'DisciplinesList',
    components: {Link, ClassifiableList, DataList, Head, SiteLayout},


}
</script>
