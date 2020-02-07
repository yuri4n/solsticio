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
                            {{
                            this.generic
                            ? "Peticiones Genericas aprobadas"
                            : "Peticiones de Parqueadero aprobadas"
                            }}
                            /
                            <a class="btn btn-link" href="/admin/peticiones">
                                {{
                                this.generic
                                ? "Peticiones Genericas sin aprobar"
                                : "Peticiones de Parqueadero sin aprobar"
                                }}
                            </a>
                        </h4>
                    </div>
                    <div class="col-sm-3">
                        <button
                            @click.prevent="toggleParking()"
                            class="btn btn-primary"
                        >
                            {{
                            this.generic
                            ? "Peticiones de Parqueadero"
                            : "Peticiones Genericas"
                            }}
                        </button>
                    </div>
                </div>
                <h4 class="card-title">Lista de peticiones</h4>
                <table class="table table-striped" v-if="this.generic">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Cédula</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="petition.id" v-for="petition in petitions">
                        <th scope="row">
                            <button
                                @click.prevent="showDetail(petition)"
                                class="btn btn-link"
                            >
                                {{ petition.id }}
                            </button>
                        </th>
                        <td>{{ petition.nombre_responsable }}</td>
                        <td>{{ petition.cedula }}</td>
                        <td>
                            <button
                                @click.prevent="
                                        showUserDetail(petition.user_id)
                                    "
                                class="btn btn-link"
                            >
                                {{ petition.user_id }}
                            </button>
                        </td>
                        <td>
                            <button
                                @click.prevent="rejectPetition(petition)"
                                class="btn btn-danger"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <table class="table table-striped" v-else>
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Carro</th>
                        <th scope="col">Moto</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="petition.id" v-for="petition in petitions">
                        <th scope="row">
                            <button
                                @click.prevent="showDetail(petition)"
                                class="btn btn-link"
                            >
                                {{ petition.id }}
                            </button>
                        </th>
                        <td>{{ petition.nombre_propietario }}</td>
                        <td>{{ petition.carro }}</td>
                        <td>{{ petition.moto }}</td>
                        <td>
                            <button
                                @click.prevent="
                                        showUserDetail(petition.user_id)
                                    "
                                class="btn btn-link"
                            >
                                {{ petition.user_id }}
                            </button>
                        </td>
                        <td>
                            <button
                                @click.prevent="rejectPetition(petition)"
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
        <!-- GENERIC DETAIL -->
        <div
            aria-hidden="true"
            aria-labelledby="myLargeModalLabel"
            class="modal fade"
            id="detail-generic"
            role="dialog"
            tabindex="-1"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle de la petición
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
                        <h4 class="mt-2 mb-3">
                            <span class="font-weight-bold"
                            >Nombre del responsable:
                            </span>
                            {{ this.currentPetition.nombre_responsable }}
                        </h4>
                        <h5>
                            <span class="font-weight-bold">Cédula: </span>
                            {{ this.currentPetition.cedula }}
                        </h5>
                        <h5 class="font-weight-bold mt-4">Petición:</h5>
                        <p>
                            {{ this.currentPetition.additional }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- PARKING DETAIL -->
        <div
            aria-hidden="true"
            aria-labelledby="myLargeModalLabel"
            class="modal fade"
            id="detail-parking"
            role="dialog"
            tabindex="-1"
        >
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            Detalle de la petición
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
                        <div class="row">
                            <div class="col-md-2">
                                <span class="font-weight-bold"
                                >Tiene deudas:
                                </span>
                                <br/>
                                <p>{{ this.currentPetition.deudas }}</p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Carro: </span>
                                <br/>
                                <p>{{ this.currentPetition.carro }}</p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Moto: </span>
                                <br/>
                                <p>{{ this.currentPetition.moto }}</p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold"
                                >Discapacidad:
                                </span>
                                <br/>
                                <p>{{ this.currentPetition.discapacidad }}</p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold"
                                >Posee parqueadero:
                                </span>
                                <br/>
                                <p>{{ this.currentPetition.asignado }}</p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Numero: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.asignado == "SI"
                                    ? this.currentPetition.numero
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="row mx-1">
                            <span class="font-weight-bold">ROL: </span>
                            <br/>
                            <p>
                                {{ this.currentPetition.tipo }}
                            </p>
                        </div>
                        <div class="row mx-1 mt-2">
                            <h3>Datos del Propietario</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold">Nombre: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.nombre_propietario
                                    }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <span class="font-weight-bold">Telefono: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition
                                    .telefono_propietario
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold"
                                >Direccion:
                                </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition
                                    .direccion_propietario
                                    }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <span class="font-weight-bold">Correo: </span>
                                <br/>
                                <p>
                                    {{ this.currentPetition.email_propietario }}
                                </p>
                            </div>
                        </div>
                        <div class="row mx-1 mt-2">
                            <h3>Datos del Solicitante</h3>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold">Nombre: </span>
                                <br/>
                                <p>
                                    {{ this.currentPetition.nombre_residente }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <span class="font-weight-bold">Telefono: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.telefono_residente
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold"
                                >Direccion:
                                </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.direccion_residente
                                    }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <span class="font-weight-bold">Correo: </span>
                                <br/>
                                <p>
                                    {{ this.currentPetition.email_residente }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold">Torre: </span>
                                <br/>
                                <p>{{ this.currentPetition.torre }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="font-weight-bold"
                                >Apartamento:
                                </span>
                                <br/>
                                <p>{{ this.currentPetition.apartamento }}</p>
                            </div>
                        </div>
                        <h3>Documentos requeridos:</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="font-weight-bold">Cedula: </span>
                                <br/>
                                <a
                                    :href="
                                        '/files/' + this.currentPetition.cedula
                                    "
                                    class="btn btn-primary"
                                    download
                                >Descargar</a
                                >
                            </div>
                            <div class="col-md-3">
                                <span class="font-weight-bold">Tarjeta: </span>
                                <br/>
                                <a
                                    :href="
                                        '/files/' +
                                            this.currentPetition
                                                .tarjeta_propiedad
                                    "
                                    class="btn btn-primary"
                                    download
                                >Descargar</a
                                >
                            </div>
                            <div class="col-md-3">
                                <span class="font-weight-bold">Soat: </span>
                                <br/>
                                <a
                                    :href="
                                        '/files/' + this.currentPetition.soat
                                    "
                                    class="btn btn-primary"
                                    download
                                >Descargar</a
                                >
                            </div>
                            <div class="col-md-3">
                                <span class="font-weight-bold"
                                >Autorización
                                </span>
                                <br/>
                                <a
                                    :href="
                                        '/files/' +
                                            this.currentPetition.autorizacion
                                    "
                                    class="btn btn-primary"
                                    download
                                >Descargar</a
                                >
                            </div>
                        </div>
                        <h3>Datos vehículo 1:</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="font-weight-bold">Placa: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.placa1
                                    ? this.currentPetition.placa1
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Color: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.color1
                                    ? this.currentPetition.color1
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Clase: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.clase1
                                    ? this.currentPetition.clase1
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Marca: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.marca1
                                    ? this.currentPetition.marca1
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Modelo: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.modelo1
                                    ? this.currentPetition.modelo1
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                        </div>
                        <h3>Datos vehículo 2:</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="font-weight-bold">Placa: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.placa2
                                    ? this.currentPetition.placa2
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Color: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.color2
                                    ? this.currentPetition.color2
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Clase: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.clase2
                                    ? this.currentPetition.clase2
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Marca: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.marca2
                                    ? this.currentPetition.marca2
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Modelo: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.modelo2
                                    ? this.currentPetition.modelo2
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                        </div>
                        <h3>Datos vehículo 3:</h3>
                        <div class="row">
                            <div class="col-md-3">
                                <span class="font-weight-bold">Placa: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.placa3
                                    ? this.currentPetition.placa3
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Color: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.color3
                                    ? this.currentPetition.color3
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Clase: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.clase3
                                    ? this.currentPetition.clase3
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Marca: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.marca3
                                    ? this.currentPetition.marca3
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                            <div class="col-md-2">
                                <span class="font-weight-bold">Modelo: </span>
                                <br/>
                                <p>
                                    {{
                                    this.currentPetition.modelo3
                                    ? this.currentPetition.modelo3
                                    : "N/a"
                                    }}
                                </p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <span class="font-weight-bold"
                                >Diligenciador:
                                </span>
                                <br/>
                                <p>{{ this.currentPetition.diligenciador }}</p>
                            </div>
                            <div class="col-md-6">
                                <span class="font-weight-bold"
                                >Documento:
                                </span>
                                <br/>
                                <p>{{ this.currentPetition.documento }}</p>
                            </div>
                        </div>
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

        <!-- PAGINATION -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                >
                    <a
                        @click="readPetitions(pagination.prev_page_url)"
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
                        @click="readPetitions(pagination.next_page_url)"
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
            this.readPetitions();
        },
        data() {
            return {
                petitions: [],
                pagination: {},
                user: {},
                generic: true,
                currentUser: {},
                currentPetition: {}
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
                const url = "http://solsticio.local/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            readPetitions(page_url) {
                let vm = this;
                if (this.generic) {
                    page_url = page_url || "/api/approved/petitions";
                } else {
                    page_url = page_url || "/api/approved/parkings";
                }
                axios
                    .get(page_url)
                    .then(response => {
                        this.petitions = response.data.data;
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
            showDetail(petition) {
                this.currentPetition = petition;
                this.generic
                    ? $("#detail-generic").modal("show")
                    : $("#detail-parking").modal("show");
            },
            toggleParking() {
                this.generic = !this.generic;
                this.readPetitions();
            },
            rejectPetition(petition) {
                let url;
                if (this.generic) {
                    url = "/api/petitions/" + petition.id;
                } else {
                    url = "/api/parkings/" + petition.id;
                }

                const confirmacion = confirm(
                    `¿Seguro que desea eliminar la petición ${petition.id}?`
                );
                if (confirmacion) {
                    axios.delete(url).then(response => {
                        this.alert(
                            "warn",
                            `La petición ${petition.id} ha sido eliminada`
                        );
                        this.readPetitions();
                    });
                }
            }
        }
    };
</script>
