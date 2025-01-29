<?php

namespace App\Controller;

use App\Entity\Intern;
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
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;

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
    public function detailSession(Session $session = null, SessionRepository $sessionRepo, ProgramRepository $programRepo, Intern $intern): Response
    {    
        $programs = $programRepo->findAll();
        $noRegistered = $sessionRepo->findNoRegistered($session->getId());
        $noProgrammed = $sessionRepo->findNoProgrammed($session->getId());

        return $this->render('session/detailSession.html.twig', [
            'session' => $session,
            'programs' => $programs,
            'intern' => $intern,
            'noRegistered' => $noRegistered,
            'noProgrammed' => $noProgrammed,
        ]);
    }
   
      //Supprime un stagiaire dans la session
      #[Route('/session/{sessionId}/detailSession/{internId}', name: 'removeInternToSession')]
      public function deleteInternToSession(SessionRepository $sessionRepo, InternRepository $internRepo, EntityManagerInterface $entityManager, int $sessionId, int $internId)
      {
          $session = $sessionRepo->find($sessionId); //Recup id session
          $intern = $internRepo->find($internId); //Recup id intern
          $session->removeIntern($intern); //suppr intern
  
          //Maj BDD
          $entityManager->persist($session);
          $entityManager->flush();
            
          return $this->redirectToRoute('app_session', ['id' => $sessionId]);
      }

      //Supprime un module dans la session
      #[Route('/session/{sessionId}/detailSession/{programId}', name: 'removeModuleToSession')]
      public function deleteModuleToSession(SessionRepository $sessionRepo, ProgramRepository $programRepo, EntityManagerInterface $entityManager, int $sessionId, int $programId)
      {
          $session = $sessionRepo->find($sessionId); //Recup id session
          $program = $programRepo->find($programId); //Recup id program
          $session->removeModule($program); //suppr module
  
          //Maj BDD
          $entityManager->persist($program);
          $entityManager->flush();
            
          return $this->redirectToRoute('app_session', ['id' => $sessionId]);
      }


    //Suppression     
    #[Route('/session/{id}/deleteSession', name: 'app_deleteSession')]
    public function deleteSession(Session $session, EntityManagerInterface $entityManager, int $sessionId): Response
    {
        $entityManager->remove($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_session', ['id' => $sessionId]);
    }

  
    
}
