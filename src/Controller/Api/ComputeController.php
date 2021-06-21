<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\{Request, JsonResponse};
use App\Solver\{DivisionSolver, SumSolver, SoustractionSolver};

class ComputeController extends AbstractController
{

    public function __construct(
        private SumSolver $sumSolver,
        private SoustractionSolver $soustractionSolver,
        private DivisionSolver $divisionSolver
    ){}

    #[Route('/api/v1/compute', name: 'api_compute')]
    public function compute(Request $request): JsonResponse
    {
        if(null !== $expression = json_decode($request->getContent())?->expression) {
            $compute = $this->divisionSolver->solve($expression);
            $compute = $this->sumSolver->solve($compute);
            $compute = $this->soustractionSolver->solve($compute);
            return $this->json([
                'compute' => $compute
            ]);
        }
        
        return $this->json([
            'error' => 'No expression found'
        ]);
    }
}
