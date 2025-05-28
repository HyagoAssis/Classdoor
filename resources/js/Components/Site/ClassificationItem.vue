<template>
    <div class="card mb-3">
        <div class="card-body">
            <div class="row mb-lg-4">
                <div class="col-8 d-inline-block">
                    <div class="mb-2" v-if="withTypeName">
                        <Link class="fw-bold" :href="route('classifiable_manager.show', {'classifiableItem' : item.classifiable_item_id})">{{ item.classifiable_item.name }}</Link>
                        <p class="text-secondary">#{{ item.classifiable_item.classification_type.name }}</p>
                    </div>

                    <p class="text-secondary-emphasis">{{ item.comment }}</p>
                </div>
                <div class="col-4 text-end">
                    <StarValue :value="item.value"/>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <Link class="link-success d-flex flex-column text-secondary" href="#">
                    <div class="d-flex">
                        <div class="me-4">
                            <small class="fw-bold me-2">20</small>
                            <i class="bi-hand-thumbs-up-fill me-2"/>
                            <small class="fw-bold">Útil</small>
                        </div>
                    </div>
                    <small class="text-secondary">{{ moment(item.created_at).format('DD/MM/YYYY H:mm')}}</small>
                </Link>
                <div class="align-content-end">
                    <Link class="fw-bold small link-danger" href="#">Denunciar</Link>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import StarValue from "@/Components/Site/ValueStar.vue";
import moment from "moment";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'ClassificationItem',
    components: {StarValue, Link},

    props: {
        item: {
            type: Object,
            required: true,
        },
        withTypeName: false
    },

    data() {
        return {
            moment
        }
    },
}

</script>
