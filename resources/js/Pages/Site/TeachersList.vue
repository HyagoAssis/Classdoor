<template>
    <Head title="Professores"/>
    <SiteLayout>
        <div class="flex-grid row">
            <h1 class="fs-4 fw-bold mb-4 col-sm-8">Explorar professores</h1>
            <div class="col-sm-4 text-end">
                <button class="btn btn-dark">+ Novo Professor</button>
            </div>
        </div>
        <ClassifiableList :type="2"/>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import {classifiableItemService} from "@/resource.js";
import DataList from "@/Components/Site/DataList.vue";
import ClassifiableList from "@/Components/Site/ClassifiableList.vue";

export default {
    name: 'TeachersList',
    components: {ClassifiableList, Head, SiteLayout},

    data() {
        return {
            method: classifiableItemService.query,
            params: {
                type: 2
            }
        }
    },
}
</script>
