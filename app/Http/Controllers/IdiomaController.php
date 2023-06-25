<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    public function __construct( )
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $idiomas = Idioma::orderBy('cod_idioma','DESC')
        ->paginate(5);
        return view('idiomas.index', compact(['idiomas']));
    }

    public function create()
    {
        return view('idiomas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_idioma'
        ]);

        Idioma::create($request->all());
        return redirect()
            ->route('idiomas.index')
            ->with('success','Idioma se ha registrado correctamente.');
    }

        public function show(Idioma $idioma)
    {
        return view('idiomas.show', compact(['idioma']));
    }

    public function edit(Idioma $idioma)
    {
        return view('idiomas.edit', compact(['idioma']));
    }

    public function update(Request $request, Idioma $idioma)
    {
        $request->validate([
            'descripcion' => 'required|min:3|max:100|unique:lib_idioma,descripcion,'.$idioma->cod_idioma.',cod_idioma'
        ]);

        $idioma->fill($request->only([
            'descripcion'
        ]));

        if($idioma->isClean()){
            return back()->with('warning', 'Debe realizar al menos un cambio para actualizar');
        }

        $idioma->update($request->all());
        return redirect()->route('idiomas.index')
        ->with('primary', 'Idioma se ha actualizado correctamente.');
    }

    public function destroy(Idioma $idioma)
    {
        $idioma->delete();
        return redirect()->route('idiomas.index')
        ->with('danger', 'Idioma se ha eliminado correctamente.');
    }

}
