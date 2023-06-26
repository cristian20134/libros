<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    use HasFactory;

    protected $table = 'lib_libro';
    protected $primaryKey = 'cod_libro';
    protected $fillable = ['titulo','descripcion','fecha_publicacion','cod_idioma' ];

    public $timestamps = false;

    public function idioma()
    {
        return $this->belongsTo(Idioma::class,'cod_idioma','cod_idioma');
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class,'lib_asignar_categorias','cod_libro','cod_categoria');
    }

    public function autores()
    {
        return $this->belongsToMany(Autor::class,'lib_asignar_autores','cod_libro','cod_autor');
    }

}
