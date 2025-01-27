<?php

namespace App\Controller;

use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController
{
    //Affiche liste sessions
    #[Route('/session', name: 'app_session')]

    public function index(SessionRepository $sessionRepo): Response
    {

        $sessions = $sessionRepo->findAll();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions,
        ]);
    }

    #[Route('/session/addSession', name: 'app_addSession')]
    public function addSession(): Response
    {
        return $this->render('session/addSession.html.twig', [
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
