<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitacoes', function (Blueprint $table) {
            $table->id("id_solicitacoes");
            $table->string("titulo_solicitacoes");
            $table->string("prioridade_solicitacoes");
            $table->integer("tempo_solicitacoes");
            $table->timestamp("data_cadastro_solicitacoes")->nullable();
            $table->timestamp("data_atualizado_solicitacoes")->nullable();
            $table->unsignedBigInteger("id_departamento_solicitacoes");
            $table->foreign("id_departamento_solicitacoes")->references("id_departamentos")->on("departamentos")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitacoes');
    }
};
