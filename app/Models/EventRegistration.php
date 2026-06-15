<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read User|null $user
 */
class EventRegistration extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'event_id' => 'integer',
            'total_amount' => 'decimal:2',
        ];
    }

    /**
     * Get the user who registered.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the event associated with the registration.
     */
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
