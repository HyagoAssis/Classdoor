<template>
    <Head title="Perfil" />
    <SiteLayout>
        <h1 class="fs-4 fw-bold mb-4">Minhas avaliações</h1>
        <div class="mb-4">
            <div class="d-flex">
                <input v-model="search" class="form-control me-2 rounded" type="search" placeholder="Busque uma disciplina,professor, local..." aria-label="Busque uma disciplina,professor, local..."/>
                <button class="btn btn-success" @click="searchName">Procurar</button>
            </div>
            <div class="row justify-content-center mt-2">
                <div class="col-sm-3 d-flex align-items-center mt-1">
                    <label class="me-2">Tipo:</label>
                    <select class="form-control form-select-sm rounded" v-model="params.type">
                        <option selected :value="null">Selecione</option>
                        <option :value="2">Disciplina</option>
                        <option :value="1">Professor</option>
                        <option :value="3">Local</option>
                    </select>
                </div>
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
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row mb-lg-4">
                        <div class="col-11 d-inline-block">
                            <div class="mb-2">
                                <Link class="fw-bold" :href="route('classifiable_manager.show', {'classifiableItem' : item.classifiable_item_id})">{{ item.classifiable_item.name }}</Link>
                                <p class="text-secondary">#{{ item.classifiable_item.classification_type.name }}</p>
                            </div>

                            <p class="text-secondary-emphasis">{{ item.comment }}</p>
                        </div>
                        <div class="col-1 text-end">
                            <StarValue :value="item.value"/>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <small class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm')}}</small>
                        <a class="text-danger small" href="#">Denunciar</a>
                    </div>
                </div>
            </div>
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

export default {
    name: 'Profile',
    components: {StarValue, Link, ValueStar, DataList, Head, SiteLayout },

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
        searchName() {
            this.params.search = this.search;
        }
    }

}
</script>
