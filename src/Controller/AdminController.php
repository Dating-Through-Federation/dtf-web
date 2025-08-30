<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted('admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin/users', name: 'app_admin_users')]
    #[IsGranted('admin')]
    public function usersList(EntityManagerInterface $em, UserRepository $repo): Response
    {
        $users = $repo->findAll();

        // dd($users);
        return $this->render('admin/users.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('/admin/users/{id}', name: 'app_admin_users_edit')]
    #[IsGranted('admin')]
    public function usersEdit(EntityManagerInterface $em, UserRepository $repo, User $id): Response
    {

        dd($id);

        return $this->render('admin/users.html.twig', [
            'user' => $id,
        ]);
    }
}
