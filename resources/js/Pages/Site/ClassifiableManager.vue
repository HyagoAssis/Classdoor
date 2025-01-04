<template>
    <Head :title="title" />
    <SiteLayout>
        <h1 class="fs-1 fw-bold mb-4">{{title}}</h1>
        <template v-if="    !classifiableItem && newClassifiableItem">
            <div class="mb-2">
                <label for="inputName">Nome:</label>
                <input type="text" v-model="newClassifiableItem.name" class="form-control rounded" id="inputName" placeholder="Preencha um nome...">
            </div>
            <div class="text-end">
                <button class="btn btn-dark fw-bold me-2" :class="{disabled: !newClassifiableItem.name}" @click="saveClassifiable">Salvar</button>
            </div>
        </template>
        <template v-else>
            <div class="mb-4 row">
                <div class="col-sm-2 text-center">
                    <span class="fw-bold primary-color me-1">10<i class="bi-star-fill ms-1"/></span>
                    <p class="text-secondary">Avaliação Média</p>
                </div>
                <div class="col-sm-2 text-center">
                    <strong>10</strong>
                    <p class="text-secondary">Avaliações</p>
                </div>
            </div>
            <div class="flex-grid row">
                <h1 class="fs-4 fw-bold mb-4 col-sm-8">Últimas avaliações</h1>
                <div class="col-sm-4 text-end">
                    <Link class="btn btn-dark" :href="route('classifiable_manager.new', {'type' : 'teacher'})">+ Nova Avaliação</Link>
                </div>

            </div>

            <DataList :method="method" :params="params" v-slot="{ item: item }">
                <div class="card mb-1">
                    <div class="card-body row">
                        <div class="col-sm-11">
                            <h1 class="card-title fw-bold">{{ item.classifiable_item.name }}</h1>
                            <p>{{ item.comment }}</p>
                            <small class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm')}}</small>
                        </div>
                        <div class="col-sm-1 fw-bold"><span class="fw-bold primary-color">{{ item.value }}<i class="bi-star-fill ms-1"/></span></div>
                    </div>
                </div>
            </DataList>
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


const DEFAULT_CLASSIFIABLE = {
    name: null,
    classification_type_id: null
};

export default {
    name: 'Home',
    components: {Link, DataList, Head, SiteLayout },

    props: {
        classifiableItem: {
            type: Object
        },
        classificationType: {
            type: Object,
            required: true
        }
    },

    data(){
        return {
            method: classificationService.query,
            headers: [
                'testando'
            ],
            newClassifiableItem: null,
            moment
        }
    },

    created() {
        if(!this.classifiableItem){
            this.newClassifiableItem = {...DEFAULT_CLASSIFIABLE};
        }
    },

    computed: {
        title(){
            if(this.classifiableItem){
                return this.classifiableItem.name;
            }

            return 'Novo '+ this.classificationType.name;
        },

        params(){
            return {
                perPage: 10,
                classifiable_id: this.classifiableItem.id
            }
        }
    },
    methods: {
        saveClassifiable(){
            this.newClassifiableItem.classification_type_id = this.classificationType.id;

            classifiableItemService.save(this.newClassifiableItem).then((response) => {

                if(response.data && response.data.data && response.data.data.id){

                    this.$swal.fire({
                        title: 'Sucesso!',
                        text: 'Professor salvo',
                        icon: 'success',
                        confirmButtonText: 'Ok'
                    });

                    router.get('/classificado/'+response.data.data.id);
                }
            }).catch(() => {
                this.$swal.fire({
                    title: 'Erro!',
                    text: 'Não foi possível salvar o professor',
                    icon: 'error',
                    confirmButtonText: 'Ok'
                });
            })
        }
    }

}
</script>
