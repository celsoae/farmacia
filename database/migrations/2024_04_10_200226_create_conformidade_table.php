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
        Schema::create('conformidade', function (Blueprint $table) {
            $table->id();
            $table->text('SUBSTANCIA');
            $table->string('CNPJ');
            $table->string('LABORATORIO');
            $table->string('CODIGO_GGREM');
            $table->string('REGISTRO');
            $table->string('EAN_1');
            $table->string('EAN_2');
            $table->string('EAN_3');
            $table->string('PRODUTO');
            $table->string('APRESENTACAO');
            $table->string('CLASSE_TERAPEUTICA');
            $table->string('TIPO_PRODUTO');
            $table->string('REGIME_DE_PRECO');
            $table->string('PF_SEM_IMPOSTOS')->nullable();
            $table->string('PF_0')->nullable();
            $table->string('PF_12')->nullable();
            $table->string('PF_12_ALC')->nullable();
            $table->string('PF_17')->nullable();
            $table->string('PF_17_ALC')->nullable();
            $table->string('PF_17-5')->nullable();
            $table->string('PF_17-5_ALC')->nullable();
            $table->string('PF_18')->nullable();
            $table->string('PF_18_ALC')->nullable();
            $table->string('PF_19')->nullable();
            $table->string('PF_19_ALC')->nullable();
            $table->string('PF_19-5')->nullable();
            $table->string('PF_19-5_ALC')->nullable();
            $table->string('PF_20')->nullable();
            $table->string('PF_20_ALC')->nullable();
            $table->string('PF_20-5')->nullable();
            $table->string('PF_21')->nullable();
            $table->string('PF_21_ALC')->nullable();
            $table->string('PF_22')->nullable();
            $table->string('PF_22_ALC')->nullable();
            $table->string('PMC_SEM_IMPOSTO')->nullable();
            $table->string('PMC_0')->nullable();
            $table->string('PMC_12')->nullable();
            $table->string('PMC_12_ALC')->nullable();
            $table->string('PMC_17')->nullable();
            $table->string('PMC_17_ALC')->nullable();
            $table->string('PMC_17-5')->nullable();
            $table->string('PMC_17-5_ALC')->nullable();
            $table->string('PMC_18')->nullable();
            $table->string('PMC_18_ALC')->nullable();
            $table->string('PMC_19')->nullable();
            $table->string('PMC_19_ALC')->nullable();
            $table->string('PMC_19-5')->nullable();
            $table->string('PMC_19-5_ALC')->nullable();
            $table->string('PMC_20')->nullable();
            $table->string('PMC_20_ALC')->nullable();
            $table->string('PMC_20-5')->nullable();
            $table->string('PMC_21')->nullable();
            $table->string('PMC_21_ALC')->nullable();
            $table->string('PMC_22')->nullable();
            $table->string('PMC_22_ALC')->nullable();
            $table->string('RESTRICAO_HOSPITALAR');
            $table->string('CAP');
            $table->string('CONFAZ_87');
            $table->string('ICMS_0');
            $table->string('ANALISE_RECURSAL')->nullable();
            $table->string('LISTA_CONCESSAO');
            $table->string('COMERCIALIZACAO_2022');
            $table->string('TARJA');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conformidade');
    }
};
