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
                <div class="mb-4 row">
                    <div class="col-sm-2 text-center">
                        <StarValue :value="classifiableItem.avg_classification" />
                        <p class="text-secondary">Avaliação Média</p>
                    </div>
                    <div class="col-sm-2 text-center">
                        <strong>{{ classifiableItem.total_classification}}</strong>
                        <p class="text-secondary">Avaliações</p>
                    </div>
                </div>
                <div class="form-control mb-4 ps-3 pe-3">
                    <h1 class="fs-5 fw-bold mb-4 mt-2 col-sm-8">Inserir uma avaliação</h1>

                    <div class="row mb-4">
                        <div class="col-sm-4">
                            <label>Avaliação:</label>
                            <select class="form-control form-select-sm rounded" v-model="classification.value">
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
                        <small class="text-danger me-2" v-if="cantSaveMessage">{{ cantSaveMessage}}</small>
                        <button class="btn btn-dark" @click="saveClassification" :class="{disabled: !canMakeClassification}">Inserir</button>
                    </div>
                </div>
                <div class="flex-grid row">
                    <h1 class="fs-5 fw-bold mb-4 col-sm-8">Últimas avaliações</h1>
                </div>
                <DataList :method="method" :params="params" v-slot="{ item: item }">
                    <div class="card mb-1">
                        <div class="card-body row">
                            <div class="col-sm-11">
                                <p>{{ item.comment }}</p>
                                <small
                                    class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm') }}</small>
                            </div>
                            <div class="col-sm-1 fw-bold"><span class="fw-bold primary-color">{{ item.value }}<i
                                class="bi-star-fill ms-1"/></span></div>
                        </div>
                    </div>
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
    components: {StarValue, Spinner, Link, DataList, Head, SiteLayout},

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
                classifiable_id: this.classifiableItem.id
            }
        },

        typeName(){
            return this.classificationType.name;
        },

        canMakeClassification(){
          return this.classification.comment && this.classification.value && this.$page.props.auth.user;
        },

        cantSaveMessage(){
          if(!this.$page.props.auth.user){
              return 'Necessário estar logado para salvar uma classificação'
          }

          if (!this.classification.comment || !this.classification.value){
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
                    this.$swal.fire({
                        title: 'Sucesso!',
                        text: 'Avaliação salva',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });

                    this.classification = { ...DEFAULT_CLASSIFICATION};
                }
            }).catch(() => {
                this.$swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível salvar a avaliação',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            }).then(() => this.request--);
        },
        saveClassifiable() {
            this.newClassifiableItem.classification_type_id = this.classificationType.id;

            classifiableItemService.save(this.newClassifiableItem).then((response) => {

                if (response.data && response.data.data && response.data.data.id) {
                    this.$swal.fire({
                        title: 'Sucesso!',
                        text: this.typeName + ' salvo(a)',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });

                    router.get('/classificado/' + response.data.data.id);
                }
            }).catch(() => {
                this.$swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível salvar o(a) '.this.typeName,
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            })
        }
    }

}
</script>
