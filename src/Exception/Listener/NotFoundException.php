<?php

declare(strict_types = 1);

namespace App\Exception\Listener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::EXCEPTION)]
class NotFoundException
{
    public function __invoke(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

        if (!$exception instanceof NotFoundHttpException){
            return;
        }

        $event->setResponse(new JsonResponse([
            'code' => 404,
            'message' => $exception->getMessage()
        ], 404));
    }
}