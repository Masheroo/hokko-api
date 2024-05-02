<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Service\UserService;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

final class UserFixtures extends Fixture
{
    public function __construct(
        private UserService $service
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $admin = $this->service->createUser('admin@admin.admin', 'admin123');
        $admin->setRoles([User::ROLE_ADMIN]);
        $manager->persist($admin);

        $user = $this->service->createUser('user@user.user', 'password123');
        $manager->persist($user);

        $manager->flush();
    }
}
