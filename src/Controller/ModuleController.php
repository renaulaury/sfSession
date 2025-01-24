<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(): Response
    {
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
        ]);
    }

    #[Route('/module/addModule', name: 'app_addModule')]
    public function addModule(): Response
    {
        return $this->render('module/addModule.html.twig', [           
        ]);
    }

    #[Route('/module/editModule', name: 'app_editModule')]
    public function editModule(): Response
    {
        return $this->render('module/editModule.html.twig', [
        ]);
    }

    #[Route('/module/deleteModule', name: 'app_deleteModule')]
    public function deleteModule(): Response
    {
        return $this->render('module/deleteModule.html.twig', [
        ]);
    }
}
