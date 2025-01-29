<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Entity\Module;
use App\Entity\Program;
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
use Symfony\Component\BrowserKit\Response as BrowserKitResponse;
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
    public function detailSession(Session $session = null, SessionRepository $sessionRepo, ProgramRepository $programRepo): Response
    {    
        $programs = $programRepo->findAll();
        $noRegistered = $sessionRepo->findNoRegistered($session->getId());
        $noProgrammed = $sessionRepo->findNoProgrammed($session->getId());

        return $this->render('session/detailSession.html.twig', [
            'session' => $session,
            'programs' => $programs,
            'noRegistered' => $noRegistered,
            'noProgrammed' => $noProgrammed,
        ]);
    }
   
      //Supprime un stagiaire dans la session
      #[Route('/session/{session}/removeInternToSession/{intern}', name: 'removeInternToSession')]
      public function deleteInternToSession(EntityManagerInterface $entityManager, Session $session, Intern $intern)
      {
          $session->removeIntern($intern); //suppr intern
  
          //Maj BDD
          $entityManager->persist($session);
          $entityManager->flush();
            
          return $this->redirectToRoute('app_detailSession', ['id' => $session->getId()]);
      }

      //Ajoute un stagiaire dans la session
      #[Route('/session/{session}/addInternToSession/{intern}', name: 'addInternToSession')]
    public function addInternToSession(Session $session, Intern $intern, InternRepository $internRepo, EntityManagerInterface $entityManager)
    {        
        $intern = $internRepo->find($intern->getId());
        
        $session->addIntern($intern);
        $entityManager->persist($session);
        $entityManager->flush();

        return $this->redirectToRoute('app_detailSession', ['id' => $session->getId()]);
    }

      //Supprime un module dans la session
      #[Route('/session/{session}/removeModuleToSession/{program}', name: 'removeModuleToSession')]
      public function deleteModuleToSession(EntityManagerInterface $entityManager, Session $session, Program $program)
      {
          $session->removeProgram($program); //suppr module
  
          //Maj BDD
          $entityManager->persist($program);
          $entityManager->flush();
            
          return $this->redirectToRoute('app_detailSession', ['id' => $session->getId()]);
      }

      //Ajoute un module dans la session
      #[Route('/session/{session}/addModuleToSession/{module}', name: 'addModuleToSession')]
      public function addModuleToSession(Session $session, Module $module, EntityManagerInterface $entityManager)
      {
        $nbDay = 1;

        $program = new Program();
        $program->setModule($module);
        $program->setSession($session);
        $program->setNbDay($nbDay);

        $entityManager->persist($program);
        $entityManager->flush();
  
        return $this->redirectToRoute('app_detailSession', [
            'id' => $session->getId(),
        ]);
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
