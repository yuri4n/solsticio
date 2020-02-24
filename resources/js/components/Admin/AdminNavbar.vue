<template>
    <nav
        class="navbar navbar-expand-lg navbar-dark bg-dark"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN' && user.status === 'APPROVED'"
    >
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
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/admin/">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/noticias/">Noticias</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/servicios/">Servicios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/archivos/">Archivos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/clasificados/">Clasificados</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/peticiones/">Peticiones</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/censo/">Censo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/admin/usuarios/">Usuarios</a>
                </li>
                <li class="nav-item" id="auth">
                    <a
                        @click="$auth.logout()"
                        class="nav-link"
                        href="/inicio"
                        id="logout"
                    >Cerrar Sesión</a>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
    export default {
        mounted() {
            if (this.$auth.isAuthenticated()) this.getUser();
        },
        data() {
            return {
                user: undefined
            };
        },
        methods: {
            getUser() {
                var url = "/api/auth/user";
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

<style scoped>
    #logout {
        color: #fff !important;
        font-weight: bold !important;
    }
</style>

