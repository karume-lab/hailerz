<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

class Contract extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'booking_id',
        'status',
        'file_path',
        'file_hash',
        'version',
    ];

    protected $casts = [
        'booking_id' => 'integer',
        'status' => 'string',
        'version' => 'string',
    ];

    /**
     * The booted method of the model.
     */
    protected static function booted(): void
    {
        static::saving(function (Contract $contract) {
            if ($contract->isDirty('file_path')) {
                $contract->file_hash = $contract->calculateHash();
            }
        });
    }

    /**
     * Get the signatures associated with the contract.
     *
     * @return HasMany<ContractSignature, $this>
     */
    public function signatures(): HasMany
    {
        return $this->hasMany(ContractSignature::class);
    }

    /**
     * Calculate SHA-256 hash of the contract file.
     */
    public function calculateHash(): ?string
    {
        if (! $this->file_path) {
            return null;
        }

        if (! Storage::disk('local')->exists($this->file_path)) {
            return null;
        }

        $absolutePath = Storage::disk('local')->path($this->file_path);

        return hash_file('sha256', $absolutePath);
    }

    /**
     * Check if the contract is fully executed.
     */
    public function isFullySigned(): bool
    {
        // A contract is fully signed if all associated signature records have a non-null signed_at
        if ($this->signatures()->count() === 0) {
            return false;
        }

        return $this->signatures()->whereNull('signed_at')->count() === 0;
    }
}
