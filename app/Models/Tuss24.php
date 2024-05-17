<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tuss24 extends Model
{
    use HasFactory;

    protected $table = 'tuss_24';

    protected $fillable = [
      'display',
      'code',
      'sub_code',
      'observacao',
      'status'
    ];
}
