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
