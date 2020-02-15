<template>
    <div class="container">
        <notifications :speed="500" group="foo" position="bottom left"/>
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8 mb-4">
                <h1 class="my-4">
                    Clasificados
                    <small class="text-muted">Pública en tu conjunto</small>
                </h1>

                <!-- Blog Classified -->
                <div class="row">
                    <div
                        class="col-sm-6"
                        v-bind:key="classified.id"
                        v-for="classified in classifieds"
                    >
                        <div class="card sm-4 mb-3" style="width: 20rem;">
                            <img
                                :src="classified.file"
                                alt="Card image cap"
                                class="card-img-top"
                                v-if="classified.file"
                            />
                            <div class="card-body">
                                <h2 class="card-title">
                                    {{ classified.title }}
                                </h2>
                                <p class="card-text">
                                    {{ classified.excerpt }}
                                </p>
                                <a
                                    :href="classifiedRoute(classified)"
                                    class="btn btn-primary"
                                >Leer Más &rarr;</a
                                >
                            </div>
                            <div class="card-footer text-muted">
                                Publicado el
                                {{ formatDate(classified.created_at) }}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <nav aria-label="Page navigation example">
                    <ul class="pagination">
                        <li
                            class="page-item"
                            v-bind:class="[
                                { disabled: !pagination.prev_page_url }
                            ]"
                        >
                            <a
                                @click="
                                    readClassifieds(pagination.prev_page_url)
                                "
                                class="page-link"
                                href="#"
                            >Anterior</a
                            >
                        </li>

                        <li class="page-item disabled">
                            <a class="page-link text-dark" href="#"
                            >Página {{ pagination.current_page }} de
                                {{ pagination.last_page }}</a
                            >
                        </li>

                        <li
                            class="page-item"
                            v-bind:class="[
                                { disabled: !pagination.next_page_url }
                            ]"
                        >
                            <a
                                @click="
                                    readClassifieds(pagination.next_page_url)
                                "
                                class="page-link"
                                href="#"
                            >Siguiente</a
                            >
                        </li>
                    </ul>
                </nav>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Bienvenido</h5>
                    <div class="card-body">
                        Aquí podrás estar al tanto de cada evento y noticia
                        acerca de tu conjunto!
                    </div>
                </div>

                <!-- Logged -->
                <div
                    class="card my-4"
                    v-if="
                        this.$auth.isAuthenticated() &&
                            user.status === 'APPROVED'
                    "
                >
                    <h5 class="card-header">Sube tus propios clasificados</h5>
                    <div class="card-body">
                        <p class="card-text">
                            Te recomendamos registrarte o iniciar sesión para
                            subir contenido
                        </p>
                        <button
                            class="btn btn-primary"
                            data-target=".bd-example-modal-lg"
                            data-toggle="modal"
                        >
                            Crear
                        </button>
                    </div>
                </div>

                <!-- Unlogged -->
                <div class="card my-4" v-else>
                    <h5 class="card-header">Sube tus propios clasificados</h5>
                    <div class="card-body">
                        <p class="card-text">
                            Te recomendamos registrarte o iniciar sesión para
                            subir contenido
                        </p>
                        <a
                            class="btn btn-link"
                            href="/login"
                        >Ingresa</a
                        >
                        <a
                            class="btn btn-link"
                            href="/register"
                        >Regístrate</a
                        >
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categorias</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li
                                        :key="category.name"
                                        v-for="category in categories"
                                    >
                                        <a href="#">{{ category.name }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Crear -->
            <div
                aria-hidden="true"
                aria-labelledby="myLargeModalLabel"
                class="modal fade bd-example-modal-lg"
                id="create"
                role="dialog"
                tabindex="-1"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Crear Clasificado</h5>
                            <button
                                aria-label="Close"
                                class="close"
                                data-dismiss="modal"
                                type="button"
                            >
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form
                                action="POST"
                                v-on:submit.prevent="createClassified()"
                            >
                                <div class="form-group">
                                    <label for="title">Título</label>
                                    <input
                                        aria-describedby="helpId"
                                        autocomplete="off"
                                        class="form-control"
                                        id="title"
                                        name
                                        type="text"
                                        v-model="newTitle"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="category">Categoría</label>
                                    <select
                                        class="form-control"
                                        id="category"
                                        v-model="newCategory"
                                    >
                                        <option
                                            :key="category.id"
                                            v-for="category in categories"
                                        >{{ category.name }}
                                        </option
                                        >
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="file">Sube una imagen</label>
                                    <input
                                        @change="fileNew"
                                        class="form-control-file"
                                        id="file"
                                        type="file"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="excerpt">Resume</label>
                                    <textarea
                                        class="form-control"
                                        id="excerpt"
                                        rows="3"
                                        v-model="newExcerpt"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="body">Contenido</label>
                                    <vue-editor
                                        id="body"
                                        v-model="newBody"
                                    />
                                </div>
                                <button
                                    class="btn btn-primary btn-md btn-block"
                                    type="submit"
                                    v-on:click="status = 'PENDING'"
                                >
                                    Crear
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {VueEditor} from "vue2-editor";

    export default {
        components: {
            VueEditor
        },
        created() {
            if (this.$auth.isAuthenticated()) this.getUser();
            this.readClassifieds();
            this.getCategories();
        },
        data() {
            return {
                classifieds: [],
                pagination: {},
                user: {},
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
                const monthNames = [
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

                const ndate = date.split(" ");
                const fdate = ndate[0].split("-");

                let month = fdate[1];

                while (month.charAt(0) == "0") month = month.substr(1);

                const day = fdate[2];
                const monthIndex = month;
                const year = fdate[0];

                return day + " de " + monthNames[monthIndex - 1] + " de " + year;
            },
            getCategories() {
                let url = "/api/categories";
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
                this.pagination = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    next_page_url: meta.next_page_url,
                    prev_page_url: meta.prev_page_url
                };
            },
            getUser() {
                const url = "/api/auth/user";
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
                var url = "/api/classifieds";
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
                        this.alert(
                            "success",
                            "La noticia ha sido creada",
                            "¡Bien!"
                        );
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
