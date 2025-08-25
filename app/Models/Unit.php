<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Unit extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'project_id',
        'unit_number',
        'building',
        'floor',
        'view',
        'area',
        'price',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'floor' => 'integer',
            'area' => 'decimal:2',
            'price' => 'decimal:2',
        ];
    }

    /**
     * Get the project that owns the unit.
     */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
