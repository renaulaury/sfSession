<?php

namespace App\Controller;

use App\Entity\Trainer;
use App\Form\TrainerType;
use App\Repository\TrainerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TrainerController extends AbstractController
{
    // Affiche liste compléte des formateurs
    #[Route('/trainer', name: 'app_trainer')]
    public function index(TrainerRepository $trainerRepo): Response
    {

        $trainers = $trainerRepo->findAll();

        return $this->render('trainer/index.html.twig', [
            'trainers' => $trainers,
        ]);
    }

    //Affiche le profil d'un formateur
    #[Route('/trainer/profilTrainer/{id}', name: 'app_profilTrainer')]

    public function profilTrainer(Trainer $trainer): Response
    {

        return $this->render('trainer/profilTrainer.html.twig', [
           'trainer' => $trainer,
        ]);
    }

    //Affiche le formulaire d'ajout et d'édition
    #[Route('/trainer/newTrainer', name: 'add_trainer')]
    #[Route('/trainer/{id}/newTrainer', name: 'edit_trainer')]
    public function addEditTrainer(Trainer $trainer = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        //ajout
        //request recup get et post - recup id dans url avec attributes
        if($request->attributes->get('id') && (!$trainer)) {
            return $this->redirectToRoute('app_trainer');
        }

        //edition
        if(!$trainer) {
            $trainer = new Trainer();
        }

        $form = $this->createForm(TrainerType::class, $trainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $trainer = $form->getData();
            $entityManager->persist($trainer);
            $entityManager->flush();
            return $this->redirectToRoute('app_trainer');
        }

        return $this->render('trainer/newTrainer.html.twig', [
           'formTrainer' => $form,
           'edit' => $trainer->getId(),
        ]);
    }

    
     //Suppression     
     #[Route('/trainer/{id}/deleteTrainer', name: 'app_deleteTrainer')]
     public function deleteTrainer(Trainer $trainer, EntityManagerInterface $entityManager): Response
     {

        if(!$trainer) {
            return $this->redirectToRoute('app_trainer');
        }

         $entityManager->remove($trainer);
         $entityManager->flush();
 
         return $this->redirectToRoute('app_trainer');
     }
}
