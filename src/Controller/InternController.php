<?php

namespace App\Controller;

use App\Entity\Intern;
use App\Form\InternType;
use App\Repository\InternRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Session;

final class InternController extends AbstractController
{
    //Affiche liste des stagiaires
    #[Route('/intern', name: 'app_intern')]
    public function index(InternRepository $internRepo): Response
    {
        $interns = $internRepo->findAll();

        return $this->render('intern/index.html.twig', [
            'interns' => $interns,
        ]);
    }

    //Affiche le profil perso
    #[Route('/intern/profilIntern/{id}', name: 'app_profilIntern')]

    public function profilIntern(Intern $intern, Session $session): Response
    {

        if(!$intern) {
            return $this->redirectToRoute('app_intern');
        }

        return $this->render('intern/profilIntern.html.twig', [
            'intern' => $intern,
            'session' => $session,
        ]);
    }

    //Ajout et édition 
    #[Route('/intern/newIntern', name: 'add_intern')]
    #[Route('/intern/{id}/newIntern', name: 'edit_intern')]

    public function addEditIntern(?Intern $intern, Request $request, EntityManagerInterface $entityManager): Response
    {
        //ajout
        //request recup get et post - recup id dans url avec attributes
        if($request->attributes->get('id') && (!$intern)) {
            return $this->redirectToRoute('app_intern');
        }

        //edition
        if(!$intern) {
            $intern = new Intern();
        }

        
        $form = $this->createForm(InternType::class, $intern);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            return $this->redirectToRoute('app_intern');
        }

        return $this->render('intern/newIntern.html.twig', [
            'formIntern' => $form,
            'edit' => $intern->getId(),
        ]);
    }


    //Suppression     
    #[Route('/intern/{id}/deleteIntern', name: 'app_deleteIntern')]
    public function deleteIntern(Intern $intern, EntityManagerInterface $entityManager): Response
    {

        if(!$intern) {
            return $this->redirectToRoute('app_intern');
        }

        $entityManager->remove($intern);
        $entityManager->flush();

        return $this->redirectToRoute('app_intern');
    }
}
