@extends('adminlte::page')

@section('title', 'Visitas')

@section('content_header')
<h1>Listado de Visitas</h1>
@stop

@section('content')
<a style="background-color: rgb(1, 130, 5); border: 1px solid rgb(1, 130, 5);" href="{{ route('visita.create') }}" class="btn btn-primary">Registrar Nueva Visita</a>
<a href="{{ $pdfRoute }}" class="btn btn-danger"> <i class="fas fa-file-pdf"></i></a>
<a href="{{ $csvRoute }}" class="btn btn-success"><i class="fa fa-file-excel"></i></a>
<br> <br>
<table id="visitas" class="table table-striped table-bordered" style="width: 100%">
    <thead class="bg-primary text-white">
        <tr>
            <th scope="col" style="background-color: #4b545c">ID</th>
            <th scope="col" style="background-color: #4b545c">Ejecutivo</th>
            <th scope="col" style="background-color: #4b545c">Nombre del Cliente</th>
            <th scope="col" style="background-color: #4b545c">Teléfono</th>
            <th scope="col" style="background-color: #4b545c">Email</th>
            <th scope="col" style="background-color: #4b545c">Fecha de Visita</th>
            <th scope="col" style="background-color: #4b545c">Opciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visitas as $visita)
        <tr>
            <td>{{ $visita->id }}</td>
            <td>{{ $visita->user->nombre }}</td> 
            <td>{{ $visita->cliente_nombre }}</td>
            <td>{{ $visita->cliente_telefono }}</td>
            <td>{{ $visita->cliente_email }}</td>
            <td>{{ $visita->fecha_visita }}</td>
            <td>
                <form class="formulario-eliminar" action="{{ route('visitas.destroy', $visita->id) }}" method="POST">
                    <a href="{{ route('visita.show', $visita->id) }}" class="btn btn-info">Ver Más</a>
                    <a href="https://www.google.com/maps?q={{ $visita->latitud . ',' . $visita->longitud }}" class="btn btn-info" target="_blank">Ver Mapa</a>
                    <a href="{{ route('visitas.edit', $visita->id) }}" class="btn btn-warning">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<script>
    $('#visitas').DataTable();
</script>

@if (session('eliminar') == 'ok')
<script>
    Swal.fire(
        'Eliminado!',
        'La visita se ha eliminado exitosamente',
        'success'
    )
</script>
@endif
@if (session('success'))
<script>
    Swal.fire(
        'Éxito!',
        'La visita se ha guardado exitosamente.',
        'success'
    )
</script>
@endif
@if (session('edit-success'))
<script>
    Swal.fire(
        'Éxito!',
        'La visita se ha actualizado exitosamente',
        'success'
    )
</script>
@endif

<script>
    $('.formulario-eliminar').submit(function(evento) {
        evento.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta visita se eliminará definitivamente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar!'
        }).then((result) => {
            if (result.isConfirmed) {
                this.submit();
            }
        })
    })
</script>
@stop
