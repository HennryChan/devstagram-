<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'imagen',
        'user_id'
    ];

    public function user(){
        //Es una relación de Belongs To, se utiliza select para deducir datos, y evitar datos de mas,
        // de esta manera se optimiza la carga de datos, y evitamos traer datos innecesarios
        return $this->belongsTo(User::class)->select(['name', 'username']);
    }

    public function comentarios(){
        return $this->hasMany(Comentario::class);
    }

    public function likes(){
        return $this->hasMany(Like::class);
    }

    //verifica en la BD si existe el registro
    public function checkLike(User $user){
        return $this->likes->contains('user_id', $user->id);
    }
}
