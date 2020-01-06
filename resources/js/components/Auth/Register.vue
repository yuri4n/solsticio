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
                            autocomplete="off"
                            @submit.prevent="register"
                            method="post"
                        >
                            <div
                                class="form-group"
                                v-bind:class="{
                                    'has-error': has_error && errors.name
                                }"
                            >
                                <label for="name">Nombre Completo:</label>
                                <input
                                    type="text"
                                    id="name"
                                    class="form-control"
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
                                    type="email"
                                    id="email"
                                    class="form-control"
                                    placeholder="usuario@ejemplo.com"
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
                                    v-model="role"
                                    class="form-control"
                                    id="role"
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
                                    type="number"
                                    id="torre"
                                    class="form-control"
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
                                    type="number"
                                    id="apartamento"
                                    class="form-control"
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
                                    type="password"
                                    id="password"
                                    class="form-control"
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
                                    type="password"
                                    id="password_confirmation"
                                    class="form-control"
                                    v-model="password_confirmation"
                                />
                            </div>
                            <button type="submit" class="btn btn-default">
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
                    <hr class="my-4" />
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
