<!DOCTYPE html>
<html lang="en">
<head>
  <title>Doce Entrega - Inicio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>


<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="{{route('inicio.index')}}">Área Restrita</a>
    </li>
  </ul>
</nav>

  @yield('conteudo')

</body>
</html>