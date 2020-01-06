<template>
    <div
        class="container my-5"
        v-if="$auth.isAuthenticated() && user.role == 'ADMIN'"
    >
        <notifications group="foo" position="bottom left" :speed="500" />
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">Clasificados pendientes por aprobar</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Título</th>
                            <th scope="col">Categoría</th>
                            <th scope="col">Aprobar</th>
                            <th scope="col">Rechazar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="classified in classifieds"
                            :key="classified.id"
                        >
                            <th scope="row">{{ classified.id }}</th>
                            <td>
                                <a href="#" class="btn btn-link">{{
                                    classified.title
                                }}</a>
                            </td>
                            <td>
                                <a href="#" class="btn btn-link">{{
                                    classified.category_id
                                }}</a>
                            </td>
                            <td>
                                <button
                                    class="btn btn-success"
                                    v-on:click="updateClassified(classified.id)"
                                >
                                    Aprobar
                                </button>
                            </td>
                            <td>
                                <button
                                    class="btn btn-danger"
                                    v-on:click.prevent="
                                        deleteClassified(classified)
                                    "
                                >
                                    Rechazar
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Nav -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li
                    v-bind:class="[{ disabled: !pagination.prev_page_url }]"
                    class="page-item"
                >
                    <a
                        class="page-link"
                        href="#"
                        @click="readClassifieds(pagination.prev_page_url)"
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
                        @click="readClassifieds(pagination.next_page_url)"
                        >Siguiente</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    created() {
        if (this.$auth.isAuthenticated()) this.getUser();
        this.readClassifieds();
    },
    data() {
        return {
            classifieds: [],
            pagination: {},
            status: "",
            user: {}
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
        getUser() {
            var url = "http://solsticio.local/api/auth/user";
            axios
                .get(url)
                .then(response => {
                    this.user = response.data.data;
                })
                .catch();
        },
        readClassifieds(page_url) {
            let vm = this;
            page_url = page_url || "/api/admin/classifieds";
            axios
                .get(page_url)
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
        deleteClassified(classified) {
            var url = "http://solsticio.local/api/classifieds/" + classified.id;
            var confirmacion = confirm(
                `¿Seguro que deseas borrar el clasificado ${classified.id}?`
            );
            if (confirmacion) {
                axios.delete(url).then(response => {
                    this.alert(
                        "warn",
                        `El clasificado ${classified.id} ha sido rechazado`
                    );
                    this.readClassifieds();
                });
            }
        },
        updateClassified(id) {
            var url = "http://solsticio.local/api/admin/classifieds/" + id;
            axios
                .put(url, {
                    status: "PUBLISHED"
                })
                .then(response => {
                    this.readClassifieds();
                    $("#edit").modal("hide");
                    this.alert(
                        "success",
                        "El clasificado ha sido aprovado y ahora será visible"
                    );
                })
                .catch(error => {
                    this.alert("error", "Algo ha salido mal");
                });
        }
    }
};
</script>

<style></style>
