<h3>Hola {{ $data['user']->name }}</h3>

@if ($data['status'] == "APPROVED")
    <p>Nos complace informarte que tu petición fue aprovada</p>
@else
    <p>Lastimosamente tu petición fue rechazada</p>
    <p>Incumpliste con uno de los requerimentos o los datos que nos enviaste están incompletos</p>
@endif

<h5>Datos de la petición:</h5>
<ul>
    <li>Nombre del responsable: {{ $data['petition']['nombre_responsable'] }} </li>
    <li>Cédula: {{ $data['petition']['cedula'] }} </li>
    <li>Información suministrada: {{ $data['petition']['additional'] }} </li>
</ul>
