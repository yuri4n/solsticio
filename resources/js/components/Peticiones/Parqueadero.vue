<template>
    <div class="container">
        <notifications group="foo" position="bottom left" :speed="500" />
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card text-left">
                    <div class="card-body">
                        <h3 class="card-title">
                            Formulario de peticion de parqueadero
                        </h3>
                        <p class="card-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Beatae aperiam voluptates mollitia nulla ipsa
                            iusto accusantium eius corrupti blanditiis eum,
                            deleniti ipsum? Vitae odio debitis sapiente saepe
                            tempore consequatur aperiam?
                        </p>
                        <hr />
                        <form
                            action="POST"
                            v-on:submit.prevent="sendPetition()"
                        >
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label
                                        >¿Tiene deudas con la
                                        administración?</label
                                    >
                                    <v-select
                                        v-model="deudas"
                                        :options="[
                                            { label: 'No', value: 'NO' },
                                            { label: 'Si', value: 'SI' }
                                        ]"
                                    ></v-select>
                                </div>
                                <div class="form-group col-md-4 text-center">
                                    <label
                                        >¿Qué tipo de vehículos tiene?</label
                                    >
                                    <p-check
                                        class="p-default p-thick"
                                        v-model="carro"
                                        >Carro</p-check
                                    >
                                    <p-check
                                        class="p-default p-thick"
                                        v-model="moto"
                                        >Moto</p-check
                                    >
                                </div>
                                <div class="form-group col-md-4">
                                    <label
                                        >¿Su vehículo posee placas de
                                        discapacidad?</label
                                    >
                                    <v-select
                                        v-model="discapacidad"
                                        :options="[
                                            { label: 'No', value: 'NO' },
                                            { label: 'Si', value: 'SI' }
                                        ]"
                                    ></v-select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label
                                        >¿Posee actualmente parqueadero
                                        asignado?</label
                                    >
                                    <v-select
                                        v-model="asignado"
                                        :options="[
                                            { label: 'No', value: 'NO' },
                                            { label: 'Si', value: 'SI' }
                                        ]"
                                    ></v-select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="parqueadero">¿Cuál?</label>
                                    <input
                                        v-model="numero"
                                        type="number"
                                        class="form-control"
                                        id="parqueadero"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label >Es usted:</label>
                                    <v-select
                                        v-model="tipo"
                                        :options="[
                                            {
                                                label: 'Propietario',
                                                value: 'PROPIETARIO'
                                            },
                                            {
                                                label: 'Arrendatario',
                                                value: 'ARRENDATARIO'
                                            }
                                        ]"
                                    ></v-select>
                                </div>
                            </div>
                            <hr />
                            <h4>Datos del propietario</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_propietario"
                                        >Nombre completo del propietario</label
                                    >
                                    <input
                                        v-model="nombre_propietario"
                                        type="text"
                                        class="form-control"
                                        id="nombre_propietario"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono_propietario"
                                        >Teléfono</label
                                    >
                                    <input
                                        v-model="telefono_propietario"
                                        type="text"
                                        class="form-control"
                                        id="telefono_propietario"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="direccion_propietario"
                                        >Dirección</label
                                    >
                                    <input
                                        v-model="direccion_propietario"
                                        type="text"
                                        class="form-control"
                                        id="direccion_propietario"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="email_propietario"
                                        >E-mail</label
                                    >
                                    <input
                                        v-model="email_propietario"
                                        type="text"
                                        class="form-control"
                                        id="email_propietario"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <hr />
                            <h4>Datos del solicitante</h4>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="nombre_residente"
                                        >Nombre completo del solicitante</label
                                    >
                                    <input
                                        v-model="nombre_residente"
                                        type="text"
                                        class="form-control"
                                        id="nombre_residente"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="telefono_residente"
                                        >Teléfono</label
                                    >
                                    <input
                                        v-model="telefono_residente"
                                        type="text"
                                        class="form-control"
                                        id="telefono_residente"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-5">
                                    <label for="direccion_residente"
                                        >Dirección</label
                                    >
                                    <input
                                        v-model="direccion_residente"
                                        type="text"
                                        class="form-control"
                                        id="direccion_residente"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="email_residente">E-mail</label>
                                    <input
                                        v-model="email_residente"
                                        type="text"
                                        class="form-control"
                                        id="email_residente"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="torre">Torre</label>
                                    <input
                                        v-model="torre"
                                        type="number"
                                        class="form-control"
                                        id="torre"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="apartamento">Apartamento</label>
                                    <input
                                        v-model="apartamento"
                                        type="number"
                                        class="form-control"
                                        id="apartamento"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <hr />
                            <h4>Documentos Requeridos</h4>
                            <div class="form-group">
                                <label for="cedula"
                                    >Fotocopia de la Cédula</label
                                >
                                <input
                                    type="file"
                                    class="form-control-file"
                                    id="cedula"
                                    @change="cedulaNew"
                                />
                            </div>
                            <div class="form-group">
                                <label for="tarjeta_propiedad"
                                    >Tarjeta de propiedad</label
                                >
                                <input
                                    type="file"
                                    class="form-control-file"
                                    id="tarjeta_propiedad"
                                    @change="tarjeta_propiedadNew"
                                />
                            </div>
                            <div class="form-group">
                                <label for="soat">Soat</label>
                                <input
                                    type="file"
                                    class="form-control-file"
                                    id="soat"
                                    @change="soatNew"
                                />
                            </div>
                            <div class="form-group">
                                <label for="autorizacion"
                                    >Autorizacion del propietario</label
                                >
                                <input
                                    type="file"
                                    class="form-control-file"
                                    id="autorizacion"
                                    @change="autorizacionNew"
                                />
                            </div>
                            <hr />
                            <h4>Datos del Vehiculo</h4>
                            <h5>
                                Asegúrese de tomarlos de la targeta de
                                propiedad*
                            </h5>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="placa1">Placa</label>
                                    <input
                                        v-model="placa1"
                                        type="text"
                                        class="form-control"
                                        id="placa1"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="color1">Color</label>
                                    <input
                                        v-model="color1"
                                        type="text"
                                        class="form-control"
                                        id="color1"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="clase1">Clase</label>
                                    <input
                                        v-model="clase1"
                                        type="text"
                                        class="form-control"
                                        id="clase1"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="marca1">Marca</label>
                                    <input
                                        v-model="marca1"
                                        type="text"
                                        class="form-control"
                                        id="marca1"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="modelo1">Modelo</label>
                                    <input
                                        v-model="modelo1"
                                        type="number"
                                        class="form-control"
                                        id="modelo1"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <h6>Vehículo 2 (no llene de no ser necesario)</h6>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="placa2">Placa</label>
                                    <input
                                        v-model="placa2"
                                        type="text"
                                        class="form-control"
                                        id="placa2"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="color2">Color</label>
                                    <input
                                        v-model="color2"
                                        type="text"
                                        class="form-control"
                                        id="color2"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="clase2">Clase</label>
                                    <input
                                        v-model="clase2"
                                        type="text"
                                        class="form-control"
                                        id="clase2"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="marca2">Marca</label>
                                    <input
                                        v-model="marca2"
                                        type="text"
                                        class="form-control"
                                        id="marca2"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="modelo2">Modelo</label>
                                    <input
                                        v-model="modelo2"
                                        type="number"
                                        class="form-control"
                                        id="modelo2"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <h6>Vehículo 3 (no llene de no ser necesario)</h6>
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="placa3">Placa</label>
                                    <input
                                        v-model="placa3"
                                        type="text"
                                        class="form-control"
                                        id="placa3"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="color3">Color</label>
                                    <input
                                        v-model="color3"
                                        type="text"
                                        class="form-control"
                                        id="color3"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="clase3">Clase</label>
                                    <input
                                        v-model="clase3"
                                        type="text"
                                        class="form-control"
                                        id="clase3"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="marca3">Marca</label>
                                    <input
                                        v-model="marca3"
                                        type="text"
                                        class="form-control"
                                        id="marca3"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="modelo3">Modelo</label>
                                    <input
                                        v-model="modelo3"
                                        type="number"
                                        class="form-control"
                                        id="modelo3"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <hr />
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="diligenciador"
                                        >Nombre completo del
                                        diligenciador</label
                                    >
                                    <input
                                        v-model="diligenciador"
                                        type="text"
                                        class="form-control"
                                        id="diligenciador"
                                        autocomplete="off"
                                    />
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="documento">Su documento</label>
                                    <input
                                        v-model="documento"
                                        type="text"
                                        class="form-control"
                                        id="documento"
                                        autocomplete="off"
                                    />
                                </div>
                            </div>
                            <hr />
                            <button type="submit" class="btn btn-primary">
                                Enviar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title">Bienvenido!</h4>
                        <p class="card-text">
                            Lorem ipsum dolor sit, amet consectetur adipisicing
                            elit. Iusto, in numquam quibusdam.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import vSelect from "vue-select";
