<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notificacao;
use Illuminate\Support\Facades\DB;


class NotificacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function createEmail(){
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function showNotificationNow(Request $request){
        $data = date("Y-m-d");

        $sql = "SELECT * FROM notificacao INNER JOIN manifestacoes ON notificacao.id_manifestacao_notificacao=manifestacoes.id_manifestacoes INNER JOIN chamados ON manifestacoes.id_chamado_manifestacoes=chamados.id_chamados INNER JOIN departamentos ON departamentos.id_departamentos=chamados.id_departamento_chamados WHERE data_cadastro_notificacao BETWEEN '$data 00:00:00' AND '$data 23:59:59'";

        foreach ($request->input("listDepartament") as $key => $value) {

            if($key == 0){
                $sql.=" AND ( id_departamento_chamados=".$value."";
            }else if(count($request->input("listDepartament")) == $key + 1){
                $sql.=" OR id_departamento_chamados=".$value.")";
            }else{
                $sql.=" OR id_departamento_chamados=".$value."";
            }

            if(count($request->input("listDepartament")) == 1){
                $sql.=")";
            }
            
        }

        $sql.= " ORDER BY data_cadastro_notificacao DESC";

        $lista = DB::select($sql);

        sleep(1);

        return compact("lista");
    }
}
