<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pagina de Prueba</title>
</head>
<body>
    <h1>Esta es la pagina que regresa una ruta de laravel</h1>
    @if($num)
        <p>Existe la variable num</p>
        <p>{{$num}}</p>
    @else
        <p>No existe la variable num</p>
    @endif
</body>
</html>
