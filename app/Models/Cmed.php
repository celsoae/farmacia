<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Cmed extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $connection = 'hostgator';

    protected $primaryKey = 'REGISTRO';

    protected $keyType = 'string';

    protected $table = 'db_homologa.cmed';

    public function viasAdministracao(): HasOne
    {
        return $this->hasOne(ViasAdministracao::class, 'id', 'vias_administracao_id');
    }

    public function formaFarmaceutica(): HasOne
    {
        return $this->hasOne(FormasFarmaceuticas::class, 'id', 'forma_farmaceutica_id');
    }

    public function produtos()
    {
        return $this->selectRaw('PRODUTO GROUP BY PRODUTO');
    }
}
