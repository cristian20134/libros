<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct( )
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $categorias = Categoria::orderBy('cod_categoria','DESC')
        ->paginate(5);
        return view('categorias.index', compact(['categorias']));
    }

    public function create()
    {
        return view('categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_categoria'
        ]);

        Categoria::create($request->all());
        return redirect()
            ->route('categorias.index')
            ->with('success','Categoría se ha registrado correctamente.');
    }

        public function show(Categoria $categoria)
    {
        return view('categorias.show', compact(['categoria']));
    }

    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact(['categoria']));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_categoria,titulo,'.$categoria->cod_categoria.',cod_categoria'
        ]);

        $categoria->fill($request->only([
            'titulo'
        ]));

        if($categoria->isClean()){
            return back()->with('warning', 'Debe realizar al menos un cambio para actualizar');
        }

        $categoria->update($request->all());
        return redirect()->route('categorias.index')
        ->with('primary', 'Categoría se ha actualizado correctamente.');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('categorias.index')
        ->with('danger', 'Categoría se ha eliminado correctamente.');
    }

}
