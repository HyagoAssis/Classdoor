<template>
    <div class="mb-4">
        <div class="d-flex">
            <input v-model="search" class="form-control me-2 rounded" type="search" placeholder="Busque uma disciplina,professor, local..."/>
            <button class="btn btn-success" @click="applySearch">Procurar</button>
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

export default {
    name: 'FiltersHeader',

    model: {
        prop: 'params',
        event: 'change',
    },

    props: {
        withTypeName: false,
        params: Object,
        showStatusFilter: false,
        showTypeFilter: true,
        placeholder: "Busque uma disciplina,professor, local...",
    },

    data() {
        return {
            search: null,
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
