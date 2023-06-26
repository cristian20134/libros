<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{

     public function __construct( )
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $libros = Libro::orderBy('cod_libro','DESC')
        ->paginate(5);
        return view('libros.index', compact(['libros']));
    }


    public function create()
    {
        $idiomas = Idioma::all();
        return view('libros.create', compact(['idiomas']));
    }


    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_libro',
            'descripcion' =>'required|min:3|max:200',
            'fecha_publicacion' => 'required|date'
        ]);

        Libro::create($request->all());
        return redirect()
        ->route('libros.index')
        ->with('success','Libro se ha registrado correctamente.');
    }


    public function show(Libro $libro)
    {
        return view('libros.show', compact(['libro']));
    }

    public function edit(Libro $libro)
    {
        $idiomas = Idioma::all();
        return view('libros.edit', compact(['idiomas','libro']));
    }


    public function update(Request $request, Libro $libro)
    {
        $request->validate([
            'titulo' => 'required|min:3|max:100|unique:lib_libro,titulo,'.$libro->cod_libro.',cod_libro',
            'descripcion' =>'required|min:3|max:200',
            'fecha_publicacion' => 'required|date'
        ]);

        $libro->fill($request->only([
            'titulo',
            'descripcion',
            'fecha_publicacion',
            'cod_idioma'
        ]));

        if($libro->isClean()){
            return back()->with('warning', 'Debe realizar al menos un cambio para actualizar');
        }

        $libro->update($request->all());
        return redirect()
        ->route('libros.index')
        ->with('success','Libro se ha modificado correctamente.');
    }


    public function destroy(Libro $libro)
    {
        $libro->delete();
        return redirect()->route('libros.index')
        ->with('danger', 'El autor se ha eliminado correctamente.');
    }
}
