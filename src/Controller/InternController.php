<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class InternController extends AbstractController
{
    #[Route('/intern', name: 'app_intern')]
    public function index(): Response
    {
        return $this->render('intern/index.html.twig', [
        ]);
    }

    #[Route('/intern/addIntern', name: 'app_addIntern')]
    public function addIntern(): Response
    {
        return $this->render('intern/addIntern.html.twig', [
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
