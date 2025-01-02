<template>
    <Head title="Professores"/>
    <SiteLayout>
        <div class="flex-grid row">
            <h1 class="fs-4 fw-bold mb-4 col-sm-8">Explorar professores</h1>
            <div class="col-sm-4 text-end">
                <Link class="btn btn-dark" :href="route('classifiable_manager.new', {'type' : 'teacher'})">+ Novo Professor</Link>
            </div>
        </div>
        <ClassifiableList :type="1"/>
    </SiteLayout>
</template>

<script>
import {Head} from "@inertiajs/vue3";
import SiteLayout from "@/Layouts/SiteLayout.vue";
import {classifiableItemService} from "@/resource.js";
import ClassifiableList from "@/Components/Site/ClassifiableList.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: 'TeachersList',
    components: {ClassifiableList, Head, SiteLayout, Link},

    data() {
        return {
            method: classifiableItemService.query,
            params: {
                type: 2
            }
        }
    },
}
</script>
