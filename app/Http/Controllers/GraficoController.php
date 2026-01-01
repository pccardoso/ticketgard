<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Chamado;
use Illuminate\Support\Facades\Auth;

class GraficoController extends Controller
{
    public function countFullChamados(){

        $mes = ["01", "02", "03", "04", "05", "06", "07", "08", "09", "10", "11", "12"];
        $val = [];

        foreach ($mes as $key => $value) {
            
            $sql = "SELECT COUNT(id_chamados) AS 'quantidade' FROM chamados WHERE id_criador_chamados=".Auth::user()->id_users." AND data_cadastro_chamados BETWEEN '2026-".$value."-01 00:00:00' AND '2026-".$value."-31 23:59:59'";

            $result = DB::select($sql);

            $val[] = $result[0]->quantidade;

        }

        return response()->json([
            "dias" => $mes,
            "quantidade" => $val
        ]);

    }
}
