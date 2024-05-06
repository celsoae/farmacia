<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpro extends Model
{
    use HasFactory;

    protected $table = 'simpro';

    protected $fillable = [
        'codigoUsuario',
        'codigoFracao',
        'descricao',
        'vigencia',
        'identificacao',
        'precoFabrica',
        'precoVenda',
        'precoUsuario',
        'precoFabricaFracao',
        'precoVendaFracao',
        'precoUsuarioFracao',
        'embalagem',
        'fracao',
        'quantidadeEmbalagem',
        'quantidadeFracao',
        'lucro',
        'tipoAlteracao',
        'fabricante',
        'codigoSimpro',
        'codigoMercado',
        'desconto',
        'ipi',
        'anvisa',
        'validadeAnvisa',
        'codigoEAN',
        'lista',
        'hospitalar',
        'fracionavel',
        'codigoTUSS',
        'classificacao',
        'referencia',
        'generico',
        'diversos',
        'versao'
    ];
}
