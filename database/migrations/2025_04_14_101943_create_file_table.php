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
        Schema::create('file', function (Blueprint $table) {
            $table->id("id_file");
            $table->text("caminho_file");
            $table->unsignedBigInteger("id_chamado_file");
            $table->foreign("id_chamado_file")->references("id_chamados")->on("chamados")->onUpdate("cascade")->onDelete("cascade");
            $table->timestamp("data_cadastro_file")->nullable();
            $table->timestamp("data_atualizado_file")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('file');
    }
};
