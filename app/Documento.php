<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documentos';
    protected $fillable = [
        'tipo_documento_id',
        'nombre',
        'url',
    ];
    protected $hidden = ['created_at', 'updated_at'];
    public function tipoDocumento() {
        return $this->belongsTo(TipoDocumento::class);
    }
}
