<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ModuleController extends AbstractController
{
    //Affiche liste modules
    #[Route('/module', name: 'app_module')]
    public function index(ModuleRepository $moduleRepo): Response
    {
        $modules = $moduleRepo->findAll();
        
        return $this->render('module/index.html.twig', [
            'modules' => $modules,
        ]);
    }

    //Formulaire d'ajout
    #[Route('/module/addModule', name: 'app_addModule')]
    public function addModule(Request $request, EntityManagerInterface $entityManager): Response
    {
        $module = new Module;
        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $module = $form->getData();
            $entityManager->persist($module);
            $entityManager->flush();
            return $this->redirectToRoute('app_module');
        }

        return $this->render('module/addModule.html.twig', [   
            'formModule' => $form,        
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
