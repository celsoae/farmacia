<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('simpro', function (Blueprint $table) {
            $table->id();
            $table->string('codigoUsuario', '15')->nullable();
            $table->string('codigoFracao', '15')->nullable();
            $table->string('descricao', 255)->nullable();
            $table->date('vigencia')->nullable();
            $table->char('identificacao', '1')->nullable();
            $table->float('precoFabrica', '11', '2')->nullable();
            $table->float('precoVenda', '11', '2')->nullable();
            $table->float('precoUsuario', '11', '2')->nullable();
            $table->float('precoFabricaFracao', '12', '2')->nullable();
            $table->float('precoVendaFracao', '12', '2')->nullable();
            $table->float('precoUsuarioFracao', '12', '2')->nullable();
            $table->char('embalagem', '3')->nullable();
            $table->string('fracao')->nullable();
            $table->float('quantidadeEmbalagem', '9', '2')->nullable();
            $table->float('quantidadeFracao', '8', '2')->nullable();
            $table->float('lucro', '8', '2')->nullable();
            $table->char('tipoAlteracao', '1')->nullable();
            $table->string('fabricante')->nullable();
            $table->char('codigoSimpro', '10')->nullable();
            $table->char('codigoMercado', '3')->nullable();
            $table->float('desconto', '8', '2')->nullable();
            $table->float('ipi', '8', '2')->nullable();
            $table->char('anvisa', '18')->nullable();
            $table->char('validadeAnvisa', '13')->nullable();
            $table->bigInteger('codigoEAN')->nullable();
            $table->char('lista', '1')->nullable();
            $table->char('hospitalar', '1')->nullable();
            $table->char('fracionavel', '1')->nullable();
            $table->integer('codigo_tuss')->nullable();
            $table->char('classificacao', '2')->nullable();
            $table->string('referencia')->nullable();
            $table->char('generico', '1')->nullable();
            $table->char('diversos', '1')->nullable();
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
