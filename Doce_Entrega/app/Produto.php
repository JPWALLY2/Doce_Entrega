<?php
namespace App;
use Illuminate\Database\Eloquent\Model;
class Produto extends Model
{
    public $timestamps = false;
    protected $fillable = ['tipo', 'nome', 'preco', 'descricao', 'usuarios_id'];
    public function usuarios() {
        return $this->belongsTo('App\Usuario');
    }
}