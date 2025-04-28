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
        Schema::create('chamados', function (Blueprint $table) {
            $table->id("id_chamados");
            $table->string("assunto_chamados");
            $table->text("descricao_chamados");
            $table->integer("status_chamados")->default(0);
            $table->timestamp("data_cadastro_chamados")->nullable();
            $table->timestamp("data_atualizado_chamados")->nullable();
            $table->integer("id_criador_chamados");
            $table->string("nome_criador_chamados");
            $table->integer("vip_criador_chamados");
            $table->text("observacoes_finalizar_chamados")->nullable(true);
            $table->text("file")->nullable(true);
            $table->datetime("data_finalizar_chamados")->nullable(true);
            $table->unsignedBigInteger("id_departamento_chamados");
            $table->unsignedBigInteger("id_solicitacao_chamados");
            $table->unsignedBigInteger("id_user_chamados")->nullable(true);
            $table->foreign("id_user_chamados")->references("id_users")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_departamento_chamados")->references("id_departamentos")->on("departamentos")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_solicitacao_chamados")->references("id_solicitacoes")->on("solicitacoes")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamados');
    }
};
