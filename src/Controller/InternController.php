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
    #[Route('/intern', name: 'app_intern')]
    public function index(InternRepository $internRepo): Response
    {
        $interns = $internRepo->findAll();

        return $this->render('intern/index.html.twig', [
            'interns' => $interns,
        ]);
    }

    #[Route('/intern/addIntern', name: 'app_addIntern')]


    public function addIntern(Request $request, EntityManagerInterface $entityManager): Response
    {
        $intern = new Intern;
        $form = $this->createForm(InternType::class, $intern);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            return $this->redirectToRoute('app_intern');
        }

        return $this->render('intern/addIntern.html.twig', [
            'formIntern' => $form,
        ]);
    }

    #[Route('/intern/editIntern', name: 'app_editIntern')]
    public function editIntern(): Response
    {
        return $this->render('intern/editIntern.html.twig', [
        ]);
    }

    #[Route('/intern/deleteIntern', name: 'app_deleteIntern')]
    public function deleteIntern(): Response
    {
        return $this->render('intern/deleteIntern.html.twig', [
        ]);
    }
}
