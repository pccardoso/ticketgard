<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacao extends Model
{
    
    protected $primaryKey = "id_notificao";
    protected $table = "notificacao";

    const CREATED_AT = "data_cadastro_notificacao";
    const UPDATED_AT = "data_atualizacao_notificacao";

    protected $fillable = [
        "descricao_notificacao",
        "tipo_notificacao",
        "id_chamado"
    ];

}
