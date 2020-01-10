<template>
    <div
        class="container my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    >
        <notifications group="foo" position="bottom left" :speed="500" />
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <div class="row justify-content-between mb-4">
                    <div class="col-sm-3">
                        <h4 class="card-title">Listado de noticias</h4>
                    </div>
                    <div class="col-sm-2">
                        <button
                            type="button"
                            class="btn btn-primary"
                            data-toggle="modal"
                            data-target=".bd-example-modal-lg"
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
                        <tr v-for="post in posts" :key="post.id">
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
                            <h5 class="modal-title">Crear Noticia</h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
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
                                        type="text"
                                        name
                                        id="title"
                                        v-model="newTitle"
                                        class="form-control"
                                        autocomplete="off"
                                        aria-describedby="helpId"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="file">Sube una imagen</label>
                                    <input
                                        type="file"
                                        class="form-control-file"
                                        id="file"
                                        @change="fileNew"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="excerpt">Resume</label>
                                    <textarea
                                        class="form-control"
                                        id="excerpt"
                                        v-model="newExcerpt"
                                        rows="3"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Contenido</label>
                                    <vue-editor
                                        v-model="newBody"
                                        id="body"
                                    ></vue-editor>
                                </div>
                                <button
                                    type="submit"
                                    v-on:click="status = 'DRAFT'"
                                    class="btn btn-secundary btn-md btn-block"
                                >
                                    Guardar como borrador
                                </button>
                                <button
                                    type="submit"
                                    v-on:click="status = 'PUBLISHED'"
                                    class="btn btn-primary btn-md btn-block"
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
                class="modal fade bd-example-modal-lg"
                id="edit"
                tabindex="-1"
                role="dialog"
                aria-labelledby="myLargeModalLabel"
                aria-hidden="true"
            >
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">
                                Editar Noticia {{ fillPost.id }}
                            </h5>
                            <button
                                type="button"
                                class="close"
                                data-dismiss="modal"
                                aria-label="Close"
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
                                        type="text"
                                        name
                                        id="title"
                                        v-model="fillPost.title"
                                        class="form-control"
                                        autocomplete="off"
                                        aria-describedby="helpId"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="file">Sube una imagen</label>
                                    <input
                                        type="file"
                                        class="form-control-file"
                                        id="file"
                                        @change="fileEdit"
                                    />
                                </div>
                                <div class="form-group">
                                    <label for="excerpt">Resume</label>
                                    <textarea
                                        class="form-control"
                                        id="excerpt"
                                        v-model="fillPost.excerpt"
                                        rows="3"
                                    ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="body">Contenido</label>
                                    <vue-editor
                                        v-model="fillPost.body"
                                        id="body"
                                    ></vue-editor>
                                </div>
                                <button
                                    type="submit"
                                    v-on:click="status = 'PUBLISHED'"
                                    class="btn btn-primary btn-md btn-block"
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
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                    class="page-item"
                >
                    <a
                        class="page-link"
                        href="#"
                        @click="readPosts(pagination.prev_page_url)"
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
                    v-bind:class="[{ disabled: !pagination.next_page_url }]"
                    class="page-item"
                >
                    <a
                        class="page-link"
                        href="#"
                        @click="readPosts(pagination.next_page_url)"
                        >Siguiente</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

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
