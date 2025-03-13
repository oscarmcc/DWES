<?php
namespace App\Http\Controllers;

use App\Models\CentroCivico;
use Illuminate\Http\Request;

class CentroCivicoController extends Controller
{
    public function index()
    {
        $centros = CentroCivico::all();
        return view('centros.index', compact('centros'));
    }

    public function create()
    {
        return view('centros.create');
    }

    public function store(Request $request)
{
    // Validación de datos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'direccion' => 'required|string|max:255',
        'telefono' => 'required|string|max:20',
        'email' => 'required|email|max:255',
        'horario' => 'required|string|max:255',
    ]);

    // Crear nuevo centro cívico
    CentroCivico::create([
        'nombre' => $request->nombre,
        'direccion' => $request->direccion,
        'telefono' => $request->telefono,
        'email' => $request->email,
        'horario' => $request->horario,
    ]);

    // Redirigir con mensaje de éxito
    return redirect()->route('centros.index')->with('success', 'Centro Cívico creado correctamente.');
}

    public function show(CentroCivico $centro)
    {
        return view('centros.show', compact('centro'));
    }

    public function edit(CentroCivico $centro)
    {
        return view('centros.edit', compact('centro'));
    }

    public function update(Request $request, CentroCivico $centro)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
            'horario' => 'required'
        ]);

        $centro->update($request->all());
        return redirect()->route('centros.index')->with('success', 'Centro cívico actualizado.');
    }

    public function destroy(CentroCivico $centro)
    {
        $centro->delete();
        return redirect()->route('centros.index')->with('success', 'Centro cívico eliminado.');
    }
}

