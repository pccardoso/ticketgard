<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    const CREATED_AT = 'data_cadastro_file';
    const UPDATED_AT = 'data_atualizado_file';

    protected $fillable = [
        "id_file",
        "caminho_file",
        "id_chamado_file"
    ];

    protected $table = "file";
    protected $primaryKey = "id_file";
}
