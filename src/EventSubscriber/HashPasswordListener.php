<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class HashPasswordListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function hashPassword(User $user)
    {
        if (!$user->getPlainPassword()) {
            return;
        }

        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            $user->getPlainPassword()
        );
        $user->setPassword($hashedPassword);
    }
}
