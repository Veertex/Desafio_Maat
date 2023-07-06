<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Maat</title>
</head>

<body>
    <!-- HEADER CON TITULO Y SUBTITULO-->
    <header>
        <h1>Desafio Maat</h1>
        <h4>Williams Torres</h4>
    </header>
    <main>
        <form action="/update/{{$user->id}}" method="POST">
            @method('PUT')
            @csrf
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror" value="{{$user->name}}">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="@error('email') is-invalid @enderror" value="{{$user->email}}">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror" value="{{$user->password}}">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Guardar cambios</button>
        </form>
    </main>
</body>
<!-- LIBRERIA CHARTS.JS PARA LA GENERACION DE GRAFICOS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- LIBRERIA SWEETALERT2 PARA LA CREACION DE ALERTAS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ESTILOS CSS -->
<link rel="stylesheet" href="/styles.css">

</html>