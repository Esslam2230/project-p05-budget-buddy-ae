<?php

namespace App\Controller;

use App\Form\TransactionType;
use App\Repository\TransactionRepository;
use App\Repository\UsersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TransactionController extends AbstractController
{
    #[Route('/transaction/insert', name: 'app_transaction_insert')]
    public function insert(Request $request,EntityManagerInterface $entityManager, UsersRepository $userRepository): Response
    {
        $form = $this->createForm(TransactionType::class);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $transaction = $form->getData();
            $entityManager->persist($transaction);
            $entityManager->flush();
            return $this->redirectToRoute('app_index');
        }
        return $this->render('transaction/insert.html.twig', [
            'form' => $form,
        ]);
    }
    #[Route('/transaction/{id}', name: 'app_transaction')]
    public function index(int $id, UsersRepository $userRepository): Response
    {
        return $this->render('transaction/index.html.twig', [
            'controller_name' => 'TransactionController',
            'user' => $userRepository->find($id),
        ]);
    }

    #[Route('/transaction/update/{id}', name: 'app_update')]
    public function update(int $id, EntityManagerInterface $entityManager, TransactionRepository $transactionRepository ,Request $request): Response
    {
        $t=$transactionRepository->find($id);
        $form = $this->createForm(TransactionType::class,$t);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            $transaction = $form->getData();
            $entityManager->persist($transaction);
            $entityManager->flush();
            return $this->redirectToRoute('app_index');
        }
        return $this->render('transaction/insert.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/transaction/delete/{id}', name: 'app_delete')]
    public function delete(int $id, EntityManagerInterface $entityManager, TransactionRepository $transactionRepository): Response
    {
        $e=$transactionRepository->find($id);
        $entityManager->remove($e);
        $entityManager->flush();
        return $this->redirectToRoute('app_index');

    }

    #[Route('/transaction/detail/{id}', name: 'app_transaction_detail')]
    public function tra(TransactionRepository $transactionRepository, int $id): Response
    {
        $detail = $transactionRepository->find($id);

        return $this->render('transaction/trans-detail.html.twig', [
            'd' => $detail,
        ]);
    }

    #[Route('/user/rapport/{id}', name: 'app_user_report')]
    public function userRapport(int $id, UsersRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        if (!$user) {
            throw $this->createNotFoundException('Gebruiker niet gevonden.');
        }

        $transactions = $user->getTransacties();

        $totalIncome = 0;
        $totalExpenses = 0;

        foreach ($transactions as $t) {
            $categoryType = strtolower($t->getCategory()->getIncomeExpense());
            // should be 'income' or 'expense'

            if ($categoryType === 'income') {
                $totalIncome += $t->getAmount();
            } elseif ($categoryType === 'expense') {
                $totalExpenses += $t->getAmount();
            }
        }

        $difference = $totalIncome - $totalExpenses;

        if ($difference < 0) {
            $advice = "Je geeft meer uit dan je verdient. Probeer te besparen! 🟥";
        } elseif ($difference < 200) {
            $advice = "Je spaart een beetje, maar er is ruimte voor verbetering. 🟨";
        } else {
            $advice = "Goed bezig! Je spaart netjes 💚";
        }

        return $this->render('transaction/rapport.html.twig', [
            'user' => $user,
            'inkomen' => $totalIncome,
            'uitgaven' => $totalExpenses,
            'verschil' => $difference,
            'advies' => $advice,
        ]);
    }

}

