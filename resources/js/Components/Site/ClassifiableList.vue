<template>
    <DataList :method="method" :params="params" v-slot="{ item: item }">
        <Link class="card mb-1" :href="route('classifiable_manager.show', {'classifiableItem' : item.id})">
            <div class="card-body row">
                <div class="col-sm-9">
                    <h1 class="card-title fw-bold">{{ item.name }}</h1>
                    <span class="fw-bold primary-color">{{item.avg_classification}}<i class="bi-star-fill ms-1"/></span>
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

export default {
    name: 'ClassifiableList',
    components: {DataList, Link},

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
