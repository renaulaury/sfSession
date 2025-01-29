<?php


// {

    //================Sessions dans une formation

    // #[Route('/formation/{id}/sessions', name: 'show_sessions')]
    // public function index(SessionRepository $sessionRepository, int $id): Response
    // {
    //     $sessions = $sessionRepository->findBy(['formation' => $id]);
        
    //     // Retour des informations a la vue
    //     return $this->render('session/index.html.twig', [
    //         'sessions' => $sessions
    //     ]);
    // } 

    //==============Details d'une session

    // #[Route('/session/{id}/details', name: 'detail_session')]
    // public function detailSession(Session $session, SessionRepository $sessionRepository): Response
    // {
    //     $nonInscrits = $sessionRepository->findNonInscrits($session->getId());
    //     $nonProgrammes = $sessionRepository->findNonProgramme($session->getId());
        
    //     $nbPlace = $session->getNbPlace();
    //     $stagiairesInscrits = $session->getStagiaires();
    //     $nbInscrits = count($stagiairesInscrits);
    //     $placesRestantes = $nbPlace - $nbInscrits;

        
    //     return $this->render('session/detailsession.html.twig', [
    //         'session' => $session,
    //         'nonInscrits' => $nonInscrits,
    //         'nonProgrammes' => $nonProgrammes,
    //         'placeRestantes' => $placesRestantes,
    //     ]);
    // }

    //==================Ajout et supression d'un stagiaire dans une session

    // #[Route('/session/{id}/details/add/{stagiaireId}', name: 'addStagToSession')]
    // public function AddStagToSession(Session $session, int $stagiaireId, SessionRepository $sessionRepo, StagiaireRepository $stagiaireRepo, EntityManagerInterface $em)
    // {
    //     $nbPlace = $session->getNbPlace();
    //     $stagiairesInscrits = $session->getStagiaires();
    //     $nbInscrits = count($stagiairesInscrits);
    //     $placesRestantes = $nbPlace - $nbInscrits;
        
    //     if($placesRestantes <= 0){
    //         $this->addFlash('error', 'Il n’y a plus de places disponibles');
    //         return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    //     }

    //     $stagiaire = $stagiaireRepo->find($stagiaireId);
        
    //     $session->addStagiaire($stagiaire);
    //     $em->persist($session);
    //     $em->flush();

    //     return $this->redirectToRoute('detail_session', ['id' => $session->getId()]);
    // }
    
    // #[Route('/session/{id}/details/remove/{stagiaireId}', name: 'removeStagToSession')]
    // public function removeStagToSession(int $id, int $stagiaireId, SessionRepository $sessionRepo, StagiaireRepository $stagiaireRepo, EntityManagerInterface $em)
    // {
    //     $stagiaire = $stagiaireRepo->find($stagiaireId);
    //     $session = $sessionRepo->find($id);
        
    //     $session->removeStagiaire($stagiaire);
    //     $em->persist($session);
    //     $em->flush();

    //     return $this->redirectToRoute('detail_session', ['id' => $id]);
    // }
    
    //==================Ajout et supression d'un module dans une session

    // #[Route('/session/{id}/details/addmodule/{moduleId}', name: 'addModuleToSession')]
    // public function addModuleToSession(int $id, int $moduleId, ModuleRepository $moduleRepo, SessionRepository $sessionRepo, EntityManagerInterface $em, Request $request)
    // {
    //     $session = $sessionRepo->find($id);
    //     $module = $moduleRepo->find($moduleId);
        
    //     if($request->request->get('nbJour') > 0) {

    //         $nbJour = $request->request->get('nbJour');
    //         $programme = new Programme();
    //         $programme->setModule($module);
    //         $programme->setSession($session);
    //         $programme->setNbJour($nbJour);
            
            

    //         $em->persist($programme);
    //         $em->flush();
    //     }
    //     return $this->redirectToRoute('detail_session', ['id' => $id]);
    // }
    

    // #[Route('/session/{id}/details/removemodule/{programmeId}', name: 'removeModuleToSession')]
    // public function removeModuleToSession(int $id, int $programmeId, ProgrammeRepository $programmeRepo, SessionRepository $sessionRepo, EntityManagerInterface $em)
    // {
    //     $session = $sessionRepo->find($id);
    //     $programme = $programmeRepo->find($programmeId);
        
    //     $em->remove($programme);
    //     $em->flush();

    //     return $this->redirectToRoute('detail_session', ['id' => $id]);
    // }
    
//     #[Route('/session/add', name: 'add_session')]
//     public function addSession(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
//     {
//         $form = $this->createForm(SessionType::class, $session);
//         $form->handleRequest($request);
//         if ($form->isSubmitted() && $form->isValid()) {
//             $session = $form->getData();
//             $entityManager->persist($session);
//             $entityManager->flush();

//             return $this->redirectToRoute('app_formation');
//         }

//         return $this->render('session/addsession.html.twig', [
//             'formAddSession' => $form
//         ]);
//     }

// }