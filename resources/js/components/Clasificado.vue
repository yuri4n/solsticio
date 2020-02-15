<template>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <h1 class="mt-4">{{classified.title}}</h1>
                <p class="lead">
                    por
                    <span class="font-weight-bold">{{user.name}}</span>
                </p>

                <hr>

                <p>{{formatDate(classified.created_at)}}</p>

                <div v-if="classified.file">
                    <hr>
                    <img :src="classified.file" alt class="img-fluid rounded">
                </div>

                <hr>

                <p class="lead">{{classified.excerpt}}</p>
                <p v-html="classified.body"/>
            </div>

            <!-- Sidebar Widgets Column -->
            <div class="col-md-4">
                <!-- Side Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Bienvenido!</h5>
                    <div
                        class="card-body"
                    >Aquí podrás estar al tanto de cada evento y noticia acerca de tu conjunto!
                    </div>
                </div>

                <!-- Categories Widget -->
                <div class="card my-4">
                    <h5 class="card-header">Categorias</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <ul class="list-unstyled mb-0">
                                    <li :key="category.name" v-for="category in categories">
                                        <a href="#">{{category.name}}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            if (this.$auth.isAuthenticated()) this.getUser();
            this.readPost();
            this.getCategories();
        },
        data() {
            return {
                classified: [],
                user: {},
                authenticatedUser: {},
                categories: []
            };
        },
        methods: {
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
            readPost() {
                let path = window.location.pathname.split("/");
                let url = "/api/classifieds/" + path[2];
                axios
                    .get(url)
                    .then(response => {
                        this.classified = response.data;
                        this.getUser();
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            getUser() {
                let user_url =
                    "/api/users/" + this.classified.user_id;
                axios
                    .get(user_url)
                    .then(response => {
                        this.user = response.data.user;
                    })
                    .catch(error => {
                        console.log(error);
                    });
            },
            getCategories() {
                let url = "/api/categories";
                axios
                    .get(url)
                    .then(response => {
                        this.categories = response.data;
                    })
                    .catch(err => console.log(err));
            }
        }
    };
</script>
