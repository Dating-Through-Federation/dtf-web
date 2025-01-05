<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProfileType::class, $this->getUser()->getProfile());

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($profile);
            $entityManager->flush();
        }

        return $this->render('profile/index.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/profile/{username}', name: 'app_profile_user')]
    public function indexUser(User $username): Response
    {
        dd($username);

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }
}
