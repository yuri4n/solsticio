<template>
  <div class="container">
    <notifications group="foo" position="bottom left" :speed="500"/>
    <div class="row">
      <!-- Blog Entries Column -->
      <div class="col-md-8 mb-4">
        <h1 class="my-4">
          Clasificados
          <small class="text-muted">Pública en tu conjunto</small>
        </h1>
        <!-- 
                750x300
        -->
        <!-- Blog Classified -->
        <div class="row">
          <div class="col-sm-6" v-for="classified in classifieds" v-bind:key="classified.id">
            <div class="card sm-4 mb-3" style="width: 20rem;">
              <img
                v-if="classified.file"
                class="card-img-top"
                :src="classified.file"
                alt="Card image cap"
              >
              <div class="card-body">
                <h2 class="card-title">{{ classified.title }}</h2>
                <p class="card-text">{{ classified.excerpt }}</p>
                <a :href="classifiedRoute(classified)" class="btn btn-primary">Leer Más &rarr;</a>
              </div>
              <div class="card-footer text-muted">
                Publicado el {{formatDate(classified.created_at)}}
              </div>
            </div>
          </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item">
              <a
                class="page-link"
                href="#"
                @click="readClassifieds(pagination.prev_page_url)"
              >Anterior</a>
            </li>

            <li class="page-item disabled">
              <a
                class="page-link text-dark"
                href="#"
              >Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
            </li>

            <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item">
              <a
                class="page-link"
                href="#"
                @click="readClassifieds(pagination.next_page_url)"
              >Siguiente</a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Sidebar Widgets Column -->
      <div class="col-md-4">
        <!-- Side Widget -->
        <div class="card my-4">
          <h5 class="card-header">Bienvenido</h5>
          <div
            class="card-body"
          >Aquí podrás estar al tanto de cada evento y noticia acerca de tu conjunto!</div>
        </div>

        <!-- Logged -->
        <div v-if="$auth.isAuthenticated()" class="card my-4">
          <h5 class="card-header">Sube tus propios clasificados</h5>
          <div class="card-body">
            <p class="card-text">Te recomendamos registrarte o iniciar sesión para subir contenido</p>
            <button
              data-toggle="modal"
              data-target=".bd-example-modal-lg"
              class="btn btn-primary"
            >Crear</button>
          </div>
        </div>

        <!-- Unlogged -->
        <div v-else class="card my-4">
          <h5 class="card-header">Sube tus propios clasificados</h5>
          <div class="card-body">
            <p class="card-text">Te recomendamos registrarte o iniciar sesión para subir contenido</p>
            <a class="btn btn-link" href="http://solsticio.local/login">Ingresa</a>
            <a class="btn btn-link" href="http://solsticio.local/register">Regístrate</a>
          </div>
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

      <!-- Crear -->
      <div
        class="modal fade bd-example-modal-lg"
        id="create"
        tabindex="-1"
        role="dialog"
        aria-labelledby="myLargeModalLabel"
        aria-hidden="true"
      >
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Crear Clasificado</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="POST" v-on:submit.prevent="createClassified()">
                <div class="form-group">
                  <label for="title">Título</label>
                  <input
                    type="text"
                    name
                    id="title"
                    v-model="newTitle"
                    class="form-control"
                    autocomplete="off"
                    aria-describedby="helpId"
                  >
                </div>
                <div class="form-group">
                  <label for="category">Categoría</label>
                  <select v-model="newCategory" class="form-control" id="category">
                    <option v-for="category in categories" :key="category.id">{{category.name}}</option>
                  </select>
                </div>
                <div class="form-group">
                  <label for="file">Sube una imagen</label>
                  <input type="file" class="form-control-file" id="file" @change="fileNew">
                </div>
                <div class="form-group">
                  <label for="excerpt">Resume</label>
                  <textarea class="form-control" id="excerpt" v-model="newExcerpt" rows="3"></textarea>
                </div>
                <div class="form-group">
                  <label for="body">Contenido</label>
                  <vue-editor v-model="newBody" id="body"></vue-editor>
                </div>
                <button
                  type="submit"
                  v-on:click="status='PENDING'"
                  class="btn btn-primary btn-md btn-block"
                >Crear</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor
  },
  created() {
    this.readClassifieds();
    if (this.$auth.isAuthenticated()) this.getUser();
    this.getCategories();
  },
  data() {
    return {
      classifieds: [],
      pagination: {},
      user: null,
      newTitle: "",
      newExcerpt: "",
      newBody: "Escribe aquí el contenido...",
      newFile: "",
      newCategory: "",
      status: "",
      alertMessage: "",
      alertType: "",
      alertTitle: "",
      categories: []
    };
  },
  methods: {
    alert(alertType, alertMessage, alertTitle) {
      this.$notify({
        group: "foo",
        type: alertType,
        title: alertTitle,
        text: alertMessage
      });
    },
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
    getCategories() {
      let url = "http://solsticio.local/api/categories";
      axios
        .get(url)
        .then(response => {
          this.categories = response.data;
        })
        .catch(err => console.log(err));
    },
    readClassifieds(page_url) {
      let vm = this;
      page_url = page_url || "/api/classifieds";
      axios
        .get(page_url)
        .then(response => {
          this.classifieds = response.data.data;
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
    slugify() {
      return this.newTitle
        .toString()
        .toLowerCase()
        .replace(/\s+/g, "-") // Replace spaces with -
        .replace(/[^\w\-]+/g, "") // Remove all non-word chars
        .replace(/\-\-+/g, "-") // Replace multiple - with single -
        .replace(/^-+/, "") // Trim - from start of text
        .replace(/-+$/, ""); // Trim - from end of text
    },
    fileNew(event) {
      var fileReader = new FileReader();
      fileReader.readAsDataURL(event.target.files[0]);
      fileReader.onload = event => {
        this.newFile = event.target.result;
      };
    },
    setCategory() {
      let categoryId = this.categories.filter(o => {
        return o.name == this.newCategory;
      });
      let id = categoryId[0].id;
      return id;
    },
    createClassified() {
      var url = "http://solsticio.local/api/classifieds";
      axios
        .post(url, {
          user_id: this.user.id,
          category_id: this.setCategory(),
          title: this.newTitle,
          slug: this.slugify(),
          excerpt: this.newExcerpt,
          body: this.newBody,
          file: this.newFile,
          status: this.status
        })
        .then(response => {
          $("#create").modal("hide");
          this.alert("success", "La noticia ha sido creada", "¡Bien!");
          this.newTitle = "";
          this.newExcerpt = "";
          this.newBody = "";
          this.newFile = "";
        })
        .catch(error => {
          this.alert("error", "Algo ha salido mal", "Error :(");
        });
    },
    classifiedRoute(post) {
      return "clasificados/" + post.slug;
    }
  }
};
</script>