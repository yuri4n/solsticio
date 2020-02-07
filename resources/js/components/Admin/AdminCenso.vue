<template>
    <div
        class="container my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    >
        <notifications :speed="500" group="foo" position="bottom left"/>
        <div class="card text-left mb-3">
            <div class="card-body">
                <div class="row justify-content-between mb-4">
                    <div class="col-sm-8">
                        <h4 class="card-title">
                            Listado de censos sin exportar /
                            <a
                                class="btn btn-link"
                                href="/admin/censo/exportados"
                            >Listado de censos exportados</a
                            >
                        </h4>
                    </div>
                    <div class="col-sm-4">
                        <a
                            download="censos.xlsx"
                            href="/api/export/censuses/"
                            type="button"
                        >
                            <button class="btn btn-primary">
                                Exportar Todos
                            </button>
                        </a>
                        <a
                            @click="exportPending()"
                            download="censos.xlsx"
                            href="/api/export_pending/censuses/"
                            type="button"
                        >
                            <button class="btn btn-primary">
                                Exportar Pendientes
                            </button>
                        </a>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Propietario</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Torre</th>
                        <th scope="col">Apartamento</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="census.id" v-for="census in censuses">
                        <th scope="row">{{ census.id }}</th>
                        <td>{{ census.elaborado }}</td>
                        <td>{{ census.nombre_propietario }}</td>
                        <td>{{ census.email_propietario }}</td>
                        <td>{{ census.torre }}</td>
                        <td>{{ census.apartamento }}</td>
                        <td>
                            <button
                                @click.prevent="rejectCensus(census)"
                                class="btn btn-danger"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                >
                    <a
                        @click="readCensuses(pagination.prev_page_url)"
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
                    v-bind:class="[{ disabled: !pagination.next_page_url }]"
                >
                    <a
                        @click="readCensuses(pagination.next_page_url)"
                        class="page-link"
                        href="#"
                    >Siguiente</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    export default {
        created() {
            if (this.$auth.isAuthenticated()) this.getUser();
            this.readCensuses();
        },
        data() {
            return {
                censuses: [],
                pagination: {},
                user: undefined
            };
        },
        methods: {
            readCensuses(page_url) {
                let vm = this;
                page_url = page_url || "/api/censuses";
                axios
                    .get(page_url)
                    .then(response => {
                        this.censuses = response.data.data;
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
            },
            getUser() {
                let url = "http://solsticio.local/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            alert(alertType, alertMessage) {
                this.$notify({
                    group: "foo",
                    type: alertType,
                    title: "BIEN",
                    text: alertMessage
                });
            },
            rejectCensus(census) {
                let url = "http://solsticio.local/api/censuses/" + census.id;
                let confirmacion = confirm(
                    `¿Seguro que desea borrar el censo ${census.id}?`
                );
                if (confirmacion) {
                    axios.delete(url).then(response => {
                        this.alert(
                            "warn",
                            `El censo ${census.id} ha sido eliminado`
                        );
                        this.readCensuses();
                    });
                }
            },
            exportAll() {
            },
            exportPending() {
                this.updatePending();
                this.alert("success", "Los censos han sido exportados");
                this.readCensuses();
            },
            updatePending() {
                let url = "/api/censuses/";
                this.censuses.forEach(census => {
                    axios
                        .put(url + census.id, {
                            status: "SAVED"
                        })
                        .then()
                        .catch();
                });
            }
        }
    };
</script>

<style scoped></style>
