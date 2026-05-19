<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ContractSignature extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'signer_role',
        'signer_identifier',
        'token_id',
        'ip_address',
        'user_agent',
        'signed_at',
    ];

    protected $casts = [
        'signed_at' => 'datetime',
    ];

    /**
     * Get the contract associated with the signature.
     */
    public function contract(): BelongsTo
    {
        return $this->belongsTo(Contract::class);
    }
}
