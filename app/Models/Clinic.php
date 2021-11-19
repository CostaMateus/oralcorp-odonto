<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        "full_name",
        "code",
        "address",
        "whatsapp",
        "phone",
        "instagram",
    ];

    /**
     * Retorna o usuário da clinica
     *
     * @return void
     */
    public function users()
    {
        return $this->hasMany(Uses::class);
    }
}
