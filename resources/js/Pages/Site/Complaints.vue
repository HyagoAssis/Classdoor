<template>
    <Head title="Denúncias" />
    <SiteLayout>
        <FiltersHeader :params="params" @applySearch="applySearch" :show-status-filter="true" :show-type-filter="true"/>
        <ComplaintsList :params="params" />
    </SiteLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import {classificationService, complaintService} from "@/resource.js";
import moment from "moment";
import ValueStar from "@/Components/Site/ValueStar.vue";
import StarValue from "@/Components/Site/ValueStar.vue";
import FiltersHeader from "@/Components/Site/FiltersHeader.vue";
import Spinner from "@/Components/Site/Spinner.vue";
import ComplaintsList from "@/Pages/Site/ComplaintsList.vue";

export default {
    name: 'Complaints',
    components: {ComplaintsList, Spinner, FiltersHeader, StarValue, Link, ValueStar, DataList, Head, SiteLayout },

    data(){
        return {
            requests: 0,
            method: complaintService.query,
            search: null,
            params: {
                perPage: 10,
                filterUser: 0,
                type: null,
                value: null,
                status: null,
                search: null
            },
            moment
        }
    },

    methods:{
        applySearch(value){
          this.params.search = value;
        },
    }

}
</script>
