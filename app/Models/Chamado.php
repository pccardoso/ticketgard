<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chamado extends Model
{
    //

    const CREATED_AT = 'data_cadastro_chamados';
    const UPDATED_AT = 'data_atualizado_chamados';

    protected $fillable = [
        "id_chamados",
        "assunto_chamados",
        "id_departamento_chamados",
        "id_solicitacao_chamados",
        "descricao_chamados",
        "id_criador_chamados",
        "nome_criador_chamados",
        "file",
        "vip_criador_chamados"
    ];

    protected $table = "chamados";
    protected $primaryKey = 'id_chamados';
}
