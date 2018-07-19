<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Aluno
 * @package App\Models
 * @version July 18, 2018, 8:27 pm UTC
 *
 * @property \App\Models\Disciplina disciplina
 * @property \Illuminate\Database\Eloquent\Collection Nota
 * @property string matricula
 * @property string nome
 * @property string endereco
 * @property string bairro
 * @property string cep
 * @property string cidade
 * @property string uf
 * @property string email
 * @property string|\Carbon\Carbon dtentrada
 */
class Aluno extends Model
{
    use SoftDeletes;

    public $table = 'Alunos';
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'matricula',
        'nome',
        'endereco',
        'bairro',
        'cep',
        'cidade',
        'uf',
        'email',
        'dtentrada'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'matricula' => 'string',
        'nome' => 'string',
        'endereco' => 'string',
        'bairro' => 'string',
        'cep' => 'string',
        'cidade' => 'string',
        'uf' => 'string',
        'email' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function disciplina()
    {
        return $this->hasOne(\App\Models\Disciplina::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function notas()
    {
        return $this->hasMany(\App\Models\Nota::class);
    }
}
