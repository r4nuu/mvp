<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'address',
        'year_of_creation',
        'owner_phone_number',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'year_of_creation' => 'integer',
        ];
    }

    /**
     * Get the units for the project.
     */
    public function units(): HasMany
    {
        return $this->hasMany(Unit::class);
    }

    /**
     * Get the available units count (units with status 'available').
     */
    public function getAvailableUnitsCountAttribute(): int
    {
        return $this->units()->where('status', 'available')->count();
    }

    /**
     * Get the reserved units count (units with status 'reserved').
     */
    public function getReservedUnitsCountAttribute(): int
    {
        return $this->units()->where('status', 'reserved')->count();
    }

    /**
     * Get the sold units count (units with status 'sold').
     */
    public function getSoldUnitsCountAttribute(): int
    {
        return $this->units()->where('status', 'sold')->count();
    }

    /**
     * Get the total units count.
     */
    public function getTotalUnitsCountAttribute(): int
    {
        return $this->units()->count();
    }
}
