<template>
    <Head :title="title" />
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">{{title}}</h1>
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

    props: {
        classifiableItem: {
            type: Object
        },
        classificationType: {
            type: Object,
            required: true
        }
    },

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
    },

    created() {
        console.log(this.classifiableItem);
    },

    computed: {
        title(){
            if(this.classifiableItem){
                return this.classifiableItem.name;
            }

            return 'Novo '+ this.classificationType.name;
        }
    }

}
</script>
