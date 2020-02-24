<template>
    <div
        class="container vh-100 my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN' && user.status === 'APPROVED'"
    >
        <notifications :speed="500" group="foo" position="bottom left"/>
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">
                    Lista de Usuarios pendientes por aprobar /
                    <a class="btn btn-link" href="/admin/usuarios/completos"
                    >Lista de Usuarios aprobados</a
                    >
                </h4>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">E-mail</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Torre</th>
                        <th scope="col">Apartamento</th>
                        <th scope="col">Aprobar</th>
                        <th scope="col">Rechazar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="user.id" v-for="user in users">
                        <th scope="row">{{ user.id }}</th>
                        <td>
                            <button
                                @click.prevent="showUserDetail(user.id)"
                                class="btn btn-link"
                            >
                                {{ user.name }}
                            </button>
                        </td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.role }}</td>
                        <td>{{ user.torre }}</td>
                        <td>{{ user.apartamento }}</td>
                        <td>
                            <button
                                @click="updateStatus(user)"
                                class="btn btn-success"
                            >
                                Aprobar
                            </button>
                        </td>
                        <td>
                            <button
                                @click.prevent="rejectUser(user)"
                                class="btn btn-danger"
                            >
                                Rechazar
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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

        <!-- PAGINATION -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                >
                    <a
                        @click="readUsers(pagination.prev_page_url)"
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
                        @click="readUsers(pagination.next_page_url)"
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
            this.readUsers();
        },
        data() {
            return {
                users: [],
                pagination: {},
                user: {},
                currentUser: {}
            };
        },
        methods: {
            alert(alertType, alertMessage) {
                this.$notify({
                    group: "foo",
                    type: alertType,
                    title: "BIEN",
                    text: alertMessage
                });
            },
            readUsers(page_url) {
                let vm = this;
                page_url = page_url || "/api/users";
                axios
                    .get(page_url)
                    .then(response => {
                        this.users = response.data.data;
                        vm.makePagination(response.data);
                    })
                    .catch(err => console.log(err));
            },
            makePagination(meta) {
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
                };
            },
            getUser() {
                var url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            showUserDetail(id) {
                let url = `/api/users/${id}`;
                axios
                    .get(url)
                    .then(response => {
                        this.currentUser = response.data.user;
                    })
                    .catch(error => console.log(error));
                $("#detail-user").modal("show");
            },
            updateStatus(user) {
                const url = `/api/approved/users/${user.id}`;
                axios
                    .put(url, {
                        status: "APPROVED",
                        user
                    })
                    .then(response => {
                        this.alert("success", "El usuario ha sido aprobado");
                        this.readUsers();
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            },
            rejectUser(user) {
                const url = `/api/rejected/users/${user.id}`;
                const confirmacion = confirm(
                    `¿Seguro que desea borrar el usuario y notificarlo ${user.id}?`
                );
                if (confirmacion) {
                    axios.put(url, {
                        user
                    }).then(response => {
                        this.deleteUser(user.id);
                        this.alert(
                            "warn",
                            `El usuario ${user.id} ha sido rechazado`
                        );
                    }).catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
                }
            },
            deleteUser(id) {
                const url = `/api/users/${id}`;
                axios.delete(url).then(response => {
                    this.readUsers();
                }).catch();
            }
        }
    };
</script>

<style scoped>
    .vh-100 {
        min-height: 69vh;
    }
</style>
