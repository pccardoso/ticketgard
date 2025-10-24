<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Services\NotificationService;
use Illuminate\Support\Facades\Log;

class NotificationUserJob implements ShouldQueue
{
    use Queueable;

    protected $token;
    protected $title;
    protected $body;
    protected $id_ticket;

    /**
     * Create a new job instance.
     */
    public function __construct($token, $title, $body, $id_ticket)
    {
        $this->token = $token;
        $this->title = $title;
        $this->body = $body;
        $this->id_ticket = $id_ticket;
    }

    /**
     * Execute the job.
     */
    public function handle(NotificationService $notification): void
    {
        
        $msg = $notification->sendToToken($this->token, $this->title, $this->body, $this->id_ticket);

        Log::info("Notificaçao gerada para o ticket {$this->id_ticket} / Token: {$this->token}");

    }
}
