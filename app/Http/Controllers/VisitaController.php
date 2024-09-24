<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\User;
use Illuminate\Http\Request;
use Dompdf\Dompdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class VisitaController extends Controller
{
    public function index()
    {
        $visitas = Visita::all();
        $pdfRoute = route('visita.pdf', ['tipo' => 'todas']);
        $csvRoute = route('visita.csv', ['tipo' => 'todas']);
        return view('visita.index', compact('visitas', 'pdfRoute', 'csvRoute'));
    }

    public function create()
    {
        $ejecutivos = User::where('tipo_usuario', 'ejecutivo')->get(); 
        return view('visita.create', compact('ejecutivos'));
    }

    public function store(Request $request)
    {
        $this->validarDatos($request);

        $visita = new Visita();
        $visita->cliente_nombre = $request->input('cliente_nombre');
        $visita->cliente_telefono = $request->input('cliente_telefono');
        $visita->cliente_email = $request->input('cliente_email');
        $visita->forma_contacto = $request->input('forma_contacto');
        $visita->estado_visita = $request->input('estado_visita');
        $visita->referencia = $request->input('referencia');
        $visita->link = $request->input('link');
        $visita->latitud = $request->input('latitud');
        $visita->longitud = $request->input('longitud');
        $visita->fecha_visita = $request->input('fecha_visita');
        $visita->user_id = $request->input('user_id');  

        $visita->save();

        return redirect('visitas')->with('success', 'La visita se ha guardado exitosamente.');
    }

    public function show(string $id)
    {
        $visita = Visita::findOrFail($id);
        return view('visita.show', compact('visita'));
    }

    public function edit(string $id)
    {
        $visita = Visita::findOrFail($id);
        return view('visita.edit', compact('visita'));
    }

        public function update(Request $request, $id)
    {

        $visita = Visita::find($id);

        if (!$visita) {
            return redirect('visitas')->with('error', 'Visita no encontrada.');
        }

        $visita->cliente_nombre = $request->input('cliente_nombre');
        $visita->cliente_telefono = $request->input('cliente_telefono');
        $visita->cliente_email = $request->input('cliente_email');
        $visita->forma_contacto = $request->input('forma_contacto');
        $visita->estado_visita = $request->input('estado_visita');
        $visita->referencia = $request->input('referencia');
        $visita->link = $request->input('link');
        $visita->latitud = $request->input('latitud');
        $visita->longitud = $request->input('longitud');
        $visita->fecha_visita = $request->input('fecha_visita');
        $visita->user_id = $request->input('user_id'); // Este debería estar correcto ahora

        $visita->save();
        return redirect('visitas')->with('success', 'La visita se ha actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $visita = Visita::find($id);
        $visita->delete();
        return redirect('visitas')->with('eliminar', 'ok');
    }

    public function validarDatos(Request $request)
    {
        $request->validate([
            'cliente_nombre' => 'required',
            'cliente_telefono' => 'required|min:8',
            'cliente_email' => 'required|email',
            'forma_contacto' => 'required',
            'estado_visita' => 'required|not_in:nulo',
            'fecha_visita' => 'required|date',
            'user_id' => 'required',  
        ]);
    }

    public function generarPdf($tipo)
    {
        if ($tipo === 'todas') {
            $visitas = Visita::all();
        } else {
            $visitas = Visita::where('tipo_visita', $tipo)->get();
        }

        $dompdf = new Dompdf();
        $html = View::make('visita.pdf', compact('visitas'))->render();

        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream("listado_{$tipo}_visitas.pdf");
    }

    public function generarCsv($tipo)
    {
        if ($tipo === 'todas') {
            $visitas = Visita::all();
        } else {
            $visitas = Visita::where('tipo_visita', $tipo)->get();
        }

        $csvData = '';
        $csvHeader = ['ID', 'Cliente Nombre', 'Cliente Teléfono', 'Cliente Email', 'Forma de Contacto', 'Estado de Visita', 'Fecha de Visita', 'Ejecutivo'];
        $csvData .= implode(',', $csvHeader) . "\n";

        foreach ($visitas as $visita) {
            $csvRow = [
                $visita->id,
                $visita->cliente_nombre,
                $visita->cliente_telefono,
                $visita->cliente_email,
                $visita->forma_contacto,
                $visita->estado_visita,
                $visita->fecha_visita,
                $visita->user->nombre . ' ' . $visita->user->apellido,
            ];
            $csvData .= implode(',', $csvRow) . "\n";
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=listado_' . $tipo . '_visitas.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        return new Response($csvData, 200, $headers);
    }
}
