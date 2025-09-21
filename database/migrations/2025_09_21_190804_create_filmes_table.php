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
        Schema::create('filmes', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->string('genero');
            $table->integer('ano_lancamento');
            $table->string('arquivo');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // chave estrangeira -> um filme pertence a um usuário
            // onDelete -> se o usuário for deletado, seus filmes também serão
            $table->timestamps(); // created_at e updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('filmes');
    }
};
