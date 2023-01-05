<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Universidad
 *
 * @property int $id
 * @property string $nombre_universidad
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Carrera[] $carrera
 * @property-read int|null $carrera_count
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad query()
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad whereNombreUniversidad($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Universidad whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Universidad extends Model
{
    use HasFactory;
    protected $table = 'universidades';
    protected $fillable = [
        'nombre_universidad'
    ];

    public function carrera()
    {
        return $this->hasMany(Carrera::class,'id_universidad','id');
    }
}
