<template>
    <Head title="Página Inicial" />
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Avaliações</h1>
        <FiltersHeader :params="params" @applySearch="searchName" :show-type-filter="true"/>
        <DataList :method="method" :params="params" v-slot="{ item: item }">
            <ClassificationItem :item="item" :with-type-name="true"/>
        </DataList>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import {classificationService} from "@/resource.js";
import moment from "moment";
import StarValue from "@/Components/Site/ValueStar.vue";
import {Link} from "@inertiajs/vue3";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import ClassificationItem from "@/Components/Site/ClassificationItem.vue";
import FiltersHeader from "@/Components/Site/FiltersHeader.vue";

export default {
    name: 'Home',
    components: {FiltersHeader, ClassificationItem, AuthenticatedLayout, StarValue, DataList, Head, SiteLayout, Link },

    data(){
        return {
            method: classificationService.query,
            params: {
                perPage: 10,
                search: null,
                type: null,
                value: null,
            },
            moment
        }
       },

        methods: {
            searchName(value) {
                this.params.search = value;
            }
        }

}
</script>
