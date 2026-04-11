<?php

namespace App\Enums;

enum InquiryStatus: string
{
    case New = 'new';
    case Quoted = 'quoted';
    case ContractSent = 'contract_sent';
    case Confirmed = 'confirmed';
    case Declined = 'declined';

    public function kanbanTitle(): string
    {
        return str($this->value)->headline()->toString();
    }
}
