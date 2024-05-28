<?php

namespace App\Models\Brasindice;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oncologicos extends Model
{
    use HasFactory;

    protected $connection = 'forge';

    protected $table = 'farmacia_importacoes.brasindice_oncologicos';

    protected $fillable = [
        'laboratorio_codigo',
        'laboratorio',
        'produto_codigo',
        'produto',
        'apresentacao_codigo',
        'apresentacao',
        'pfb',
        'fracao',
        'tipo_pfb_fracao',
        'pfb_fracao',
        'edicao_alteracao',
        'ipi',
        'portaria',
        'ean',
        'tiss',
        'generico',
        'tuss',
        'ggrem',
        'registro',
        'hierarquia',
        'aliquota_id',
        'versao_update',
        'tipo_brasindice',
        'restrito_hospitalar'
    ];
}
