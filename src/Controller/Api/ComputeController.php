<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use App\Services\Solver\{CalculatorInterface, Calculator};

class ComputeController extends AbstractController
{

    private CalculatorInterface $calculatorInterface;

    public function __construct() {
        $this->calculatorInterface = new Calculator();
    }

    #[Route('/api/v1/compute', name: 'api_compute')]
    public function compute(Request $request): JsonResponse
    {
        if(null !== $expression = json_decode($request->getContent())?->expression) 
            return $this->json(['compute' => $this->calculatorInterface->compute($expression)]);
        
        return $this->json(['compute' => 'No expression found']);
    }
}
