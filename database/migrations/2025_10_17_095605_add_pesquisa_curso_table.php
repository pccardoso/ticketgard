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
        Schema::create('pesquisa_curso', function (Blueprint $table) {
            $table->string("name");
            $table->string("whatsapp");
            $table->boolean("question_1");
            $table->boolean("question_2");
            $table->boolean("question_3");
            $table->boolean("question_4");
            $table->boolean("question_5");
            $table->boolean("question_6");
            $table->unsignedBigInteger("id_user");
            $table->foreign("id_user")->references("id_users")->on("users")->onUpdate("cascade")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesquisa_curso');
    }
};
