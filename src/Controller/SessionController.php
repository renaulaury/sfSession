<?php

namespace App\Controller;

use App\Entity\Session;
use App\Form\SessionType;
use Doctrine\ORM\EntityManager;
use App\Repository\InternRepository;
use App\Repository\ModuleRepository;
use App\Repository\ProgramRepository;
use App\Repository\SessionRepository;
use App\Repository\TrainerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class SessionController extends AbstractController
{
    //Affiche liste sessions
    #[Route('/session', name: 'app_session')]

    public function index(SessionRepository $sessionRepo, TrainerRepository $trainerRepo): Response
    {

        $sessions = $sessionRepo->findAll();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    //Formulaire d'ajout
    #[Route('/session/addSession', name: 'app_addSession')]
    public function addSession(Request $request, EntityManagerInterface $entityManager): Response
    {
        $session = new Session;
        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $session = $form->getData();
            $entityManager->persist($session);
            $entityManager->flush();
            return $this->redirectToRoute('app_session');
        }

        return $this->render('session/addSession.html.twig', [
            'formSession' => $form,
        ]);
    }

    //Affiche le détail de la session
    #[Route('/session/detailSession/{id}', name: 'app_detailSession')]
    public function detailSession(Session $sessions, ProgramRepository $programRepo): Response
    {    
        $programs = $programRepo->findAll();

        return $this->render('session/detailSession.html.twig', [
            'sessions' => $sessions,
            'programs' => $programs
        ]);
    }

    #[Route('/session/editSession', name: 'app_editSession')]
    public function editSession(): Response
    {
        return $this->render('session/editSession.html.twig', [
        ]);
    }

    #[Route('/session/deleteSession', name: 'app_deleteSession')]
    public function deleteSession(): Response
    {
        return $this->render('session/deleteSession.html.twig', [
        ]);
    }
}
