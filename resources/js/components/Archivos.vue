<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1 class="my-4">Archivos</h1>

                <!-- LIST -->
                <div class="card mb-3">
                    <div class="card-body">
                        <h2 class="card-title">Lista de Archivos</h2>
                        <table class="table table-striped"
                               v-if="this.$auth.isAuthenticated() && user.status === 'APPROVED' && user.role !==
                        'ARRENDATARIO'">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Descargar</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr :key="file.id" v-for="file in files">
                                <th scope="row">{{ file.id }}</th>
                                <td>{{ file.description }}</td>
                                <td>
                                    <a
                                        :href="'files/' + file.file"
                                        class="btn btn-primary"
                                        download
                                    >
                                        Descargar
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <div v-if="this.$auth.isAuthenticated() && user.status !== 'APPROVED'">
                            <h3>Tu cuenta no ha sido verificada</h3>
                            <p>
                                Para acceder a los archivos disponibles deberás esperar a que un administrador del
                                sitio apruebe tu cuenta, o intenta con otra
                            </p>
                            <a
                                @click="$auth.logout()"
                                class="btn btn-primary"
                                href="/inicio"
                            >Cerrar Sesión</a>
                        </div>

                        <div v-if="this.$auth.isAuthenticated() && user.status === 'APPROVED' && user.role ===
                        'ARRENDATARIO'">
                            <h3>No tienes permiso para acceder a esta información</h3>
                            <p>
                                Sólo los administradores o los propietarios pueden ver los archivos disponibles
                            </p>
                            <a
                                @click="$auth.logout()"
                                class="btn btn-primary"
                                href="/inicio"
                            >Cerrar Sesión</a>
                        </div>

                        <div v-else>
                            <h3>No has iniciado sesión</h3>
                            <p>
                                Para ver los archivos deberás iniciar sesión
                            </p>
                            <a
                                class="btn btn-primary"
                                href="http://solsticio.local/login"
                            >Iniciar sesión</a
                            >
                            <a
                                class="btn btn-primary"
                                href="http://solsticio.local/register"
                            >Registrarse</a
                            >
                        </div>
                    </div>
                </div>

                <!-- PAGINATION -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li
                            class="page-item"
                            v-bind:class="[
                                { disabled: !pagination.prev_page_url }
                            ]"
                        >
                            <a
                                @click="readPosts(pagination.prev_page_url)"
                                class="page-link"
                                href="#"
                            >Anterior</a
                            >
                        </li>

                        <li class="page-item disabled">
                            <a class="page-link text-dark" href="#"
                            >Página {{ pagination.current_page }} de
                                {{ pagination.last_page }}</a
                            >
                        </li>

                        <li
                            class="page-item"
                            v-bind:class="[
                                { disabled: !pagination.next_page_url }
                            ]"
                        >
                            <a
                                @click="readPosts(pagination.next_page_url)"
                                class="page-link"
                                href="#"
                            >Siguiente</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Bienvenido!</h5>
                    <div class="card-body">
                        Aquí podrás estar al tanto de cada evento y noticia
                        acerca de tu conjunto!
                    </div>
                </div>

                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Búsqueda</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input
                                class="form-control"
                                placeholder="Buscar..."
                                type="text"
                            />
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    ir
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        created() {
            if (this.$auth.isAuthenticated()) this.getUser();
            this.readPosts();
        },
        data() {
            return {
                user: {},
                files: [],
                pagination: {}
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
            },
            readPosts(page_url) {
                let vm = this;
                page_url = page_url || "/api/files";
                axios
                    .get(page_url)
                    .then(response => {
                        this.files = response.data.data;
                        vm.makePagination(response.data);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta) {
                let pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
                };
                this.pagination = pagination;
            }
        }
    };
</script>
