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

    //Affiche le formulaire d'ajout
    #[Route('/trainer/addTrainer', name: 'app_addTrainer')]
    public function addTrainer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $trainer = new Trainer;
        $form = $this->createForm(TrainerType::class, $trainer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            return $this->redirectToRoute('app_trainer');
        }

        return $this->render('trainer/addTrainer.html.twig', [
           'formTrainer' => $form,
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
