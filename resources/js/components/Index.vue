<template>
    <div>
        <header class="background-overlay text-white">
        <div class="container text-center">
            <h1>Bienvenido a la página de Solsticio</h1>
            <p class="lead">Parque Residencial etapa 5</p>
        </div>
        </header>

        <section id="about">
        <div class="container mt-5">
            <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>About this page</h2>
                <p class="lead">This is a great place to talk about your webpage. This template is purposefully unstyled so you can use it as a boilerplate or starting point for you own landing page designs! This template features:</p>
                <ul>
                <li>Clickable nav links that smooth scroll to page sections</li>
                <li>Responsive behavior when clicking nav links perfect for a one page website</li>
                <li>Bootstrap's scrollspy feature which highlights which section of the page you're on in the navbar</li>
                <li>Minimal custom CSS so you are free to explore your own unique design options</li>
                </ul>
            </div>
            </div>
        </div>
        </section>

        <section id="services" class="bg-light">
        <div class="container mt-5">
            <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Services we offer</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aut optio velit inventore, expedita quo laboriosam possimus ea consequatur vitae, doloribus consequuntur ex. Nemo assumenda laborum vel, labore ut velit dignissimos.</p>
            </div>
            </div>
        </div>
        </section>

        <section id="contact">
        <div class="container mt-5 mb-5">
            <div class="row">
            <div class="col-lg-8 mx-auto">
                <h2>Contact us</h2>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vero odio fugiat voluptatem dolor, provident officiis, id iusto! Obcaecati incidunt, qui nihil beatae magnam et repudiandae ipsa exercitationem, in, quo totam.</p>
            </div>
            </div>
        </div>
        </section>
    </div>
</template>

<style>
    header {
        padding: 154px 0 100px;
        position: relative;
        background: url(http://localhost/solsticio/public/images/background.jpg);
        background-size: cover;      
    }

    .background-overlay {
        background: rgba(127, 0, 0,.6);
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }

    @media (min-width: 992px) {
        header {
            padding: 156px 0 100px;
        }
    }
</style>
