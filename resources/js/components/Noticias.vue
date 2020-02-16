<template>
    <div class="container">
        <div class="row">
            <!-- Blog Entries Column -->
            <div class="col-md-8">
                <h1 class="my-4">
                    Noticias
                    <small class="text-muted">Lo último de tu conjunto</small>
                </h1>
                <div
                    class="card mb-4"
                    v-bind:key="post.id"
                    v-for="post in posts"
                >
                    <img
                        :src="post.file"
                        alt="Card image cap"
                        class="card-img-top"
                        style="width:750;height:300;"
                        v-if="post.file"
                    />
                    <div class="card-body">
                        <h2 class="card-title">{{ post.title }}</h2>
                        <p class="card-text">{{ post.excerpt }}</p>
                        <a :href="postRoute(post)" class="btn btn-primary"
                            >Leer Más &rarr;</a
                        >
                    </div>
                    <div class="card-footer text-muted">
                        {{ formatDate(post.created_at) }}
                        <a href="#">{{ getUser(post.user_id) }}</a>
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
                            v-bind:class="[
                                { disabled: !pagination.next_page_url }
                            ]"
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

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Bienvenido!</h5>
                    <div class="card-body">
                        Aquí podrás estar al tanto de cada evento y noticia
                        acerca de tu conjunto!
                    </div>
                </div>

                <!-- Search Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Búsqueda</h5>
                    <div class="card-body">
                        <div class="input-group">
                            <input
                                class="form-control"
                                placeholder="Buscar..."
                                type="text"
                            />
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="button">
                                    ir
                                </button>
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
            posts: [],
            pagination: {}
        };
    },
    methods: {
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
        readPosts(page_url) {
            let vm = this;
            page_url = page_url || "/api/posts";
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
        getUser(user_id) {
            const url = "/api/users/" + user_id;
            let user_name;
            axios
                .get(url)
                .then(response => {
                    user_name = response.data.user.name;
                })
                .catch(error => {
                    console.log(error);
                });
            return user_name;
        }
    }
};
</script>
