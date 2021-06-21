<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use App\Solver\{DivisionSolver, MultiplicationSolver, SumSolver, SubstractionSolver};

class ComputeController extends AbstractController
{

    public function __construct(
        private DivisionSolver $divisionSolver,
        private MultiplicationSolver $multiplicationSolver,
        private SumSolver $sumSolver,
        private SubstractionSolver $substractionSolver
    ){}

    #[Route('/api/v1/compute', name: 'api_compute')]
    public function compute(Request $request): JsonResponse
    {
        if(null !== $expression = json_decode($request->getContent())?->expression) {
            $compute = $this->divisionSolver->solve($expression);
            $compute = $this->multiplicationSolver->solve($compute);
            $compute = $this->sumSolver->solve($compute);
            $compute = $this->substractionSolver->solve($compute);

            return $this->json([
                'compute' => substr($compute, 0, 1) === '+' ? substr($compute, 1) : $compute
            ]);
        }
        
        return $this->json([
            'error' => 'No expression found'
        ]);
    }
}
