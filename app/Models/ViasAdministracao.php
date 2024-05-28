<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViasAdministracao extends Model
{
    use HasFactory;

    protected $connection = 'hostgator';

    protected $table = 'db_homologa.vias_administracao';
}
