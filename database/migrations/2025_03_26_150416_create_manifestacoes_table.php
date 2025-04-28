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
        Schema::create('manifestacoes', function (Blueprint $table) {
            $table->id('id_manifestacoes');
            $table->integer("tipo_manifestacoes");
            $table->text("descricao_manifestacoes");
            $table->text("anexo_manifestacoes")->nullable();
            $table->unsignedBigInteger("id_user_manifestacoes")->nullable(true);
            $table->unsignedBigInteger("id_chamado_manifestacoes");
            $table->foreign("id_user_manifestacoes")->references("id_users")->on("users")->onUpdate("cascade")->onDelete("cascade");
            $table->foreign("id_chamado_manifestacoes")->references("id_chamados")->on("chamados")->onUpdate("cascade")->onDelete("cascade");
            $table->timestamp("data_cadastro_manifestacoes")->nullable();
            $table->timestamp("data_atualizado_manifestacoes")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manifestacoes');
    }
};
