<template>
    <li class="nav-item">
        <Link class="nav-link" aria-current="page" :href="route(routeName)"
              :class="route().current(routeName) ? 'text-light' : 'text-white-50'">{{ title }}
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
