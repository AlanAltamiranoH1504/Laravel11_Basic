<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf_token" content="{{csrf_token()}}">
    <title>Peticion AJAX</title>
</head>
<body>
    <h1>Vista para peticion ajax</h1>
    <button type="button" id="btnAjax" name="btnAjax" class="btn btn-primary">Enviar Peticion</button>
    <script src="{{asset("js/PruebaAjax.js")}}"></script>
</body>
</html>
