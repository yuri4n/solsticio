<template>
  <div class="container my-5" v-if="$auth.isAuthenticated() && user.role == 'ADMIN'">
    <div class="card text-left mb-3">
      <div class="card-body">
        <h4 class="card-title">Lista de Usuarios</h4>
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">Nombre</th>
              <th scope="col">E-mail</th>
              <th scope="col">Tipo</th>
              <th scope="col">Torre</th>
              <th scope="col">Apartamento</th>
              <th scope="col">Aprobar</th>
              <th scope="col">Rechazar</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users" :key="user.id">
              <th scope="row">{{user.id}}</th>
              <td>{{user.name}}</td>
              <td>{{user.email}}</td>
              <td>{{user.role}}</td>
              <td>{{user.torre}}</td>
              <td>{{user.apartamento}}</td>
              <td>
                <button class="btn btn-success">Aprobar</button>
              </td>
              <td>
                <button class="btn btn-danger">Rechazar</button>
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
          <a class="page-link" href="#" @click="readUsers(pagination.prev_page_url)">Anterior</a>
        </li>

        <li class="page-item disabled">
          <a
            class="page-link text-dark"
            href="#"
          >Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
        </li>

        <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
          <a class="page-link" href="#" @click="readUsers(pagination.next_page_url)">Siguiente</a>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  created() {
    this.readUsers();
    if (this.$auth.isAuthenticated()) this.getUser();
  },
  data() {
    return {
      users: [],
      pagination: {},
      user: undefined
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
    readUsers(page_url) {
      let vm = this;
      page_url = page_url || "/api/users";
      axios
        .get(page_url)
        .then(response => {
          this.users = response.data.data;
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
    }
  }
};
</script>

<style scoped>
</style>