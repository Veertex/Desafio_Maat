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
        <form action="/store" method="POST">
            @method('POST')
            @csrf
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" class="@error('name') is-invalid @enderror">
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="email">Email:</label>
            <input type="text" name="email" id="email" class="@error('email') is-invalid @enderror">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password" class="@error('password') is-invalid @enderror">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <button type="submit">Guardar</button>
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