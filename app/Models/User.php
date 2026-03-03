<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    public const ROLE_ADMIN = 'administrador';
    public const ROLE_GESTOR = 'gestor';
    public const ROLE_USUARIO = 'usuario';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function isAdministrador(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isGestor(): bool
    {
        return $this->role === self::ROLE_GESTOR;
    }

    public function isUsuario(): bool
    {
        return $this->role === self::ROLE_USUARIO;
    }

    /** Acesso ao menu/área: Menu superior, Rodapé, Cadastro de usuários */
    public function canManageMenu(): bool
    {
        return $this->isAdministrador();
    }

    public function canManageFooter(): bool
    {
        return $this->isAdministrador();
    }

    public function canManageUsers(): bool
    {
        return $this->isAdministrador();
    }

    /** Páginas, Carrosséis: Admin e Gestor */
    public function canManageContent(): bool
    {
        return $this->isAdministrador() || $this->isGestor();
    }

    public static function roles(): array
    {
        return [
            self::ROLE_ADMIN => 'Administrador',
            self::ROLE_GESTOR => 'Gestor',
            self::ROLE_USUARIO => 'Usuário',
        ];
    }
}
