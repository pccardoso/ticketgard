<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Manifestacao extends Model
{

    const CREATED_AT = 'data_cadastro_manifestacoes';
    const UPDATED_AT = 'data_atualizado_manifestacoes';
    
    protected $fillable = [
        'id_manifestacoes',
        'tipo_manifestacoes',
        'descricao_manifestacoes',
        'id_user_manifestacoes',
        'id_chamado_manifestacoes',
        "anexo_manifestacoes"
    ];

    protected $table = "manifestacoes";
    protected $primaryKey = 'id_manifestacoes';
}
