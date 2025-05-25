<template>
    <DataList :method="method" :params="params" v-slot="{ item: item }">
        <Link class="card mb-3" :href="route('classifiable_manager.show', {'classifiableItem' : item.id})">
            <div class="card-body row">
                <div class="col-sm-11">
                    <h1 class="card-title fw-bold">{{ item.name }}</h1>
                    <p class="text-secondary">{{item.total_classification}} {{ item.total_classification === 1 ? 'Avaliação' : 'Avaliações'}}</p>
                </div>
                <div class="col-sm-1 fw-bold"><StarValue :value="item.avg_classification" /></div>
            </div>
        </Link>
    </DataList>
</template>

<script>
import {classifiableItemService} from "@/resource.js";
import DataList from "@/Components/Site/DataList.vue";
import {Link} from "@inertiajs/vue3";
import StarValue from "@/Components/Site/ValueStar.vue";

export default {
    name: 'ClassifiableList',
    components: {StarValue, DataList, Link},

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
