<template>
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8 mb-4">

            <h1 class="my-4">Clasificados
                <small class="text-muted">Pública en tu conjunto</small>
            </h1>
            <!-- 
                750x300
             -->
            <!-- Blog Post -->
            <div class="row">
                <div class="col-sm-6" v-for="classified in classifieds" v-bind:key="classified.id">
                    <div class="card sm-4 mb-3" style="width: 20rem;">
                        <img class="card-img-top" :src="classified.file" alt="Card image cap">
                        <div class="card-body">
                        <h2 class="card-title">{{ classified.title }}</h2>
                        <p class="card-text">{{ classified.excerpt }}</p>
                        <a href="#" class="btn btn-primary">Leer Más &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                        Publicado en January 1, 2017 by
                        <a href="#">Lady Rincon</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="readClassifieds(pagination.prev_page_url)">Anterior</a></li>

                    <li class="page-item disabled"><a class="page-link text-dark" href="#">Página {{ pagination.current_page }} de {{ pagination.last_page }}</a></li>
                
                    <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="readClassifieds(pagination.next_page_url)">Siguiente</a></li>
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
        this.readClassifieds();
    },
    data() {
        return {
            classifieds: [],
            pagination: {}
        }
    },
    methods: {
        readClassifieds(page_url) {
            let vm = this;
            page_url = page_url || '/api/classifieds';
            axios.get(page_url)
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
    }
}
</script>