<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Autor extends Model
{
    use HasFactory;

    protected $table = 'lib_autor';
    protected $primaryKey = 'cod_autor';
    protected $fillable = ['nombres','apellidos','nombrecompleto','cod_sexo' ];

    public $timestamps = false;

    public function sexo()
    {
        return $this->belongsTo(Sexo::class,'cod_sexo','cod_sexo');
    }
}
