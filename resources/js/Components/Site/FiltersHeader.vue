<template>
    <div class="mb-4">
        <div class="d-flex">
            <TextInput
                v-model="search"
                type="text"
                :placeholder="placeholder"
                class="tw-mt-1 tw-block tw-w-full me-2"
                @keyup.enter="applySearch"
            />
            <button class="btn btn-success mt-1" @click="applySearch">Procurar</button>
        </div>
        <div class="justify-content-start d-flex mt-3 flex-wrap gap-3">
            <div class="d-flex align-items-center me-3" v-if="showTypeFilter" style="width: 13rem">
                <label class="me-2">Tipo:</label>
                <select class="form-control form-select-sm rounded" v-model="params.type">
                    <option selected :value="null">Selecione</option>
                    <option :value="2">Disciplina</option>
                    <option :value="1">Professor</option>
                    <option :value="3">Local</option>
                </select>
            </div>
            <div class="d-flex align-items-center me-3" style="width: 13rem">
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
            <div class="d-flex align-items-center me-3" v-if="showStatusFilter" style="width: 13rem">
                <label class="me-2">Status:</label>
                <select class="form-control form-select-sm rounded" v-model="params.status">
                    <option selected :value="null">Selecione</option>
                    <option :value="1">Em análise</option>
                    <option :value="2">Aprovada</option>
                    <option :value="3">Reprovada</option>
                </select>
            </div>
            <div style="width: 20rem">
                <button class="btn btn-sm btn-outline-danger" @click="cleanFilters">Limpar filtros</button>
            </div>
        </div>
    </div>
</template>

<script>

import TextInput from "@/Components/TextInput.vue";

export default {
    name: 'FiltersHeader',
    components: {TextInput},

    model: {
        prop: 'params',
        event: 'change',
    },

    props: {
        withTypeName: false,
        params: Object,
        showStatusFilter: {
            default: false
        },
        showTypeFilter: {
            default: true
        },
        placeholder: {
            default: "Busque uma disciplina,professor, local..."
        },
    },

    data() {
        return {
            search: null,
        }
    },

    watch: {
        search(newValue, oldValue) {
            if(oldValue && (newValue === null || newValue === '')) {
                this.applySearch();
            }
        }
    },
    methods: {
        applySearch() {
            this.$emit('applySearch', this.search);
        },

        cleanFilters() {
            if(!this.params){
                return;
            }

            if(this.params.type){
                this.params.type = null;
            }

            if(this.params.value){
                this.params.value = null;
            }

            if(this.params.status){
                this.params.status = null;
            }
        }
    }
}

</script>
