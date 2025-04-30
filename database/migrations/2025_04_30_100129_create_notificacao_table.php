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
        Schema::create('notificacao', function (Blueprint $table) {
            $table->id("id_notificacao");
            $table->string("descricao_notificacao");
            $table->integer("tipo_notificacao");
            $table->unsignedBigInteger("id_chamado_notificacao");
            $table->foreign("id_chamado_notificacao")->references("id_chamados")->on("chamados")->onUpdate("cascade")->onDelete("cascade");
            $table->timestamp("data_cadastro_notificacao")->nullable();
            $table->timestamp("data_atualizacao_notificacao")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacao');
    }
};
