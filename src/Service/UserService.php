<?php

declare(strict_types = 1);

namespace App\Service;

use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserService
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function createUser(string $email, string $password): User
    {
        $user = new User($email, $password);
        $user->setPassword($this->passwordHasher->hashPassword($user, $user->getPassword()));
        return $user;
    }
}