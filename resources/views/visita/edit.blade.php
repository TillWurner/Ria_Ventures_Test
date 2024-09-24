@extends('adminlte::page')

@section('title', 'Editar Visita')

@section('content_header')
<h1>Editar Visita</h1>
@stop

@section('content')
<form action="{{ route('visitas.update', $visita->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="hidden" name="user_id" value="{{ $visita->user_id }}">

    <div class="mb-3">
        <label for="ejecutivo_a_cargo" class="form-label">Ejecutivo a Cargo</label>
        <input type="text" class="form-control" value="{{ $visita->user->nombre }}" readonly>
    </div>

    <div class="mb-3">
        <label for="cliente_nombre" class="form-label">Nombre del Cliente</label>
        <input type="text" id="cliente_nombre" name="cliente_nombre" class="form-control" value="{{ old('cliente_nombre', $visita->cliente_nombre) }}">
    </div>

    <div class="mb-3">
        <label for="cliente_telefono" class="form-label">Teléfono</label>
        <input type="text" id="cliente_telefono" name="cliente_telefono" class="form-control" value="{{ old('cliente_telefono', $visita->cliente_telefono) }}">
    </div>

    <div class="mb-3">
        <label for="cliente_email" class="form-label">Email</label>
        <input type="email" id="cliente_email" name="cliente_email" class="form-control" value="{{ old('cliente_email', $visita->cliente_email) }}">
    </div>

    <div class="mb-3">
        <label for="forma_contacto" class="form-label">Forma de Contacto</label>
        <input type="text" id="forma_contacto" name="forma_contacto" class="form-control" value="{{ old('forma_contacto', $visita->forma_contacto) }}">
    </div>

    <div class="mb-3">
        <label for="estado_visita" class="form-label">Estado de la Visita</label>
        <input type="text" id="estado_visita" name="estado_visita" class="form-control" value="{{ old('estado_visita', $visita->estado_visita) }}">
    </div>

    <div class="mb-3">
        <label for="referencia" class="form-label">Referencia</label>
        <input type="text" id="referencia" name="referencia" class="form-control" value="{{ old('referencia', $visita->referencia) }}">
        @error('referencia')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="link" class="form-label">Link de Google Maps</label>
        <input type="text" id="link" name="link" class="form-control" value="{{ old('link', $visita->link) }}">
        @error('link')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="latitud" class="form-label">Latitud</label>
        <input type="text" id="latitud" name="latitud" class="form-control" value="{{ old('latitud', $visita->latitud) }}">
        @error('latitud')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="longitud" class="form-label">Longitud</label>
        <input type="text" id="longitud" name="longitud" class="form-control" value="{{ old('longitud', $visita->longitud) }}">
        @error('longitud')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fecha_visita" class="form-label">Fecha de Visita</label>
        <input type="text" id="fecha_visita" name="fecha_visita" class="form-control" value="{{ old('fecha_visita', $visita->fecha_visita) }}">
    </div>

    <div id="map" style="height: 400px;"></div>

    <a href="{{ route('visitas.index') }}" class="btn btn-secondary">Cancelar</a>
    <button type="submit" class="btn btn-success">Guardar</button>
</form>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@stop

@section('js')
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
<script>
    var map = L.map('map').setView([{{ $visita->latitud }}, {{ $visita->longitud }}], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var marker = L.marker([{{ $visita->latitud }}, {{ $visita->longitud }}]).addTo(map)
        .bindPopup('{{ $visita->cliente_nombre }}')
        .openPopup();

    marker.on('dragend', function(e) {
        var lat = marker.getLatLng().lat;
        var lng = marker.getLatLng().lng;
        document.getElementById("latitud").value = lat;
        document.getElementById("longitud").value = lng;
    });
</script>
@stop
