<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desafio Maat</title>
</head>

<body>


    <main>
        <!-- HEADER CON TITULO Y SUBTITULO-->
        <header>
            <h1>Desafio Maat</h1>
            <h4>Williams Torres</h4>
        </header>
        <!-- CANVA DE GRAFICO DE USUARIOS POR MES -->
        <div>
            <canvas id="myChart"></canvas>
        </div>

        <div>
            <!-- BOTON PARA AÑADIR NUEVO USUARIO A LOS REGISTROS -->
            <button id="create">Nuevo usuario</button>

            <!-- BOTON PARA EXPORTAR TABLA A DOCUMENTO EXCEL -->
            <button id="download">Descargar</button>
        </div>

        <!-- TABLA DE USUARIOS -->
        <table>

            <!-- ENCABEZADOS DE LA TABLA DE USUARIOS -->
            <tr>
                <th>id</th>
                <th>Nombre</th>
                <th>Email</th>
                <th></th>
            </tr>

            <!-- REGISTROS DE LA TABLA DE USUARIOS -->
            @if (count($users) >= 1)
            @foreach($users as $user)
            <tr>
                <td>{{$user->id}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <button class="edit">Editar</button>
                    <button class="delete">Eliminar</button>
                </td>
            </tr>
            @endforeach
            @else
            Sin registros
            @endif
        </table>

        <!-- SCRIPT DE BOTONES Y GRAFICO DE USUARIOS -->
        <script>
            /* COMENZAMOS CON UNA FUNCION QUE RETRASA LA EJECUCION
             DEL SCRIPT HASTA QUE SE HAYA CARGADO TODO EL DOCUMENTO */
            window.addEventListener("load", function() {

                /* SE FORMATEA LA INFORMACION RECIBIDA DESDE EL BACKEND */
                let data = JSON.parse('<?= $usersPerMonth ?>');

                /* SE CONFIGURA EL GRAFICO CON DATOS RELEVANTES */
                new Chart(
                    document.getElementById('myChart'), {
                        type: 'bar',
                        data: {
                            labels: data.map(row => row.date),
                            datasets: [{
                                label: 'Usuarios por mes',
                                data: data.map(row => row.users),
                                backgroundColor: '#EDD836',
                            }]
                        }
                    }
                );

                /* SE CONFIGURA EL BOTON PARA DESCARGAR ARCHIVO EXCEL Y EJECUTAR ALERTA */
                document.getElementById('download').addEventListener('click', function() {
                    fetch('download')
                        .then(response => response.blob())
                        .then(blob => {
                            const url = window.URL.createObjectURL(blob);

                            const a = document.createElement('a');
                            a.href = url;
                            a.download = 'users.xlsx';
                            a.click();

                            window.URL.revokeObjectURL(url);
                            Swal.fire({
                                icon: 'success',
                                title: 'Archivo descargado',
                            })
                        })
                        .catch(error => {
                            Swal.fire({
                                icon: 'error',
                                title: 'Archivo no descargado',
                            })
                        });
                });

                /* SE CONFIGURA EL BOTON PARA CREAR NUEVO USUARIO */
                document.getElementById('create').addEventListener('click', function() {
                    const a = document.createElement('a');
                    a.href = 'create';
                    a.click();
                });

                /* SE OBTIENE LA LISTA DE BOTONES DE EDICION */
                var buttons = document.getElementsByClassName('edit');

                for (var i = 0; i < buttons.length; i++) {

                    /* SE CONFIGURA EL BOTON PARA EDITAR USUARIO */
                    buttons[i].addEventListener('click', function() {

                        /* SE OBTIENE EL ID DEL USUARIO Y SE PERSONALIZA LA URL*/
                        let id = this.parentNode.parentNode.querySelector('td:first-child').innerText
                        const a = document.createElement('a');
                        a.href = 'edit/' + id;
                        a.click();
                    });
                }

                /* SE OBTIENE LA LISTA DE BOTONES DE ELIMINACION */
                var buttons = document.getElementsByClassName('delete');

                for (var i = 0; i < buttons.length; i++) {

                    /* SE CONFIGURA EL BOTON PARA ELIMINAR USUARIO*/
                    buttons[i].addEventListener('click', function() {

                        let id = this.parentNode.parentNode.querySelector('td:first-child').innerText

                        /* SE OBTIENE EL ID DEL USUARIO Y SE PERSONALIZA LA URL*/
                        fetch('/delete/' + id, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '<?= csrf_token() ?>'
                                }
                            })
                            .then(response => {
                                if (response.ok) {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Recurso eliminado correctamente',
                                        didDestroy: () => {
                                            location.reload();
                                        }
                                    })
                                    this.parentNode.parentNode.remove();
                                } else {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'No se ha podido eliminar el recurso',
                                    })
                                }
                            })
                            .catch(error => {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'No se ha podido eliminar el recurso',
                                })
                            });
                    });
                }
            })
        </script>
    </main>
</body>
<!-- LIBRERIA CHARTS.JS PARA LA GENERACION DE GRAFICOS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- LIBRERIA SWEETALERT2 PARA LA CREACION DE ALERTAS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- ESTILOS CSS -->
<link rel="stylesheet" href="/styles.css">

</html>