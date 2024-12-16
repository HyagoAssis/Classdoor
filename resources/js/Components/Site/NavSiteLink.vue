<template>
    <li class="nav-item">
        <Link class="nav-link" aria-current="page" :href="route(routeName)"
              :class="{active: route().current(routeName)}">{{ title }}
        </Link>
    </li>
</template>

<script>

import {Link} from "@inertiajs/vue3";
export default {
    name: 'NavSiteLink',

    components: {
        Link
    },

    props: {
        routeName: {
            required: true,
            type: String,
        },
        title: {
            required: true,
            type: String
        }
    }
}

</script>
