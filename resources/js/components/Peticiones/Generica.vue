<template>
    <div class="vh-100 container">
        <notifications :speed="500" group="foo" position="bottom left"/>
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card text-left">
                    <div class="card-body"
                         v-if="this.$auth.isAuthenticated() && user.status === 'APPROVED'"
                    >
                        <h4 class="card-title">Formulario de peticiones</h4>
                        <p class="card-text">
                            Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit. Beatae aperiam voluptates mollitia nulla ipsa
                            iusto accusantium eius corrupti blanditiis eum,
                            deleniti ipsum? Vitae odio debitis sapiente saepe
                            tempore consequatur aperiam?
                        </p>
                        <form @submit.prevent="sendPetition()">
                            <div class="form-group">
                                <label for="name">Nombre del responsable</label>
                                <input
                                    aria-describedby="nameHelp"
                                    autocomplete="off"
                                    class="form-control"
                                    id="name"
                                    placeholder
                                    type="text"
                                    v-model="newName"
                                />
                                <small class="text-muted" id="nameHelp"
                                >Help text</small
                                >
                            </div>
                            <div class="form-group">
                                <label for="cedula">Número de cédula</label>
                                <input
                                    aria-describedby="cedulaHelp"
                                    autocomplete="off"
                                    class="form-control"
                                    id="cedula"
                                    placeholder
                                    type="number"
                                    v-model="newCedula"
                                />
                                <small class="text-muted" id="cedulaHelp"
                                >Help text</small
                                >
                            </div>
                            <div class="form-group">
                                <label for="texto">Texto</label>
                                <textarea
                                    class="form-control"
                                    id="texto"
                                    rows="6"
                                    v-model="newAdditional"
                                />
                            </div>
                            <button class="btn btn-primary mb-2" type="submit">
                                Enviar
                            </button>
                        </form>
                    </div>
                    <div class="card-body" v-if="this.$auth.isAuthenticated() && user.status === 'PENDING'">
                        <h4 class="card-title">Tu cuenta no está aprobada</h4>
                        <p class="card-text">
                            Primero deberás esperar a que un administrador del sitio apruebe tu
                            cuenta, por favor revisa el correo con el que te registraste
                        </p>
                    </div>
                    <div class="card-body" v-else>
                        <h4 class="card-title">Deberás iniciar sesión para realizar la petición</h4>
                        <p class="card-text">
                            El contenido de esta página es exclusiva para usuarios registrados. Si perteneces a la
                            comunidad de Solsticio Etapa 5, por favor registrate o inicia sesión.
                        </p>
                        <a class="btn btn-primary" href="/login">Iniciar sesión</a>
                        <a class="btn btn-primary" href="/register">Registrarse</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title">Bienvenido!</h4>
                        <p class="card-text">
                            Por favor llena correctamente los campos, con información precisa y honesta para poder
                            brindarte una respuesta rápida.
                        </p>
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
        },
        data() {
            return {
                user: {},
                newName: "",
                newCedula: "",
                newAdditional: ""
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
                const url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            sendPetition() {
                const url = "/api/petitions";
                axios
                    .post(url, {
                        user_id: this.user.id,
                        nombre_responsable: this.newName,
                        cedula: this.newCedula,
                        additional: this.newAdditional
                    })
                    .then(response => {
                        this.alert("success", "La reservación ha sido solicitada");
                        (this.newName = ""),
                            (this.newCedula = ""),
                            (this.newAdditional = "");
                    })
                    .catch(error => {
                        this.alert(
                            "Error",
                            "error",
                            "Completa todos los campos requeridos"
                        );
                    });
            }
        }
    };
</script>

<style scoped>
    .vh-100 {
        min-height: 74vh;
    }
</style>
