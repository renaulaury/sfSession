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

    public function profilIntern(Intern $intern): Response
    {
        return $this->render('intern/profilIntern.html.twig', [
            'intern' => $intern,
        ]);
    }


    //Affiche le formulaire d'ajout
    // #[Route('/intern/addIntern', name: 'app_addIntern')]

    // public function addIntern(Request $request, EntityManagerInterface $entityManager): Response
    // {
    //     $intern = new Intern;
    //     $form = $this->createForm(InternType::class, $intern);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $intern = $form->getData();
    //         $entityManager->persist($intern);
    //         $entityManager->flush();
    //         return $this->redirectToRoute('app_intern');
    //     }

    //     return $this->render('intern/addIntern.html.twig', [
    //         'formIntern' => $form,
    //     ]);
    // }

    //Ajout et édition 
    #[Route('/intern/newIntern', name: 'add_intern')]
    #[Route('/intern/{id}/newIntern', name: 'edit_intern')]

    public function addEdit(Intern $intern = null, Request $request, EntityManagerInterface $entityManager): Response
    {
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
    #[Route('/intern/deleteIntern', name: 'app_deleteIntern')]
    public function deleteIntern(): Response
    {
        return $this->render('intern/deleteIntern.html.twig', [
        ]);
    }
}
