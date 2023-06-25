<?php

namespace App\Http\Controllers;

use App\Models\Sexo;
use Illuminate\Http\Request;

class SexoController extends Controller
{
    public function __construct( )
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $sexos = Sexo::orderBy('cod_sexo','DESC')
        ->paginate(5);
        return view('sexos.index', compact(['sexos']));
    }

    public function create()
    {
        return view('sexos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_sexo'
        ]);

        Sexo::create($request->all());
        return redirect()
            ->route('sexos.index')
            ->with('success','Sexo registrado correctamente.');
    }

        public function show(Sexo $sexo)
    {
        return view('sexos.show', compact(['sexo']));
    }

    public function edit(Sexo $sexo)
    {
        return view('sexos.edit', compact(['sexo']));
    }

    public function update(Request $request, Sexo $sexo)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_sexo,descripcion,'.$sexo->cod_sexo.',cod_sexo'
        ]);

        $sexo->fill($request->only([
            'descripcion'
        ]));

        if($sexo->isClean()){
            return back()->with('warning', 'Debe realizar al menos un cambio para actualizar');
        }

        $sexo->update($request->all());
        return redirect()->route('sexos.index')
        ->with('primary', 'Sexo actualizado correctamente.');
    }

    public function destroy(Sexo $sexo)
    {
        $sexo->delete();
        return redirect()->route('sexos.index')
        ->with('danger', 'Sexo eliminadi correctamente.');
    }

}
