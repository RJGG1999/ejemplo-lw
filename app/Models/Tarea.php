<?php

namespace App\Models;

use App\Scopes\UsuarioScope;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $fillable = ['tarea', 'descripcion', 'tipo', 'user_id'];

    //Scope global
    protected static function booted()
    {
        static::addGlobalScope(new UsuarioScope);
    }

    //Scope local
    public function scopeTrabajo($query)
    {
        return $query->where('tipo', 'Trabajo');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function etiquetas()
    {
        return $this->belongsToMany(Etiqueta::class);
    }

    protected function tarea(): Attribute
    {
        return Attribute::make(
            //get: fn ($value) => strtoupper($value),
            set: fn ($value) => ucfirst(strtolower($value)),
        );
    }
}
