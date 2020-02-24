<template>
    <div
        class="container vh-100 my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN' && user.status === 'APPROVED'"
    >
        <notifications :speed="500" group="foo" position="bottom left"/>
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">
                    Clasificados Aprobados /
                    <a class="btn btn-link" href="/admin/clasificados"
                    >Clasificados pendientes por aprobar</a
                    >
                </h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Eliminar</th>
                        ``
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        :key="classified.id"
                        v-for="classified in classifieds"
                    >
                        <th scope="row">{{ classified.id }}</th>
                        <td>
                            <button
                                @click.prevent="showDetail(classified)"
                                class="btn btn-link"
                            >
                                {{ classified.title }}
                            </button>
                        </td>
                        <td>
                            <button
                                @click.prevent="
                                        showUserDetail(classified.user_id)
                                    "
                                class="btn btn-link"
                            >
                                {{ classified.user_id }}
                            </button>
                        </td>
                        <td>
                            <button
                                class="btn btn-danger"
                                v-on:click.prevent="
                                        deleteClassified(classified.id)
                                    "
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CLASSIFIED DETAIL -->
        <div
            aria-hidden="true"
            aria-labelledby="myLargeModalLabel"
            class="modal fade"
            id="detail-classified"
            role="dialog"
            tabindex="-1"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle del clasificado
                        </h5>
                        <button
                            aria-label="Close"
                            class="close"
                            data-dismiss="modal"
                            type="button"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h3 class="mb-4">{{ this.currentClassified.title }}</h3>
                        <p>
                            <span class="text-muted">{{
                                this.currentClassified.excerpt
                            }}</span>
                        </p>
                        <p>{{ this.currentClassified.body }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- USER DETAIL -->
        <div
            aria-hidden="true"
            aria-labelledby="myLargeModalLabel"
            class="modal fade"
            id="detail-user"
            role="dialog"
            tabindex="-1"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle del usuario
                        </h5>
                        <button
                            aria-label="Close"
                            class="close"
                            data-dismiss="modal"
                            type="button"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row d-flex align-items-center">
                            <div class="col-md-1">
                                <span class="font-weight-bold">{{
                                    this.currentUser.id
                                }}</span>
                            </div>
                            <div class="col-md-11">
                                <h4>
                                    {{ this.currentUser.name }}
                                </h4>
                            </div>
                        </div>
                        <p>
                            <span class="font-weight-bold">Rol: </span>
                            {{ this.currentUser.role }}
                        </p>
                        <p>
                            <span class="font-weight-bold">Email: </span>
                            {{ this.currentUser.email }}
                        </p>
                        <p>
                            <span class="font-weight-bold">Torre: </span>
                            {{ this.currentUser.torre }}
                        </p>
                        <p>
                            <span class="font-weight-bold">Apartamento: </span>
                            {{ this.currentUser.apartamento }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- NAVIGATION -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                >
                    <a
                        @click="readClassifieds(pagination.prev_page_url)"
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
                        @click="readClassifieds(pagination.next_page_url)"
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
            this.readClassifieds();
        },
        data() {
            return {
                classifieds: [],
                pagination: {},
                status: "",
                user: {},
                currentClassified: {},
                currentUser: {}
            };
        },
        methods: {
            alert(alertTitle, alertType, alertMessage) {
                this.$notify({
                    group: "foo",
                    type: alertType,
                    title: alertTitle,
                    text: alertMessage
                });
            },
            getUser() {
                let url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            readClassifieds(page_url) {
                let vm = this;
                page_url = page_url || "/api/admin/classifieds";
                axios
                    .get(page_url)
                    .then(response => {
                        this.classifieds = response.data.data;
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
            deleteClassified(id) {
                let url = `/api/classifieds/${id}`;
                axios
                    .delete(url)
                    .then(response => {
                        this.alert(
                            "Bien",
                            "warn",
                            "El clasificado ha sido eliminado satisfactoriamente"
                        );
                        this.readClassifieds();
                    })
                    .catch(error => {
                        this.alert(
                            "Error",
                            "error",
                            "Algo ha salido mal intentando borrar el clasificado"
                        );
                    });
            },
            showUserDetail(id) {
                let url = `/api/users/${id}`;
                axios
                    .get(url)
                    .then(response => {
                        this.currentUser = response.data.user;
                    })
                    .catch(err => console.log(err));
                $("#detail-user").modal("show");
            },
            showDetail(classified) {
                this.currentClassified = classified;
                $("#detail-classified").modal("show");
            }
        }
    };
</script>

<style scoped>
    .vh-100 {
        min-height: 69vh;
    }
</style>
