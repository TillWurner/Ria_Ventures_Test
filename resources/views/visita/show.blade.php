@extends('adminlte::page')

@section('title', 'Detalles de Visita')

@section('content_header')
<h1>Detalles de Visita</h1>
@stop

@section('content')

<div class="mb-3">
    <label for="ejecutivo_a_cargo" class="form-label">Ejecutivo a Cargo</label>
    <input type="text" class="form-control" value="{{ $visita->user->nombre}}" readonly> 
</div>

<div class="mb-3">
    <label for="cliente_nombre" class="form-label">Nombre del Cliente</label>
    <input type="text" class="form-control" value="{{ $visita->cliente_nombre }}" readonly>
</div>

<div class="mb-3">
    <label for="cliente_telefono" class="form-label">Teléfono</label>
    <input type="text" class="form-control" value="{{ $visita->cliente_telefono }}" readonly>
</div>

<div class="mb-3">
    <label for="cliente_email" class="form-label">Email</label>
    <input type="email" class="form-control" value="{{ $visita->cliente_email }}" readonly>
</div>

<div class="mb-3">
    <label for="forma_contacto" class="form-label">Forma de Contacto</label>
    <input type="text" class="form-control" value="{{ $visita->forma_contacto }}" readonly>
</div>

<div class="mb-3">
    <label for="estado_visita" class="form-label">Estado de la Visita</label>
    <input type="text" class="form-control" value="{{ $visita->estado_visita }}" readonly>
</div>

<div class="mb-3">
    <label for="referencia" class="form-label">Referencia</label>
    <input type="text" class="form-control" value="{{ $visita->referencia }}" readonly>
</div>

<div class="mb-3">
    <label for="link" class="form-label">Link de Google Maps</label>
    <input type="text" class="form-control" value="{{ $visita->link }}" readonly>
</div>

<div class="mb-3">
    <label for="latitud" class="form-label">Latitud</label>
    <input type="text" class="form-control" value="{{ $visita->latitud }}" readonly>
</div>

<div class="mb-3">
    <label for="longitud" class="form-label">Longitud</label>
    <input type="text" class="form-control" value="{{ $visita->longitud }}" readonly>
</div>

<div class="mb-3">
    <label for="fecha_visita" class="form-label">Fecha de Visita</label>
    <input type="text" class="form-control" value="{{ $visita->fecha_visita }}" readonly>
</div>

<div id="map" style="height: 400px;"></div>

<br>
<a href="{{ route('visitas.index') }}" class="btn btn-secondary">Volver</a>
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

    L.marker([{{ $visita->latitud }}, {{ $visita->longitud }}]).addTo(map)
        .bindPopup('{{ $visita->cliente_nombre }}') 
        .openPopup();
</script>
@stop
