<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 100);
            $table->string('imagem_capa')->nullable();
            $table->boolean('privado')->default(false);
            $table->text('descricao')->nullable();
            $table->date('data_inicio');
            $table->time('hora_inicio');
            $table->date('data_fim')->nullable();
            $table->time('hora_fim')->nullable();
            $table->foreignId('local_id')->nullable()->constrained('locais');
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eventos');
    }
};
