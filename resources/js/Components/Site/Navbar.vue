<template>
    <nav class="navbar navbar-expand-lg border-bottom bg-success">
        <div class="container">
            <Link class="navbar-brand fs-3 fw-bold text-light" href="/">Classdoor</Link>
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
                <template v-if="$page.props.auth.user">
                    <Link class="btn btn-light fw-bold me-2" :href="route('profile')">Meu Perfil</Link>
                    <button class="btn btn-outline-light fw-bold" @click="logout">Sair</button>

                </template>
                <template v-else>
                    <Link class="btn btn-light fw-bold me-2" :href="route('login')">Entrar</Link>
                    <Link class="btn btn-outline-light fw-bold" :href="route('register')">Registrar</Link>
                </template>
            </div>
        </div>
    </nav>
</template>

<script>

import {Link} from "@inertiajs/vue3";
import NavSiteLink from "@/Components/Site/NavSiteLink.vue";
import {router} from "@inertiajs/vue3";
export default {
    name: 'Navbar',

    components: {
        NavSiteLink,
        Link
    },
    methods:{
        logout(){
            router.post('/logout');
        }
    }
}

</script>
