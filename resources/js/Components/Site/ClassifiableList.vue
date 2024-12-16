<template>
    <DataList :method="method" :params="params" v-slot="{ item: item }">
        <div class="card mb-1">
            <div class="card-body row">
                <div class="col-sm-9">
                    <h1 class="card-title fw-bold">{{ item.name }}</h1>
                    <span class="fw-bold primary-color">3.7<i class="bi-star-fill ms-1"/></span>
                </div>
                <div class="col-sm-3 fw-bold">10 Avaliações</div>
            </div>
        </div>
    </DataList>
</template>

<script>
import {classifiableItemService} from "@/resource.js";
import DataList from "@/Components/Site/DataList.vue";

export default {
    name: 'ClassifiableList',
    components: {DataList},

    props: {
        type: {
            type: Number,
            required: true
        }
    },

    data() {
        return {
            method: classifiableItemService.query,
            params: {
                type: this.type
            }
        }
    },
}
</script>
