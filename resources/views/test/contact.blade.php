<h1>Pagina Contact</h1>

@if($paises)
    <ul>
        @foreach($paises as $pais)
            <li>{{$pais}}</li>
        @endforeach
    </ul>
@else
    <p>No existe la variable paises</p>
@endif
