<?php

namespace App\Controller;

use App\Form\AmountForLoanType;
use App\Model\LoanProposal;
use App\Interface\FeeCalculator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController implements FeeCalculator
{
    public function __construct(){}

    #[Route('/', name: 'app_main')]
    public function index(Request $request): Response
    {
        $form = $this->createForm(AmountForLoanType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $dataForm = $form->getData();

            if ($dataForm['amount'] >= 1000 && $dataForm['amount'] <= 20000) {
                $application = new LoanProposal($dataForm['amount']);
                $fee = $this->calculate($application);
            } else {
                $fee = 'Podana wartość przekracza założenia zadania !!!';
            }
        }


        return $this->render('main/index.html.twig', [
            'form' => $form->createView(),
            'fee' => $fee ?? 'Tutaj zobaczysz koszt pożyczki'
        ]);
    }

    public function calculate(LoanProposal $application): float
    {
        return $application->countFee();
    }
}
