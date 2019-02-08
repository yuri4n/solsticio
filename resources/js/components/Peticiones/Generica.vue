<template>
<div class="container">
    <notifications group="foo"
                   position="bottom left"
                   :speed="500" />
    <div class="row my-5">
    <div class="col-md-8">
        <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Formulario de peticiones</h4>
            <p
            class="card-text"
            >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae aperiam voluptates mollitia nulla ipsa iusto accusantium eius corrupti blanditiis eum, deleniti ipsum? Vitae odio debitis sapiente saepe tempore consequatur aperiam?</p>
            <form action="POST" @submit.prevent="sendPetition()">
            <div class="form-group">
                <label for="name">Nombre del responsable</label>
                <input type="text" id="name" class="form-control" placeholder aria-describedby="nameHelp" autocomplete="off" v-model="newName">
                <small id="nameHelp" class="text-muted">Help text</small>
            </div>
            <div class="form-group">
                <label for="cedula">Número de cédula</label>
                <input type="number" id="cedula" class="form-control" placeholder aria-describedby="cedulaHelp" autocomplete="off" v-model="newCedula">
                <small id="cedulaHelp" class="text-muted">Help text</small>
            </div>
            <div class="form-group">
                <label for="texto">Texto</label>
                <textarea class="form-control" id="texto" rows="6" v-model="newAdditional"></textarea>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Enviar</button>
            </form>
        </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-left">
        <div class="card-body">
            <h4 class="card-title">Bienvenido!</h4>
            <p
            class="card-text"
            >Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto, in numquam quibusdam quisquam.</p>
        </div>
        </div>
    </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            newName: '',
            newCedula: '',
            newAdditional: '',
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
        sendPetition() {
            var url = 'http://solsticio.local/api/petitions';
            axios.post(url, {
                user_id: Math.random() * (29 - 1) + 1,
                nombre_responsable: this.newName,
                cedula: this.newCedula,
                additional: this.newAdditional,
            }).then(response => {
                this.alert('success','La reservación ha sido solicitada');
                this.newName = '',
                this.newCedula = '',
                this.newAdditional = '';
            }).catch(error => {
                this.alert('error', 'Algo ha salido mal');
            });
        }
    }
}
</script>
