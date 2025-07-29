<?php

namespace App\Security\Voter;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

final class AdminVoter extends Voter
{
    protected function supports(string $attribute, mixed $subject): bool
    {
        // dd($subject);
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, [User::TYPE_ADMIN]);
        // && $subject instanceof \App\Entity\Admin;
    }

    protected function voteOnAttribute(string $attribute, mixed $subject, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        if (User::TYPE_ADMIN === $user->getType()) {
            return true;
        }

        return false;
    }
}
