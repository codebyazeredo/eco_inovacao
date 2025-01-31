<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('classificacoes_indicativas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('sigla', 5);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('classificacoes_indicativas');
    }
};
