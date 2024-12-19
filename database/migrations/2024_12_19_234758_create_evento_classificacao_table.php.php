<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('evento_classificacao', function (Blueprint $table) {
            $table->id();
            $table->foreignId('evento_id')->constrained('eventos')->onDelete('cascade');
            $table->foreignId('classificacao_id')->constrained('classificacoes_indicativas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
      Schema::dropIfExists('evento_classificacao');
    }
};
