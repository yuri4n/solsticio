<template>
  <div class="container my-5">
    <div
      v-if="$auth.isAuthenticated() && user.role == 'ADMIN' && user.status == 'APPROVED'"
      class="card text-left"
    >
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Panel de administración</h5>
          <p
            class="card-text"
          >En este panel encontrarás herramientas relacionadas con la administración de la página web de Solsticio Parque Residencial Etapa 5</p>
          <p class="card-text">
            <small class="text-muted">Made by Julian Garzon</small>
          </p>
        </div>
        <img
          class="card-img-bottom"
          src="http://solsticio.local/images/background.jpg"
          alt="Card image cap"
        >
      </div>
    </div>
    <div v-else class="card text-center">
      <div class="card-body">
        <h1 class="card-title display-1">Oops! Acceso Restringido!</h1>
        <p
          class="card-text"
        >Lorem ipsum, dolor sit amet consectetur adipisicing elit. Asperiores repudiandae vitae deleniti labore? Cupiditate quia doloremque aspernatur dolore dolores quaerat in quidem reiciendis ipsam. Tempora, consequuntur voluptas. Aperiam, dicta atque.</p>
        <p
          class="card-text"
        >Lorem, ipsum dolor sit amet consectetur adipisicing elit. Minima ad eligendi id sunt in expedita. Fugit accusamus ipsum delectus quo repellendus sit omnis ad, voluptate impedit quisquam adipisci repellat. Consequatur.</p>
        <a href="http://solsticio.local/login" class="btn btn-primary">Iniciar sesión</a>
        <a href="http://solsticio.local/register" class="btn btn-primary">Registrarse</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    if (this.$auth.isAuthenticated()) this.getUser();
  },
  data() {
    return {
      user: undefined
    };
  },
  methods: {
    getUser() {
      var url = "http://solsticio.local/api/auth/user";
      axios
        .get(url)
        .then(response => {
          this.user = response.data.data;
        })
        .catch();
    }
  }
};
</script>
