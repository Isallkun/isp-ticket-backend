<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Helpers\RoleHelper;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
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
            'password' => 'hashed',
        ];
    }

    public function ticketLogs() {
        return $this->hasMany(TicketLog::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims()
    {
        return [
            'role' => $this->role,
        ];
    }

    /**
     * Role helper methods
     */
    public function isCS(): bool
    {
        return $this->role === RoleHelper::CS;
    }

    public function isNOC(): bool
    {
        return $this->role === RoleHelper::NOC;
    }

    public function isAdmin(): bool
    {
        return $this->role === RoleHelper::ADMIN;
    }

    public function hasRole(string $role): bool
    {
        return RoleHelper::hasRole($this, $role);
    }

    public function hasAnyRole(array $roles): bool
    {
        return RoleHelper::hasAnyRole($this, $roles);
    }

    public function hasMinimumRole(string $minimumRole): bool
    {
        return RoleHelper::hasMinimumRole($this, $minimumRole);
    }

    public function hasPermission(string $action): bool
    {
        return RoleHelper::can($this, $action);
    }

    public function getRoleDisplayName(): string
    {
        return RoleHelper::getRoleDisplayName($this->role);
    }

    public function getDashboardData(): array
    {
        return RoleHelper::getDashboardData($this);
    }

    /**
     * Scope queries by role
     */
    public function scopeCS($query)
    {
        return $query->where('role', RoleHelper::CS);
    }

    public function scopeNOC($query)
    {
        return $query->where('role', RoleHelper::NOC);
    }

    public function scopeAdmin($query)
    {
        return $query->where('role', RoleHelper::ADMIN);
    }

    public function scopeNotAdmin($query)
    {
        return $query->where('role', '!=', RoleHelper::ADMIN);
    }
}
