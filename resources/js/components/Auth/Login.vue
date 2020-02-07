<template>
    <div class="container login-cont my-5">
        <div class="row justify-content-between">
            <div class="col-md-4">
                <div class="card card-default">
                    <div class="card-header">Inicia Sesión</div>
                    <div class="card-body">
                        <div class="alert alert-danger" v-if="has_error">
                            <p>
                                Estos datos no coinciden con nuestra informacion
                            </p>
                        </div>
                        <form
                            @submit.prevent="login"
                            autocomplete="off"
                            method="post"
                        >
                            <div class="form-group">
                                <label for="email">E-mail</label>
                                <input
                                    class="form-control"
                                    id="email"
                                    placeholder="usuario@ejemplo.com"
                                    required
                                    type="email"
                                    v-model="email"
                                />
                            </div>
                            <div class="form-group">
                                <label for="password">Constraseña</label>
                                <input
                                    class="form-control"
                                    id="password"
                                    required
                                    type="password"
                                    v-model="password"
                                />
                            </div>
                            <button class="btn btn-default" type="submit">
                                Iniciar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Recuerda que:</h4>
                        <p class="card-text">
                            No tendrás acceso a todo el contenido que tenemos
                            para tí hasta que un administrador del sitio apruebe
                            tu cuenta.
                        </p>
                        <p>
                            Revisa tu correo electronico para estar seguro si tu
                            cuenta no fue rechazada
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                email: null,
                password: null,
                has_error: false
            };
        },
        methods: {
            login() {
                this.$auth
                    .login({
                        email: this.email,
                        password: this.password
                    })
                    .then(response => {
                        window.location = response.data.redirect;
                    })
                    .catch(error => {
                        this.has_error = true;
                    });
            }
        }
    };
</script>
