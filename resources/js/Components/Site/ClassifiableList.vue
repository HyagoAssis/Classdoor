<template>
    <div>
        <FiltersHeader placeholder="Pesquise..." :show-status-filter="false" :show-type-filter="false" :params="params" @applySearch="searchName"/>
        <DataList :method="method" :params="params" v-slot="{ item: item }">
            <Link class="card mb-3" :href="route('classifiable_manager.show', {'classifiableItem' : item.id})">
                <div class="card-body d-flex justify-content-between">
                    <div>
                        <h1 class="card-title fw-bold">{{ item.name }}</h1>
                        <p class="text-secondary">{{ item.total_classification }}
                            {{ item.total_classification === 1 ? 'Avaliação' : 'Avaliações' }}</p>
                    </div>
                    <div>
                        <StarValue :value="item.avg_classification"/>
                    </div>
                </div>
            </Link>
        </DataList>
    </div>

</template>

<script>
import {classifiableItemService} from "@/resource.js";
import DataList from "@/Components/Site/DataList.vue";
import {Link} from "@inertiajs/vue3";
import StarValue from "@/Components/Site/ValueStar.vue";
import FiltersHeader from "@/Components/Site/FiltersHeader.vue";

export default {
    name: 'ClassifiableList',
    components: {FiltersHeader, StarValue, DataList, Link},

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
                type: this.type,
                value: null,
                search: null,
            }
        }
    },
    methods: {
        searchName(search) {
            this.params.search = search;
        }
    }
}
</script>
