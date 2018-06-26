<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
     public function user() {
        return $this->belongsTo('App\User');
    }
     public function tipo() {
        return $this->belongsTo('App\Tipo');
    }
    
    protected $fillable = ['nome', 'descricao',
        'preco', 'user_id', 'foto', 'tipo_id', 'estoque', 'estoquemin'];
    
    public function setPrecoAttribute($value) {
        $novo1 = str_replace('.', '', $value);    // retira o ponto
        $novo2 = str_replace(',', '.', $novo1);   // substitui a , por .
        $this->attributes['preco'] = $novo2;
    }
    
}
