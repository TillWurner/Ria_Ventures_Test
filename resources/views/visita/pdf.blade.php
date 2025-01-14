<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .titulo {
            text-align: center;
            font-size: 24px;
            color: rgb(0, 0, 0);
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: rgb(113, 113, 196);
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .btn {
            display: inline-block;
            padding: 5px 10px;
            background-color: blue;
            color: white;
            text-decoration: none;
            border-radius: 3px;
        }

        .btn:hover {
            background-color: rgb(73, 73, 167);
        }

        .btn-danger {
            background-color: red;
        }

        .btn-danger:hover {
            background-color: darkred;
        }
    </style>
</head>

<body>
    <div>
        <h1 class="titulo">Listado de Visitas</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ejecutivo a Cargo</th>
                    <th>Nombre del Cliente</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Fecha de Visita</th>
                    <th>Estado de la Visita</th>
                    <th>Referencia</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($visitas as $visita)
                    <tr>
                        <td>{{ $visita->id ?? '--' }}</td>
                        <td>{{ $visita->user->nombre?? '--' }}</td>
                        <td>{{ $visita->cliente_nombre ?? '--' }}</td>
                        <td>{{ $visita->cliente_telefono ?? '--' }}</td>
                        <td>{{ $visita->cliente_email ?? '--' }}</td>
                        <td>{{ $visita->fecha_visita ?? '--' }}</td>
                        <td>{{ $visita->estado_visita ?? '--' }}</td>
                        <td>{{ $visita->referencia ?? '--' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
