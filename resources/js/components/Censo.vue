<template>
    <div class="container my-5">
        <notifications :speed="500" group="foo" position="bottom left"/>
        <div class="card text-left">
            <div class="card-body">
                <h3 class="card-title">Censo</h3>
                <p class="card-text">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit.
                    Perspiciatis nulla assumenda culpa dolorum voluptatum,
                    quaerat quos sunt. Temporibus unde numquam sapiente
                    excepturi. Excepturi tempora nesciunt nisi! Nobis soluta vel
                    quo!
                </p>
                <br/>
                <div
                    v-if="
                        this.$auth.isAuthenticated() &&
                            user.status === 'APPROVED'
                    "
                >
                    <form @submit.prevent="sendCensus()" action="POST">
                        <h3>Formulario</h3>
                        <hr/>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="tipo">Es usted:</label>
                                <select
                                    class="form-control"
                                    id="tipo"
                                    v-model="tipo"
                                >
                                    <option>PROPIETARIO</option>
                                    <option>ARRENDATARIO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefonoApto"
                                >Telefono de su Apartamento</label
                                >
                                <input
                                    class="form-control"
                                    id="telefonoApto"
                                    type="number"
                                    v-model="telefono_apto"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="torre">Torre</label>
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="torre"
                                    type="number"
                                    v-model="torre"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="apartamento">Apartamento</label>
                                <input
                                    class="form-control"
                                    id="apartamento"
                                    type="number"
                                    v-model="apartamento"
                                />
                            </div>
                        </div>
                        <hr/>
                        <h4>Datos del propietario</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre"
                                >Nombre completo del propietario</label
                                >
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="nombre_propietario"
                                    type="text"
                                    v-model="nombre_propietario"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"
                                >Correo electronico del propietario</label
                                >
                                <input
                                    class="form-control"
                                    id="email_propietario"
                                    placeholder="Email"
                                    type="email"
                                    v-model="email_propietario"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="telefono_propietario"
                                >Telefono del Propietario</label
                                >
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="telefono_propietario"
                                    type="number"
                                    v-model="telefono_propietario"
                                />
                            </div>
                        </div>
                        <hr/>
                        <h4>Datos residente resposable</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nombre"
                                >Nombre completo del residente
                                    responsable</label
                                >
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="nombre"
                                    type="text"
                                    v-model="nombre_residente"
                                />
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email"
                                >Correo electronico del residente
                                    responsable</label
                                >
                                <input
                                    class="form-control"
                                    id="email"
                                    placeholder="Email"
                                    type="email"
                                    v-model="email_residente"
                                />
                            </div>
                        </div>
                        <hr/>
                        <h4>Datos sobre su estadía</h4>
                        <p>Tiempo residiendo en Solsticio estapa 5:</p>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="inputDias">Dias</label>
                                <input
                                    class="form-control"
                                    id="inputDias"
                                    type="number"
                                    v-model="time_days"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputMeses">Meses</label>
                                <input
                                    class="form-control"
                                    id="inputMeses"
                                    type="number"
                                    v-model="time_months"
                                />
                            </div>
                            <div class="form-group col-md-4">
                                <label for="inputAños">Años</label>
                                <input
                                    class="form-control"
                                    id="inputAños"
                                    type="number"
                                    v-model="time_years"
                                />
                            </div>
                        </div>
                        <hr/>
                        <h4>Vehículos</h4>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="carro">¿Tiene carro?</label>
                                <select
                                    class="form-control"
                                    id="carro"
                                    v-model="carro"
                                >
                                    <option>NO</option>
                                    <option>SI</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="placasCarro">Placas</label>
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="placasCarro"
                                    type="text"
                                    v-model="placa_carro"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="modeloCarro">Modelo</label>
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="modeloCarro"
                                    type="number"
                                    v-model="modelo_carro"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="parqueaderoCarro"
                                >No. Parqueadero asignado</label
                                >
                                <input
                                    class="form-control"
                                    id="parqueaderoCarro"
                                    type="number"
                                    v-model="parqueadero_asign_carro"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="moto">¿Tiene moto?</label>
                                <select
                                    class="form-control"
                                    id="moto"
                                    v-model="moto"
                                >
                                    <option>NO</option>
                                    <option>SI</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="placasMoto">Placas</label>s
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="placasMoto"
                                    type="text"
                                    v-model="placa_moto"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="modeloMoto">Modelo</label>
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="modeloMoto"
                                    type="number"
                                    v-model="modelo_moto"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="parqueaderoMoto"
                                >No. Parqueadero asignado</label
                                >
                                <input
                                    class="form-control"
                                    id="parqueaderoMoto"
                                    type="number"
                                    v-model="parqueadero_asign_moto"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="bicicleta">¿Tiene bicicleta?</label>
                                <select
                                    class="form-control"
                                    id="bicicleta"
                                    v-model="bicicleta"
                                >
                                    <option>NO</option>
                                    <option>SI</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="gancho">No. Gancho asignado</label>
                                <input
                                    class="form-control"
                                    id="gancho"
                                    type="number"
                                    v-model="gancho"
                                />
                            </div>
                        </div>
                        <hr/>
                        <h4>Información de los residentes</h4>
                        <p>
                            Complete la información de las personas que residen
                            con usted, si le sobran campos déjelos vacíos
                        </p>
                        <h5>Residente 1</h5>
                        <div class="form-group">
                            <label for="name1">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name1"
                                type="text"
                                v-model="residente1"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado1"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado1"
                                        v-model="discapacitado1"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad1">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad1"
                                        type="number"
                                        v-model="edad1"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco1">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco1"
                                        type="text"
                                        v-model="parentesco1"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad1">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad1"
                                        type="text"
                                        v-model="actividad1"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular1">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular1"
                                        type="number"
                                        v-model="celular1"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 2</h5>
                        <div class="form-group">
                            <label for="name2">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name2"
                                type="text"
                                v-model="residente2"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado2"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado2"
                                        v-model="discapacitado2"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad2">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad2"
                                        type="number"
                                        v-model="edad2"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco2">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco2"
                                        type="text"
                                        v-model="parentesco2"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad2">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad2"
                                        type="text"
                                        v-model="actividad2"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular2">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular2"
                                        type="number"
                                        v-model="celular2"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 3</h5>
                        <div class="form-group">
                            <label for="name3">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name3"
                                type="text"
                                v-model="residente3"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado3"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado3"
                                        v-model="discapacitado3"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad3">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad3"
                                        type="number"
                                        v-model="edad3"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco3">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco3"
                                        type="text"
                                        v-model="parentesco3"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad3">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad3"
                                        type="text"
                                        v-model="actividad3"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular3">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular3"
                                        type="number"
                                        v-model="celular3"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 4</h5>
                        <div class="form-group">
                            <label for="name4">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name4"
                                type="text"
                                v-model="residente4"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado4"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado4"
                                        v-model="discapacitado4"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad4">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad4"
                                        type="number"
                                        v-model="edad4"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco4">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco4"
                                        type="text"
                                        v-model="parentesco4"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad4">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad4"
                                        type="text"
                                        v-model="actividad4"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular4">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular4"
                                        type="number"
                                        v-model="celular4"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 5</h5>
                        <div class="form-group">
                            <label for="name5">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name5"
                                type="text"
                                v-model="residente5"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado5"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado5"
                                        v-model="discapacitado5"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad5">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad5"
                                        type="number"
                                        v-model="edad5"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco5">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco5"
                                        type="text"
                                        v-model="parentesco5"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad5">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad5"
                                        type="text"
                                        v-model="actividad5"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular5">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular5"
                                        type="number"
                                        v-model="celular5"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 6</h5>
                        <div class="form-group">
                            <label for="name6">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name6"
                                type="text"
                                v-model="residente6"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado6"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado6"
                                        v-model="discapacitado6"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad6">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad6"
                                        type="number"
                                        v-model="edad6"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco6">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco6"
                                        type="text"
                                        v-model="parentesco6"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad6">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad6"
                                        type="text"
                                        v-model="actividad6"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular6">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular6"
                                        type="number"
                                        v-model="celular6"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 7</h5>
                        <div class="form-group">
                            <label for="name7">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name7"
                                type="text"
                                v-model="residente7"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado7"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado7"
                                        v-model="discapacitado7"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad7">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad7"
                                        type="number"
                                        v-model="edad7"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco7">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco7"
                                        type="text"
                                        v-model="parentesco7"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad7">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad7"
                                        type="text"
                                        v-model="actividad7"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular7">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular7"
                                        type="number"
                                        v-model="celular7"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 8</h5>
                        <div class="form-group">
                            <label for="name8">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name8"
                                type="text"
                                v-model="residente8"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado8"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado8"
                                        v-model="discapacitado8"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad8">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad8"
                                        type="number"
                                        v-model="edad8"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco8">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco8"
                                        type="text"
                                        v-model="parentesco8"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad8">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad8"
                                        type="text"
                                        v-model="actividad8"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular8">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular8"
                                        type="number"
                                        v-model="celular8"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 9</h5>
                        <div class="form-group">
                            <label for="name9">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name9"
                                type="text"
                                v-model="residente9"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado9"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado9"
                                        v-model="discapacitado9"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad9">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad9"
                                        type="number"
                                        v-model="edad9"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco9">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco9"
                                        type="text"
                                        v-model="parentesco9"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad9">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad9"
                                        type="text"
                                        v-model="actividad9"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular9">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular9"
                                        type="number"
                                        v-model="celular9"
                                    />
                                </div>
                            </div>
                        </div>
                        <h5>Residente 10</h5>
                        <div class="form-group">
                            <label for="name10">Nombre Completo</label>
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="name10"
                                type="text"
                                v-model="residente10"
                            />
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="dicapacitado10"
                                    >¿Discapacitado?</label
                                    >
                                    <select
                                        class="form-control"
                                        id="dicapacitado10"
                                        v-model="discapacitado10"
                                    >
                                        <option>NO</option>
                                        <option>SI</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="edad10">Edad</label>
                                    <input
                                        class="form-control"
                                        id="edad10"
                                        type="number"
                                        v-model="edad10"
                                    />
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="parentesco10">Parentesco</label>
                                    <input
                                        class="form-control"
                                        id="parentesco10"
                                        type="text"
                                        v-model="parentesco10"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="actividad10">Actividad</label>
                                    <input
                                        class="form-control"
                                        id="actividad10"
                                        type="text"
                                        v-model="actividad10"
                                    />
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="celular10">Celular</label>
                                    <input
                                        class="form-control"
                                        id="celular10"
                                        type="number"
                                        v-model="celular10"
                                    />
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h4>Otros datos</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="internet"
                                >¿Cuenta con servicio de internet?</label
                                >
                                <select
                                    class="form-control"
                                    id="internet"
                                    v-model="internet"
                                >
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="proveedor">¿De cuál empresa?</label>
                                <input
                                    class="form-control"
                                    id="proveedor"
                                    type="text"
                                    v-model="proveedor"
                                />
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="mascota">¿Tiene mascota?</label>
                                <select
                                    class="form-control"
                                    id="mascota"
                                    v-model="mascota"
                                >
                                    <option>NO</option>
                                    <option>SI</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="raza">¿Cuál?</label>
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="raza"
                                    type="text"
                                    v-model="mascota_raza"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="mascotaNumero">Cuantas</label>
                                <input
                                    autocomplete="off"
                                    class="form-control"
                                    id="mascotaNumero"
                                    type="number"
                                    v-model="mascota_cantidad"
                                />
                            </div>
                            <div class="form-group col-md-3">
                                <label for="vacunas"
                                >¿Vacunado oportunamente?</label
                                >
                                <select
                                    class="form-control"
                                    id="vacunas"
                                    v-model="vacunas"
                                >
                                    <option>SI</option>
                                    <option>NO</option>
                                </select>
                            </div>
                        </div>
                        <hr/>
                        <h4>Observaciones</h4>
                        <div class="form-group">
                            <label for="observaciones"></label>
                            <textarea
                                class="form-control"
                                id="observaciones"
                                rows="5"
                                v-model="observaciones"
                            />
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label for="elaborado"
                            >Este censo fue elaborado por:</label
                            >
                            <input
                                autocomplete="off"
                                class="form-control"
                                id="elaborado"
                                type="text"
                                v-model="elaborado"
                            />
                        </div>
                        <hr/>
                        <div class="form-group">
                            <div class="form-check">
                                <input
                                    class="form-check-input"
                                    id="gridCheck"
                                    type="checkbox"
                                    v-model="acepto"
                                />
                                <label class="form-check-label" for="gridCheck"
                                >Estoy de acuerdo con las políticas de uso y
                                    el manejo de la información que ha sido
                                    consignada en este formulario</label
                                >
                            </div>
                        </div>
                        <div
                            class="alert alert-danger"
                            role="alert"
                            v-show="alerta"
                        >
                            {{ alerta }}
                        </div>
                        <button class="btn btn-primary" type="submit">
                            Terminado
                        </button>
                    </form>
                </div>
                <div v-else>
                    <h3>No has iniciado sesión</h3>
                    <p>
                        Para completar este censo primero debes iniciar sesión
                    </p>
                    <a
                        class="btn btn-primary"
                        href="http://solsticio.local/login"
                    >Iniciar sesión</a
                    >
                    <a
                        class="btn btn-primary"
                        href="http://solsticio.local/register"
                    >Registrarse</a
                    >
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    function initialState() {
        return {
            user: {},
            torre: "",
            apartamento: "",
            telefono_apto: "",
            tipo: "",
            nombre_propietario: "",
            email_propietario: "",
            telefono_propietario: "",
            nombre_residente: "",
            email_residente: "",
            time_days: "",
            time_months: "",
            time_years: "",
            carro: "NO",
            placa_carro: "",
            modelo_carro: "",
            parqueadero_asign_carro: "",
            moto: "NO",
            placa_moto: "",
            modelo_moto: "",
            parqueadero_asign_moto: "",
            bicicleta: "NO",
            gancho: "",

            residente1: "",
            discapacitado1: "NO",
            edad1: "",
            parentesco1: "",
            actividad1: "",
            celular1: "",

            residente2: "",
            discapacitado2: "NO",
            edad2: "",
            parentesco2: "",
            actividad2: "",
            celular2: "",

            residente3: "",
            discapacitado3: "NO",
            edad3: "",
            parentesco3: "",
            actividad3: "",
            celular3: "",

            residente4: "",
            discapacitado4: "NO",
            edad4: "",
            parentesco4: "",
            actividad4: "",
            celular4: "",

            residente5: "",
            discapacitado5: "NO",
            edad5: "",
            parentesco5: "",
            actividad5: "",
            celular5: "",

            residente6: "",
            discapacitado6: "NO",
            edad6: "",
            parentesco6: "",
            actividad6: "",
            celular6: "",

            residente7: "",
            discapacitado7: "NO",
            edad7: "",
            parentesco7: "",
            actividad7: "",
            celular7: "",

            residente8: "",
            discapacitado8: "NO",
            edad8: "",
            parentesco8: "",
            actividad8: "",
            celular8: "",

            residente9: "",
            discapacitado9: "NO",
            edad9: "",
            parentesco9: "",
            actividad9: "",
            celular9: "",

            residente10: "",
            discapacitado10: "NO",
            edad10: "",
            parentesco10: "",
            actividad10: "",
            celular10: "",

            internet: "SI",
            proveedor: "",
            mascota: "NO",
            mascota_raza: "",
            mascota_cantidad: "",
            vacunas: "",
            observaciones: "",
            elaborado: "",
            fecha: "",
            acepto: false,
            alerta: ""
        };
    }

    export default {
        created() {
            if (this.$auth.isAuthenticated()) this.getUser();
        },
        data() {
            return initialState();
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
            sendCensus() {
                var url = "http://solsticio.local/api/censuses";
                if (this.acepto) {
                    axios
                        .post(url, {
                            user_id: this.user.id,
                            fecha: this.getDate(),
                            torre: this.torre,
                            apartamento: this.apartamento,
                            telefono_apto: this.telefono_apto,
                            tipo: this.tipo,
                            nombre_propietario: this.nombre_propietario,
                            email_propietario: this.email_propietario,
                            telefono_propietario: this.telefono_propietario,
                            nombre_residente: this.nombre_propietario,
                            email_residente: this.email_residente,
                            time_days: this.time_days,
                            time_months: this.time_months,
                            time_years: this.time_years,
                            carro: this.carro,
                            placa_carro: this.placa_carro,
                            modelo_carro: this.modelo_carro,
                            parqueadero_asign_carro: this.parqueadero_asign_carro,
                            moto: this.moto,
                            placa_moto: this.placa_moto,
                            modelo_moto: this.modelo_moto,
                            parqueadero_asign_moto: this.parqueadero_asign_moto,
                            bicicleta: this.bicicleta,
                            gancho: this.gancho,

                            residente1: this.residente1,
                            discapacitado1: this.discapacitado1,
                            edad1: this.edad1,
                            parentesco1: this.parentesco1,
                            actividad1: this.actividad1,
                            celular1: this.celular1,

                            residente2: this.residente2,
                            discapacitado2: this.discapacitado2,
                            edad2: this.edad2,
                            parentesco2: this.parentesco2,
                            actividad2: this.actividad2,
                            celular2: this.celular2,

                            residente3: this.residente3,
                            discapacitado3: this.discapacitado3,
                            edad3: this.edad3,
                            parentesco3: this.parentesco3,
                            actividad3: this.actividad,
                            celular3: this.celular3,

                            residente4: this.residente4,
                            discapacitado4: this.discapacitado4,
                            edad4: this.edad4,
                            parentesco4: this.parentesco4,
                            actividad4: this.actividad4,
                            celular4: this.celular4,

                            residente5: this.residente5,
                            discapacitado5: this.discapacitado5,
                            edad5: this.edad5,
                            parentesco5: this.parentesco5,
                            actividad5: this.actividad5,
                            celular5: this.celular5,

                            residente6: this.residente6,
                            discapacitado6: this.discapacitado6,
                            edad6: this.edad6,
                            parentesco6: this.parentesco6,
                            actividad6: this.actividad6,
                            celular6: this.celular6,

                            residente7: this.residente7,
                            discapacitado7: this.discapacitado7,
                            edad7: this.edad7,
                            parentesco7: this.parentesco7,
                            actividad7: this.actividad7,
                            celular7: this.celular7,

                            residente8: this.residente8,
                            discapacitado8: this.discapacitado8,
                            edad8: this.edad8,
                            parentesco8: this.parentesco8,
                            actividad8: this.actividad8,
                            celular8: this.celular8,

                            residente9: this.residente9,
                            discapacitado9: this.discapacitado9,
                            edad9: this.edad9,
                            parentesco9: this.parentesco9,
                            actividad9: this.actividad9,
                            celular9: this.celular9,

                            residente10: this.residente10,
                            discapacitado10: this.discapacitado10,
                            edad10: this.edad10,
                            parentesco10: this.parentesco10,
                            actividad10: this.actividad10,
                            celular10: this.celular10,

                            internet: this.internet,
                            proveedor: this.proveedor,
                            mascota: this.mascota,
                            mascota_raza: this.mascota_raza,
                            mascota_cantidad: this.mascota_cantidad,
                            vacunas: this.vacunas,
                            observaciones: this.observaciones,
                            elaborado: this.elaborado
                        })
                        .then(response => {
                            this.alert("success", "El censo ha sido enviado");
                            this.alerta = "";
                            Object.assign(this.$data, initialState());
                        })
                        .catch(error => {
                            this.alert("error", "Algo ha salido mal");
                        });
                } else {
                    this.alerta = "Por favor acepte los términos";
                }
            },
            getDate() {
                let today = new Date();
                let dd = today.getDate();
                let mm = today.getMonth() + 1;
                let yyyy = today.getFullYear();

                if (dd < 10) dd = "0" + dd;

                if (mm < 10) mm = "0" + mm;

                today = yyyy + "-" + mm + "-" + dd;
                return today;
            },
            getUser() {
                const url = "/api/auth/user";
                axios
                    .get(url)
                    .then(response => {
                        this.user = response.data.data;
                    })
                    .catch();
            }
        }
    };
</script>
