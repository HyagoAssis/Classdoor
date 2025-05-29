<template>
    <div>
        <h1 class="fs-4 fw-bold mb-4">Denúncias</h1>
        <Spinner v-if="requests"/>
        <DataList v-else :method="method" :params="params" v-slot="{ item: item }">
            <div class="tw-bg-white tw-p-4 tw-shadow sm:tw-rounded-lg sm:tw-p-8 mb-3">
                <div class="row mb-lg-4">
                    <div class="col-6 d-inline-block">
                        <div class="mb-2">
                            <Link class="fw-bold"
                                  :href="route('classifiable_manager.show', {'classifiableItem' : item.classification.classifiable_item_id})">
                                {{ item.classification.classifiable_item.name }}
                            </Link>
                            <p class="text-secondary-emphasis">
                                #{{ item.classification.classifiable_item.classification_type.name }}</p>
                        </div>

                        <p class="text-secondary">{{ item.classification.comment }}</p>
                        <div class="mt-4">
                            <p class="fw-bold">Denúncia:</p>
                            <p class="text-secondary">{{ item.complaint }}</p>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <span :class="getComplaintClass(item.status)"
                              class="rounded p-2 fw-bold me-2">{{ item.status_text }}</span>
                        <StarValue :value="item.classification.value"/>
                    </div>
                </div>
                <div class="d-flex justify-content-between" v-if="params && !params.filterUser">
                    <small class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm') }}</small>
                    <div>
                        <button v-if="item.status !== 1" class="fw-bold link-warning text-warning small me-2"
                                @click="changeStatus(item.id, 1)">Em análise
                        </button>
                        <button v-if="item.status !== 2" class="fw-bold link-success text-success small me-2"
                                @click="changeStatus(item.id, 2)">Aprovar
                        </button>
                        <button v-if="item.status !== 3" class="fw-bold link-danger text-danger small"
                                @click="changeStatus(item.id, 3)">Reprovar
                        </button>
                    </div>
                </div>
            </div>
        </DataList>
    </div>
</template>

<script>
import {Head, Link} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import DataList from "@/Components/Site/DataList.vue";
import {classificationService, complaintService} from "@/resource.js";
import moment from "moment";
import ValueStar from "@/Components/Site/ValueStar.vue";
import StarValue from "@/Components/Site/ValueStar.vue";
import FiltersHeader from "@/Components/Site/FiltersHeader.vue";
import Spinner from "@/Components/Site/Spinner.vue";

export default {
    name: 'ComplaintsList',
    components: {Spinner, FiltersHeader, StarValue, Link, ValueStar, DataList, Head, SiteLayout},

    props: {
        filterUser: {
            default: false,
        },
        withFilters: {
            default: true,
        },
        params: Object,
    },

    data() {
        return {
            requests: 0,
            method: complaintService.query,
            search: null,
            moment
        }
    },

    methods: {
        applySearch(value) {
            this.params.search = value;
        },
        getComplaintClass(status) {
            if (status === 2) {
                return 'text-success bg-success-subtle';
            }

            if (status === 3) {
                return 'text-danger bg-danger-subtle';
            }

            return 'text-warning bg-warning-subtle';
        },
        changeStatus(id, status) {
            this.requests++;

            complaintService.changeStatus(id, {
                status: status,
            }).then(() => {
                this.$notification.success('Sucesso!', 'Denúncia atualizada!');
            }).catch(() => {
                this.$notification.error('Erro!', 'Não foi possível atualizar a denúncia!');
            }).then(() => {
                this.requests--;
            });
        }
    }

}
</script>
