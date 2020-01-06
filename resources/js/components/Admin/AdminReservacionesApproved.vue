<template>
    <div
        class="container my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    >
        <notifications group="foo" position="bottom left" :speed="500" />
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">
                    Listado de peticiones aprobadas /
                    <a href="/admin/servicios" class="btn btn-link"
                        >Listado de peticiones de salones</a
                    >
                </h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nombre Responsable</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Aprobar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="reservation in reservations"
                            :key="reservation.id"
                        >
                            <th scope="row">
                                <a
                                    @click.prevent="showDetail(reservation)"
                                    class="btn btn-link"
                                    >{{ reservation.id }}</a
                                >
                            </th>
                            <td>{{ reservation.fecha_solicitada }}</td>
                            <td>{{ typeToName(reservation.type) }}</td>
                            <td>{{ reservation.nombre_responsable }}</td>
                            <td>
                                <a
                                    @click.prevent="
                                        showUserDetail(reservation.user_id)
                                    "
                                    class="btn btn-link"
                                    >{{ reservation.user_id }}</a
                                >
                            </td>
                            <td>
                                <button
                                    @click.prevent="
                                        approveReservation(reservation)
                                    "
                                    class="btn btn-success"
                                >
                                    Aprobar
                                </button>
                            </td>
                            <td>
                                <button class="btn btn-danger">Rechazar</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- MODAL -->
        <div
            class="modal fade"
            id="detail-petition"
            tabindex="-1"
            role="dialog"
            aria-labelledby="myLargeModalLabel"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Para:
                            <span class="font-weight-bold">
                                {{ typeToName(this.currentReservation.type) }}
                            </span>
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
                                    this.currentReservation.user_id
                                }}</span>
                            </div>
                            <div class="col-md-11">
                                <h4>
                                    {{
                                        this.currentReservation
                                            .nombre_responsable
                                    }}
                                </h4>
                            </div>
                        </div>
                        <p
                            class="my-2"
                            :class="{
                                available: isAvailable,
                                notAvailable: !isAvailable
                            }"
                        >
                            {{ this.currentReservation.fecha_solicitada }}
                        </p>
                        <p>
                            {{ this.currentReservation.additional_info }}
                        </p>
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
                            Para:
                            <span class="font-weight-bold">
                                {{ typeToName(this.currentReservation.type) }}
                            </span>
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

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                    class="page-item"
                >
                    <a
                        class="page-link"
                        href="#"
                        @click="readReservations(pagination.prev_page_url)"
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
                        @click="readReservations(pagination.next_page_url)"
                        >Siguiente</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    mounted() {
        this.readReservations();
        if (this.$auth.isAuthenticated()) this.getAuthUser();
    },
    data() {
        return {
            reservations: [],
            pagination: {},
            user: null,
            currentReservation: {},
            currentUser: {},
            available: null
        };
    },
    methods: {
        getAuthUser() {
            let url = "http://solsticio.local/api/auth/user";
            axios
                .get(url)
                .then(response => {
                    this.user = response.data.data;
                })
                .catch();
        },
        readReservations(page_url) {
            let vm = this;
            page_url = page_url || "/api/reservations/approved";
            axios
                .get(page_url)
                .then(response => {
                    this.reservations = response.data.data;
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
        typeToName(type) {
            switch (type) {
                case "BBQ": {
                    return "BBQ";
                    break;
                }
                case "SJ": {
                    return "Salon de Juntas";
                    break;
                }
                case "SS": {
                    return "Salon Social";
                    break;
                }
            }
        },
        showDetail(reservation) {
            this.currentReservation = reservation;
            this.isAvailable();
            $("#detail-petition").modal("show");
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
        isAvailable() {
            let result = false;
            for (let reservation in this.reservations) {
                if (
                    this.currentReservation.fecha_solicitada ==
                        reservation.fecha_solicitada &&
                    reservation.status == "APPROVED"
                ) {
                    result = true;
                }
            }
            return result;
        },
        alert(alertType, alertMessage) {
            this.$notify({
                group: "foo",
                type: alertType,
                title: "BIEN",
                text: alertMessage
            });
        },
        approveReservation(reservation) {
            let url = `/api/admin/reservations/${reservation.id}`;
            axios
                .put(url, {
                    status: "APPROVED",
                    reservation
                })
                .then(response => {
                    this.alert(
                        "success",
                        "La reservación ha sido aprovada y ahora se le notificará al usuario"
                    );
                    this.readReservations();
                })
                .catch(error => {
                    this.alert("error", "Algo ha salido mal");
                });
        }
    }
};
</script>
