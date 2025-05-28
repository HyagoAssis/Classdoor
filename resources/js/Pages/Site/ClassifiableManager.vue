<template>
    <Head :title="title"/>
    <SiteLayout>
        <Spinner v-if="request"/>
        <template v-else>
            <h1 class="fs-1 fw-bold mb-4">{{ title }}</h1>
            <template v-if="    !classifiableItem && newClassifiableItem">
                <div class="mb-2">
                    <label for="inputName">Nome:</label>
                    <input type="text" v-model="newClassifiableItem.name" class="form-control rounded" id="inputName"
                           placeholder="Preencha um nome...">
                </div>
                <div class="text-end">
                    <button class="btn btn-dark fw-bold me-2" :class="{disabled: !newClassifiableItem.name}"
                            @click="saveClassifiable">Salvar
                    </button>
                </div>
            </template>
            <template v-else>
                <div class="row">
                    <div class="col-sm-2 mt-lg-4">
                        <div class="text-center mb-3">
                            <StarValue :value="classifiableItem.avg_classification"/>
                            <p class="text-secondary">Avaliação Média</p>
                        </div>
                        <div class="text-center">
                            <div class="d-inline-block rounded p-2 bg-secondary-subtle">
                                <i class="bi-pen-fill me-1"/>
                                <strong>{{ classifiableItem.total_classification }}</strong>
                            </div>
                            <p class="text-secondary">Avaliações</p>
                        </div>
                    </div>
                    <div class="col-sm-10">
                        <div class="form-control mb-4 ps-3 pe-3">
                            <h1 class="fs-5 fw-bold mb-4 mt-2 col-sm-8">Inserir uma nova avaliação</h1>

                            <div class="row">
                                <div class="col-sm-4">
                                    <label for="type ">Avaliação:</label>
                                    <select id='type' class="form-control form-select-sm rounded" v-model="classification.value">
                                        <option selected :value="null">Insira um valor</option>
                                        <option :value="1">1 Estrela</option>
                                        <option :value="2">2 Estrelas</option>
                                        <option :value="3">3 Estrelas</option>
                                        <option :value="4">4 Estrelas</option>
                                        <option :value="5">5 Estrelas</option>
                                    </select>
                                </div>

                                <div class="col-sm-8">
                                    <label>Comentário: </label>
                                    <textarea class="form-control rounded" v-model="classification.comment"></textarea>
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <small class="text-danger me-2" v-if="cantSaveMessage">{{ cantSaveMessage }}</small>
                                <button class="btn btn-dark" @click="saveClassification"
                                        :class="{disabled: !canMakeClassification}">Inserir
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex-grid row">
                    <h1 class="fs-5 fw-bold mb-4 col-sm-8">Últimas avaliações</h1>
                </div>
               <FiltersHeader :params=filters :show-type-filter="false" @applySearch="applySearch" placeholder="Busque uma avaliação" :show-status-filter="false"/>
                <DataList :method="method" :params="params" v-slot="{ item: item }">
                    <ClassificationItem :item="item" />
                </DataList>
            </template>
        </template>
    </SiteLayout>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import {classifiableItemService, classificationService} from "@/resource.js";
import {router} from "@inertiajs/vue3";
import moment from "moment";
import Spinner from "@/Components/Site/Spinner.vue";
import StarValue from "@/Components/Site/ValueStar.vue";
import ClassificationItem from "@/Components/Site/ClassificationItem.vue";
import FiltersHeader from "@/Components/Site/FiltersHeader.vue";

const DEFAULT_CLASSIFIABLE = {
    name: null,
    classification_type_id: null
};

const DEFAULT_CLASSIFICATION = {
    comment: null,
    value: null,
    classifiable_item_id: null
};

export default {
    name: 'ClassifiableManager',
    components: {FiltersHeader, ClassificationItem, StarValue, Spinner, Link, DataList, Head, SiteLayout},

    props: {
        classifiableItem: {
            type: Object
        },
        classificationType: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            request: 0,
            method: classificationService.query,
            headers: [
                'testando'
            ],
            newClassifiableItem: null,
            showClassificationModal: false,
            classification: {...DEFAULT_CLASSIFICATION},

            value: null,
            classificationSearch: null,
            filters: {
              value: null,
              search: null
            },
            moment
        }
    },

    created() {
        if (!this.classifiableItem) {
            this.newClassifiableItem = {...DEFAULT_CLASSIFIABLE};
        }
    },

    computed: {
        title() {
            if (this.classifiableItem) {
                return this.classifiableItem.name;
            }

            return 'Novo ' + this.classificationType.name;
        },

        params() {
            return {
                perPage: 10,
                classifiable_id: this.classifiableItem.id,
                value: this.filters.value,
                classification_search: this.filters.search,
            }
        },

        typeName() {
            return this.classificationType.name;
        },

        canMakeClassification() {
            return this.classification.comment && this.classification.value && this.$page.props.auth.user;
        },

        cantSaveMessage() {
            if (!this.$page.props.auth.user) {
                return 'Necessário estar logado para salvar uma classificação'
            }

            if (!this.classification.comment || !this.classification.value) {
                return 'Necessário preencher os campos!'
            }

            return null;
        }
    },
    methods: {
        saveClassification() {
            this.classification.classifiable_item_id = this.classifiableItem.id;
            this.request++;

            classificationService.save(this.classification).then((response) => {
                if (response.data && response.data.data && response.data.data.id) {
                    this.$notification.success('Sucesso!', 'Avaliação salva');
                    this.classification = {...DEFAULT_CLASSIFICATION};
                }
            })
                .catch(() => {
                    this.$notification.error('Erro!', 'Não foi possível salvar a avaliação');
                }).then(() => this.request--);
        },
        saveClassifiable() {
            this.newClassifiableItem.classification_type_id = this.classificationType.id;

            classifiableItemService.save(this.newClassifiableItem).then((response) => {

                if (response.data && response.data.data && response.data.data.id) {
                    this.$notification.success('Sucesso!', this.typeName + ' salvo(a)');

                    router.get('/classificado/' + response.data.data.id);
                }
            }).catch(() => {
                this.$notification.error('Erro!', 'Não foi possível salvar o(a) '.this.typeName);
            })
        },

        applySearch(value) {
            this.filters.search = value;
        }
    }

}
</script>
