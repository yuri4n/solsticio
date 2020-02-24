<template>
    <div
        class="container vh-100 my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN' && user.status === 'APPROVED'"
    >
        <notifications :speed="500" group="foo" position="bottom left"/>
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">
                    Listado de peticiones de salones /
                    <a class="btn btn-link" href="/admin/servicios/aprobadas"
                    >Listado de peticiones aprobadas</a
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
                        <th scope="col">Rechazar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr
                        :key="reservation.id"
                        v-for="reservation in reservations"
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
                            <button
                                @click.prevent="
                                        showUserDetail(reservation.user_id)
                                    "
                                class="btn btn-link"
                            >
                                {{ reservation.user_id }}
                            </button>
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
                            <button
                                @click.prevent="
                                        rejectReservation(reservation)
                                    "
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

        <!-- RESERVATION DETAIL -->
        <div
            aria-hidden="true"
            aria-labelledby="myLargeModalLabel"
            class="modal fade"
            id="detail-petition"
            role="dialog"
            tabindex="-1"
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
                            :class="{
                                available: this.available,
                                notAvailable: !this.available
                            }"
                            class="my-2"
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

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                >
                    <a
                        @click="readReservations(pagination.prev_page_url)"
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
                        @click="readReservations(pagination.next_page_url)"
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
        mounted() {
            this.readReservations();
            this.readApprovedReservations();
            if (this.$auth.isAuthenticated()) this.getAuthUser();
        },
        data() {
            return {
                reservations: [],
                approvedReservations: [],
                pagination: {},
                user: null,
                currentReservation: {},
                currentUser: {},
                available: true
            };
        },
        methods: {
            getAuthUser() {
                let url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            readReservations(page_url) {
                let vm = this;
                page_url = page_url || "/api/reservations";
                axios
                    .get(page_url)
                    .then(response => {
                        this.reservations = response.data.data;
                        vm.makePagination(response.data);
                    })
                    .catch(err => console.log(err));
            },
            readApprovedReservations() {
                let url = "/api/approved/reservations";
                axios
                    .get(url)
                    .then(response => {
                        this.approvedReservations = response.data.data;
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
                this.available = true;
                for (let reservation of this.approvedReservations) {
                    if (
                        this.currentReservation.fecha_solicitada ==
                        reservation.fecha_solicitada
                    ) {
                        this.available = false;
                    }
                }
                this.readApprovedReservations();
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
                let url = `/api/approved/reservations/${reservation.id}`;
                axios
                    .put(url, {
                        status: "APPROVED",
                        reservation
                    })
                    .then(response => {
                        this.alert(
                            "success",
                            "La reservación ha sido aprobada y ahora se le notificará al usuario"
                        );
                        this.readReservations();
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            },
            rejectReservation(reservation) {
                let url = `/api/reject/reservations/${reservation.id}`;
                axios
                    .put(url, {
                        reservation
                    })
                    .then(response => {
                        this.deleteReservation(reservation.id);
                        this.alert(
                            "warn",
                            "La reservación ha sido rechazada y ahora se le notificará al usuario"
                        );
                        this.readReservations();
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            },
            deleteReservation(id) {
                const url = `/api/reservations/${id}`;
                axios
                    .delete(url)
                    .then()
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            }
        }
    };
</script>

<style scoped>
    .vh-100 {
        min-height: 69vh;
    }
</style>
