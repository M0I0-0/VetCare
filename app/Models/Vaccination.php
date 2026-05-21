<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['pet_id', 'name', 'dose', 'date_applied', 'next_dose_due'])]
class Vaccination extends Model
{
    use HasFactory;

    /**
     * Get the pet that received this vaccination.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }
}
