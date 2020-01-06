<h3>Hola {{ $data['user']->name }}</h3>

@if ($data['status'] == "APPROVED")
    <p>Nos complace informarte que tu reserva fue aprovada</p>
@else
    <p>Lastimosamente tu reserva fue rechazada.</p>
    <p>El salón que solicitaste está reservado para ese día o alguno de tus datos era erroneo o poco confiable</p>
@endif

<h5>Datos de la reserva:</h5>
<ul>
    <li>Nombre del responsable: {{ $data['reservation']['nombre_responsable'] }} </li>
    <li>Fecha solicitada: {{ $data['reservation']['fecha_solicitada'] }} </li>
    <li>
        Información adicional suministrada:
        <p>{{ $data['reservation']['additional_info'] }}</p>
    </li>
</ul>
