<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['pet_id', 'user_id', 'weight_at_visit', 'diagnosis', 'treatment'])]
class MedicalRecord extends Model
{
    use HasFactory;

    /**
     * Get the pet that has this medical record.
     */
    public function pet(): BelongsTo
    {
        return $this->belongsTo(Pet::class);
    }

    /**
     * Get the veterinarian (user) who recorded this entry.
     */
    public function veterinarian(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
