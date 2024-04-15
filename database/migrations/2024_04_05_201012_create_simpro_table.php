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
        Schema::create('simpro', function (Blueprint $table) {
            $table->id();
            $table->integer('codigoUsuario');
            $table->integer('codigoFracao');
            $table->string('descricao', 255);
            $table->date('vigencia');
            $table->string('identificacao');
            $table->float('precoFabrica');
            $table->float('precoVenda');
            $table->float('precoUsuario');
            $table->float('precoFabricaFracao');
            $table->float('precoVendaFracao');
            $table->float('precoUsuarioFracao');
            $table->string('embalagem');
            $table->string('fracao');
            $table->float('quantidadeEmbalagem');
            $table->float('quantidadeFracao');
            $table->float('lucro');
            $table->string('tipoAlteracao');
            $table->string('fabricante');
            $table->integer('codigoSimpro');
            $table->integer('codigoMercado');
            $table->float('desconto');
            $table->float('ipi');
            $table->integer('anvisa');
            $table->date('validadeAnvisa');
            $table->integer('codigoEAN');
            $table->string('lista');
            $table->char('hospitalar');
            $table->char('fracionavel');
            $table->integer('codigoTUSS');
            $table->string('classificacao')->nullable();
            $table->string('referencia')->nullable();
            $table->char('generico');
            $table->char('diversos');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpro');
    }
};
