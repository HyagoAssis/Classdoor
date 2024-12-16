<template>
    <Head title="Professores"/>
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Explorar professores</h1>
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
