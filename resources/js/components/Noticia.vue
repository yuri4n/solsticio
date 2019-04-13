<template>
  <div class="container">
    <div class="row">
      <!-- Post Content Column -->
      <div class="col-lg-8">
        <!-- Title -->
        <h1 class="mt-4">{{post.title}}</h1>
        <!-- Author -->
        <p class="lead">
          por
          <a href="#">{{user.name}}</a>
        </p>

        <hr>

        <p>{{formatDate(post.created_at)}}</p>

        <div v-if="post.file">
          <hr>
          <img class="img-fluid rounded" style="height:300;width:900;" :src="post.file" alt>
        </div>

        <hr>

        <p class="lead">{{post.excerpt}}</p>
        <p v-html="post.body"></p>
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Bienvenido!</h5>
          <div
            class="card-body"
          >Aquí podrás estar al tanto de cada evento y noticia acerca de tu conjunto!</div>
        </div>

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Búsqueda</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" placeholder="Buscar...">
              <span class="input-group-btn">
                <button class="btn btn-secondary" type="button">ir</button>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    this.readPost();
  },
  data() {
    return {
      post: [],
      user: {}
    };
  },
  methods: {
    formatDate(date) {
      var monthNames = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre"
      ];

      var ndate = date.split(" ");
      var fdate = ndate[0].split("-");

      var month = fdate[1];

      while (month.charAt(0) == "0") month = month.substr(1);

      var day = fdate[2];
      var monthIndex = month;
      var year = fdate[0];

      return day + " de " + monthNames[monthIndex - 1] + " de " + year;
    },
    readPost() {
      let path = window.location.pathname.split("/");
      let url = "http://solsticio.local/api/posts/" + path[2];
      axios
        .get(url)
        .then(response => {
          this.post = response.data;
          this.getUser();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getUser() {
      let user_url = "http://solsticio.local/api/users/" + this.post.user_id;
      axios
        .get(user_url)
        .then(response => {
          this.user = response.data.user;
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>

