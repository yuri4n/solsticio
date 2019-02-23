<template>
  <nav
    v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    class="navbar navbar-expand-lg navbar-dark bg-dark"
  >
    <a class="navbar-brand" href="http://solsticio.local/inicio/">
      <img src="http://solsticio.local/images/icon.png" width="30" height="30" alt>
      Solsticio Parque Residencial |
      <small class="text-muted">Etapa 5</small>
    </a>
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/noticias/">Noticias</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/servicios/">Servicios</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/archivos/">Archivos</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/clasificados/">Clasificados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/peticiones/">Peticiones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/censo/">Censo</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="http://solsticio.local/admin/usuarios/">Usuarios</a>
        </li>
        <li class="nav-item" id="auth">
          <a
            id="logout"
            class="nav-link"
            href="http://solsticio.local/inicio"
            @click="$auth.logout()"
          >Cerrar Sesión</a>
        </li>
      </ul>
    </div>
  </nav>
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

<style scoped>
#logout {
  color: #fff !important;
  font-weight: bold !important;
}
</style>

