@extends('adminlte::page')

@section('title', 'Detalles de Persona')

@section('content_header')
<h1>Detalles de Persona</h1>
@stop

@section('content')
<div class="mb-3">
    <label for="name" class="form-label">Nombre</label>
    <input type="text" class="form-control" value="{{ $persona->nombre }}" readonly>
</div>

<div class="mb-3">
    <label for="name" class="form-label">Apellido</label>
    <input type="text" class="form-control" value="{{ $persona->apellido }}" readonly>
</div>

<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" value="{{ $persona->email }}" readonly>
</div>

<div class="mb-3">
    <label for="ci" class="form-label">Tipo de Usuario</label>
    <input type="text" class="form-control" value="{{ $persona->tipo_usuario }}" readonly>
</div>

<div class="mb-3">
    <label for="telefono" class="form-label">Estado</label>
    <input type="text" class="form-control" value="{{ $persona->estado }}" readonly>
</div>

<div class="mb-3">
    <label for="foto" class="form-label">Foto</label><br>
    @if ($persona->foto)
        <img src="{{ asset($persona->foto) }}" alt="Foto del usuario" width="200" height="200">
    @else
        <p>No se ha cargado ninguna foto</p>
    @endif
</div>



<a href="/personas" class="btn btn-secondary" tabindex="4">Volver</a>
{{-- @if($persona->tipo_usuario === 'cliente')
    <a style="background-color: rgb(1, 130, 5); border: 1px solid rgb(1, 130, 5);" href="{{ route('ubicaciones.index', $persona->id) }}" class="btn btn-primary">Ubicaciones</a>
@endif --}}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop