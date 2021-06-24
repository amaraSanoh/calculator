<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use App\Solver\Calculator;

class ComputeController extends AbstractController
{

    public function __construct(private Calculator $calculator){}

    #[Route('/api/v1/compute', name: 'api_compute')]
    public function compute(Request $request): JsonResponse
    {
        if(null !== $expression = json_decode($request->getContent())?->expression) 
            return $this->json(['compute' => $this->calculator->compute($expression)]);
        
        return $this->json(['compute' => 'No expression found']);
    }
}
