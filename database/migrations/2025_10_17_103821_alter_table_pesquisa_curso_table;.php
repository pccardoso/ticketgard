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
            $table->integer("question_1")->change();
            $table->integer("question_2")->change();
            $table->integer("question_3")->change();
            $table->integer("question_4")->change();
            $table->integer("question_5")->change();
            $table->integer("question_6")->change();

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
