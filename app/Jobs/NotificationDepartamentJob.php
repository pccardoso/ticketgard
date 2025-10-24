<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Chamado;
use App\Models\Departamento;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Jobs\NotificationUserJob;


class NotificationDepartamentJob implements ShouldQueue
{
    use Queueable;

    protected $id_chamado;

    /**
     * Create a new job instance.
     */
    public function __construct($id_chamado)
    {
        $this->id_chamado = $id_chamado;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        
        $resultChamado = Chamado::find($this->id_chamado);

        if($resultChamado){
    
            $usersToNotify = User::where(function ($query) use ($resultChamado) {
                $query->where('lista_departamento_users', 'LIKE', "[{$resultChamado->id_departamento_chamados}]")
                    ->orWhere('lista_departamento_users', 'LIKE', "[{$resultChamado->id_departamento_chamados},%")
                    ->orWhere('lista_departamento_users', 'LIKE', "%,{$resultChamado->id_departamento_chamados},%")
                    ->orWhere('lista_departamento_users', 'LIKE', "%,{$resultChamado->id_departamento_chamados}]");
            })
            ->where('res_chamados', 1)
            ->where('id_users', "!=", $resultChamado->id_criador_chamados)
            ->get();
            
            foreach ($usersToNotify as $key => $user) {

                Log::info("Encontrado {$user->name} para o departamento do ticket {$this->id_chamado}");

                if($user->token_firebase){

                    $resultDepartamento = Departamento::find($resultChamado->id_departamento_chamados);

                    $nameDepartamento = $resultDepartamento->nome_departamentos;

                    NotificationUserJob::dispatch(
                        $user->token_firebase,
                        "Novo Ticket (${$nameDepartamento})",
                        "{$resultChamado->nome_criador_chamados} abriu ticket de Nº {$this->id_chamado}!",
                        $this->id_chamado
                    );

                }

            }
        
        }else{
            Log::info("Chamado de Nº {$this->id_chamado} não encontrado");
        }

    }
}
