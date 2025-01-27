<?php

namespace App\Controller;

use App\Entity\Training;
use App\Form\TrainingType;
use Doctrine\ORM\EntityManager;
use App\Repository\TrainingRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class TrainingController extends AbstractController
{
    //Affiche la liste des formations
    #[Route('/training', name: 'app_training')]
    public function index(TrainingRepository $trainingRepo): Response
    {

        $trainings = $trainingRepo->findAll();

        return $this->render('training/index.html.twig', [
            'trainings' => $trainings,
        ]);
    }

    //Affiche détail formation
    #[Route('/training/detailTraining/{id}', name: 'app_detailTraining')]
    public function detailTraining(Training $training): Response
    {

        return $this->render('training/detailTraining.html.twig', [
            'training' => $training,
        ]);
    }

    //Formulaire d'ajout
    #[Route('/training/addTraining', name: 'app_addTraining')]
    public function addTraining(Request $request, EntityManagerInterface $entityManager): Response
    {
        $intern = new Training;
        $form = $this->createForm(TrainingType::class, $intern);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            return $this->redirectToRoute('app_training');
        }

        return $this->render('training/addTraining.html.twig', [
            'formTraining' => $form,
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
