<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Solsticio Parque Residencial</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="inicio">Inicio</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="noticias">Noticias</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Servicios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Archivos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Clasificados</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Peticiones</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Censo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Pagos</a>
            </li>
            </ul>
        </div>
    </nav>
</template>

<script>
export default {
    mounted() {
        console.log('Navbar component')
    }
}
</script>
