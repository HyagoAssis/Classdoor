<template>
    <Head title="Novo ----" />
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Novo ----</h1>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import {classificationService} from "@/resource.js";
import moment from "moment";

export default {
    name: 'Home',
    components: {DataList, Head, SiteLayout },

    data(){
        return {
            method: classificationService.query,
            headers: [
                'testando'
            ],
            params: {
                perPage: 10
            },
            moment
        }
    }

}
</script>
