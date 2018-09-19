<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = "tipo_documentos";
    protected $fillable = [
        'nombre',
        'descripcion'
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function documentos() {
        return $this->hasMany(Documento::class);
    }
}
