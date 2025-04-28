<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solicitacao extends Model
{

    const CREATED_AT = 'data_cadastro_solicitacoes';
    const UPDATED_AT = 'data_atualizado_solicitacoes';

    protected $fillable = [
        'id_solicitacoes',
        'id_departamento_solicitacoes',
        'titulo_solicitacoes',
        'prioridade_solicitacoes',
        'tempo_solicitacoes'
    ];

    protected $table = "solicitacoes";
    protected $primaryKey = 'id_solicitacoes';
}
