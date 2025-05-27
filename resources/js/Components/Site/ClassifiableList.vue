<template>
    <div>
        <div class="mb-4">
            <div class="d-flex">
                <input v-model="search" class="form-control me-2 rounded" type="search" placeholder="Busque uma disciplina,professor, local..." aria-label="Busque uma disciplina,professor, local..."/>
                <button class="btn btn-success" @click="searchName">Procurar</button>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-sm-3 d-flex align-items-center mt-1">
                    <label class="me-2">Avaliação:</label>
                    <select class="form-control form-select-sm rounded" v-model="params.value">
                        <option selected :value="null">Selecione</option>
                        <option :value="1">1 Estrela</option>
                        <option :value="2">2 Estrelas</option>
                        <option :value="3">3 Estrelas</option>
                        <option :value="4">4 Estrelas</option>
                        <option :value="5">5 Estrelas</option>
                    </select>
                </div>
            </div>
        </div>
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
            search: null,
            params: {
                type: this.type,
                value: null,
                search: null,
            }
        }
    },
    methods: {
        searchName() {
            this.params.search = this.search;
        }
    }
}
</script>
