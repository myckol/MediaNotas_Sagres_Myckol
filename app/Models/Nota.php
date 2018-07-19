<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Nota
 * @package App\Models
 * @version July 18, 2018, 8:27 pm UTC
 *
 * @property \App\Models\Aluno aluno
 * @property \App\Models\Disciplina disciplina
 * @property integer idaluno
 * @property integer iddisciplina
 * @property decimal nota1
 * @property decimal nota2
 * @property decimal nota3
 */
class Nota extends Model
{
    use SoftDeletes;

    public $table = 'Notas';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'idaluno',
        'iddisciplina',
        'nota1',
        'nota2',
        'nota3'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'idaluno' => 'integer',
        'iddisciplina' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nota1' => 'required|min:0|max:10',
        'nota2' => 'required|min:0|max:10',
        'nota3' => 'required|min:0|max:10'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function aluno()
    {
        return $this->belongsTo('\App\Models\Aluno','idaluno','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function disciplina()
    {
        return $this->belongsTo(\App\Models\Disciplina::class,'iddisciplina','id');
    }
}
