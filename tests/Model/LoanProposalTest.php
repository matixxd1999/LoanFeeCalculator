<?php

namespace App\Tests\Model;

use App\Model\LoanProposal;
use PHPUnit\Framework\TestCase;

class LoanProposalTest extends TestCase
{
    public function testCountFee()
    {
        for ($i = 1000; $i <= 20000; $i++) {
            $xd = new LoanProposal($i);
            $this->assertIsFloat($xd->countFee(), 'must be of type float');
        }
    }
}
