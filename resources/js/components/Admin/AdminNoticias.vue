<template>
    <div
        class="container my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    >
        <notifications :speed="500" group="foo" position="bottom left"/>
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <div class="row justify-content-between mb-4">
                    <div class="col-sm-3">
                        <h4 class="card-title">Listado de noticias</h4>
                    </div>
                    <div class="col-sm-2">
                        <button
                            class="btn btn-primary"
                            data-target=".bd-example-modal-lg"
                            data-toggle="modal"
                            type="button"
                        >
                            Crear Noticia
                        </button>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="post.id" v-for="post in posts">
                        <th scope="row">{{ post.id }}</th>
                        <td>{{ post.title }}</td>
                        <td>
                            <button
                                class="btn btn-warning"
                                v-on:click.prevent="editPost(post)"
                            >
                                Editar
                            </button>
                        </td>
                        <td>
                            <button
                                class="btn btn-danger"
                                v-on:click.prevent="deletePost(post)"
                            >
                                Eliminar
                            </button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
                            <h5 class="modal-title">Crear Noticia</h5>
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
                                v-on:submit.prevent="createPost()"
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
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Contenido</label>
                                    <vue-editor
                                        id="body"
                                        v-model="newBody"
                                    ></vue-editor>
                                </div>
                                <button
                                    class="btn btn-secundary btn-md btn-block"
                                    type="submit"
                                    v-on:click="status = 'DRAFT'"
                                >
                                    Guardar como borrador
                                </button>
                                <button
                                    class="btn btn-primary btn-md btn-block"
                                    type="submit"
                                    v-on:click="status = 'PUBLISHED'"
                                >
                                    Crear
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Editar -->
            <div
                aria-hidden="true"
                aria-labelledby="myLargeModalLabel"
                class="modal fade bd-example-modal-lg"
                id="edit"
                role="dialog"
                tabindex="-1"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Editar Noticia {{ fillPost.id }}
                            </h5>
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
                                v-on:submit.prevent="updatePost(fillPost.id)"
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
                                        v-model="fillPost.title"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="file">Sube una imagen</label>
                                    <input
                                        @change="fileEdit"
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
                                        v-model="fillPost.excerpt"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Contenido</label>
                                    <vue-editor
                                        id="body"
                                        v-model="fillPost.body"
                                    ></vue-editor>
                                </div>
                                <button
                                    class="btn btn-primary btn-md btn-block"
                                    type="submit"
                                    v-on:click="status = 'PUBLISHED'"
                                >
                                    Actualizar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    class="page-item"
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                >
                    <a
                        @click="readPosts(pagination.prev_page_url)"
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
                    v-bind:class="[{ disabled: !pagination.next_page_url }]"
                >
                    <a
                        @click="readPosts(pagination.next_page_url)"
                        class="page-link"
                        href="#"
                    >Siguiente</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
    import {VueEditor} from "vue2-editor";

    export default {
        components: {
            VueEditor
        },
        created() {
            this.readPosts();
            if (this.$auth.isAuthenticated()) this.getUser();
        },
        data() {
            return {
                posts: [],
                pagination: {},
                newTitle: "",
                newExcerpt: "",
                newBody: "Escribe aquí el contenido...",
                newFile: "",
                fillPost: {
                    user_id: "",
                    id: "",
                    title: "",
                    slug: "",
                    excerpt: "",
                    body: "",
                    file: ""
                },
                status: "",
                alertMessage: "",
                alertType: "",
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
            readPosts(page_url) {
                let vm = this;
                page_url = page_url || "/api/admin/posts";
                axios
                    .get(page_url)
                    .then(response => {
                        this.posts = response.data.data;
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
            postRoute(post) {
                return "noticias/" + post.slug;
            },
            deletePost(post) {
                var url = "http://solsticio.local/api/posts/" + post.id;
                var confirmacion = confirm(
                    `¿Seguro que deseas borrar la noticia ${post.id}?`
                );
                if (confirmacion) {
                    axios.delete(url).then(response => {
                        this.alert(
                            "warn",
                            `La noticia ${post.id} ha sido eliminada`
                        );
                        this.readPosts();
                    });
                }
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
            fileEdit(event) {
                var fileReader = new FileReader();
                fileReader.readAsDataURL(event.target.files[0]);
                fileReader.onload = event => {
                    this.fillPost.file = event.target.result;
                };
            },
            createPost() {
                var url = "http://solsticio.local/api/posts";
                axios
                    .post(url, {
                        user_id: this.user.id,
                        title: this.newTitle,
                        slug: this.slugify(),
                        excerpt: this.newExcerpt,
                        body: this.newBody,
                        file: this.newFile,
                        status: this.status
                    })
                    .then(response => {
                        $("#create").modal("hide");
                        this.alert("success", "La noticia ha sido creada");
                        this.readPosts();
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            },
            editPost(post) {
                this.fillPost.user_id = post.user_id;
                this.fillPost.id = post.id;
                this.fillPost.title = post.title;
                this.fillPost.slug = post.slug;
                this.fillPost.excerpt = post.excerpt;
                this.fillPost.body = post.body;

                $("#edit").modal("show");
            },
            updatePost(id) {
                var url = "http://solsticio.local/api/posts/" + id;
                axios
                    .put(url, this.fillPost)
                    .then(response => {
                        this.readPosts();
                        this.fillPost = {
                            id: "",
                            title: "",
                            excerpt: "",
                            body: ""
                        };
                        $("#edit").modal("hide");
                        this.alert(
                            "success",
                            "La noticia ha sido actualizada correctamente"
                        );
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
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
