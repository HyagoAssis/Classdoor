<template>
    <Head title="Locais"/>
    <SiteLayout>
        <div class="flex-grid row">
            <h1 class="fs-4 fw-bold mb-4 col-sm-8">Explorar locais</h1>
            <div class="col-sm-4 text-end">
                <Link class="btn btn-dark" :href="route('classifiable_manager.new', {'type' : 'place'})">+ Novo Local</Link>
            </div>
        </div>
        <ClassifiableList :type="3"/>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import ClassifiableList from "@/Components/Site/ClassifiableList.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'PlacesList',
    components: {ClassifiableList, Head, SiteLayout, Link},


}
</script>
