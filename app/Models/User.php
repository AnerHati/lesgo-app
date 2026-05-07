<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
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
        'phone',
        'address',
        'profile_photo_path',
        'active_role',
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

    // ── Relationships ────────────────────────────────────────────────────

    /**
     * Roles yang dimiliki user (many-to-many).
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_user')
                    ->withPivot(['registration_step', 'is_verified', 'ktp_path', 'ijazah_path', 'verified_at'])
                    ->withTimestamps();
    }

    public function studentProfile(): HasOne
    {
        return $this->hasOne(StudentProfile::class);
    }

    public function tutorProfile(): HasOne
    {
        return $this->hasOne(TutorProfile::class);
    }

    public function parentProfile(): HasOne
    {
        return $this->hasOne(ParentProfile::class);
    }

    /**
     * Anak-anak yang dipantau (jika user adalah orang tua).
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'parent_student', 'parent_id', 'student_id')
                    ->withPivot('relationship')
                    ->withTimestamps();
    }

    /**
     * Orang tua yang memantau (jika user adalah siswa).
     */
    public function parents(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'parent_student', 'student_id', 'parent_id')
                    ->withPivot('relationship')
                    ->withTimestamps();
    }

    // ── Helper Methods ───────────────────────────────────────────────────

    /**
     * Cek apakah user punya role tertentu.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()->where('name', $roleName)->exists();
    }

    /**
     * Assign role baru ke user.
     */
    public function assignRole(string $roleName, array $pivotData = []): void
    {
        $role = Role::where('name', $roleName)->firstOrFail();

        if (!$this->hasRole($roleName)) {
            $this->roles()->attach($role->id, array_merge([
                'registration_step' => 1,
                'is_verified' => false,
            ], $pivotData));
        }
    }

    /**
     * Ambil data pivot role_user untuk role tertentu.
     */
    public function getRolePivot(string $roleName)
    {
        $role = $this->roles()->where('name', $roleName)->first();
        return $role ? $role->pivot : null;
    }

    /**
     * Ambil active role saat ini.
     */
    public function activeRole(): ?string
    {
        return $this->active_role;
    }

    /**
     * Switch ke role lain.
     */
    public function switchRole(string $roleName): bool
    {
        if ($this->hasRole($roleName)) {
            $this->update(['active_role' => $roleName]);
            return true;
        }
        return false;
    }

    /**
     * Ambil semua nama role yang dimiliki user.
     */
    public function roleNames(): array
    {
        return $this->roles->pluck('name')->toArray();
    }

    /**
     * Cek apakah registrasi untuk role tertentu sudah selesai (step >= 4).
     */
    public function isRegistrationComplete(string $roleName): bool
    {
        $pivot = $this->getRolePivot($roleName);
        return $pivot && $pivot->registration_step >= 4;
    }

        // Relasi untuk Siswa: Kelas apa saja yang dia ikuti
    public function studentClasses()
    {
        return $this->hasMany(StudyClass::class, 'student_id');
    }

    // Relasi untuk Tutor: Kelas apa saja yang dia ajar
    public function tutorClasses()
    {
        return $this->hasMany(StudyClass::class, 'tutor_id');
    }

    // Relasi untuk Tutor: Mata pelajaran apa saja yang dia kuasai
    public function taughtSubjects()
    {
        return $this->belongsToMany(Subject::class, 'tutor_subjects')
                    ->withPivot('price_per_hour')
                    ->withTimestamps();
    }

}
