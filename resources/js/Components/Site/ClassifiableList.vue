<template>
    <DataList :method="method" :params="params" v-slot="{ item: item }">
        <Link class="card mb-1" :href="route('classifiable_manager.show', {'classifiableItem' : item.id})">
            <div class="card-body row">
                <div class="col-sm-9">
                    <h1 class="card-title fw-bold">{{ item.name }}</h1>
                    <StarValue :value="item.avg_classification" />
                </div>
                <div class="col-sm-3 fw-bold">{{item.total_classification}} Avaliações</div>
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
