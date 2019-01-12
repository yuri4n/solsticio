<template>
    <div class="container">
        <div class="row my-5">
            <div class="col-md-8">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title">Formulario de Peticion</h4>
                        <p class="card-text">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Beatae aperiam voluptates mollitia nulla ipsa iusto accusantium eius corrupti blanditiis eum, deleniti ipsum? Vitae odio debitis sapiente saepe tempore consequatur aperiam?</p>
                        <form action="">
                            <div class="form-group">
                              <label for="name">Nombre del responsable</label>
                              <input type="text" name="nombre" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                              <label for="cedula">Número de cédula</label>
                              <input type="text" name="Cédula" id="cedula" class="form-control" placeholder="" aria-describedby="helpId">
                              <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div class="form-group">
                              <label for="texto">Texto</label>
                              <textarea class="form-control" id="texto" rows="6"></textarea>
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
                    <p class="card-text">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Iusto, in numquam quibusdam quisquam ad dolorum itaque deleniti impedit? Ea ad blanditiis possimus aliquid! Rerum blanditiis, culpa pariatur esse quibusdam odit.</p>
                  </div>
                </div>
            </div>
        </div>
    </div>
</template>
