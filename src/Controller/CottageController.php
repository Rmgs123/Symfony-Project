<?php

namespace App\Controller;

use App\Service\CottageCsvService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class CottageController extends AbstractController
{
    #[Route('/api/cottages', name: 'api_cottages_list', methods: ['GET'])]
    public function list(CottageCsvService $cottageService): JsonResponse
    {
        $cottages = $cottageService->getAllCottages();
        return $this->json($cottages);
    }
}
