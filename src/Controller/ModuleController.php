<?php

namespace App\Controller;

use App\Repository\ModuleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $moduleRepo): Response
    {
        $modules = $moduleRepo->findAll();
        
        return $this->render('module/index.html.twig', [
            'modules' => $modules,
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
