<h3>Hola {{ $data['user']->name }}</h3>

@if ($data['status'] == "PUBLISHED")
    <p>Nos complace informarte que tu clasificado fue aprovado</p>
@else
    <p>Lastimosamente tu clasificado fue rechazado.</p>
    <p>Incumpliste con uno de los requerimentos o tu contenido es inapropiado</p>
@endif

<h5>Datos del clasificado:</h5>
<ul>
    <li>Título: {{ $data['classified']['title'] }} </li>
    <li>Resumen: {{ $data['classified']['excerpt'] }} </li>
</ul>
