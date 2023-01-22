<?php

namespace App\Tests\Model;

use App\Model\LoanProposal;
use PHPUnit\Framework\TestCase;

class LoanProposalTest extends TestCase
{

    /**
     * @return void
     * Jest to pierwszy napisany przeze mnie test phpunit, ponieważ w aktualnej firmie nigdy nie pisaliśmy testów
     * Prosiłbym o feedback odnoszący się między innymi do tego testu naile popranie został wykonany
     */
    public function testCountFee(): void
    {
        for ($i = 1000; $i <= 20000; $i++) {
            $loanProposal = new LoanProposal($i);
            $this->assertIsFloat($loanProposal->countFee(), 'must be of type float');
        }
    }
}
