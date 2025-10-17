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
        Schema::table('pesquisa_curso', function (Blueprint $table) {
            $table->string("question_1")->change();
            $table->string("question_2")->change();
            $table->string("question_3")->change();
            $table->string("question_4")->change();
            $table->string("question_5")->change();
            $table->string("question_6")->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
