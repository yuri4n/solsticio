<template>
    <div>
        <header class="background-overlay text-white">
            <div class="container text-center">
                <h1 class="font-weight-bold" v-if="this.user == {}">
                    Bienvenido a la página de Solsticio
                </h1>
                <h1 class="font-weight-bold" v-else>
                    Bienvenido {{ user.name }} a la página de Solsticio
                </h1>
                <p class="lead">Parque Residencial Etapa 5</p>
            </div>
        </header>

        <section id="about">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="font-weight-bold">Acerca de esta página</h2>
                        <p class="lead">
                            Aquí podrás encontrar todo tipo de contenido
                            relacionado con tu conjunto, como noticias, archivo
                            y mucho más. También podrás ver y crear tus propios
                            clasificados, contribuyendo al bienestar de nuestra
                            comunidad.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section>
            <div class="container my-5">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="font-weight-bold right-align">Noticias</h3>
                        <div class="row">
                            <div
                                :key="post.id"
                                v-for="post in posts"
                                class="col-md-6"
                            >
                                <div class="card" style="width: 100%;">
                                    <img
                                        v-if="post.file"
                                        class="card-img-top"
                                        :src="post.file"
                                        style="width:100%;"
                                        alt="post_image"
                                    />
                                    <div class="card-body">
                                        <h2 class="card-title">
                                            {{ post.title }}
                                        </h2>
                                        <p class="card-text">
                                            {{ post.excerpt }}
                                        </p>
                                        <a
                                            :href="postRoute(post)"
                                            class="btn btn-primary"
                                            >Leer Más &rarr;</a
                                        >
                                    </div>
                                    <div class="card-footer text-muted">
                                        {{ formatDate(post.created_at) }}
                                        <a href="#">{{
                                            getUserName(post.user_id)
                                        }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h5 class="font-weight-light right-align" v-if="posts.length === 0">No hay noticias para
                            mostrar</h5>
                        <a v-if="posts.length < 0" class="btn btn-link mt-3 right-align" href="/noticias"
                            >Ver todas las noticias &rarr;</a
                        >
                    </div>
                    <div class="col-md-6">
                        <h3 class="font-weight-bold">Clasificados</h3>
                        <div class="row">
                            <div
                                class="col-sm-6"
                                v-bind:key="classified.id"
                                v-for="classified in classifieds"
                            >
                                <div
                                    class="card sm-4 mb-3"
                                    style="width: 100%;"
                                >
                                    <img
                                        :src="classified.file"
                                        alt="Card image cap"
                                        class="card-img-top"
                                        v-if="classified.file"
                                        style="width: 100%"
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
                        <a v-if="posts.length < 0" class="btn btn-link mt-2" href="/clasificados"
                            >Ver todos los clasificados &rarr;</a
                        >
                        <h5 class="font-weight-light" v-if="posts.length === 0">No hay clasificados para mostrar</h5>
                        <a v-if="posts.length === 0" class="btn btn-link mt-1 create_own_link" href="/clasificados"
                            >Crea tu propio clasificado &rarr;</a
                        >
                    </div>
                </div>
            </div>
        </section>

        <section id="contact">
            <div class="container mt-5 mb-5">
                <div class="row">
                    <div class="col-lg-8 mx-auto">
                        <h2 class="font-weight-bold">Contáctenos</h2>
                        <p class="lead">
                            Si tienes alguna duda, o algo que no puedas resolver
                            desde este portal, te invitamos a acercarte a la
                            administración del conjunto en los horarios
                            habituales de atención.
                        </p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
export default {
    mounted() {
        if (this.$auth.isAuthenticated()) this.getUser();
        this.getPosts();
        this.getClassifieds();
    },
    data() {
        return {
            user: {},
            posts: [],
            classifieds: []
        };
    },
    methods: {
        getUser() {
            const url = "/api/auth/user";
            axios
                .get(url)
                .then(response => {
                    this.user = response.data.data;
                })
                .catch();
        },
        getPosts() {
            const url = "/api/landing/posts";
            axios
                .get(url)
                .then(response => {
                    this.posts = response.data;
                })
                .catch();
        },
        getClassifieds() {
            const url = "/api/landing/classifieds";
            axios
                .get(url)
                .then(response => {
                    this.classifieds = response.data;
                })
                .catch();
        },
        postRoute(post) {
            return "/noticias/" + post.slug;
        },
        classifiedRoute(classified) {
            return "/clasificados/" + classified.slug;
        },
        getUserName(user_id) {
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
        }
    }
};
</script>

<style>
header {
    width: 100%;
    height: 100%;
    background-image: url(/images/background.jpg);
    background-size: cover;
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}

.create_own_link {
    padding: 0 !important;
}

.right-align {
    text-align: right;
}

@media (min-width: 992px) {
    header {
        padding: 156px 0 100px;
    }
}
</style>
