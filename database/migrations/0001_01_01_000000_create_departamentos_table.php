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
        Schema::create('departamentos', function (Blueprint $table) {
            $table->id("id_departamentos");
            $table->string("nome_departamentos");
            $table->string("descricao_departamentos");
            $table->timestamp("data_cadastro_departamentos")->nullable();
            $table->timestamp("data_atualizado_departamentos")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departamentos');
    }
};
