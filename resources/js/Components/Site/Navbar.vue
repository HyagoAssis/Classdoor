<template>
    <nav class="navbar navbar-expand-lg border-bottom mb-2">
        <div class="container">
            <Link class="navbar-brand fs-3 fw-bold primary-color" href="/">Classdoor</Link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse fs-6 fw-bold" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 m-auto">
                    <NavSiteLink title="Página Inicial" route-name="home" />
                    <NavSiteLink title="Disciplinas" route-name="disciplines" />
                    <NavSiteLink title="Professores" route-name="teachers" />
                    <NavSiteLink title="Locais" route-name="places" />
                </ul>
            </div>

            <div>
                <button class="btn btn-dark fw-bold me-2">Entrar</button>
                <button class="btn btn-outline-dark fw-bold">Registrar</button>
            </div>
        </div>
    </nav>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import NavSiteLink from "@/Components/Site/NavSiteLink.vue";
export default {
    name: 'Navbar',

    components: {
        NavSiteLink,
        Link
    }
}

</script>
