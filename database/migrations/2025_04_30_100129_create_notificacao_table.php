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
            $table->timestamp("data_cadastro_notificacao");
            $table->timestamp("data_atualizacao_notificacao");
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
