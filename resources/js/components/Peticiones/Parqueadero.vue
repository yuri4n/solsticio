<template>
<div class="container">
    <div class="row my-5">
    <div class="col-md-8">
        <div class="card text-left">
        <div class="card-body">
            <h3 class="card-title">Formulario de peticion de parqueadero</h3>
            <p
            class="card-text"
            >Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae aperiam voluptates mollitia nulla ipsa iusto accusantium eius corrupti blanditiis eum, deleniti ipsum? Vitae odio debitis sapiente saepe tempore consequatur aperiam?</p>
            <hr>
            <form>
                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="deudas">¿Tiene deudas con la administración?</label>
                        <select class="form-control" id="deudas">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="vehiculo">¿Qué tipo de vehículos tiene?</label>
                        <br>
                        <div class="form-check form-check-inline col-md-5">
                            <input class="form-check-input" type="checkbox" id="carro" value="option1">
                            <label class="form-check-label" for="carro">Carro</label>
                        </div>
                        <div class="form-check form-check-inline col-md-5">
                            <input class="form-check-input" type="checkbox" id="moto" value="option2">
                            <label class="form-check-label" for="moto">Moto</label>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                    <label for="discapacidad">¿Su vehículo posee placas de discapacidad?</label>
                        <select class="form-control" id="discapacidad">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="asignado">¿Posee actualmente parqueadero asignado?</label>
                        <select class="form-control" id="asignado">
                            <option>No</option>
                            <option>Sí</option>
                        </select>
                    </div>
                    <div class="form-group col-md-6">
                    <label for="parqueadero">¿Cuál?</label>
                    <input type="number" class="form-control" id="parqueadero" autocomplete="off">
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-4">
                    <label for="tipo">Es usted:</label>
                        <select class="form-control" id="tipo">
                            <option>Propietario</option>
                            <option>Arrendatario</option>
                        </select>
                    </div>
                </div>
                <hr>
                <h4>Datos del propietario</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="nombre_propietario">Nombre completo del propietario</label>
                    <input type="text" class="form-control" id="nombre_propietario" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="telefono_propietario">Teléfono</label>
                    <input type="text" class="form-control" id="telefono_propietario" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5">
                    <label for="direccion_propietario">Dirección</label>
                    <input type="text" class="form-control" id="direccion_propietario" autocomplete="off">
                    </div>
                    <div class="form-group col-md-7">
                    <label for="email_propietario">E-mail</label>
                    <input type="text" class="form-control" id="email_propietario" autocomplete="off">
                    </div>
                </div>
                <hr>
                <h4>Datos del solicitante</h4>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="nombre_solicitante">Nombre completo del solicitante</label>
                    <input type="text" class="form-control" id="nombre_solicitante" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="telefono_solicitante">Teléfono</label>
                    <input type="text" class="form-control" id="telefono_solicitante" autocomplete="off">
                    </div>
                    <div class="form-group col-md-5">
                    <label for="direccion_solicitante">Dirección</label>
                    <input type="text" class="form-control" id="direccion_solicitante" autocomplete="off">
                    </div>
                    <div class="form-group col-md-7">
                    <label for="email_solicitante">E-mail</label>
                    <input type="text" class="form-control" id="email_solicitante" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="torre">Torre</label>
                    <input type="number" class="form-control" id="torre" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="apartamento">Apartamento</label>
                    <input type="number" class="form-control" id="apartamento" autocomplete="off">
                    </div>
                </div>
                <hr>
                <h4>Documentos Requeridos</h4>
                <div class="form-group">
                    <label for="cedula">Fotocopia de la Cédula</label>
                    <input type="file" class="form-control-file" id="cedula">
                </div>
                <div class="form-group">
                    <label for="tarjeta_propiedad">Tarjeta de propiedad</label>
                    <input type="file" class="form-control-file" id="tarjeta_propiedad">
                </div>
                <div class="form-group">
                    <label for="soat">Soat</label>
                    <input type="file" class="form-control-file" id="soat">
                </div>
                <div class="form-group">
                    <label for="autorizacion">Autorizacion del propietario</label>
                    <input type="file" class="form-control-file" id="autorizacion">
                </div>
                <hr>
                <h4>Datos del Vehiculo</h4>
                <h5>Asegúrese de tomarlos de la targeta de propiedad*</h5>
                <div class="form-row">
                    <div class="form-group col-md-3">
                    <label for="placa1">Placa</label>
                    <input type="text" class="form-control" id="placa1" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="color1">Color</label>
                    <input type="text" class="form-control" id="color1" autocomplete="off">
                    </div>
                    <div class="form-group col-md-3">
                    <label for="clase1">Clase</label>
                    <input type="text" class="form-control" id="clase1" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="marca1">Marca</label>
                    <input type="text" class="form-control" id="marca1" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="modelo1">Modelo</label>
                    <input type="number" class="form-control" id="modelo1" autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                    <label for="placa2">Placa</label>
                    <input type="text" class="form-control" id="placa2" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="color2">Color</label>
                    <input type="text" class="form-control" id="color2" autocomplete="off">
                    </div>
                    <div class="form-group col-md-3">
                    <label for="clase2">Clase</label>
                    <input type="text" class="form-control" id="clase2" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="marca2">Marca</label>
                    <input type="text" class="form-control" id="marca2" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="modelo2">Modelo</label>
                    <input type="number" class="form-control" id="modelo2" autocomplete="off">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                    <label for="placa3">Placa</label>
                    <input type="text" class="form-control" id="placa3" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="color3">Color</label>
                    <input type="text" class="form-control" id="color3" autocomplete="off">
                    </div>
                    <div class="form-group col-md-3">
                    <label for="clase3">Clase</label>
                    <input type="text" class="form-control" id="clase3" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="marca3">Marca</label>
                    <input type="text" class="form-control" id="marca3" autocomplete="off">
                    </div>
                    <div class="form-group col-md-2">
                    <label for="modelo3">Modelo</label>
                    <input type="number" class="form-control" id="modelo3" autocomplete="off">
                    </div>
                </div>
                <hr>
                <div class="form-row">
                    <div class="form-group col-md-6">
                    <label for="diligenciador">Nombre completo del diligenciador</label>
                    <input type="text" class="form-control" id="diligenciador" autocomplete="off">
                    </div>
                    <div class="form-group col-md-6">
                    <label for="documento">Su documento</label>
                    <input type="text" class="form-control" id="documento" autocomplete="off">
                    </div>
                </div>
                <hr>
                <button class="btn btn-primary">Enviar</button>
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
            >Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto, in numquam quibusdam.</p>
        </div>
        </div>
    </div>
    </div>
</div>
</template>