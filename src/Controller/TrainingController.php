<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainingController extends AbstractController
{
    #[Route('/training', name: 'app_training')]
    public function index(): Response
    {
        return $this->render('training/index.html.twig', [
            'controller_name' => 'TrainingController',
        ]);
    }

    #[Route('/training/addTraining', name: 'app_addTraining')]
    public function addTraining(): Response
    {
        return $this->render('training/addTraining.html.twig', [
        ]);
    }

    #[Route('/training/editTraining', name: 'app_editTraining')]
    public function editTraining(): Response
    {
        return $this->render('training/editTraining.html.twig', [
        ]);
    }

    #[Route('/training/deleteTraining', name: 'app_deleteTraining')]
    public function deleteTraining(): Response
    {
        return $this->render('training/deleteTraining.html.twig', [
        ]);
    }
}
