<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Practica
 *
 * @property int $id
 * @property int $usuarioId
 * @property string $campo_clinico
 * @property string $nivel_cursado
 * @property string $tipo_practica
 * @property string|null $nombre_docente
 * @property string|null $telefono_docente
 * @property string $fecha_inicio
 * @property string $fecha_termino
 * @property string|null $hora_registro_inicio
 * @property string|null $hora_registro_termino
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Practica newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Practica newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Practica query()
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereCampoClinico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereFechaInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereFechaTermino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereHoraRegistroInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereHoraRegistroTermino($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereNivelCursado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereNombreDocente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereTelefonoDocente($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereTipoPractica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Practica whereUsuarioId($value)
 * @mixin \Eloquent
 */
class Practica extends Model
{
    use HasFactory;
    protected $fillable = [
        'usuarioId',
        'campo_clinico',
        'nivel_cursado',
        'tipo_practica',
        'nombre_docente',
        'telefono_docente',
        'fecha_inicio',
        'fecha_termino',
        'hora_inicio',
        'hora_termino'
    ];

    public function usuario()
    {
        return $this->belongsTo(User::class,'id','usuarioId');
    }

}
