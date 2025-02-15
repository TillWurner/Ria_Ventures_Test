@extends('adminlte::page')

@section('title', 'Editar Persona')

@section('content_header')
    <h1>Editar Persona</h1>
@stop

@section('content')
    <form action="/personas/{{ $persona->id }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="{{ old('nombre', $persona->nombre) }}" tabindex="1">
            @error('nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="apellido" class="form-label">Apellido</label>
            <input type="text" id="apellido" name="apellido" class="form-control" value="{{ old('apellido', $persona->apellido) }}" tabindex="1">
            @error('apellido')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3" >
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $persona->email) }}" tabindex="6">
            @error('email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Telefono/Celular</label>
            <input type="number" id="telefono" name="telefono" class="form-control" value="{{ old('telefono', $persona->telefono) }}" tabindex="3">
            @error('telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="direccion" class="form-label">Direccion</label>
            <input type="text" id="direccion" name="direccion" class="form-control" value="{{ old('direccion', $persona->direccion) }}" tabindex="1">
            @error('direccion')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cargo" class="form-label">Cargo</label>
            <input type="text" id="cargo" name="cargo" class="form-control" value="{{ old('cargo', $persona->cargo) }}" tabindex="1">
            @error('cargo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <label for="estado" class="form-label">Estado</label>
        <select name="estado" id="estado" class="form-control" tabindex="4">
            <option value="activo" {{ old('estado', $persona->estado) === 'activo' ? 'selected' : '' }}>
                Activo
            </option>
            <option value="inactivo"
                {{ old('estado', $persona->estado) === 'inactivo' ? 'selected' : '' }}>Inactivo
            </option>
        </select>
        @error('estado')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <br>

        <div class="mb-3" id="foto_container" style="display: none;">
            <label for="foto" class="form-label">{{ __('Selecciona una Imagen') }}</label>
            <input type="file" id="foto" class="form-control" name="foto" accept="image/*" tabindex="5">
            @error('foto')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <a href="/personas" class="btn btn-secondary" tabindex="8">Cancelar</a>
        <button type="submit" class="btn btn-success" tabindex="9">Guardar</button>
    </form>
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#tipo_usuario').change(function() {
                var selectedOption = $(this).val();

                // Establece las variables para los contenedores
                var fotoContainer = $('#foto_container');
                /* var emailContainer = $('#email_container'); */

                // Muestra u oculta los contenedores según la opción seleccionada
                fotoContainer.toggle(selectedOption === 'ejecutivo');
                /* emailContainer.toggle(selectedOption === 'administrador'); */ 
            });
        });
    </script>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
</style>
@stop
