<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brasindice extends Model
{
    use HasFactory;

    protected $table = 'brasindice';

    protected $fillable = [
        'cod_laboratorio',
        'nome_laboratorio',
        'codigo_item',
        'nome_item',
        'codigo_apresentacao',
        'nome_apresentacao',
        'preco_item',
        'qt_para_fracionamento',
        'tipo_preco',
        'preco_item_fracionado',
        'edicao_ultima_alteracao',
        'ipi',
        'flag_pis_cofins',
        'codigo_ean',
        'codigo_tiss_brasindice',
        'codigo_tuss',
    ];
}
