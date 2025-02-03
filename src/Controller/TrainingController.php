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

        if(!$training) {
            return $this->redirectToRoute('app_training');
        }
        
        return $this->render('training/detailTraining.html.twig', [
            'training' => $training,
        ]);
    }

    //Formulaire d'ajout et d'édition
    #[Route('/training/newTRaining', name: 'add_training')]
    #[Route('/training/{id}/newTraining', name: 'edit_training')]

    public function addTraining(Training $training = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        //ajout
        //request recup get et post - recup id dans url avec attributes
        if($request->attributes->get('id') && (!$training)) {
            return $this->redirectToRoute('app_training');
        }

        //edition
        if(!$training) {
            $training = new Training();
        }

        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $entityManager->persist($training);
            $entityManager->flush();
            return $this->redirectToRoute('app_training');
        }

        return $this->render('training/newTraining.html.twig', [
            'formTraining' => $form,
            'edit' => $training->getId(),
        ]);
    }

    
    #[Route('/training/deleteTraining', name: 'app_deleteTraining')]
    public function deleteTraining(): Response
    {
        return $this->render('training/deleteTraining.html.twig', [
        ]);
    }
}
