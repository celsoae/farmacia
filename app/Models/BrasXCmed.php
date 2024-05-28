<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Illuminate\Support\Facades\DB;

class BrasXCmed extends Model
{
    use HasFactory;

    protected $connection = 'hostgator';

    protected $table = 'db_homologa.brasxcmed';

    public function cmed(): BelongsTo
    {
        return $this->belongsTo(Cmed::class, 'registro_anvisa', 'REGISTRO');
    }

    public function viasAdministracao()
    {
        return $this->cmed->vias_administracao?->getAttribute('descricao');
    }
}
