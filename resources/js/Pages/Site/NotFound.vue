<template>
    <Head title="Página Inicial" />
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Últimas avaliações</h1>
        <DataList :method="method" :params="params" v-slot="{ item: item }">
            <div class="card mb-1">
                <div class="card-body row">
                    <div class="col-sm-11">
                        <h1 class="card-title fw-bold">{{ item.classifiable_item.name }}  <span class="text-secondary">{{ item.classifiable_item.classification_type.name }} </span></h1>
                        <p>{{ item.comment }}</p>
                        <small class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm')}}</small>
                    </div>
                    <div class="col-sm-1 fw-bold"><span class="fw-bold primary-color">{{ item.value }}<i class="bi-star-fill ms-1"/></span></div>
                </div>
            </div>
        </DataList>
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
