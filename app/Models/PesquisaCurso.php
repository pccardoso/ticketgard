<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

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

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id_users');
    }

}
