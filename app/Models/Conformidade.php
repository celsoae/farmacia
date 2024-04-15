<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conformidade extends Model
{
    use HasFactory;

    protected $table = 'conformidade';

    protected $fillable = [
        'SUBSTANCIA',
        'CNPJ',
        'LABORATORIO',
        'CODIGO_GGREM',
        'REGISTRO',
        'EAN_1',
        'EAN_2',
        'EAN_3',
        'PRODUTO',
        'APRESENTACAO',
        'CLASSE_TERAPEUTICA',
        'TIPO_PRODUTO',
        'REGIME_DE_PRECO',
        'PF_SEM_IMPOSTOS',
        'PF_0',
        'PF_12',
        'PF_12_ALC',
        'PF_17',
        'PF_17_ALC',
        'PF_17-5',
        'PF_17-5_ALC',
        'PF_18',
        'PF_18_ALC',
        'PF_19',
        'PF_19_ALC',
        'PF_19-5',
        'PF_19-5_ALC',
        'PF_20',
        'PF_20_ALC',
        'PF_20-5',
        'PF_21',
        'PF_21_ALC',
        'PF_22',
        'PF_22_ALC',
        'PMC_SEM_IMPOSTO',
        'PMC_0',
        'PMC_12',
        'PMC_12_ALC',
        'PMC_17',
        'PMC_17_ALC',
        'PMC_17-5',
        'PMC_17-5_ALC',
        'PMC_18',
        'PMC_18_ALC',
        'PMC_19',
        'PMC_19_ALC',
        'PMC_19-5',
        'PMC_19-5_ALC',
        'PMC_20',
        'PMC_20_ALC',
        'PMC_20-5',
        'PMC_21',
        'PMC_21_ALC',
        'PMC_22',
        'PMC_22_ALC',
        'RESTRICAO_HOSPITALAR',
        'CAP',
        'CONFAZ_87',
        'ICMS_0',
        'ANALISE_RECURSAL',
        'LISTA_CONCESSAO',
        'COMERCIALIZACAO_2022',
        'TARJA',
    ];
}
