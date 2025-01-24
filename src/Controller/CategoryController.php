<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(): Response
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    #[Route('/category/addCat', name: 'app_addCat')]
    public function addCat(): Response
    {
        return $this->render('category/addCat.html.twig', [
        ]);
    }

    #[Route('/category/editCat', name: 'app_editCat')]
    public function editCat(): Response
    {
        return $this->render('category/editCat.html.twig', [
        ]);
    }

    #[Route('/category/deleteCat', name: 'app_deleteCat')]
    public function deleteCat(): Response
    {
        return $this->render('category/deleteCat.html.twig', [
        ]);
    }
}
