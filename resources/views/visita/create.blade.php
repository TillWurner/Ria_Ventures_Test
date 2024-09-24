@extends('adminlte::page')

@section('title', 'Crear Visita')

@section('content_header')
    <h1>Crear Nueva Visita</h1>
@stop

@section('content')
    <form action="{{ route('visitas.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="user_id">Ejecutivo a Cargo:</label>
            <select name="user_id" id="user_id" class="form-control" required>
                <option value="">Seleccione un ejecutivo</option>
                @foreach ($ejecutivos as $ejecutivo)
                    <option value="{{ $ejecutivo->id }}">{{ $ejecutivo->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cliente_nombre" class="form-label">Nombre del Cliente</label>
            <input type="text" id="cliente_nombre" name="cliente_nombre" class="form-control" value="{{ old('cliente_nombre') }}"
                tabindex="1" required>
            @error('cliente_nombre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cliente_telefono" class="form-label">Teléfono del Cliente</label>
            <input type="text" id="cliente_telefono" name="cliente_telefono" class="form-control" value="{{ old('cliente_telefono') }}"
                tabindex="1" required>
            @error('cliente_telefono')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cliente_email" class="form-label">Email del Cliente</label>
            <input type="email" id="cliente_email" name="cliente_email" class="form-control" value="{{ old('cliente_email') }}"
                tabindex="1" required>
            @error('cliente_email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="forma_contacto" class="form-label">Forma de Contacto</label>
            <select id="forma_contacto" name="forma_contacto" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="Telefono">Teléfono</option>
                <option value="Email">Email</option>
                <option value="Visita">Visita</option>
            </select>
            @error('forma_contacto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado_visita" class="form-label">Estado de la Visita</label>
            <select id="estado_visita" name="estado_visita" class="form-control" required>
                <option value="">Seleccione</option>
                <option value="Programada">Programada</option>
                <option value="Realizada">Realizada</option>
                <option value="Cancelada">Cancelada</option>
            </select>
            @error('estado_visita')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <label for="referencia" class="form-label">Referencia de la Ubicacion</label>
            <input type="text" id="referencia" name="referencia" class="form-control" value="{{ old('referencia') }}" required>
            @error('referencia')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="link" class="form-label">Link</label>
            <input type="url" id="link" name="link" class="form-control" value="{{ old('link') }}" required>
            @error('link')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <div class="mb-3">
            <div class="mapform">
                <div class="row">
                    <div class="col-6">
                        <label for="latitud">Latitud:</label>
                        <input type="text" class="form-control" id="latitud" name="latitud" placeholder="Latitud"
                            value="{{ old('latitud') }}">
                        @error('latitud')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="longitud">Longitud:</label>
                        <input type="text" class="form-control" id="longitud" name="longitud" placeholder="Longitud"
                            value="{{ old('longitud') }}">
                        @error('longitud')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div id="map" style="height: 400px; width: 100%" class="my-3"></div>
            </div>
        </div>

        <div class="mb-3">
            <label for="fecha_visita" class="form-label">Fecha y Hora de la Visita</label>
            <input type="datetime-local" id="fecha_visita" name="fecha_visita" class="form-control" value="{{ old('fecha_visita') }}" required>
            @error('fecha_visita')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>



        <a href="{{ route('visitas.index') }}" class="btn btn-secondary" tabindex="4">Cancelar</a>
        <button style="background-color: rgb(1, 130, 5); border: 1px solid rgb(1, 130, 5);" type="submit" class="btn btn-success" tabindex="3">Guardar</button>
    </form>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
    <script>
        let map;
        let marker;

        function initMap() {
            const initialLatLng = [-17.783, -63.182];

            map = L.map('map').setView(initialLatLng, 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(map);

            marker = L.marker(initialLatLng, { draggable: true }).addTo(map);

            marker.on('dragend', function (event) {
                const position = marker.getLatLng();
                document.getElementById("latitud").value = position.lat;
                document.getElementById("longitud").value = position.lng;
            });

            map.on('click', function (event) {
                marker.setLatLng(event.latlng);
                document.getElementById("latitud").value = event.latlng.lat;
                document.getElementById("longitud").value = event.latlng.lng;
            });
        }

        document.addEventListener("DOMContentLoaded", initMap);
    </script>
@stop

