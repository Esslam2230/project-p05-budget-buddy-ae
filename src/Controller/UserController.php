<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{
    #[Route('/user', name: 'app_index')]
    public function index(UsersRepository $usersRepository): Response
    {
        $users = $usersRepository->findAll();
        $user = new Users();
        $form = $this->createForm(UserType::class, $user);

        return $this->render('user/index.html.twig', [
            'users' => $users,
            'form' => $form->createView(), // now 'form' always exists
        ]);
    }


    #[Route('/user/detail/{id}', name: 'app_detail')]
    public function detail(UsersRepository $usersRepository, int $id): Response
    {
        $user = $usersRepository->find($id);

        return $this->render('user/detail.html.twig', [
            'f' => $user,
        ]);
    }


    #[Route('/user/insert', name: 'app_insert')]
    public function add(Request $request, UsersRepository $usersRepository, EntityManagerInterface $entityManager): Response
    {
        $user = new Users();

        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user = $form->getData();
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('app_index');

        }
        return $this->render('user/insert.html.twig', parameters: [
            'controller_name' => 'UserController',
            'form' => $form->createView(),
            'users' => $usersRepository->findAll(),
        ]);

    }


}