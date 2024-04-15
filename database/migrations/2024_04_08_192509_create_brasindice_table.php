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
        Schema::create('brasindice', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_laboratorio')->nullable();
            $table->string('nome_laboratorio')->nullable();
            $table->string('codigo_item')->nullable();
            $table->string('nome_item')->nullable();
            $table->string('codigo_apresentacao')->nullable();
            $table->string('nome_apresentacao')->nullable();
            $table->string('preco_item')->nullable();
            $table->string('qt_para_fracionamento')->nullable();
            $table->string('tipo_preco')->nullable();
            $table->string('preco_item_fracionado')->nullable();
            $table->string('edicao_ultima_alteracao')->nullable();
            $table->string('ipi')->nullable();
            $table->string('flag_pis_cofins')->nullable();
            $table->string('codigo_ean')->nullable();
            $table->string('codigo_tiss_brasindice')->nullable();
            $table->string('codigo_tuss')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brasindice');
    }
};
