<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listings extends Model
{
    use HasFactory;

    // Necesario para formularios, pero puede omitirse si se tiene el modelo en AppServiceProvider.php
    // protected $fillable = ['title', 'company', 'location', 'website', 'email', 'description', 'tags'];

    // Filtrar los Listings
    public function scopeFilter($query, array $filters)
    {
        // devolver el primer valor que no sea nulo, ya que puede o no enviarse el la etiqueta
        // Filtrar por etiqueta
        if ($filters['tag'] ?? false) {
            $query->where('tags', 'like', '%' . request('tag') . '%');
        }

        // Filtrar por cuado de búsqueda
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('tags', 'like', '%' . request('search') . '%');
        }
    }

    // Crear la relación entre el listing y el usuario que los creó
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }
}
