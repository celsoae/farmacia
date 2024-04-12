<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TabelaTuss extends Model
{
    use HasFactory;

    protected $table = 'tuss_tabela_20';

    protected $fillable = [
        'cod_termo',
        'termo',
        'apresentacao',
        'laboratorio',
        'data_inicio_vigencia',
        'data_fim_vigencia',
        'data_fim_implantacao',
        'reg_anvisa'
    ];
}
