<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
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
