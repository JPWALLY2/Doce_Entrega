<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
     public function user() {
        return $this->belongsTo('App\User');
    }
    
    protected $fillable = ['tipo', 'nome', 'descricao',
        'preco', 'user_id', 'foto'];
    
    public function setPrecoAttribute($value) {
        $novo1 = str_replace('.', '', $value);    // retira o ponto
        $novo2 = str_replace(',', '.', $novo1);   // substitui a , por .
        $this->attributes['preco'] = $novo2;
    }
    
    public static function tipos() {
        return ['Doce', 'Torta', 'Pavê'];
    }
}
