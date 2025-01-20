<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InternControlerController extends AbstractController
{
    #[Route('/intern/controler', name: 'app_intern_controler')]
    public function index(): Response
    {
        return $this->render('intern_controler/index.html.twig', [
            'controller_name' => 'InternControlerController',
        ]);
    }
}
