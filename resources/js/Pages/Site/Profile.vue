<template>
    <Head title="Perfil" />
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Minhas avaliações</h1>
        <FiltersHeader :params=params :showTypeFilter="true" @applySearch="searchName"/>
        <DataList :method="method" :params="params" v-slot="{ item: item }">
            <ClassificationItem :item="item" :with-type-name="true"/>
        </DataList>
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

export default {
    name: 'Profile',
    components: {FiltersHeader, ClassificationItem, StarValue, Link, ValueStar, DataList, Head, SiteLayout },

    data(){
        return {
            method: classificationService.query,
            search: null,
            params: {
                perPage: 10,
                filterUser: true,
                search: null,
                type: null,
                value: null
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
