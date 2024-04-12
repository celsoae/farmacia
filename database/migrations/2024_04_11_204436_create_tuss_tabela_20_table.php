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
        Schema::create('tuss_tabela_20', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cod_termo');
            $table->string('termo');
            $table->text('apresentacao');
            $table->string('laboratorio');
            $table->date('data_inicio_vigencia');
            $table->date('data_fim_vigencia')->nullable();
            $table->date('data_fim_implantacao')->nullable();
            $table->string('reg_anvisa')->nullable();
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tuss_tabela_20');
    }
};
