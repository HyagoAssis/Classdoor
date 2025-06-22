<template>
    <div class="tw-bg-white tw-p-4 tw-shadow sm:tw-rounded-lg sm:tw-p-8 mb-3">
        <div class="card-body">
            <div class="row mb-lg-4">
                <div class="col-8 d-inline-block">
                    <div class="mb-2" v-if="withTypeName">
                        <Link class="fw-bold"
                              :href="route('classifiable_manager.show', {'classifiableItem' : item.classifiable_item_id})">
                            {{ item.classifiable_item.name }}
                        </Link>
                        <p class="text-secondary">#{{ item.classifiable_item.classification_type.name }}</p>
                    </div>

                    <p class="text-secondary-emphasis">{{ item.comment }}</p>
                    <a v-if="item.file" class="small text-secondary mt-2 tw-cursor-pointer" @click="downloadFile(item.id)">{{ item.file }}</a>
                </div>
                <div class="col-4 text-end">
                    <span v-if="!item.valid" class="text-danger bg-danger-subtle rounded p-2 fw-bold me-2">Removida</span>
                    <StarValue :value="item.value"/>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button ref='usefulButton' class="link-success d-flex flex-column text-secondary" :class="{'tw-pointer-events-none': !$page.props.auth.user, 'text-success': item.liked}" @click="changeUseful(item)">
                    <div class="d-flex">
                        <div class="me-4">
                            <small class="fw-bold me-2">{{ item.useful_count }}</small>
                            <i class="bi-hand-thumbs-up-fill me-2"/>
                            <small class="fw-bold">Útil</small>
                        </div>
                    </div>
                    <small class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm') }}</small>
                </button>
                <div class="align-content-end">
                    <button class="fw-bold small link-danger" href="#" @click="showComplaintModal = true">Denunciar
                    </button>
                </div>
            </div>
        </div>
        <Modal v-model="showComplaintModal">
            <template v-slot:header>Inserir denúncia</template>
            <div class="row mb-lg-4">
                <div class="col-8 d-inline-block">
                    <div class="mb-2" v-if="withTypeName">
                        <Link class="fw-bold"
                              :href="route('classifiable_manager.show', {'classifiableItem' : item.classifiable_item_id})">
                            {{ item.classifiable_item.name }}
                        </Link>
                        <p class="text-secondary">#{{ item.classifiable_item.classification_type.name }}</p>
                    </div>

                    <p class="text-secondary-emphasis">{{ item.comment }}</p>
                </div>
                <div class="col-4 text-end">
                    <StarValue :value="item.value"/>
                </div>
            </div>
            <div>
                <label>Denuncia: </label>
                <textarea class="form-control rounded" v-model="complaint"></textarea>
            </div>
            <template v-slot:footer>
                <button type="button" class="btn btn-danger" @click="showComplaintModal = false">Cancelar</button>
                <button type="button" class="btn btn-warning" @click="saveComplaint">Denunciar</button>
            </template>
        </Modal>
    </div>
</template>

<script>
import StarValue from "@/Components/Site/ValueStar.vue";
import moment from "moment";
import {Link} from "@inertiajs/vue3";
import Modal from "@/Components/Site/Modal.vue";
import {classificationService, complaintService} from "@/resource.js";

export default {
    name: 'ClassificationItem',
    components: {Modal, StarValue, Link},

    props: {
        item: {
            type: Object,
            required: true,
        },
        withTypeName: false
    },

    data() {
        return {
            requests: 0,
            showComplaintModal: false,
            complaint: null,
            classificationToComplaint: null,
            moment
        }
    },

    watch: {
        showComplaintModal: {
            immediate: true,
            handler() {
                this.complaint = null;
                this.classificationToComplaint = null;
            }
        }
    },

    methods: {
        saveComplaint() {
            this.requests++;

            complaintService.save({
                complaint: this.complaint,
                classification_id: this.item.id
            }).then(() => {
                this.$notification.success(
                    'Sucesso',
                    'Denúncia salva'
                );
            }).catch(() => this.$notification.error('Error', 'Não foi possível salvar a denúncia'))
                .then(() => {
                    this.requests--;
                    this.showComplaintModal = false;
                });
        },

        changeUseful(item) {
            if (!this.$page.props.auth.user){
                return;
            }

            classificationService.useful(item.id).then((response) => {
                item.useful_count = response.data.count;
                item.liked = response.data.liked;
            }).catch(() => {
                this.$notification.error('Erro')
            }).then(() => {
                if(this.$refs.usefulButton) {
                    this.$refs.usefulButton.blur();
                }
            });
        },
        downloadFile(id){
            this.requests++;

            classificationService.downloadFile(id).then((response) => {
                window.open(response.data.url, '_blank');
            }).catch((error) => {
               this.$notification.error('Erro', error?.response?.data?.message);
            }).then(() => this.requests--)
        }
    }
}

</script>
