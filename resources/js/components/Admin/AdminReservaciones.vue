<template>
    <div class="container my-5">
        <notifications group="foo"
                   position="bottom left"
                   :speed="500" />
        <!-- Tabla -->
        <div class="card text-left mb-3">
            <div class="card-body">
                <h4 class="card-title">Listado de peticiones de salones</h4>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Nombre e Info</th>
                            <th scope="col">Aprovar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="reservation in reservations" :key="reservation.id">
                            <th scope="row">{{ reservation.id }}</th>
                            <td>{{reservation.fecha_solicitada}}</td>
                            <td>{{ reservation.type }}</td>
                            <td>{{ reservation.nombre_responsable }}<br><small class="text-muted">{{ substract(reservation.additional_info) }}</small></td>
                            <td><button class="btn btn-success">Aprovar</button></td>
                            <td><button class="btn btn-danger">Rechazar</button></td>
                        </tr>
                    </tbody>
                </table> 
            </div>
        </div>

        <!-- Pagination -->
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li v-bind:class="[{disabled: !pagination.prev_page_url}]" class="page-item"><a class="page-link" href="#" @click="readReservations(pagination.prev_page_url)">Anterior</a></li>

                <li class="page-item disabled"><a class="page-link text-dark" href="#">Página {{ pagination.current_page }} de {{ pagination.last_page }}</a></li>
            
                <li v-bind:class="[{disabled: !pagination.next_page_url}]" class="page-item"><a class="page-link" href="#" @click="readReservations(pagination.next_page_url)">Siguiente</a></li>
            </ul>
        </nav>
    </div>
</template>
<script>
export default {
    created() {
        this.readReservations();
    },
    data() {
    return {
        reservations: [],
        pagination: {},
    }
    },
    methods: {
        readReservations(page_url) {
        let vm = this;
        page_url = page_url || '/api/reservations';
        axios.get(page_url)
            .then(response => {
            this.reservations = response.data.data;
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
        substract(str) {
            if(str.length > 50) {
                str = str.substring(0,50);
                str = str + '...';
            }
            return str;
        }
    }
}
</script>
