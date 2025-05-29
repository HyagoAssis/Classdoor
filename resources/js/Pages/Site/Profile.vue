<template>
    <Head title="Perfil" />
    <SiteLayout>
        <Edit />
        <h1 class="fs-4 fw-bold mb-4">Classificações e Denúncias</h1>
        <FiltersHeader :params="params" @applySearch="searchName" :show-status-filter="true" :show-type-filter="true" />
        <h1 class="fs-4 fw-bold mb-4">Avaliações</h1>
        <DataList :method="method" :params="params" v-slot="{ item: item }">
            <ClassificationItem :item="item" :with-type-name="true"/>
        </DataList>
        <ComplaintsList :params=params :with-filters=false class="mt-4" :filter-user="true"/>
    </SiteLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import {classificationService} from "@/resource.js";
import moment from "moment";
import ValueStar from "@/Components/Site/ValueStar.vue";
import StarValue from "@/Components/Site/ValueStar.vue";
import ClassificationItem from "@/Components/Site/ClassificationItem.vue";
import FiltersHeader from "@/Components/Site/FiltersHeader.vue";
import Edit from "@/Pages/Site/Profile/Edit.vue";
import ComplaintsList from "@/Pages/Site/ComplaintsList.vue";

export default {
    name: 'Profile',
    components: {
        ComplaintsList,
        Edit, FiltersHeader, ClassificationItem, StarValue, Link, ValueStar, DataList, Head, SiteLayout },

    data(){
        return {
            method: classificationService.query,
            search: null,
            params: {
                perPage: 10,
                filterUser: 1,
                search: null,
                type: null,
                value: null,
                status: null,
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
