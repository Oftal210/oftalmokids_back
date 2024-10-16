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
    protected $primaryKey = 'id';

    // Si la clave primaria no es un incremento automático
    public $incrementing = false;

    /**
     * Find the user instance for the given username.
     */
    public function findForPassport(string $username): User
    {
        return $this->where('id', $username)->first();
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
        'documento',
        'nombre',
        'apellido',
        'telefono',
        'contrasena',
        'email',
        'id_rol',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'contrasena',
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
            'contrasena' => 'hashed',
        ];
    }

    public function rol(){
        return $this->belongsTo(Rol::class, 'id_rol');
    }

    // Relacion de los datos en el modelo, un padre puede tener varios hijos
    public function hijos(){
        return $this->hasMany(Hijo::class, 'id_hijo');
    }

    // Relacion de los datos en el modelo, un usuario puede tener varios foros
    public function foros(){
        return $this->hasMany(Foro::class, 'cod_foro');
    }
}
