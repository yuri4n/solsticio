<template>
    <div class="container my-5">
        <div class="row">
            <div class="col-md-6">
                <div class="card card-default">
                    <div class="card-header">Registro</div>
                    <div class="card-body">
                        <div class="alert alert-danger" v-if="has_error">
                            <p>Error!</p>
                        </div>
                        <form
                            @submit.prevent="register"
                            autocomplete="off"
                            method="POST"
                        >
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.name
                                }"
                            >
                                <label for="name">Nombre Completo:</label>
                                <input
                                    class="form-control"
                                    id="name"
                                    type="text"
                                    v-model="name"
                                />
                                <span
                                    class="help-block"
                                    v-if="has_error && errors.name"
                                >{{ errors.name }}</span
                                >
                            </div>
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.email
                                }"
                            >
                                <label for="email">E-mail</label>
                                <input
                                    class="form-control"
                                    id="email"
                                    placeholder="usuario@ejemplo.com"
                                    type="email"
                                    v-model="email"
                                />
                                <span
                                    class="help-block"
                                    v-if="has_error && errors.email"
                                >{{ errors.email }}</span
                                >
                            </div>
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.password
                                }"
                            >
                                <label for="role">Es usted:</label>
                                <select
                                    class="form-control"
                                    id="role"
                                    v-model="role"
                                >
                                    <option>ARRENDATARIO</option>
                                    <option>PROPIETARIO</option>
                                </select>
                                <span
                                    class="help-block"
                                    v-if="has_error && errors.role"
                                >{{ errors.role }}</span
                                >
                            </div>
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.password
                                }"
                            >
                                <label for="torre">Torre</label>
                                <input
                                    class="form-control"
                                    id="torre"
                                    type="number"
                                    v-model="torre"
                                />
                                <span
                                    class="help-block"
                                    v-if="has_error && errors.torre"
                                >{{ errors.torre }}</span
                                >
                            </div>
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.password
                                }"
                            >
                                <label for="apartamento">Apartamento</label>
                                <input
                                    class="form-control"
                                    id="apartamento"
                                    type="number"
                                    v-model="apartamento"
                                />
                                <span
                                    class="help-block"
                                    v-if="has_error && errors.apartamento"
                                >{{ errors.apartamento }}</span
                                >
                            </div>
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.password
                                }"
                            >
                                <label for="password">Contraseña</label>
                                <input
                                    class="form-control"
                                    id="password"
                                    type="password"
                                    v-model="password"
                                />
                                <span
                                    class="help-block"
                                    v-if="has_error && errors.password"
                                >{{ errors.password }}</span
                                >
                            </div>
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.password
                                }"
                            >
                                <label for="password_confirmation"
                                >Confirme la contraseña</label
                                >
                                <input
                                    class="form-control"
                                    id="password_confirmation"
                                    type="password"
                                    v-model="password_confirmation"
                                />
                            </div>
                            <button class="btn btn-default" type="submit">
                                Registrarse
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xl-6">
                <div class="jumbotron">
                    <h1 class="display-4">
                        Recuerda llenar tus datos correctamente
                    </h1>
                    <p class="lead">
                        Un administrador del sitio dará de alta tu cuenta, serás
                        notificado a tu correo
                    </p>
                    <hr class="my-4"/>
                    <p>
                        Hasta entonces no podrás llenar formularios ni realizar
                        peticiones, así que procura ser honesto con tus datos
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                name: "",
                email: "",
                role: "",
                torre: "",
                apartamento: "",
                password: "",
                password_confirmation: "",
                has_error: false,
                errors: null
            };
        },
        methods: {
            register() {
                this.$auth
                    .register({
                        name: this.name,
                        email: this.email,
                        role: this.role,
                        password: this.password,
                        password_confirmation: this.password_confirmation,
                        torre: this.torre,
                        apartamento: this.apartamento
                    })
                    .then(response => {
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.has_error = true;
                        this.errors = error.errors;
                    });
            }
        }
    };
</script>
