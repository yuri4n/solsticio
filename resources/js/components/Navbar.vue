<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light" id="navbar">
            <a class="navbar-brand" href="/inicio/">
                <img alt height="30" src="/images/icon.png" width="30">
                Solsticio Parque Residencial |
                <small class="text-muted">Etapa 5</small>
            </a>
            <button
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation"
                class="navbar-toggler"
                data-target="#navbarSupportedContent"
                data-toggle="collapse"
                type="button"
            >
                <span class="navbar-toggler-icon"/>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/inicio/">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/noticias/">Noticias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/servicios/">Servicios</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/archivos/">Archivos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/clasificados/">Clasificados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/peticiones/">Peticiones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/censo/">Censo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/pagos/">Pagos</a>
                    </li>
                    <li class="nav-item auth" v-if="!$auth.isAuthenticated()">
                        <a class="nav-link" href="/login/">Ingresar</a>
                    </li>
                    <li class="nav-item auth" v-if="!$auth.isAuthenticated()">
                        <a class="nav-link" href="/register/">Registrar</a>
                    </li>
                    <li class="nav-item auth" v-if="$auth.isAuthenticated() && user.role === 'ADMIN'">
                        <a class="nav-link" href="/admin">Admin</a>
                    </li>
                    <li class="nav-item auth" v-if="$auth.isAuthenticated()">
                        <a
                            @click="$auth.logout()"
                            class="nav-link"
                            href="/inicio"
                        >Cerrar Sesión</a>
                    </li>
                </ul>
            </div>
        </nav>

        <div
            class="alert alert-warning mt-3"
            role="alert"
            v-if="this.$auth.isAuthenticated() && user.status == 'PENDING'"
        >Tu cuenta se encuentra en proceso de verificación, cuando sea aprobada podrás disfrutar de todas las
            funcionalidades
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.$auth.isAuthenticated()) this.getUser();
        },
        data() {
            return {
                user: {}
            };
        },
        methods: {
            getUser() {
                const url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            }
        }
    };
</script>

<style lang="scss" scoped>
    #navbar1 {
        background-color: #fff !important;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
    }

    .auth {
        color: #2f3640 !important;
        font-weight: bold !important;
    }
</style>
