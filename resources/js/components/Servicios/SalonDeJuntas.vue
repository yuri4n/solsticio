<template>
    <div class="container">
        <notifications :speed="500"
                       group="foo"
                       position="bottom left"/>
        <div class="row my-5">
            <div class="col-xl-7">
                <div class="card">
                    <div class="card-header"><h2>Salon de Juntas</h2></div>
                    <img alt="" class="card-img-top" src="http://placehold.it/1280x720">
                    <div class="card-body">
                        <h4 class="card-title">Normas y Requisitos</h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipiscing elit, vestibulum proin
                            nisi pulvinar integer nisl fringilla, ultricies nostra commodo enim tempus laoreet. Quam
                            dapibus nibh donec lacinia libero rhoncus interdum, taciti sociis class eros viverra hac
                            netus ante, laoreet sodales eu ligula mollis posuere. Rhoncus urna quisque potenti facilisis
                            suspendisse aptent, venenatis dictum mus vel tempus pellentesque nisi, mollis natoque
                            pulvinar ornare interdum.</p>
                        <p class="card-text">
                        <ul>
                            <li>Lorem ipsum dolor sit amet consectetur, adipiscing elit ac semper.</li>
                            <li>Ligula rhoncus tincidunt vulputate congue lectus, etiam laoreet montes porttitor.</li>
                            <li>Cubilia cursus accumsan platea egestas taciti, dictum inceptos ut.</li>
                            <li>Fusce magnis magna nulla accumsan tincidunt, laoreet inceptos risus.</li>
                            <li>Ultrices a facilisis placerat ultricies eget dictumst, quam aliquet neque litora.</li>
                            <li>Consequat neque nostra mi nisl semper, vel hac quis.</li>
                            <li>Cubilia venenatis maecenas lectus tristique, velit vitae netus.</li>
                            <li>Pharetra praesent sociosqu eu velit faucibus, vulputate et consequat lectus.</li>
                            <li>Metus taciti odio ut eleifend iaculis, mus urna fames.</li>
                            <li>Placerat nullam sociosqu maecenas et natoque, blandit habitant posuere cras.</li>
                        </ul>
                        </p>
                        <p class="card-text">Nisl fusce quis fringilla torquent diam laoreet porta felis platea tempus,
                            vulputate duis id molestie sollicitudin vivamus commodo urna pharetra, nullam aenean ligula
                            ridiculus viverra feugiat lobortis integer sodales. Pellentesque scelerisque bibendum risus
                            cursus mauris laoreet lectus, ultricies inceptos et pulvinar ante rutrum diam, arcu nisi
                            semper eleifend vivamus accumsan. Feugiat et diam semper praesent nostra netus duis
                            convallis iaculis dictum purus vel odio euismod tempus, tortor gravida at posuere montes
                            habitant ridiculus egestas massa maecenas ullamcorper magnis mi porta.</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-5">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Reserva Ya!</h4>
                        <p class="card-text">Lorem ipsum dolor sit amet consectetur adipiscing elit varius nascetur
                            rhoncus eros, neque facilisi parturient ligula nam orci convallis fusce netus dignissim
                            facilisis augue, risus a et quis mollis.</p>
                        <form action="POST" v-on:submit.prevent="sendReservation()">
                            <div class="form-group">
                                <label for="name">Nombre del responsable</label>
                                <input autocomplete="off" class="form-control" id="name" name="nombre" placeholder
                                       type="text" v-model="newResponsable">
                            </div>
                            <div class="form-group">
                                <label for="cedula">Fecha</label><br>
                                <date-picker :date="date" :option="option"/>
                                <br>
                                <small class="text-muted" id="helpId">Help text</small>
                            </div>
                            <div class="form-group">
                                <label for="texto">Información Adicional</label>
                                <textarea class="form-control" id="texto" rows="6" v-model="newAditional"/>
                            </div>
                            <button class="btn btn-primary mb-2" type="submit" v-on:click="newType='SJ'">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import myDatepicker from 'vue-datepicker'

    export default {
        components: {
            'date-picker': myDatepicker
        },
        created() {
            if (this.$auth.isAuthenticated()) this.getUser();
        },
        data() {
            return {
                newResponsable: '',
                newAditional: '',
                newType: '',
                errors: {},
                date: {
                    time: '',
                },
                option: {
                    type: 'day',
                    week: ['Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sa', 'Do'],
                    month: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Deciembre'],
                    format: 'YYYY-MM-DD',
                    placeholder: 'Elige una Fecha',
                    inputStyle: {
                        'display': 'inline-block',
                        'padding': '6px',
                        'line-height': '22px',
                        'font-size': '16px',
                        'border': '2px solid #fff',
                        'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
                        'border-radius': '2px',
                        'color': '#5F5F5F'
                    },
                    color: {
                        header: '#ccc',
                        headerText: '#f00'
                    },
                    buttons: {
                        ok: 'Ok',
                        cancel: 'Cancelar'
                    },
                    overlayOpacity: 0.5,
                    dismissible: true,
                },
                user: {}
            }
        },
        methods: {
            alert(alertType, alertMessage) {
                this.$notify({
                    group: 'foo',
                    type: alertType,
                    title: 'BIEN',
                    text: alertMessage,
                })
            },
            getUser() {
                const url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            },
            sendReservation() {
                var url = 'http://solsticio.local/api/reservations';
                axios.post(url, {
                    user_id: this.user.id,
                    nombre_responsable: this.newResponsable,
                    additional_info: this.newAditional,
                    fecha_solicitada: this.date.time,
                    type: this.newType,
                }).then(response => {
                    $('#create').modal('hide');
                    this.alert('success', 'La reservación ha sido solicitada');
                    this.newResponsable = '',
                        this.newAditional = '',
                        this.date.time = '';
                }).catch(error => {
                    this.alert('error', 'Algo ha salido mal');
                });
            }
        }
    }
</script>
