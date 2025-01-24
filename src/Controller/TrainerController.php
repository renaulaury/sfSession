<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrainerController extends AbstractController
{
    #[Route('/trainer', name: 'app_trainer')]
    public function index(): Response
    {
        return $this->render('trainer/index.html.twig', [
            'controller_name' => 'TrainerController',
        ]);
    }

    #[Route('/trainer/addTrainer', name: 'app_addTrainer')]
    public function addTrainer(): Response
    {
        return $this->render('trainer/addTrainer.html.twig', [
           
        ]);
    }

    #[Route('/trainer/editTrainer', name: 'app_editTrainer')]
    public function editTrainer(): Response
    {
        return $this->render('trainer/editTrainer.html.twig', [
           
        ]);
    }

    #[Route('/trainer/deleteTrainer', name: 'app_deleteTrainer')]
    public function deleteTrainer(): Response
    {
        return $this->render('trainer/deleteTrainer.html.twig', [
           
        ]);
    }
}
