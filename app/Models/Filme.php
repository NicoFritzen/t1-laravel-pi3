<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filme extends Model
{
    protected $fillable = [ // array de mass assignment (campos que podem ser preenchidos via Model::create() ou fill())
        'titulo',
        'descricao',
        'genero',
        'ano_lancamento',
        'arquivo',
        'user_id'
    ];

    public function user() // muitos para um, um filme pertence a um usuário
    {
        return $this->belongsTo(User::class);
    }

   public static function rules() // regras de validação
    {
        return [
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'genero' => 'required|string|max:100',
            'ano_lancamento' => 'required|integer|min:1900|max:' . date('Y'),
            'arquivo' => 'required|mimes:jpg,jpeg,png,mp4,avi,mov|max:20480'
        ];
    }
}
