<?php

namespace App\Event\Listener;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final readonly class UserEventListener implements EventSubscriberInterface
{

    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public static function getSubscribedEvents(): iterable
    {
        return [
            BeforeEntityUpdatedEvent::class =>  'hashPassword',
            BeforeEntityPersistedEvent::class => 'hashPassword'
        ];
    }

    public function hashPassword(BeforeEntityUpdatedEvent|BeforeEntityPersistedEvent $event): void
    {
        $instance = $event->getEntityInstance();

        if (!$instance instanceof User){
            return;
        }

        $instance->setPassword($this->passwordHasher->hashPassword($instance, $instance->getPassword()));
    }
}