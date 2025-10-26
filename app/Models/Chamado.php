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

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, "id_departamento_chamados", "id_departamentos");
    }

    public function solicitacao()
    {
        return $this->belongsTo(Solicitacao::class, "id_solicitacao_chamados", "id_solicitacoes");
    }

    public function user()
    {
        return $this->belongsTo(User::class, "id_user_chamados", "id_users");
    }
}
