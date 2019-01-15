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
                        <h4 class="card-title">Listado de noticias</h4>
                    </div>
                    <div class="col-sm-2">
                        <a class="btn btn-primary" href="">Crear Noticia</a>
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
                            <td><button class="btn btn-warning">Editar</button></td>
                            <td><button class="btn btn-danger" v-on:click.prevent="deletePost(post)">Eliminar</button></td>
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
</template>

<script>
export default {
    created() {
        this.readPosts();
    },
    data() {
        return {
            posts: [],
            pagination: {}
        }
    },
    methods: {
        show(id) {
            this.$notify({
                group: 'foo',
                type: 'warn',
                title: 'BIEN',
                text: `La noticia ${id} ha sido eliminada`,
            })
        },
        readPosts(page_url) {
            let vm = this;
            page_url = page_url || '/api/admin/posts';
            axios.get(page_url)
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
            var url = 'http://solsticio.local/api/posts/' + post.id;
            var confirmacion = confirm(`¿Seguro que deseas borrar la noticia ${post.id}?`);
            if(confirmacion) {
                axios.delete(url).then(response => {
                    this.show(post.id);
                    this.readPosts();
                });
            }           
        }
    }
}
</script>
