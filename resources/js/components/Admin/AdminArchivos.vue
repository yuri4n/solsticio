<template>
    <div class="container my-5">
        <notifications group="foo"
                   position="bottom left"
                   :speed="500" />
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <div class="row justify-content-between mb-4">
                    <div class="col-sm-3">
                        <h4 class="card-title">Listado de archivos</h4>
                    </div>
                    <div class="col-sm-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Subir Archivo</button>
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
                        <tr v-for="file in files" :key="file.id">
                            <th scope="row">{{ file.id }}</th>
                            <td>{{file.description}}</td>
                            <td><button class="btn btn-warning" v-on:click.prevent="editFile(file)">Editar</button></td>
                            <td><button class="btn btn-danger" v-on:click.prevent="deleteFile(file)">Eliminar</button></td>
                        </tr>
                    </tbody>
                </table> 
            </div>
        </div>

        <!-- Crear -->
            <div class="modal fade bd-example-modal-lg" id="create" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Subir Archivo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="POST" v-on:submit.prevent="createFile()">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input type="text" name="" id="description" v-model="newDescription" class="form-control" autocomplete="off" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label for="file">Sube un archivo</label>
                                <input type="file" class="form-control-file" id="file" @change="uploadFile">
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-block">Crear</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>

            <!-- Editar -->
            <div class="modal fade bd-example-modal-lg" id="edit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Archivo {{ fillFile.id }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="POST" v-on:submit.prevent="updateFile(fillFile.id)">
                            <div class="form-group">
                                <label for="description">Descripción</label>
                                <input type="text" id="description" v-model="fillFile.description" class="form-control" autocomplete="off" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <label for="file">Sube un archivo</label>
                                <input type="file" class="form-control-file" id="file" @change="fileEdit">
                            </div>
                            <button type="submit" class="btn btn-primary btn-md btn-block">Actualizar</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="readFiles(pagination.prev_page_url)">Anterior</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">Página {{ pagination.current_page }} de {{ pagination.last_page }}</a></li>
            
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="readFiles(pagination.next_page_url)">Siguiente</a></li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    created() {
        this.readFiles();
    },
    data() {
    return {
        files: [],
        pagination: {},
        newDescription: '',
        newFile: '',
        fillFile: {
            id: '',
            description: '',
            file: '',
        },
    }
    },
    methods: {
        alert(alertType,alertMessage) {
            this.$notify({
                group: 'foo',
                type: alertType,
                title: 'BIEN',
                text: alertMessage,
            })
        },
        readFiles(page_url) {
            let vm = this;
            page_url = page_url || '/api/files';
            axios.get(page_url)
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
            var url = 'http://solsticio.local/api/files/' + file.id;
            var confirmacion = confirm(`¿Seguro que deseas borrar el archivo ${file.id}?`);
            if(confirmacion) {
                axios.delete(url).then(response => {
                    this.alert('warn',`El archivo ${file.id} ha sido eliminada`);
                    this.readFiles(); 
                });
            }           
        },
        uploadFile(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.newFile = event.target.result
            }
        },
        fileEdit(event) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(event.target.files[0]);
            fileReader.onload = (event) => {
                this.fillFile.file = event.target.result
            }
        },
        createFile() {
            var url = 'http://solsticio.local/api/files';
            axios.post(url, {
                description: this.newDescription,
                file: this.newFile,
            }).then(response => {
                $('#create').modal('hide');
                this.alert('success','La noticia ha sido creada');
                this.readFiles();
            }).catch(error => {
                this.alert('error', 'Algo ha salido mal');
            });
        },
        editFile(file) {
            this.fillFile.id = file.id;
            this.fillFile.description = file.description;
            
            $('#edit').modal('show');
        },
        updateFile(id) {
            var url = 'http://solsticio.local/api/files/' + id;
            axios.put(url, this.fillFile).then(response => {
                this.readFiles();
                this.fillFile = {
                    id: '',
                    description: '',
                };
                $('#edit').modal('hide');
                this.alert('success', 'La noticia ha sido actualizada correctamente');
            }).catch(error => {
                this.alert('error', 'Algo ha salido mal');
            });
        }
    }
}
</script>
