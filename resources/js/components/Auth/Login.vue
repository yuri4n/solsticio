<template>
  <div class="container my-5">
    <div class="row justify-content-between">
      <div class="col-md-4">
        <div class="card card-default">
          <div class="card-header">Inicia Sesión</div>
          <div class="card-body">
            <div class="alert alert-danger" v-if="has_error">
              <p>Estos datos no coinciden con nuestra informacion</p>
            </div>
            <form autocomplete="off" @submit.prevent="login" method="post">
              <div class="form-group">
                <label for="email">E-mail</label>
                <input
                  type="email"
                  id="email"
                  class="form-control"
                  placeholder="usuario@ejemplo.com"
                  v-model="email"
                  required
                >
              </div>
              <div class="form-group">
                <label for="password">Constraseña</label>
                <input
                  type="password"
                  id="password"
                  class="form-control"
                  v-model="password"
                  required
                >
              </div>
              <button type="submit" class="btn btn-default">Iniciar</button>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-8">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Title</h4>
            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Necessitatibus ab fugit quos nisi. Dignissimos repellendus quaerat ex ea! Sequi adipisci doloremque repudiandae enim tenetur neque voluptates explicabo quos iure omnis?</p>
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
      this.$auth.login({ 
        email: this.email, 
        password: this.password, 
        }).then(response => {
          window.location = response.data.redirect;
      }).catch(error => {
        this.has_error = true;
      });
    },
  }
};
</script>