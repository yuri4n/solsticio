<template>
    <div class="container my-5">
        <div class="card text-left">
            <div class="card-body">
                <h3 class="card-title">Censo</h3>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis nulla assumenda culpa dolorum voluptatum, quaerat quos sunt. Temporibus unde numquam sapiente excepturi. Excepturi tempora nesciunt nisi! Nobis soluta vel quo!</p>
                <br>
                <form>
                    <h3>Formulario</h3>
                    <hr>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="tipo">Es usted:</label>
                            <select class="form-control" id="tipo">
                                <option>Propietario</option>
                                <option>Arrendatario</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="telefonoApto">Telefono de su Apartamento</label>
                        <input type="number" class="form-control" id="telefonoApto">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="torre">Torre</label>
                        <input type="number" class="form-control" id="torre" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="apartamento">Apartamento</label>
                        <input type="number" class="form-control" id="apartamento">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="nombre">Su nombre completo</label>
                        <input type="text" class="form-control" id="nombre" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="email">Su correo electronico</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <hr>
                    <h4>Datos residente resposable</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="nombre">Nombre completo del residente responsable</label>
                        <input type="text" class="form-control" id="nombre" autocomplete="off">
                        </div>
                        <div class="form-group col-md-6">
                        <label for="email">Correo electronico del residente responsable</label>
                        <input type="email" class="form-control" id="email" placeholder="Email">
                        </div>
                    </div>
                    <hr>
                    <h4>Datos sobre su estadía</h4>
                    <p>Tiempo residiendo en Solsticio estapa 5:</p>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <label for="inputDias">Dias</label>
                        <input type="number" class="form-control" id="inputDias">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputMeses">Meses</label>
                        <input type="number" class="form-control" id="inputMeses">
                        </div>
                        <div class="form-group col-md-4">
                        <label for="inputAños">Años</label>
                        <input type="number" class="form-control" id="inputAños">
                        </div>
                    </div>
                    <hr>
                    <h4>Vehículos</h4>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                        <label for="carro">¿Tiene carro?</label>
                        <select class="form-control" id="carro">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                        </div>
                        <div class="form-group col-md-3">
                        <label for="placasCarro">Placas</label>
                        <input type="text" class="form-control" id="placasCarro" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="modeloCarro">Modelo</label>
                        <input type="number" class="form-control" id="modeloCarro" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="parqueaderoCarro">No. Parqueadero asignado</label>
                        <input type="number" class="form-control" id="parqueaderoCarro">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                        <label for="moto">¿Tiene moto?</label>
                        <select class="form-control" id="moto">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                        </div>
                        <div class="form-group col-md-3">
                        <label for="placasMoto">Placas</label>
                        <input type="text" class="form-control" id="placasMoto" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="modeloMoto">Modelo</label>
                        <input type="number" class="form-control" id="modeloMoto" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="parqueaderoMoto">No. Parqueadero asignado</label>
                        <input type="number" class="form-control" id="parqueaderoMoto">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                        <label for="bicicleta">¿Tiene bicicleta?</label>
                        <select class="form-control" id="bicicleta">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                        </div>
                        <div class="form-group col-md-3">
                        <label for="gancho">No. Gancho asignado</label>
                        <input type="number" class="form-control" id="gancho">
                        </div>
                    </div>
                    <hr>
                    <h4>Información de los residentes</h4>
                    <p>Complete la información de las personas que residen con usted, si le sobran campos déjelos vacíos</p>
                    <h5>Residente 1</h5>
                    <div class="form-group">
                        <label for="name">Nombre Completo</label>
                        <input type="text" id="name1" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado1">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado1">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad1">Edad</label>
                            <input type="number" class="form-control" id="edad1">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco1">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco1">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad1">Actividad</label>
                            <input type="text" class="form-control" id="actividad1">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular1">Celular</label>
                            <input type="number" class="form-control" id="celular1">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 2</h5>
                    <div class="form-group">
                        <label for="name2">Nombre Completo</label>
                        <input type="text" id="name2" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado2">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado2">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad2">Edad</label>
                            <input type="number" class="form-control" id="edad2">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco2">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco2">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad2">Actividad</label>
                            <input type="text" class="form-control" id="actividad2">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular2">Celular</label>
                            <input type="number" class="form-control" id="celular2">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 3</h5>
                    <div class="form-group">
                        <label for="name3">Nombre Completo</label>
                        <input type="text" id="name3" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado3">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado3">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad3">Edad</label>
                            <input type="number" class="form-control" id="edad3">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco3">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco3">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad3">Actividad</label>
                            <input type="text" class="form-control" id="actividad3">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular3">Celular</label>
                            <input type="number" class="form-control" id="celular3">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 4</h5>
                    <div class="form-group">
                        <label for="name4">Nombre Completo</label>
                        <input type="text" id="name4" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado4">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado4">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad4">Edad</label>
                            <input type="number" class="form-control" id="edad4">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco4">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco4">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad4">Actividad</label>
                            <input type="text" class="form-control" id="actividad4">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular4">Celular</label>
                            <input type="number" class="form-control" id="celular4">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 5</h5>
                    <div class="form-group">
                        <label for="name5">Nombre Completo</label>
                        <input type="text" id="name5" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado5">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado5">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad5">Edad</label>
                            <input type="number" class="form-control" id="edad5">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco5">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco5">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad5">Actividad</label>
                            <input type="text" class="form-control" id="actividad5">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular5">Celular</label>
                            <input type="number" class="form-control" id="celular5">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 6</h5>
                    <div class="form-group">
                        <label for="name6">Nombre Completo</label>
                        <input type="text" id="name6" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado6">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado6">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad6">Edad</label>
                            <input type="number" class="form-control" id="edad6">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco6">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco6">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad6">Actividad</label>
                            <input type="text" class="form-control" id="actividad6">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular6">Celular</label>
                            <input type="number" class="form-control" id="celular6">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 7</h5>
                    <div class="form-group">
                        <label for="name7">Nombre Completo</label>
                        <input type="text" id="name7" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado7">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado7">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad7">Edad</label>
                            <input type="number" class="form-control" id="edad7">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco7">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco7">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad7">Actividad</label>
                            <input type="text" class="form-control" id="actividad7">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular7">Celular</label>
                            <input type="number" class="form-control" id="celular7">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 8</h5>
                    <div class="form-group">
                        <label for="name8">Nombre Completo</label>
                        <input type="text" id="name8" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado8">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado8">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad8">Edad</label>
                            <input type="number" class="form-control" id="edad8">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco8">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco8">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad8">Actividad</label>
                            <input type="text" class="form-control" id="actividad8">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular8">Celular</label>
                            <input type="number" class="form-control" id="celular8">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 9</h5>
                    <div class="form-group">
                        <label for="name9">Nombre Completo</label>
                        <input type="text" id="name9" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado9">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado9">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad9">Edad</label>
                            <input type="number" class="form-control" id="edad9">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco9">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco9">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad9">Actividad</label>
                            <input type="text" class="form-control" id="actividad9">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular9">Celular</label>
                            <input type="number" class="form-control" id="celular9">
                            </div>
                        </div>
                    </div>
                    <h5>Residente 10</h5>
                    <div class="form-group">
                        <label for="name10">Nombre Completo</label>
                        <input type="text" id="name10" class="form-control" autocomplete="off">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                            <label for="dicapacitado10">¿Discapacitado?</label>
                            <select class="form-control" id="dicapacitado10">
                                <option>No</option>
                                <option>Sí</option>
                            </select>
                            </div>
                            <div class="form-group col-md-2">
                            <label for="edad10">Edad</label>
                            <input type="number" class="form-control" id="edad10">
                            </div>
                            <div class="form-group col-md-2">
                            <label for="parentesco10">Parentesco</label>
                            <input type="text" class="form-control" id="parentesco10">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="actividad10">Actividad</label>
                            <input type="text" class="form-control" id="actividad10">
                            </div>
                            <div class="form-group col-md-3">
                            <label for="celular10">Celular</label>
                            <input type="number" class="form-control" id="celular10">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <h4>Otros datos</h4>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label for="internet">¿Cuenta con servicio de internet?</label>
                            <select class="form-control" id="internet">
                                <option>Sí</option>
                                <option>No</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label for="empresa">¿De cuál empresa?</label>
                        <input type="text" class="form-control" id="empresa">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                        <label for="mascota">¿Tiene mascota?</label>
                        <select class="form-control" id="mascota">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                        </div>
                        <div class="form-group col-md-3">
                        <label for="raza">¿Cuál?</label>
                        <input type="text" class="form-control" id="raza" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="mascotaNumero">Cuantas</label>
                        <input type="number" class="form-control" id="mascotaNumero" autocomplete="off">
                        </div>
                        <div class="form-group col-md-3">
                        <label for="vacunado">¿Vacunado oportunamente?</label>
                        <select class="form-control" id="vacunado">
                            <option>-</option>
                            <option>Sí</option>
                            <option>No</option>
                        </select>
                        </div>
                    </div>
                    <hr>
                    <h4>Observaciones</h4>
                    <div class="form-group">
                        <label for="observaciones"></label>
                        <textarea class="form-control" id="observaciones" rows="5"></textarea>
                    </div>
                    <hr>
                    <div class="form-group">
                        <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="gridCheck">
                        <label class="form-check-label" for="gridCheck">
                            Estoy de acuerdo con las políticas de uso y el manejo de la información que ha sido consignada en este formulario
                        </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Terminado</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
        }
    },
    methods: {
    },
    computed: {
        formattedDate: function() {
            let date = new Date();
            return date.getDate() + "/" + (date.getMonth() +1) + "/" + date.getFullYear();
        }
    }
}
</script>

