<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;

use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
            'categories' => $categories,
        ]);
    }

    #[Route('/category/income', name: 'app_category_income')]
    public function income(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy(['income_expense' => 'Income']);

        return $this->render('category/list.html.twig', [
            'categories' => $categories,
            'type' => 'Income',
        ]);
    }

    #[Route('/category/expense', name: 'app_category_expense')]
    public function expense(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findBy(['income_expense' => 'Expense']);

        return $this->render('category/list.html.twig', [
            'categories' => $categories,
            'type' => 'Expense',
        ]);
    }

    #[Route('/category/add', name: 'app_add_category')]
    public function add(Request $request, CategoryRepository $categoryRepository, EntityManagerInterface $entityManager): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category = $form->getData();
            $entityManager->persist($category);
            $entityManager->flush();
            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/add.html.twig', [
            'controller_name' => 'CategoryController',
            'form' => $form->createView(),
            'categories' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/update/{id}', name: 'app_category_update')]
    public function update(Category $category, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('app_category');
        }

        return $this->render('category/edit.html.twig', [
            'form' => $form->createView(),
            'category' => $category,
        ]);
    }
    #[Route('/category/delete/{id}', name: 'app_category_delete')]
    public function delete(Category $category, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($category);
        $entityManager->flush();

        return $this->redirectToRoute('app_category');
    }

    #[Route('/category/detail/{id}', name: 'app_category_detail')]
    public function detail(Category $category): Response
    {
        return $this->render('category/detail.html.twig', [
            'category' => $category,
        ]);
    }



}