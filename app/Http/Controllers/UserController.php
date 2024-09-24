<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Dompdf\Dompdf;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function index()
    {
        $personas = User::all();
        $pdfRoute = route('user.pdf', ['tipo' => 'todos']);
        $csvRoute = route('user.csv', ['tipo' => 'todos']);
        return view('persona.index', compact('personas', 'pdfRoute', 'csvRoute'));
    }

    public function ejecutivos()
    {
        $personas = User::where('tipo_usuario', 'ejecutivo')->get();
        $pdfRoute = route('user.pdf', ['tipo' => 'ejecutivo']);
        $csvRoute = route('user.csv', ['tipo' => 'ejecutivo']);
        return view('persona.index', compact('personas', 'pdfRoute', 'csvRoute'));
    }

    public function administradores()
    {
        $personas = User::where('tipo_usuario', 'administrador')->get();
        $pdfRoute = route('user.pdf', ['tipo' => 'administrador']);
        $csvRoute = route('user.csv', ['tipo' => 'administrador']);
        return view('persona.index', compact('personas', 'pdfRoute', 'csvRoute'));
    }

    public function create()
    {
        return view('persona.create');
    }

    public function store(Request $request)
    {
        $this->validarDatos($request);

        $persona = new User();
        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->email = $request->input('email');
        $persona->password = bcrypt($request->input('password'));
        $persona->telefono = $request->input('telefono');
        $persona->direccion = $request->input('direccion');
        $persona->cargo = $request->input('cargo');
        $persona->estado = $request->input('estado');
        $persona->tipo_usuario = $request->input('tipo_usuario');
        if ($request->input('tipo_usuario') === 'ejecutivo') {
            $this->validarFoto($request, $persona);
        } 

        $persona->save();

        return redirect('personas')->with('success', 'La persona se ha guardado exitosamente.');
    }

    public function show(string $id)
    {
        $persona = User::findOrFail($id);
        return view('persona.show', compact('persona'));
    }

    public function edit(string $id)
    {
        $persona = User::findOrFail($id);
        return view('persona.edit', compact('persona'));
    }

    public function update(Request $request, $id)
    {
        $this->validarDatos($request);

        $persona = User::find($id);

        if (!$persona) {
            return redirect('personas')->with('error', 'Persona no encontrada.');
        }

        $persona->nombre = $request->input('nombre');
        $persona->apellido = $request->input('apellido');
        $persona->email = $request->input('email');
        $persona->telefono = $request->input('telefono');
        $persona->direccion = $request->input('direccion');
        $persona->cargo = $request->input('cargo');
        $persona->estado = $request->input('estado');

        if ($request->filled('password')) {
            $persona->password = bcrypt($request->input('password'));
        }

        if ($request->input('tipo_usuario') === 'ejecutivo') {
            $this->validarFoto($request, $persona);
        }

        $persona->save();
        return redirect('personas')->with('success', 'La persona se ha actualizado exitosamente.');
    }

    public function destroy(string $id)
    {
        $persona = User::find($id);
        $persona->delete();
        return redirect('personas')->with('eliminar', 'ok');
    }

    public function validarDatos(Request $request)
    {
        try {

        $reglas = [
            'nombre' => 'required',
            'apellido' => 'required',
            'password' => $request->isMethod('post') ? 'required' : 'nullable',
            'telefono' => 'min:8',
            'cargo' => 'required',
            'estado' => ['required', 'not_in:nulo'],
            'tipo_usuario' => ['sometimes','required', 'not_in:nulo'],
            

        ];

        $mensajes = [
            'nombre.required' => 'Este campo es obligatorio.',
            'apellido.required' => 'Este campo es obligatorio.',
            'password.required' => 'Este campo es obligatorio.',
            'password' => 'Este campo es obligatorio.',
            'telefono.min' => 'Este campo debe tener un mínimo de 8 dígitos.',
            'cargo.required' => 'Este campo es obligatorio.',
            'estado.not_in' => 'Por favor, selecciona una opción válida.',
            'tipo_usuario.not_in' => 'Por favor, selecciona una opción válida.',
        ];

        $request->validate($reglas, $mensajes);
        
          } catch (\Illuminate\Validation\ValidationException $e) {
        dd($e->errors()); 
    }
    }

    public function validarFoto(Request $request, $persona)
    {
        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => ['image', 'nullable', 'max:2048', 'mimes:png,jpg,jpeg,gif'],
            ]);

            $foto = $request->file('foto')->store('public/imagenes/clientes');
            $url = Storage::url($foto);
            $persona->foto = $url;
        }
      
    }

    public function generarPdf($tipo)
    {
        if ($tipo === 'todos') {
            $users = User::all();
        } else {
            $users = User::where('tipo_usuario', $tipo)->get();
        }
        $dompdf = new Dompdf();
        $html = View::make('persona.pdf', compact('users'))->render();

        $dompdf->loadHtml($html);
        $dompdf->render();

        return $dompdf->stream("listado_{$tipo}_usuarios.pdf");
    }

    public function generarCsv($tipo)
    {
        if ($tipo === 'todos') {
            $users = User::all();
        } else {
            $users = User::where('tipo_usuario', $tipo)->get();
        }
        $csvData = '';
        $csvHeader = ['ID', 'Nombre', 'Apellido', 'Email', 'Cargo', 'Estado', 'Telefono', 'Tipo de Usuario'];
        $csvData .= implode(',', $csvHeader) . "\n";
        foreach ($users as $user) {
            $csvRow = [
                $user->id,
                $user->nombre,
                $user->apellido,
                $user->email,
                $user->cargo,
                $user->estado,
                $user->telefono,
                $user->tipo_usuario,
            ];
            $csvData .= implode(',', $csvRow) . "\n";
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename=listado_' . $tipo . '_usuarios.csv',
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $response = new Response($csvData, 200, $headers);
        return $response;
    }

}
