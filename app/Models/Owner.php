<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Owner extends Model
{

    protected static function booted(): void
    {
        // $tenant = Filament::getTenant();
        // static::addGlobalScope('team', function (Builder $query) use ($tenant) {
        //     $query->where('team_id', $tenant->id);
        // });
    }

    public function patients(): HasMany
    {
        return $this->hasMany(Patient::class);
    }

    /**
     * Get the team that owns the Owner
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }
}
