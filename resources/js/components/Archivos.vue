<template>
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <h1 class="my-4">Archivos</h1>
            <!-- 
                750x300
             -->
            <!-- Table -->
            <div class="card mb-3">
                <div class="card-body">
                    <h2 class="card-title">Lista de Archivos</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Descargar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="file in files" :key="file.id">
                                <th scope="row">{{ file.id }}</th>
                                <td>{{ file.description }}</td>
                                <td><a :href="'files/'+file.file" :download="file.file"><button type="button" class="btn btn-primary">Descargar</button></a></td>
                            </tr>
                        </tbody>
                    </table>                    
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="readPosts(pagination.prev_page_url)">Anterior</a></li>

                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Página {{ pagination.current_page }} de {{ pagination.last_page }}</a></li>
                
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="readPosts(pagination.next_page_url)">Siguiente</a></li>
                </ul>
            </nav>

            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">

            <!-- Side Widget -->
            <div class="card my-4">
                <h5 class="card-header">Bienvenido!</h5>
                <div class="card-body">
                Aquí podrás estar al tanto de cada evento y noticia acerca de tu conjunto!
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
        </div>
    </div>
</template>

<script>
export default {
    created() {
        this.readPosts();
    },
    data() {
        return {
            files: [],
            pagination: {}
        }
    },
    methods: {
        readPosts(page_url) {
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
    }
}
</script>