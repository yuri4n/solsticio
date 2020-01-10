<template>
    <div
        class="container my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    >
        <notifications group="foo" position="bottom left" :speed="500" />
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">
                    Clasificados pendientes por aprobar /
                    <a href="/admin/clasificados/aprovados" class="btn btn-link"
                        >Clasificados Aprovados</a
                    >
                </h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Aprobar</th>
                            <th scope="col">Rechazar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="classified in classifieds"
                            :key="classified.id"
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
                                    class="btn btn-success"
                                    v-on:click="updateClassified(classified)"
                                >
                                    Aprobar
                                </button>
                            </td>
                            <td>
                                <button
                                    class="btn btn-danger"
                                    v-on:click.prevent="
                                        rejectClassified(classified)
                                    "
                                >
                                    Rechazar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- CLASSIFIED DETAIL -->
        <div
            class="modal fade"
            id="detail-classified"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle del clasificado
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
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
            class="modal fade"
            id="detail-user"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle del usuario
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
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
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                    class="page-item"
                >
                    <a
                        class="page-link"
                        href="#"
                        @click="readClassifieds(pagination.prev_page_url)"
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
                    v-bind:class="[{ disabled: !pagination.next_page_url }]"
                    class="page-item"
                >
                    <a
                        class="page-link"
                        href="#"
                        @click="readClassifieds(pagination.next_page_url)"
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
            currentUser: {},
            currentClassified: {}
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
        getUser() {
            let url = "http://solsticio.local/api/auth/user";
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
        rejectClassified(classified) {
            let url = `/api/reject/classifieds/${classified.id}`;
            let confirmation = confirm(
                `¿Seguro que desea rechazar el clasificado ${classified.id}?`
            );

            if (confirmation)
                axios
                    .put(url, {
                        classified
                    })
                    .then(response => {
                        this.deleteClassified(classified.id);
                        this.alert(
                            "warn",
                            "El clasificado ha sido rechazado y el usuario notificado"
                        );
                        this.readClassifieds();
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
        },
        deleteClassified(id) {
            let url = `/api/classifieds/${id}`;
            axios.delete(url).catch();
        },
        updateClassified(classified) {
            let url = `http://solsticio.local/api/admin/classifieds/${classified.id}`;
            axios
                .put(url, {
                    status: "PUBLISHED",
                    classified
                })
                .then(response => {
                    this.readClassifieds();
                    this.alert(
                        "success",
                        "El clasificado ha sido aprovado y ahora será visible"
                    );
                })
                .catch(error => {
                    this.alert("error", "Algo ha salido mal");
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

<style></style>
