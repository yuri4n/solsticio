<template>
    <div class="container vh-100 my-5" v-if="$auth.isAuthenticated() && user.role == 'ADMIN' && user.status === 'APPROVED'">
        <notifications :speed="500" group="foo" position="bottom left"/>
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <div class="row justify-content-between mb-4">
                    <div class="col-sm-3">
                        <h4 class="card-title">Listado de archivos</h4>
                    </div>
                    <div class="col-sm-2">
                        <button
                            class="btn btn-primary"
                            data-target=".bd-example-modal-lg"
                            data-toggle="modal"
                            type="button"
                        >Subir Archivo
                        </button>
                    </div>
                </div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr :key="file.id" v-for="file in files">
                        <th scope="row">{{ file.id }}</th>
                        <td>{{file.description}}</td>
                        <td>
                            <button class="btn btn-warning" v-on:click.prevent="editFile(file)">Editar</button>
                        </td>
                        <td>
                            <button class="btn btn-danger" v-on:click.prevent="deleteFile(file)">Eliminar</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
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
                        <h5 class="modal-title">Subir Archivo</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="POST" v-on:submit.prevent="createFile()">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input
                                    aria-describedby="helpId"
                                    autocomplete="off"
                                    class="form-control"
                                    id="description"
                                    name
                                    type="text"
                                    v-model="newDescription"
                                >
                            </div>
                            <div class="form-group">
                                <label for="file">Sube un archivo</label>
                                <input @change="uploadFile" class="form-control-file" id="file" type="file">
                            </div>
                            <button class="btn btn-primary btn-md btn-block" type="submit">Crear</button>
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
                        <h5 class="modal-title">Editar Archivo {{ fillFile.id }}</h5>
                        <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="POST" v-on:submit.prevent="updateFile(fillFile.id)">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input
                                    aria-describedby="helpId"
                                    autocomplete="off"
                                    class="form-control"
                                    id="description"
                                    type="text"
                                    v-model="fillFile.description"
                                >
                            </div>
                            <div class="form-group">
                                <label for="file">Sube un archivo</label>
                                <input @change="fileEdit" class="form-control-file" id="file" type="file">
                            </div>
                            <button class="btn btn-primary btn-md btn-block" type="submit">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item" v-bind:class="[{disabled: !pagination.prev_page_url}]">
                    <a @click="readFiles(pagination.prev_page_url)" class="page-link" href="#">Anterior</a>
                </li>

                <li class="page-item disabled">
                    <a
                        class="page-link text-dark"
                        href="#"
                    >Página {{ pagination.current_page }} de {{ pagination.last_page }}</a>
                </li>

                <li class="page-item" v-bind:class="[{disabled: !pagination.next_page_url}]">
                    <a @click="readFiles(pagination.next_page_url)" class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</template>
<script>
    export default {
        created() {
            if (this.$auth.isAuthenticated()) this.getUser();
            this.readFiles();
        },
        data() {
            return {
                files: [],
                pagination: {},
                newDescription: "",
                newFile: "",
                fillFile: {
                    id: "",
                    description: "",
                    file: ""
                },
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
            readFiles(page_url) {
                let vm = this;
                page_url = page_url || "/api/files";
                axios
                    .get(page_url)
                    .then(response => {
                        this.files = response.data.data;
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
            deleteFile(file) {
                var url = "/api/files/" + file.id;
                var confirmacion = confirm(
                    `¿Seguro que deseas borrar el archivo ${file.id}?`
                );
                if (confirmacion) {
                    axios.delete(url).then(response => {
                        this.alert("warn", `El archivo ${file.id} ha sido eliminado`);
                        this.readFiles();
                    });
                }
            },
            uploadFile(event) {
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
                    this.fillFile.file = event.target.result;
                };
            },
            createFile() {
                var url = "/api/files";
                axios
                    .post(url, {
                        description: this.newDescription,
                        file: this.newFile
                    })
                    .then(response => {
                        $("#create").modal("hide");
                        this.alert("success", "El archivo ha sido creado");
                        this.readFiles();
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            },
            editFile(file) {
                this.fillFile.id = file.id;
                this.fillFile.description = file.description;

                $("#edit").modal("show");
            },
            updateFile(id) {
                var url = "/api/files/" + id;
                axios
                    .put(url, this.fillFile)
                    .then(response => {
                        this.readFiles();
                        this.fillFile = {
                            id: "",
                            description: ""
                        };
                        $("#edit").modal("hide");
                        this.alert("success", "El archivo ha sido actualizado correctamente");
                    })
                    .catch(error => {
                        this.alert("error", "Algo ha salido mal");
                    });
            },
            getUser() {
                var url = "/api/auth/user";
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
    .vh-100 {
        min-height: 69vh;
    }
</style>
