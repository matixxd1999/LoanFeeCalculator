<?php

declare(strict_types=1);

namespace App\Model;

class LoanProposal
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    /**
     * Amount requested for this loan application.
     */
    public function amount(): float
    {
        return $this->amount;
    }
}