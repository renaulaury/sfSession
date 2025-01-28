<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Category;
use App\Form\CategoryType;
use App\Repository\CategoryRepository;
use App\Repository\ModuleRepository;
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

    // Affiche le formulaire d'ajout et d'édition
    #[Route('/intern/newCat', name: 'add_cat')]
    #[Route('/category/{id}/newCat', name: 'edit_cat')]

    public function addEditCat(Category $category = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$category) {
            $category = new Category();
        }

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/newCat.html.twig', [
            'formCategory' => $form,
            'edit' => $category->getId(),
        ]);
    }

    //Affiche le détail des catégories
    #[Route('/category/detailCat/{id}', name: 'app_detailCat')]
    public function detailCat(Category $category, ModuleRepository $moduleRepo, $id): Response
    {

        $modules = $moduleRepo->findBy(['category' => $id]);

        return $this->render('category/detailCat.html.twig', [
            'category' => $category,
            'modules' => $modules,
        ]);
    }

    //Suppression
    #[Route('/categorie/{id}/deleteCat', name: 'app_deleteCat')]
    public function deleteCategorie(Category $category, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('app_category');
    }

   
}
