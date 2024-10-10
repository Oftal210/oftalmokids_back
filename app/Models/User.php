<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Definimos el atributo de llave primaria de la tabla por si acaso
    protected $primaryKey = 'id_usuario';

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport(string $username): User
    {
        return $this->where('id_usuario', $username)->first();
    }

    /**
     * Validate the password of the user for the Passport password grant.
     */
    public function validateForPassportPasswordGrant(string $password): bool
    {
        return Hash::check($password, $this->password);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id_usuario',
        'cod_rol',
        'nom_usuario',
        'ape_usuario',
        'tele_usuario',
        'cont_usuario',
        'email_usuario',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'cont_usuario',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'cont_usuario' => 'hashed',
        ];
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'cod_rol');
    }

    // Relacion de los datos en el modelo, un padre puede tener varios hijos
    public function hijos(){
        return $this->hasMany(Hijo::class, 'id_hijo');
    }
}
