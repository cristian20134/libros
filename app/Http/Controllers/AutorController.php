<?php

namespace App\Http\Controllers;

use App\Models\Autor;
use App\Models\Sexo;
use Illuminate\Http\Request;

class AutorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct( )
     {
         $this->middleware('auth');
     }

    public function index()
    {
        $autores = Autor::orderBy('cod_autor','DESC')
        ->paginate(5);
        return view('autores.index', compact(['autores']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sexos = Sexo::all();
        return view('autores.create', compact(['sexos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombres' => 'required|min:3|max:100',
            'apellidos' =>'required|min:3|max:100',
            //'cod_sexo' =>'required'
        ]);

        $request['nombrecompleto'] = $request->nombres.' '.$request->apellidos;

        Autor::create($request->all());
        return redirect()
        ->route('autores.index')
        ->with('success','Autor se ha registrado correctamente.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function show(Autor $autor)
    {
        return view('autores.show', compact(['autor']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function edit(Autor $autor)
    {
        $sexos = Sexo::all();
        return view('autores.edit', compact(['sexos','autor']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Autor $autor)
    {
        $request->validate([
            'nombres' => 'required|min:3|max:100',
            'apellidos' =>'required|min:3|max:100',
        ]);

        $autor->fill($request->only([
            'nombres',
            'apellidos',
            'cod_sexo'
        ]));

        if($autor->isClean()){
            return back()->with('warning', 'Debe realizar al menos un cambio para actualizar');
        }

        $autor->update($request->all());
        return redirect()
        ->route('autores.index')
        ->with('success','Autor se ha modificado correctamente.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Autor  $autor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Autor $autor)
    {
        $autor->delete();
        return redirect()->route('autores.index')
        ->with('danger', 'El autor se ha eliminado correctamente.');
    }
}
