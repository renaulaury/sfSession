<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CategoryController extends AbstractController
{
    //Afficher la liste des catégories
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $catRepo ): Response
    {

        $categories = $catRepo->findAll();

        return $this->render('category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    // Affiche le formulaire d'ajout
    #[Route('/category/addCat', name: 'app_addCat')]
    public function addCat(Request $request, EntityManagerInterface $entityManager): Response
    {

        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $intern = $form->getData();
            $entityManager->persist($intern);
            $entityManager->flush();
            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/addCat.html.twig', [
            'formCategory' => $form,
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
