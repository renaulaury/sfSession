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

    //Formulaire d'ajout et d'édition
    #[Route('/module/newModule', name: 'add_module')]
    #[Route('/module/{id}/newModule', name: 'edit_module')]

    public function addEditModule(Module $module = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$module) {
            $module = new Module();
            return $this->redirectToRoute('app_module');
        }


        $form = $this->createForm(ModuleType::class, $module);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $module = $form->getData();
            $entityManager->persist($module);
            $entityManager->flush();
            return $this->redirectToRoute('app_module');
        }

        return $this->render('module/newModule.html.twig', [   
            'formModule' => $form,      
            'edit' => $module->getId(),  
        ]);
    }

     //Suppression     
     #[Route('/module/{id}/deleteModule', name: 'app_deleteModule')]
     public function deleteModule(Module $module, EntityManagerInterface $entityManager): Response
     {
        if(!$module) {
            return $this->redirectToRoute('app_module');
        }

         $entityManager->remove($module);
         $entityManager->flush();
 
         return $this->redirectToRoute('app_module');
     }
}
