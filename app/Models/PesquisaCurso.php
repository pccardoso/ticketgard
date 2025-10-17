<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesquisaCurso extends Model
{

    protected $table = "pesquisa_curso";
    
    protected $fillable= [
        'name',
        'whatsapp',
        'question_1',
        'question_2',
        'question_3',
        'question_4',
        'question_5',
        'question_6',
        'id_user'
    ];

}
