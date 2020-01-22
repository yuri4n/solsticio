<h3>Hola {{ $data['user']->name }}</h3>

@if ($data['status'] == "APPROVED")
    <p>Nos complace informarte que tu petición de parqueadero fue aprovada</p>
@else
    <p>Lastimosamente tu petición fue parqueadero rechazada</p>
    <p>Incumpliste con uno de los requerimentos o los datos que nos enviaste están incompletos</p>
@endif

<h5>Datos del clasificado:</h5>
<ul>
    <li>Diligenciador: {{ $data['parking']['diligenciador'] }} </li>
    <li>Documento: {{ $data['parking']['documento'] }} </li>
</ul>

<h5>Datos Vehiculo 2</h5>
<ul>
    <li>Placa: {{ $data['parking']['placa1'] }}</li>
    <li>Color: {{ $data['parking']['color1'] }}</li>
    <li>Clase: {{ $data['parking']['clase1'] }}</li>
    <li>Marca: {{ $data['parking']['marca1'] }}</li>
    <li>Modelo: {{ $data['parking']['modelo1'] }}</li>
</ul>

@if($data['parking']['placa2'])
    <h5>Datos Vehiculo 2</h5>
    <ul>
        <li>Placa: {{ $data['parking']['placa2'] }}</li>
        <li>Color: {{ $data['parking']['color2'] }}</li>
        <li>Clase: {{ $data['parking']['clase2'] }}</li>
        <li>Marca: {{ $data['parking']['marca2'] }}</li>
        <li>Modelo: {{ $data['parking']['modelo2'] }}</li>
    </ul>
@endif

@if($data['parking']['placa3'])
    <h5>Datos Vehiculo 2</h5>
    <ul>
        <li>Placa: {{ $data['parking']['placa3'] }}</li>
        <li>Color: {{ $data['parking']['color3'] }}</li>
        <li>Clase: {{ $data['parking']['clase3'] }}</li>
        <li>Marca: {{ $data['parking']['marca3'] }}</li>
        <li>Modelo: {{ $data['parking']['modelo3'] }}</li>
    </ul>
@endif
