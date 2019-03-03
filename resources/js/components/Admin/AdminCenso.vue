<template>
  <div class="container my-5" v-if="$auth.isAuthenticated() && user.role == 'ADMIN'">
    <notifications group="foo" position="bottom left" :speed="500"/>
    <div class="card text-left mb-3">
      <div class="card-body">
        <h4 class="card-title">Lista de censos pendientes</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">Propietario</th>
              <th scope="col">E-mail</th>
              <th scope="col">Torre</th>
              <th scope="col">Apartamento</th>
              <th scope="col">Guardar</th>
              <th scope="col">Eliminar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="census in censuses" :key="census.id">
              <th scope="row">{{census.id}}</th>
              <td>{{census.elaborado}}</td>
              <td>{{census.nombre_propietario}}</td>
              <td>{{census.email_propietario}}</td>
              <td>{{census.torre}}</td>
              <td>{{census.apartamento}}</td>
              <td>
                <button class="btn btn-success">Guardar</button>
              </td>
              <td>
                <button @click.prevent="rejectCensus(census)" class="btn btn-danger">Eliminar</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Pagination -->
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
          <a class="page-link" href="#" @click="readCensuses(pagination.prev_page_url)">Anterior</a>
        </li>

        <li class="page-item disabled">
          <a
            class="page-link text-dark"
            href="#"
          >Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
        </li>

        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
          <a class="page-link" href="#" @click="readCensuses(pagination.next_page_url)">Siguiente</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  created() {
    if (this.$auth.isAuthenticated()) this.getUser();
    this.readCensuses();
  },
  data() {
    return {
      censuses: [],
      pagination: {},
      user: undefined,
    };
  },
  methods: {
    readCensuses(page_url) {
      let vm = this;
      page_url = page_url || "/api/censuses";
      axios
        .get(page_url)
        .then(response => {
          this.censuses = response.data.data;
          vm.makePagination(response.data);
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
    getUser() {
      var url = "http://solsticio.local/api/auth/user";
      axios
        .get(url)
        .then(response => {
          this.user = response.data.data;
        })
        .catch();
    },
    rejectCensus(census) {
      var url = "http://solsticio.local/api/censuses/" + census.id;
      var confirmacion = confirm(
        `¿Seguro que desea borrar el censo ${census.id}?`
      );
      if (confirmacion) {
        axios.delete(url).then(response => {
          this.alert(
            "warn",
            `El censo ${census.id} ha sido eliminado`
          );
          this.readCensuses();
        });
      }
    },
  }
};
</script>
    
<style scoped>
</style>
