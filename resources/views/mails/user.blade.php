<h3>Hola {{ $data['user']['name'] }}</h3>

@if ($data['status'] == "APPROVED")
    <p>Nos complace informarte que tu cuenta de usuario ha sido aprobada</p>
@else
    <p>Lastimosamente tu cuenta de usuario ha sido rechazada.</p>
    <p>Probablemente alguno de tus datos era erroneo o poco confiable</p>
@endif

<h5>Datos del usuario:</h5>
<ul>
    <li>Email: {{ $data['user']['email'] }} </li>
    <li>Torre: {{ $data['user']['torre'] }} </li>
    <li>Apartamento: {{ $data['user']['apartamento'] }} </li>
</ul>
