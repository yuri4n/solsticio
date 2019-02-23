<template>
  <div class="container">
    <div class="row">
      <!-- Post Content Column -->
      <div class="col-lg-8">
        <!-- Title -->
        <h1 class="mt-4">{{classified.title}}</h1>
        <!-- Author -->
        <p class="lead">
          por
          <a href="#">{{user.name}}</a>
        </p>

        <hr>

        <p>{{formatDate(classified.created_at)}}</p>

        <div v-if="classified.file">
          <hr>
          <img class="img-fluid rounded" style="height:300;width:900;" :src="classified.file" alt>
        </div>

        <hr>

        <p class="lead">{{classified.excerpt}}</p>
        <p v-html="classified.body"></p>
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

        <!-- Categories Widget -->
        <div class="card my-4">
          <h5 class="card-header">Categorias</h5>
          <div class="card-body">
            <div class="row">
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">Web Design</a>
                  </li>
                  <li>
                    <a href="#">HTML</a>
                  </li>
                  <li>
                    <a href="#">Freebies</a>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6">
                <ul class="list-unstyled mb-0">
                  <li>
                    <a href="#">JavaScript</a>
                  </li>
                  <li>
                    <a href="#">CSS</a>
                  </li>
                  <li>
                    <a href="#">Tutorials</a>
                  </li>
                </ul>
              </div>
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
      classified: [],
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
      let url = "http://solsticio.local/api/classifieds/" + path[2];
      axios
        .get(url)
        .then(response => {
          this.classified = response.data;
          this.getUser();
        })
        .catch(error => {
          console.log(error);
        });
    },
    getUser() {
      let user_url = "http://solsticio.local/api/users/" + this.classified.user_id;
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