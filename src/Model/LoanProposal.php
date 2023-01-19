<?php

declare(strict_types=1);

namespace App\Model;

use App\Enum\PriceListEnum;

class LoanProposal
{
    private float $amount;
    private array $priceList = PriceListEnum::PRICE_LIST;

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

    /**
     * Method for calculating Fee of Loan
     */
    public function countFee(): float
    {
        $flagOnce = true;

        $minAmount = 0;
        $maxAmount = 0;

        foreach ($this->priceList as $amount => $fee) {
            if ($this->amount >= $amount) {
                $minAmount = $amount;
            }
            if ($this->amount <= $amount && $flagOnce) {
                $maxAmount = $amount;
                $flagOnce = false;
            }
        }

        $minAmountFee = $this->priceList[$minAmount];
        $maxAmountFee = $this->priceList[$maxAmount];

        if ($minAmount == $maxAmount) {
            $result = $minAmountFee;
        } else {
            $result = $minAmountFee + ($maxAmountFee - $minAmountFee) * (($this->amount - $minAmount)/($maxAmount - $minAmount));
        }

        return (float) $result;
    }
}