import PrettyCheckbox from "pretty-checkbox-vue";
Vue.component("v-select", vSelect);
Vue.use(PrettyCheckbox);

export default {
    created() {
        if (this.$auth.isAuthenticated()) this.getUser();
    },
    data() {
        return {
            deudas: null,
            carro: null,
            moto: null,
            discapacidad: null,
            asignado: null,
            tipo: "",
            numero: "",
            nombre_propietario: "",
            telefono_propietario: "",
            direccion_propietario: "",
            email_propietario: "",
            nombre_residente: "",
            telefono_residente: "",
            direccion_residente: "",
            email_residente: "",
            torre: "",
            apartamento: "",
            cedula: "",
            tarjeta_propiedad: "",
            soat: "",
            autorizacion: "",
            placa1: "",
            color1: "",
            clase1: "",
            marca1: "",
            modelo1: "",
            placa2: "",
            color2: "",
            clase2: "",
            marca2: "",
            modelo2: "",
            placa3: "",
            color3: "",
            clase3: "",
            marca3: "",
            modelo3: "",
            diligenciador: "",
            documento: "",
            user: {}
        };
    },
    methods: {
        alert(title, alertType, alertMessage) {
            this.$notify({
                group: "foo",
                type: alertType,
                title,
                text: alertMessage
            });
        },
        getUser() {
            var url = "http://solsticio.local/api/auth/user";
            axios
                .get(url)
                .then(response => {
                    this.user = response.data.data;
                })
                .catch();
        },
        cedulaNew(event) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.cedula = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        tarjeta_propiedadNew(event) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.tarjeta_propiedad = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        soatNew(event) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.soat = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        autorizacionNew(event) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.autorizacion = e.target.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        },
        sendPetition() {
            var url = "http://solsticio.local/api/parkings";
            axios
                .post(url, {
                    user_id: this.user.id,
                    fecha: this.getDate(),
                    carro: this.carroType(this.carro),
                    moto: this.motoType(this.moto),
                    deudas: this.deudas.value,
                    discapacidad: this.discapacidad.value,
                    asignado: this.asignado.value,
                    tipo: this.tipo.value,
                    numero: this.numero,

                    nombre_propietario: this.nombre_propietario,
                    telefono_propietario: this.telefono_propietario,
                    direccion_propietario: this.direccion_propietario,
                    email_propietario: this.email_propietario,

                    nombre_residente: this.nombre_residente,
                    telefono_residente: this.telefono_residente,
                    direccion_residente: this.direccion_residente,
                    email_residente: this.email_residente,
                    torre: this.torre,
                    apartamento: this.apartamento,

                    cedula: this.cedula,
                    tarjeta_propiedad: this.tarjeta_propiedad,
                    soat: this.soat,
                    autorizacion: this.autorizacion,

                    placa1: this.placa1,
                    color1: this.color1,
                    clase1: this.clase1,
                    marca1: this.marca1,
                    modelo1: this.modelo1,

                    placa2: this.placa2,
                    color2: this.color2,
                    clase2: this.clase2,
                    marca2: this.marca2,
                    modelo2: this.modelo2,

                    placa3: this.placa3,
                    color3: this.color3,
                    clase3: this.clase3,
                    marca3: this.marca3,
                    modelo3: this.modelo3,

                    diligenciador: this.diligenciador,
                    documento: this.documento
                })
                .then(response => {
                    this.alert(
                        "Perfecto!",
                        "success",
                        "La noticia ha sido creada"
                    );
                    this.carro = false;
                    this.moto = false;
                    this.deudas.value = "";
                    this.discapacidad.value = "";
                    this.asignado.value = "";
                    this.tipo.value = "";
                    this.numero = "";

                    this.nombre_propietario = "";
                    this.telefono_propietario = "";
                    this.direccion_propietario = "";
                    this.email_propietario = "";

                    this.nombre_residente = "";
                    this.telefono_residente = "";
                    this.direccion_residente = "";
                    this.email_residente = "";
                    this.torre = "";
                    this.apartamento = "";

                    this.cedula = "";
                    this.tarjeta_propiedad = "";
                    this.soat = "";
                    this.autorizacion = "";

                    this.placa1 = "";
                    this.color1 = "";
                    this.clase1 = "";
                    this.marca1 = "";
                    this.modelo1 = "";

                    this.placa2 = "";
                    this.color2 = "";
                    this.clase2 = "";
                    this.marca2 = "";
                    this.modelo2 = "";

                    this.placa3 = "";
                    this.color3 = "";
                    this.clase3 = "";
                    this.marca3 = "";
                    this.modelo3 = "";

                    this.diligenciador = "";
                    this.documento = "";
                })
                .catch(error => {
                    this.alert(
                        "Error",
                        "error",
                        "Completa los datos requeridos"
                    );
                });
        },
        carroType(carro) {
            if (carro) {
                return "SI";
            } else {
                return "NO";
            }
        },
        motoType(moto) {
            if (moto) {
                return "SI";
            } else {
                return "NO";
            }
        },
        getDate() {
            let today = new Date();
            let dd = today.getDate();
            let mm = today.getMonth() + 1;
            let yyyy = today.getFullYear();

            if (dd < 10) dd = "0" + dd;

            if (mm < 10) mm = "0" + mm;

            today = yyyy + "-" + mm + "-" + dd;
            return today;
        }
    }
};
</script>
