<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\Chamado;
use App\Models\User;
use Illuminate\Support\Facades\Log;

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
        
        $usersToNotify = User::where('lista_departamento_users', 'LIKE', "[{$departmentId}]") 
            ->orWhere('lista_departamento_users', 'LIKE', "[{$departmentId},%") 
            ->orWhere('lista_departamento_users', 'LIKE', "%,{$departmentId},%") 
            ->orWhere('lista_departamento_users', 'LIKE', "%,{$departmentId}]") 
            ->get();
        
        foreach ($userDepartaments as $key => $user) {
            Log::info("Encontrado {$user->name} para o departamento do ticket {$this->id_chamado}");
        }

    }
}
